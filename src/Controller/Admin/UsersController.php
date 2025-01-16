<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

use Cake\View\JsonView;
use Cake\View\XmlView;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Http\ServerRequest;

use AuditStash\Meta\ApplicationMetadata;
use Cake\Event\EventManager;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();
		$this->loadComponent('UserLogs');
		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
		//$this->addViewClasses(['csv' => 'CsvView.Csv']);
	}

	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->Authentication->allowUnauthenticated(['registration']);
	}

	public function index()
	{
		$user_group = $this->Authentication->getIdentity('user_group_id')->getIdentifier('user_group_id');
		if ($user_group == 1) {
			$this->set('title', 'User Management');
			$this->paginate = [
				//'contain' => ['UserGroups'],
				'maxLimit' => 10,
			];
			$query = $this->Users->find('search', search: $this->request->getQueryParams())
				->contain(['UserGroups'])
				//->where(['title IS NOT' => null])
			;
			$users = $this->paginate($query);


			//count
			$this->set('total_users', $this->Users->find()->count());
			$this->set('total_users_archived', $this->Users->find()->where(['status' => 2])->count());
			$this->set('total_users_active', $this->Users->find()->where(['status' => 1])->count());
			$this->set('total_users_disabled', $this->Users->find()->where(['status' => 0])->count());

			$query = $this->Users->find();

			$expectedMonths = [];
			for ($i = 11; $i >= 0; $i--) {
				$expectedMonths[] = date('M-Y', strtotime("-$i months"));
			}

			$query->select([
				'count' => $query->func()->count('*'),
				'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
				'month' => 'MONTH(created)',
				'year' => 'YEAR(created)'
			])
				->where([
					'created >=' => date('Y-m-01', strtotime('-11 months')),
					'created <=' => date('Y-m-t')
				])
				->groupBy(['year', 'month'])
				->orderBy(['year' => 'ASC', 'month' => 'ASC']);

			$results = $query->all()->toArray();

			$totalUserByMonth = [];
			foreach ($expectedMonths as $expectedMonth) {
				$found = false;
				$count = 0;

				foreach ($results as $result) {
					if ($expectedMonth === $result->date) {
						$found = true;
						$count = $result->count;
						break;
					}
				}

				$totalUserByMonth[] = [
					'month' => $expectedMonth,
					'count' => $count
				];
			}

			$this->set([
				'results' => $totalUserByMonth,
				'_serialize' => ['results']
			]);

			// JSON arrays
			$totalUserByMonth = json_encode($totalUserByMonth);
			$dataArray = json_decode($totalUserByMonth, true);
			$monthArray = [];
			$countArray = [];
			foreach ($dataArray as $data) {
				$monthArray[] = $data['month'];
				$countArray[] = $data['count'];
			}

			$this->set(compact('users', 'monthArray', 'countArray'));
			//$this->set('users', $this->paginate($query));
		} else {
			$this->Flash->error(__('Not allowed'));
			return $this->redirect($this->referer());
		}
	}



	public function registration()
	{
		$this->set('title', 'User Registration');
		$user = $this->Users->newEmptyEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'register']);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('The user has been saved.'));

				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
		$this->set(compact('user', 'userGroups'));
	}

	public function profile($slug = null)
	{
		$this->set('title', 'Account Details');

		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups', 'AuditLogs'])
			->firstOrFail();

		/* $user = $this->Users->get($id, [
            ->contain(['UserGroups'])
        ]); */

		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
				//$log->setMetaInfo($log->getMetaInfo() + ['slug' => $user]);

			}
		});
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account details updated'));
				return $this->redirect($this->referer());
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
		$this->set(compact('user', 'userGroups'));
	}

	public function update($slug = null, $id = null)
	{
		$this->set('title', 'Update Profile');

		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups', 'AuditLogs'])
			->firstOrFail();
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account details updated'));
				return $this->redirect($this->referer());
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
		$this->set(compact('user', 'userGroups'));
	}

	public function removeAvatar($slug = null)
	{
		$this->set('title', 'Remove Profile Picture');

		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account details updated'));
				//return $this->redirect($this->referer());
				return $this->redirect(['action' => 'profile', $user->slug]);
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
		$this->set(compact('user', 'userGroups', 'auditLogs'));
	}

	public function changePassword($slug = null)
	{
		$this->set('title', 'Change Password');
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();

		//$userSlug = $this->Auth->user('slug');

		/* if($slug != $userSlug){
				$this->Flash->error(__('You are not authorized to view'));
				return $this->redirect(['action' => 'profile', $this->Auth->user('slug')]);
		} */

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'password']);

			if ($this->Users->save($user)) {
				$this->Flash->success(__('Your password has been updated.'));

				return $this->redirect(['action' => 'profile', $user->slug]);
			}
			$this->Flash->error(__('Your password could not be update. Please, try again.'));
		}
		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
		$this->set(compact('user', 'userGroups'));
	}

	public function activity($slug = null)
	{
		$this->set('title', 'User Activities');

		$user = $this->Users
			->findBySlug($slug)
			->contain([
				'UserGroups',
				'AuditLogs' => function ($q) {
					return $q->order(['AuditLogs.created' => 'DESC'])->limit(5); // Limit to 5 auditlog 
				}
			])
			->limit(5)
			->firstOrFail();

		$userLogs = $this->fetchTable('UserLogs')->find(
			'all',
			limit: 5,
			order: 'UserLogs.created DESC'
		)
			->all();
		/* $this->userLogs = $this->fetchTable('userLogs');
		$userLogs = $this->fetchTable('userLogs');
		$userLogs = $this->userLogs->find('all')
			->where(['user_id' => $user->id])
			->limit(10)
			->orderBy(['created' => 'DESC']); */


		$this->set(compact('user', 'userLogs'));

		//$this->set(compact('user', 'userGroups'));
	}

	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false);
		//$user = $this->Users->find();
		$user = $this->Users->find()
			->contain(['UserGroups'])
			//->where(['title IS NOT' => null])
		;
		$users = $this->paginate($user);

		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true,
				'filename' => 'User_List.pdf'
			]
		);
		//$this->set('user', $user);
		$this->set(compact('users'));
	}

	public function pdfProfile($slug = null)
	{
		$this->viewBuilder()->enableAutoLayout(false);
		//$user = $this->Users->get($slug);
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
		//debug($user);
		//exit;
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, // This can be omitted if "filename" is specified.
				'filename' => 'User_' . $slug . '.pdf' //// This can be omitted if you want file name based on URL.
			]
		);
		$this->set('user', $user);
	}

	public function auditTrail($slug = null)
	{
		$this->set('title', 'Audit Trail');



		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups', 'AuditLogs'])
			->firstOrFail();

		$this->fetchTable('AuditLogs');
		$this->AuditLogs = $this->fetchTable('AuditLogs');

		$auditLogs = $this->AuditLogs->find('all')
			->where([
				'primary_key' => $user->id,
				//'category_id' => '1',
			])
			->order(['created' => 'ASC'])
			->limit(10);

		/* $query = $this->AuditLogs->find('all');
		$AuditLog = $this->paginate($query); */

		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
		$this->set(compact('user', 'userGroups', 'auditLogs'));
	}



	public function activate($slug = null)
	{
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			$user->status = 1;
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account has been activated'));
				return $this->redirect($this->referer());
			}
			$this->Flash->error(__('Cannot activate. Please, try again.'));
		}
	}

	public function disable($slug = null)
	{
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			$user->status = 0;
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account has been disabled'));
				return $this->redirect($this->referer());
			}
			$this->Flash->error(__('Cannot disable. Please, try again.'));
		}
	}

	public function adminVerify($slug = null)
	{
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			$user->is_email_verified = 1;
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account has been verified'));
				return $this->redirect($this->referer());
			}
			$this->Flash->error(__('Cannot verified. Please, try again.'));
		}
	}

	public function archived($slug = null)
	{
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
			$user->status = 2;
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Account has been verified'));
				return $this->redirect($this->referer());
			}
			$this->Flash->error(__('Cannot verified. Please, try again.'));
		}
	}


	public function csv()
	{
		$data = $this->Users->find();
		$header = ['ID', 'Group ID', 'Fullname', 'Email', 'Created', 'Modified'];
		$extract = ['id', 'user_group_id', 'fullname', 'email', 'created', 'modified'];

		$this->set(compact('data'));
		$this->viewBuilder()
			->setClassName('CsvView.Csv')
			->setOptions([
				'serialize' => 'data',
				'header' => $header,
				'extract' => $extract,
			]);
	}

	public function json()
	{
		$this->viewBuilder()->enableAutoLayout(false);
		$users = $this->paginate('Users');
		$this->set(compact('users'));
	}
}

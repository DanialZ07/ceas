<?php

declare(strict_types=1);

namespace App\Controller;

use Authentication\IdentityInterface;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class DashboardsController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();
	}

	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		//$this->Authentication->allowUnauthenticated(['view']);
	}
	public function index()
	{
		$this->set('title', 'Dashboard');

		//count user
		$users = $this->fetchTable('Users');
		$total_user = $users->find()->all()->count();
		$active_user = $users->find()->where(['status' => 1])->count();
		$user_percent = $active_user * 100 / $total_user;

		//count contact
		$contacts = $this->fetchTable('Contacts');
		$total_contact = $contacts->find()->all()->count();
		$pending_contact = $contacts->find()->where(['status' => 0])->count();
		if ($pending_contact == 0) {
			$pending_contact_percent = 0;
		} else
			$pending_contact_percent = $pending_contact * 100 / $total_contact;

		//count auditlog
		$auditLogs = $this->fetchTable('AuditLogs');
		$total_auditlog = $auditLogs->find()->all()->count();

		//count to do task
		$todos = $this->fetchTable('Todos');
		$total_todo = $todos->find()->all()->count();
		$pending_todo = $todos->find()->where(['status' => 'Pending'])->count();
		$pending_todo_percent = $pending_todo * 100 / $total_todo;

		//to do task list
		$todo_list = $todos->find('all')
			->where(['status IN' => ['Pending', 'In Progress']])
			->limit(5)
			->orderBy(['created' => 'DESC']);

		//count FAQ
		$faqs = $this->fetchTable('Faqs');
		$total_faq = $faqs->find()->all()->count();
		$pending_faq = $faqs->find()->where(['status' => 1])->count();
		$pending_faq_percent = $pending_faq * 100 / $total_faq;

		//get current authenticate user
		$userdetail = $this->request->getAttribute('identity');
		$userID = $userdetail->id;

		$userLogs = $this->fetchTable('UserLogs');
		//publish activity user (for module)
		$userLogs = $userLogs->find('all')
			->where(['user_id' => $userID])
			->limit(5)
			->orderBy(['created' => 'DESC']);

		//count all user activities and group by date for heatmap
		$userLogsTable = TableRegistry::getTableLocator()->get('UserLogs');
		$query = $userLogsTable->find();
		$query->select([
			'count' => $query->func()->count('*'),
			'date' => $query->func()->date_format(['created' => 'identifier', "%Y-%m-%d"])
		])
			->groupBy(['date']);

		$results = $query->all()->toArray();

		$formattedResults = [];
		foreach ($results as $result) {
			$formattedResults[] = [
				'date' => $result->date,
				'count' => $result->count
			];
		}

		$this->set([
			'results' => $formattedResults,
			'_serialize' => ['results']
		]);

		//count all user activities and group by month for bar chart
		$query = $userLogsTable->find();
		$query->select([
			'count' => $query->func()->count('*'),
			'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"])
		])
			->groupBy(['month' => 'MONTH(created)']);

		//$results = $query->all()->toArray();

		$totalActivityByMonth = [];
		foreach ($results as $result) {
			$totalActivityByMonth[] = [
				'month' => $result->date,
				'count' => $result->count
			];
		}

		$this->set([
			'results' => $totalActivityByMonth,
			'_serialize' => ['results']
		]);

		$this->set(compact('total_user', 'total_contact', 'total_auditlog', 'total_todo', 'user_percent', 'pending_todo_percent', 'pending_faq_percent', 'pending_contact_percent', 'userLogs', 'formattedResults', 'totalActivityByMonth', 'todo_list'));
	}
}

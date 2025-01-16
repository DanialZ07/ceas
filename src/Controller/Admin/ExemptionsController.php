<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * Exemptions Controller
 *
 * @property \App\Model\Table\ExemptionsTable $Exemptions
 */
class ExemptionsController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
	}

	/*public function viewClasses(): array
    {
        return [JsonView::class];
		return [JsonView::class, XmlView::class];
    }*/
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('exemptions', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'exemptions');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('exemptions.csv');
		$exemptions = $this->Exemptions->find();
		$_serialize = 'exemptions';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('exemptions', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
        $this->paginate = [
            'contain' => ['Students', 'Faculties', 'Programs', 'Campuses'],
			'maxLimit' => 10,
        ];
		$exemptions = $this->paginate($this->Exemptions);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'exemptions_List.pdf' 
			]
		);
		$this->set(compact('exemptions'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'Exemptions List');
		$this->paginate = [
			'maxLimit' => 10,
        ];
        $query = $this->Exemptions->find('search', search: $this->request->getQueryParams())
            ->contain(['Students', 'Faculties', 'Programs', 'Campuses']);
			//->where(['title IS NOT' => null])
        $exemptions = $this->paginate($query);
		
		//count
		$this->set('total_exemptions', $this->Exemptions->find()->count());
		$this->set('total_exemptions_archived', $this->Exemptions->find()->where(['status' => 2])->count());
		$this->set('total_exemptions_active', $this->Exemptions->find()->where(['status' => 1])->count());
		$this->set('total_exemptions_disabled', $this->Exemptions->find()->where(['status' => 0])->count());
		
		//Count By Month
		$this->set('january', $this->Exemptions->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->Exemptions->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->Exemptions->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->Exemptions->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->Exemptions->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->Exemptions->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->Exemptions->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->Exemptions->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->Exemptions->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->Exemptions->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->Exemptions->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->Exemptions->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

		$query = $this->Exemptions->find();

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

        $totalByMonth = [];
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

            $totalByMonth[] = [
                'month' => $expectedMonth,
                'count' => $count
            ];
        }

        $this->set([
            'results' => $totalByMonth,
            '_serialize' => ['results']
        ]);

        //data as JSON arrays for report chart
        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);
        $monthArray = [];
        $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $this->set(compact('exemptions', 'monthArray', 'countArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Exemption id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'Exemptions Details');
        $exemption = $this->Exemptions->get($id, contain: ['Students', 'Faculties', 'Programs', 'Campuses']);
        $this->set(compact('exemption'));

        $this->set(compact('exemption'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Exemptions');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Exemptions']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $exemption = $this->Exemptions->newEmptyEntity();
        if ($this->request->is('post')) {
            $exemption = $this->Exemptions->patchEntity($exemption, $this->request->getData());
            if ($this->Exemptions->save($exemption)) {
                $this->Flash->success(__('The exemption has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exemption could not be saved. Please, try again.'));
        }
        $students = $this->Exemptions->Students->find('list', ['limit' => 200])->all();
        $faculties = $this->Exemptions->Faculties->find('list', ['limit' => 200])->all();
        $programs = $this->Exemptions->Programs->find('list', ['limit' => 200])->all();
        $campuses = $this->Exemptions->Campuses->find('list', ['limit' => 200])->all();
        $this->set(compact('exemption', 'students', 'faculties', 'programs', 'campuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Exemption id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Exemptions Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Exemptions']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $exemption = $this->Exemptions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exemption = $this->Exemptions->patchEntity($exemption, $this->request->getData());
            if ($this->Exemptions->save($exemption)) {
                $this->Flash->success(__('The exemption has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exemption could not be saved. Please, try again.'));
        }
		$students = $this->Exemptions->Students->find('list', limit: 200)->all();
		$faculties = $this->Exemptions->Faculties->find('list', limit: 200)->all();
		$programs = $this->Exemptions->Programs->find('list', limit: 200)->all();
		$campuses = $this->Exemptions->Campuses->find('list', limit: 200)->all();
        $this->set(compact('exemption', 'students', 'faculties', 'programs', 'campuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Exemption id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Exemptions']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $exemption = $this->Exemptions->get($id);
        if ($this->Exemptions->delete($exemption)) {
            $this->Flash->success(__('The exemption has been deleted.'));
        } else {
            $this->Flash->error(__('The exemption could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'Exemptions Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Exemptions']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $exemption = $this->Exemptions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exemption = $this->Exemptions->patchEntity($exemption, $this->request->getData());
			$exemption->status = 2; //archived
            if ($this->Exemptions->save($exemption)) {
                $this->Flash->success(__('The exemption has been archived.'));

				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The exemption could not be archived. Please, try again.'));
        }
        $this->set(compact('exemption'));
    }
}

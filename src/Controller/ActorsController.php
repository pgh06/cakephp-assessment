<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Actors Controller
 *
 */
class ActorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Actors->find();
        $actors = $this->paginate($query);

        $this->set(compact('actors'));
    }

    /**
     * View method
     *
     * @param string|null $id Actor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $actor = $this->Actors->get($id, contain: []);
        $this->set(compact('actor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $actor = $this->Actors->newEmptyEntity();
        if ($this->request->is('post')) {
            $actor = $this->Actors->patchEntity($actor, $this->request->getData());
            if ($this->Actors->save($actor)) {
                $this->Flash->success(__('The actor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        }
        $this->set(compact('actor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Actor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $actor = $this->Actors->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $actor = $this->Actors->patchEntity($actor, $this->request->getData());
            if ($this->Actors->save($actor)) {
                $this->Flash->success(__('The actor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        }
        $this->set(compact('actor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Actor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $actor = $this->Actors->get($id);
        if ($this->Actors->delete($actor)) {
            $this->Flash->success(__('The actor has been deleted.'));
        } else {
            $this->Flash->error(__('The actor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function movies()
    {
        $searchTerm = trim((string)$this->request->getQuery('name'));

        $query = $this->Actors->find()->contain(['Movies']);

        if ($searchTerm) {
            $query = $query->where(function ($exp) use ($searchTerm) {
                return $exp->like('Actors.name', '%' . $searchTerm . '%');
            });
        }

        $actors = $this->paginate($query);
        $this->set(compact('actors'));
    }

    /**
     * Search method
     */
    public function search()
    {
        $searchTerm = trim((string)$this->request->getQuery('q'));
        $searchResults = [];

        if (!empty($searchTerm)) {
            try {
                $http = new \Cake\Http\Client();

                $apiKey = $this->getConfig('TMDB.api_key');
                $response = $http->get($this->getConfig('TMDB.url'), [
                    'api_key' => $apiKey,
                    'query' => $searchTerm,
                    'language' => 'en-US',
                    'include_adult' => 'false',
                ]);

                if ($response->isOk()) {
                    $data = $response->getJson();
                    $searchResults = $data['results'] ?? [];
                } else {
                    // get error message
                }
            } catch (\Exception $e) {
                $this->Flash->error(__('Unable to fetch search results at the moment.'));
            }
        }

        $this->set(compact('searchResults', 'searchTerm'));
    }

    private function getConfig(string $path)
    {
        return \Cake\Core\Configure::read($path);
    }
}

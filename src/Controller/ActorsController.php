<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use App\Model\Table\ActorsTable;

/**
 * @property ActorsTable $Actors
 */
class ActorsController extends AppController
{
    public function index(): void
    {
        $query = $this->Actors->find();
        $actors = $this->paginate($query);
        $this->set(compact('actors'));
    }

    public function view(string $id): void
    {
        $actor = $this->Actors->get($id, contain: []);
        $this->set(compact('actor'));
    }

    public function add(): Response
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
        return $this->getResponse();
    }

    public function edit(string $id): Response
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
        return $this->getResponse();
    }

    public function delete(string $id): Response
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

    public function movies(): void
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

    public function search(): void
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
                    $this->response = $this->response->withStatus(404);
                }
            } catch (\Exception $e) {
                $this->Flash->error(__('Unable to fetch search results at the moment.'));
            }
        }

        $this->set(compact('searchResults', 'searchTerm'));
    }

    private function getConfig(string $path): mixed
    {
        return \Cake\Core\Configure::read($path);
    }
}

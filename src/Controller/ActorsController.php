<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\TmdbService;
use Cake\Core\Configure;
use Cake\Http\Response;
use Exception;

/**
 * @property \App\Model\Table\ActorsTable $Actors
 * @property \App\Model\Table\MoviesTable $Movies
 */
class ActorsController extends AppController
{
    /**
     * List all actors with pagination.
     *
     * @return void
     */
    public function index(): void
    {
        $query = $this->Actors->find();
        $actors = $this->paginate($query);
        $this->set(compact('actors'));
    }

    /**
     * View details of a specific actor by id.
     *
     * @param string $id Actor id
     * @return void
     */
    public function view(string $id): void
    {
        $actor = $this->Actors->get($id, contain: []);
        $this->set(compact('actor'));
    }

    /**
     * Add a new actor record.
     *
     * @return \Cake\Http\Response Redirects on successful add, renders view otherwise
     */
    public function add(): Response
    {
        $actor = $this->Actors->newEmptyEntity();
        if ($this->request->is('post')) {
            $actor = $this->Actors->patchEntity($actor, $this->request->getData());
            if ($this->Actors->save($actor)) {
                $this->Flash->success(__('The actor has been saved.'));

                return $this->redirect(['action' => 'index']) ?? $this->getResponse();
            }
            $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        }

        $this->set(compact('actor'));

        return $this->render();
    }

    /**
     * Edit an existing actor record.
     *
     * @param string $id Actor id
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise
     */
    public function edit(string $id): Response
    {
        $actor = $this->Actors->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $actor = $this->Actors->patchEntity($actor, $this->request->getData());

            if ($this->Actors->save($actor)) {
                $this->Flash->success(__('The actor has been saved.'));

                return $this->redirect(['action' => 'index']) ?? $this->getResponse();
            }

            $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        }

        $this->set(compact('actor'));

        return $this->render();
    }

    /**
     * Delete an actor record.
     *
     * @param string $id Actor id
     * @return \Cake\Http\Response Redirects to index after delete attempt
     */
    public function delete(string $id): Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $actor = $this->Actors->get($id);
        if ($this->Actors->delete($actor)) {
            $this->Flash->success(__('The actor has been deleted.'));
        } else {
            $this->Flash->error(__('The actor could not be deleted. Please, try again.'));
        }

        return $this->render();
    }

    /**
     * Gets actor's movie records.
     *
     * @return void
     */
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

    /**
     * Searches TMDB database for actors.
     *
     * @return void
     */
    public function search(): void
    {
        $searchTerm = trim((string)$this->request->getQuery('q'));
        $searchResults = [];

        if (!empty($searchTerm)) {
            try {
                $service = new TmdbService();
                $searchResults = $service->searchPerson(
                    $searchTerm,
                    $this->getConfig('TMDB.url'),
                    $this->getConfig('TMDB.api_key'),
                );
            } catch (Exception $e) {
                $this->Flash->error(__('Unable to fetch search results.'));
            }
        }

        $this->set(compact('searchResults', 'searchTerm'));
    }

    /**
     * Gets config setting value.
     *
     * @return mixed
     */
    private function getConfig(string $path): mixed
    {
        return Configure::read($path);
    }
}

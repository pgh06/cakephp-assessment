<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use App\Model\Table\ActorsTable;

/**
 * Controller for managing Actors.
 *
 * Provides actions to list, view, add, edit, delete, and search actors.
 *
 * @property ActorsTable $Actors The Actors table instance
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
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        }

        $this->set(compact('actor'));
        return $this->getResponse();
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
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        }

        $this->set(compact('actor'));
        return $this->getResponse();
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

        return $this->redirect(['action' => 'index']);
    }
}

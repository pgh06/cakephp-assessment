<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\MoviesTable;
use Cake\Http\Response;

/**
 * Controller for managing Movies.
 *
 * Provides actions to list, view, add, edit, and delete movie records.
 *
 * @property MoviesTable $Movies The Movies table instance
 */
class MoviesController extends AppController
{
    /**
     * List all movies with pagination.
     *
     * @return void
     */
    public function index(): void
    {
        $query = $this->Movies->find();
        $movies = $this->paginate($query);
        $this->set(compact('movies'));
    }

    /**
     * View details of a specific movie by id.
     *
     * @param string $id Movie id
     * @return void
     */
    public function view(string $id): void
    {
        $movie = $this->Movies->get($id, contain: []);
        $this->set(compact('movie'));
    }

    /**
     * Add a new movie record.
     *
     * @return \Cake\Http\Response Redirects on successful add, renders view otherwise
     */
    public function add(): Response
    {
        $movie = $this->Movies->newEmptyEntity();
        if ($this->request->is('post')) {
            $movie = $this->Movies->patchEntity($movie, $this->request->getData());
            if ($this->Movies->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));
                return $this->redirect(['action' => 'index']) ?? $this->getResponse();
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }
        $this->set(compact('movie'));
        return $this->render();
    }

    /**
     * Edit an existing movie record.
     *
     * @param string $id Movie id
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise
     */
    public function edit(string $id): Response
    {
        $movie = $this->Movies->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movie = $this->Movies->patchEntity($movie, $this->request->getData());
            if ($this->Movies->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));
                return $this->redirect(['action' => 'index']) ?? $this->getResponse();
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }
        $this->set(compact('movie'));
        return $this->render();
    }

    /**
     * Delete a movie record.
     *
     * @param string $id Movie id
     * @return \Cake\Http\Response Redirects to index after delete attempt
     */
    public function delete(string $id): Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $movie = $this->Movies->get($id);
        if ($this->Movies->delete($movie)) {
            $this->Flash->success(__('The movie has been deleted.'));
        } else {
            $this->Flash->error(__('The movie could not be deleted. Please, try again.'));
        }
        return $this->render();
    }
}

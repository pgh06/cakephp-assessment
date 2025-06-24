<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

/**
 * Controller for managing Movies.
 *
 * @property \App\Model\Table\MoviesTable $Movies
 */
class MoviesController extends AppController
{
    /**
     * Lists all movies with pagination.
     *
     * @return void
     */
    public function index(): void
    {
        $movies = $this->paginate($this->Movies->find());
        $this->set(compact('movies'));
    }

    /**
     * Shows details for a specific movie.
     *
     * @param string $id Movie ID.
     * @return void
     */
    public function view(string $id): void
    {
        $movie = $this->Movies->get($id);
        $this->set(compact('movie'));
    }

    /**
     * Adds a new movie record.
     *
     * Processes form data unconditionally, attempts to save a new movie,
     * and handles success or failure feedback with redirects and flash messages.
     *
     * @return \Cake\Http\Response
     */
    public function add(): Response
    {
        $movie = $this->Movies->newEmptyEntity();

        $movie = $this->Movies->patchEntity($movie, $this->request->getData());

        if ($this->Movies->save($movie)) {
            $this->Flash->success(__('The movie has been saved.'));

            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        $this->set(compact('movie'));

        return $this->render();
    }

    /**
     * Edits an existing movie record.
     *
     * Loads the movie by ID, processes form data unconditionally,
     * attempts to save updates, and handles feedback and redirects.
     *
     * @param string $id Movie ID.
     * @return \Cake\Http\Response
     */
    public function edit(string $id): Response
    {
        $movie = $this->Movies->get($id);

        $movie = $this->Movies->patchEntity($movie, $this->request->getData());

        if ($this->Movies->save($movie)) {
            $this->Flash->success(__('The movie has been updated.'));

            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('The movie could not be updated. Please, try again.'));
        $this->set(compact('movie'));

        return $this->render();
    }

    /**
     * Deletes a movie record.
     *
     * Only allows POST or DELETE requests.
     * Attempts to delete the movie by ID, sets flash message,
     * then redirects to the index page.
     *
     * @param string $id Movie ID.
     * @return \Cake\Http\Response
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

        return $this->redirect(['action' => 'index']);
    }
}

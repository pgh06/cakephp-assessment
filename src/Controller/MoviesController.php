<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use App\Model\Table\MoviesTable;

/**
 * @property MoviesTable $Movies
 */
class MoviesController extends AppController
{
    // Only renders a view, never redirects: return void
    public function index(): void
    {
        $query = $this->Movies->find();
        $movies = $this->paginate($query);
        $this->set(compact('movies'));
    }

    // Only renders a view, never redirects: return void
    public function view(string $id): void
    {
        $movie = $this->Movies->get($id, contain: []);
        $this->set(compact('movie'));
    }

    // May redirect, so return Response and always return a Response object
    public function add(): Response
    {
        $movie = $this->Movies->newEmptyEntity();
        if ($this->request->is('post')) {
            $movie = $this->Movies->patchEntity($movie, $this->request->getData());
            if ($this->Movies->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }

        $this->set(compact('movie'));
        return $this->getResponse();
    }

    // May redirect, so return Response and always return a Response object
    public function edit(string $id): Response
    {
        $movie = $this->Movies->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movie = $this->Movies->patchEntity($movie, $this->request->getData());
            if ($this->Movies->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }

        $this->set(compact('movie'));
        return $this->getResponse();
    }

    // May redirect, so return Response and always return a Response object
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

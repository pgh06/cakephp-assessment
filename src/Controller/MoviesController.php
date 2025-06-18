<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use Fig\Http\Message\StatusCodeInterface;
use App\Model\Table\MoviesTable;

/**
 * @property MoviesTable $Movies
 */
class MoviesController extends AppController
{
    public function index(): Response|null
    {
        $query = $this->Movies->find();
        $movies = $this->paginate($query);
        $this->set(compact('movies'));

        return null;
    }

    public function view(?string $id = null): Response|null
    {
        $movie = $this->Movies->get($id, contain: []);
        $this->set(compact('movie'));

        return null;
    }

    public function add(): Response|null
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
        return null;
    }

    public function edit(?string $id = null): Response|null
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
        return null;
    }

    public function delete(?string $id = null): Response
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

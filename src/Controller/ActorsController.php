<?php
declare(strict_types=1);

namespace App\Controller;

use App\Factory\TmdbServiceFactory;
use App\Service\TmdbService;
use Cake\Core\Configure;
use Cake\Http\Response;
use Exception;

/**
 * Controller for managing Actors.
 *
 * @property \App\Model\Table\ActorsTable $Actors
 */
class ActorsController extends AppController
{
    private TmdbService $tmdbService;

    /**
     * Initialize TMDB service via factory.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->tmdbService = TmdbServiceFactory::create();
    }

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
     * View details of a specific actor by ID.
     *
     * @param string $id Actor ID.
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
     * Processes form data unconditionally, attempts to save a new actor,
     * sets success or error flash messages, and redirects accordingly.
     *
     * @return \Cake\Http\Response
     */
    public function add(): Response
    {
        $actor = $this->Actors->newEmptyEntity();

        $actor = $this->Actors->patchEntity($actor, $this->request->getData());

        if ($this->Actors->save($actor)) {
            $this->Flash->success(__('The actor has been saved.'));

            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        $this->set(compact('actor'));

        return $this->render();
    }

    /**
     * Edit an existing actor record.
     *
     * Loads the actor by ID, patches with form data unconditionally,
     * attempts to save changes, and handles success/error feedback.
     *
     * @param int $id Actor ID.
     * @return \Cake\Http\Response
     */
    public function edit(int $id): Response
    {
        $actor = $this->Actors->get($id, contain: []);

        $actor = $this->Actors->patchEntity($actor, $this->request->getData());

        if ($this->Actors->save($actor)) {
            $this->Flash->success(__('The actor has been saved.'));

            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('The actor could not be saved. Please, try again.'));
        $this->set(compact('actor'));

        return $this->render();
    }

    /**
     * Delete an actor record.
     *
     * Only accepts POST or DELETE requests.
     * Attempts to delete the actor and redirects with flash message.
     *
     * @param int $id Actor ID.
     * @return \Cake\Http\Response
     */
    public function delete(int $id): Response
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

    /**
     * List actors with their movies.
     *
     * Supports optional 'name' query param for filtering actors by name.
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
     * Search TMDB API for actors by name.
     *
     * Uses the TMDB service to search persons and sets results for the view.
     *
     * @return void
     */
    public function search(): void
    {
        $searchTerm = trim((string)$this->request->getQuery('q'));
        $searchResults = [];

        if (!empty($searchTerm)) {
            try {
                $searchResults = $this->tmdbService->searchPerson(
                    $searchTerm,
                    Configure::read('TMDB.url'),
                    Configure::read('TMDB.api_key'),
                );
            } catch (Exception $e) {
                $this->Flash->error(__('Unable to fetch search results.'));
            }
        }

        $this->set(compact('searchResults', 'searchTerm'));
    }
}

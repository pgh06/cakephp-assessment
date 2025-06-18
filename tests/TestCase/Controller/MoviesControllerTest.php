<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\MoviesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\MoviesController Test Case
 *
 * @uses \App\Controller\MoviesController
 */
class MoviesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Movies',
        'app.Actors',
        'app.ActorsMovies',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\MoviesController::index()
     */
    public function testIndex(): void
    {
        
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\MoviesController::view()
     */
    public function testView(): void
    {
        
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\MoviesController::add()
     */
    public function testAdd(): void
    {
        
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\MoviesController::edit()
     */
    public function testEdit(): void
    {
        
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\MoviesController::delete()
     */
    public function testDelete(): void
    {
        
    }
}

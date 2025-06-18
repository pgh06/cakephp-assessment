<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ActorsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ActorsController Test Case
 *
 * @uses \App\Controller\ActorsController
 */
class ActorsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Actors',
        'app.Movies',
        'app.ActorsMovies',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\ActorsController::index()
     */
    public function testIndex(): void
    {
        
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\ActorsController::view()
     */
    public function testView(): void
    {
        
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\ActorsController::add()
     */
    public function testAdd(): void
    {
        
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\ActorsController::edit()
     */
    public function testEdit(): void
    {
        
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\ActorsController::delete()
     */
    public function testDelete(): void
    {
        
    }
}

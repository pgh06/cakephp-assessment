<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ActorsMoviesFixture extends TestFixture
{
    public $import = ['table' => 'actors_movies'];

    public function init(): void
    {
        $this->records = [
            ['actor_id' => 1, 'movie_id' => 1],
            // add more sample records as needed for your tests...
        ];
        parent::init();
    }
}

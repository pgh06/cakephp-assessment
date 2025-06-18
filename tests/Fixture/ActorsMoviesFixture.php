<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ActorsMoviesFixture extends TestFixture
{
    public $import = ['table' => 'actors_movies']; // optionally import schema

    public function init(): void
    {
        $this->records = [
            [
                'actor_id' => 1,
                'movie_id' => 1,
                'created' => '2025-06-18 12:00:00',
                'modified' => '2025-06-18 12:00:00',
            ],
        ];
        parent::init();
    }
}

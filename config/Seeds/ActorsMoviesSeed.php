<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * ActorsMovies seed.
 */
class ActorsMoviesSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [];

        for ($actorId = 1; $actorId <= 10; $actorId++) {
            for ($movieOffset = 1; $movieOffset <= 3; $movieOffset++) {
                $movieId = ($actorId - 1) * 3 + $movieOffset; // set new row of base movie_id and then increment movie id per actor
                $data[] = [
                    'actor_id' => $actorId,
                    'movie_id' => $movieId,
                ];
            }
        }

        $table = $this->table('actors_movies');
        $table->insert($data)->save();
    }
}

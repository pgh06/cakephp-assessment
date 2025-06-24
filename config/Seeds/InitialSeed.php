<?php
declare(strict_types=1);

use Migrations\BaseSeed;

class InitialSeed extends BaseSeed
{
    public function run(): void
    {
        // Reset tables
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->execute('TRUNCATE TABLE actors;');
        $this->execute('TRUNCATE TABLE movies;');
        $this->execute('TRUNCATE TABLE actors_movies;');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');

        // Insert Actors
        $this->table('actors')->insert([
            ['id' => 1, 'name' => 'Will Smith', 'date_of_birth' => '1968-09-25'],
            ['id' => 2, 'name' => 'Tom Hanks',  'date_of_birth' => '1956-07-09'],
        ])->save();

        // Insert Movies
        $this->table('movies')->insert([
            ['id' => 1, 'name' => 'Men in Black',        'release_date' => '2000-01-01'],
            ['id' => 2, 'name' => 'Independence Day',    'release_date' => '2001-01-01'],
            ['id' => 3, 'name' => 'Ali',                 'release_date' => '2002-01-01'],
            ['id' => 4, 'name' => 'Forrest Gump',        'release_date' => '2003-01-01'],
            ['id' => 5, 'name' => 'Cast Away',           'release_date' => '2004-01-01'],
            ['id' => 6, 'name' => 'Saving Private Ryan', 'release_date' => '2005-01-01'],
        ])->save();

        // Insert Actor-Movie relationships
        $this->table('actors_movies')->insert([
            ['actor_id' => 1, 'movie_id' => 1],
            ['actor_id' => 1, 'movie_id' => 2],
            ['actor_id' => 1, 'movie_id' => 3],
            ['actor_id' => 2, 'movie_id' => 4],
            ['actor_id' => 2, 'movie_id' => 5],
            ['actor_id' => 2, 'movie_id' => 6],
        ])->save();
    }
}

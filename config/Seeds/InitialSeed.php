<?php
declare(strict_types=1);

use Migrations\BaseSeed;

class InitialSeed extends BaseSeed
{
    public function run(): void
    {
        // Reset tables for clean seed
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->execute('TRUNCATE TABLE actors;');
        $this->execute('TRUNCATE TABLE movies;');
        $this->execute('TRUNCATE TABLE actors_movies;');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');

        // 1) Insert Actors
        $actors = [
            ['name' => 'Will Smith',         'date_of_birth' => '1968-09-25'],
            ['name' => 'Tom Hanks',          'date_of_birth' => '1956-07-09'],
            ['name' => 'Chris Evans',        'date_of_birth' => '1981-06-13'],
            ['name' => 'Tom Cruise',         'date_of_birth' => '1962-07-03'],
            ['name' => 'Mark Ruffalo',       'date_of_birth' => '1967-11-22'],
            ['name' => 'Scarlett Johansson', 'date_of_birth' => '1984-11-22'],
            ['name' => 'Natalie Portman',    'date_of_birth' => '1981-06-09'],
            ['name' => 'Robert Downey Jr.',  'date_of_birth' => '1965-04-04'],
            ['name' => 'Jennifer Lawrence',  'date_of_birth' => '1990-08-15'],
            ['name' => 'Leonardo DiCaprio',  'date_of_birth' => '1974-11-11'],
        ];
        $this->table('actors')->insert($actors)->save();

        // 2) Insert Movies (3 per actor)
        $sampleTitles = [
            // Will Smith
            'Men in Black', 'Independence Day', 'Ali',
            // Tom Hanks
            'Forrest Gump', 'Cast Away', 'Saving Private Ryan',
            // Chris Evans
            'Captain America: The First Avenger', 'Snowpiercer', 'Gifted',
            // Tom Cruise
            'Top Gun', 'Mission: Impossible', 'Jerry Maguire',
            // Mark Ruffalo
            'The Avengers', 'Shutter Island', 'Spotlight',
            // Scarlett Johansson
            'Lost in Translation', 'Black Swan', 'Thor',
            // Natalie Portman
            'Black Swan', 'V for Vendetta', 'Closer',
            // Robert Downey Jr.
            'Iron Man', 'Sherlock Holmes', 'Avengers: Endgame',
            // Jennifer Lawrence
            'The Hunger Games', 'Silver Linings Playbook', 'X-Men: First Class',
            // Leonardo DiCaprio
            'Inception', 'The Revenant', 'Titanic',
        ];
        $movies = [];
        $releaseYear = 1996;
        foreach ($actors as $index => $actorData) {
            for ($i = 0; $i < 3; $i++) {
                $titleIndex = $index * 3 + $i;
                $movies[] = [
                    'name'         => $sampleTitles[$titleIndex],
                    'release_date' => ($releaseYear + $titleIndex) . '-01-01',
                ];
            }
        }
        $this->table('movies')->insert($movies)->save();

        // 3) Insert into join table
        $actorsMovies = [];
        foreach ($actors as $index => $actorData) {
            $actorId = $index + 1;
            for ($i = 0; $i < 3; $i++) {
                $movieId = $index * 3 + $i + 1;
                $actorsMovies[] = [
                    'actor_id' => $actorId,
                    'movie_id' => $movieId,
                ];
            }
        }
        $this->table('actors_movies')->insert($actorsMovies)->save();
    }
}

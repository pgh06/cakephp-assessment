<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Actors seed.
 */
class ActorsSeed extends BaseSeed
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
        $data = [
            ['name' => 'Will Smith', 'date_of_birth' => '1968-09-25'],
            ['name' => 'Tom Hanks', 'date_of_birth' => '1956-07-09'],
            ['name' => 'Chris Evans', 'date_of_birth' => '1981-06-13'],
            ['name' => 'Tom Cruise', 'date_of_birth' => '1962-07-03'],
            ['name' => 'Mark Ruffalo', 'date_of_birth' => '1967-11-22'],
            ['name' => 'Scarlett Johansson', 'date_of_birth' => '1984-11-22'],
            ['name' => 'Natalie Portman', 'date_of_birth' => '1981-06-09'],
            ['name' => 'Robert Downey Jr.', 'date_of_birth' => '1965-04-04'],
            ['name' => 'Jennifer Lawrence', 'date_of_birth' => '1990-08-15'],
            ['name' => 'Leonardo DiCaprio', 'date_of_birth' => '1974-11-11'],
        ];

        $table = $this->table('actors');
        $table->insert($data)->save();
    }
}

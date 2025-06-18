<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Movies seed.
 */
class MoviesSeed extends BaseSeed
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
            // 10 actors * 3 movies each = 30 movies total, but let's create unique movie names
            ['name' => 'Men in Black', 'release_year' => 1997],
            ['name' => 'Independence Day', 'release_year' => 1996],
            ['name' => 'Ali', 'release_year' => 2001],

            ['name' => 'Forrest Gump', 'release_year' => 1994],
            ['name' => 'Cast Away', 'release_year' => 2000],
            ['name' => 'Saving Private Ryan', 'release_year' => 1998],

            ['name' => 'Captain America: The First Avenger', 'release_year' => 2011],
            ['name' => 'Snowpiercer', 'release_year' => 2013],
            ['name' => 'Gifted', 'release_year' => 2017],

            ['name' => 'Top Gun', 'release_year' => 1986],
            ['name' => 'Mission: Impossible', 'release_year' => 1996],
            ['name' => 'Jerry Maguire', 'release_year' => 1996],

            ['name' => 'The Avengers', 'release_year' => 2012],
            ['name' => 'Shutter Island', 'release_year' => 2010],
            ['name' => 'Spotlight', 'release_year' => 2015],

            ['name' => 'Lost in Translation', 'release_year' => 2003],
            ['name' => 'Black Swan', 'release_year' => 2010],
            ['name' => 'Thor', 'release_year' => 2011],

            ['name' => 'Iron Man', 'release_year' => 2008],
            ['name' => 'Sherlock Holmes', 'release_year' => 2009],
            ['name' => 'Avengers: Endgame', 'release_year' => 2019],

            ['name' => 'The Hunger Games', 'release_year' => 2012],
            ['name' => 'Silver Linings Playbook', 'release_year' => 2012],
            ['name' => 'X-Men: First Class', 'release_year' => 2011],

            ['name' => 'Inception', 'release_year' => 2010],
            ['name' => 'The Revenant', 'release_year' => 2015],
            ['name' => 'Titanic', 'release_year' => 1997],
        ];

        $table = $this->table('movies');
        $table->insert($data)->save();
    }
}

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
            ['name' => 'Men in Black', 'release_date' => '1997-07-02'],
            ['name' => 'Independence Day', 'release_date' => '1996-07-03'],
            ['name' => 'Ali', 'release_date' => '2001-12-25'],

            ['name' => 'Forrest Gump', 'release_date' => '1994-07-06'],
            ['name' => 'Cast Away', 'release_date' => '2000-12-22'],
            ['name' => 'Saving Private Ryan', 'release_date' => '1998-07-24'],

            ['name' => 'Captain America: The First Avenger', 'release_date' => '2011-07-22'],
            ['name' => 'Snowpiercer', 'release_date' => '2013-08-01'],
            ['name' => 'Gifted', 'release_date' => '2017-04-07'],

            ['name' => 'Top Gun', 'release_date' => '1986-05-16'],
            ['name' => 'Mission: Impossible', 'release_date' => '1996-05-22'],
            ['name' => 'Jerry Maguire', 'release_date' => '1996-12-13'],

            ['name' => 'The Avengers', 'release_date' => '2012-05-04'],
            ['name' => 'Shutter Island', 'release_date' => '2010-02-19'],
            ['name' => 'Spotlight', 'release_date' => '2015-11-06'],

            ['name' => 'Lost in Translation', 'release_date' => '2003-09-12'],
            ['name' => 'Black Swan', 'release_date' => '2010-12-17'],
            ['name' => 'Thor', 'release_date' => '2011-05-06'],

            ['name' => 'Iron Man', 'release_date' => '2008-05-02'],
            ['name' => 'Sherlock Holmes', 'release_date' => '2009-12-25'],
            ['name' => 'Avengers: Endgame', 'release_date' => '2019-04-26'],

            ['name' => 'The Hunger Games', 'release_date' => '2012-03-23'],
            ['name' => 'Silver Linings Playbook', 'release_date' => '2012-11-16'],
            ['name' => 'X-Men: First Class', 'release_date' => '2011-06-03'],

            ['name' => 'Inception', 'release_date' => '2010-07-16'],
            ['name' => 'The Revenant', 'release_date' => '2015-12-25'],
            ['name' => 'Titanic', 'release_date' => '1997-12-19'],
        ];

        $table = $this->table('movies');
        $table->insert($data)->save();
    }
}

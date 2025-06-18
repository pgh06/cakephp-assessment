<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActorsFixture
 */
class ActorsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'date_of_birth' => '2025-06-18',
                'created' => '2025-06-18 11:54:04',
                'modified' => '2025-06-18 11:54:04',
            ],
        ];
        parent::init();
    }
}

<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateActors extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('actors');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('date_of_birth', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}

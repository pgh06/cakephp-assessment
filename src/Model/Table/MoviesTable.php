<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Table\ActorsTable;

/**
 * Movies Model
 *
 * @property \App\Model\Table\ActorsTable&\Cake\ORM\Association\BelongsToMany $Actors
 */
class MoviesTable extends Table
{
    /**
     * Initialization hook method.
     *
     * Use this method to define table configuration, behaviors,
     * associations, and other setup tasks.
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('movies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany(ActorsTable::class, [
            'foreignKey' => 'movie_id',
            'targetForeignKey' => 'actor_id',
            'joinTable' => 'actors_movies',
        ]);
    }

    /**
     * Default validation rules.
     *
     * Defines validation rules to apply when saving movie entities.
     * Checks that the 'name' field is a non-empty string up to 255 characters,
     * and 'release_date' is a non-empty valid date.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator The configured validator.
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('release_date')
            ->requirePresence('release_date', 'create')
            ->notEmptyDate('release_date');

        return $validator;
    }
}

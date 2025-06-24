<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Table\MoviesTable;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actors Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsToMany $Movies
 */
class ActorsTable extends Table
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

        $this->setTable('actors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany(MoviesTable::class, [
            'foreignKey' => 'actor_id',
            'targetForeignKey' => 'movie_id',
            'joinTable' => 'actors_movies',
        ]);
    }

    /**
     * Default validation rules.
     *
     * Defines validation rules to apply when saving actor entities.
     * Checks that the 'name' field is a non-empty string up to 255 characters,
     * and 'date_of_birth' is a non-empty valid date.
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
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmptyDate('date_of_birth');

        return $validator;
    }
}

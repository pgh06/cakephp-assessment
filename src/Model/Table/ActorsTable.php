<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actors Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsToMany $Movies
 *
 * @method \App\Model\Entity\Actor newEmptyEntity()
 * @method \App\Model\Entity\Actor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Actor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Actor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Actor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Actor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Actor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Actor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Actor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Actor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Actor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Actor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Actor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Actor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Actor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Actor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Actor> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ActorsTable extends Table
{
    /**
     * Initialize method
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

        $this->belongsToMany('Movies', [
            'foreignKey' => 'actor_id',
            'targetForeignKey' => 'movie_id',
            'joinTable' => 'actors_movies',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
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

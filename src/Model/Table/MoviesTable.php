<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Movies Model
 *
 * @property \App\Model\Table\ActorsTable&\Cake\ORM\Association\BelongsToMany $Actors
 *
 * @method \App\Model\Entity\Movie newEmptyEntity()
 * @method \App\Model\Entity\Movie newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Movie> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Movie get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Movie findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Movie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Movie> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Movie|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Movie saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Movie>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Movie>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Movie>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Movie> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Movie>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Movie>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Movie>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Movie> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MoviesTable extends Table
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

        $this->setTable('movies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Actors', [
            'foreignKey' => 'movie_id',
            'targetForeignKey' => 'actor_id',
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
            ->date('release_date')
            ->requirePresence('release_date', 'create')
            ->notEmptyDate('release_date');

        return $validator;
    }
}

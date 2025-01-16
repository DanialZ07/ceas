<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Campuses Model
 *
 * @property \App\Model\Table\ExemptionsTable&\Cake\ORM\Association\HasMany $Exemptions
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\HasMany $Students
 *
 * @method \App\Model\Entity\Campus newEmptyEntity()
 * @method \App\Model\Entity\Campus newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Campus> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Campus get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Campus findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Campus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Campus> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Campus|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Campus saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Campus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Campus>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Campus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Campus> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Campus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Campus>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Campus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Campus> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CampusesTable extends Table
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

        $this->setTable('campuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Exemptions', [
            'foreignKey' => 'campus_id',
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'campus_id',
        ]);
		$this->addBehavior('AuditStash.AuditLog');
		$this->addBehavior('Search.Search');
		$this->searchManager()
			->value('id')
				->add('search', 'Search.Like', [
					//'before' => true,
					//'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '|',
					'comparison' => 'LIKE',
					'wildcardAny' => '*',
					'wildcardOne' => '?',
					'fields' => ['id'],
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
            ->integer('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }
}

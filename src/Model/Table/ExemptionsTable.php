<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exemptions Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\FacultiesTable&\Cake\ORM\Association\BelongsTo $Faculties
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\CampusesTable&\Cake\ORM\Association\BelongsTo $Campuses
 *
 * @method \App\Model\Entity\Exemption newEmptyEntity()
 * @method \App\Model\Entity\Exemption newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Exemption> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Exemption get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Exemption findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Exemption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Exemption> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Exemption|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Exemption saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Exemption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exemption>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exemption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exemption> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exemption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exemption>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Exemption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Exemption> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExemptionsTable extends Table
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

        $this->setTable('exemptions');
        $this->setDisplayField('matrix');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Faculties', [
            'foreignKey' => 'faculty_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Campuses', [
            'foreignKey' => 'campus_id',
            'joinType' => 'INNER',
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
            ->integer('student_id')
            ->notEmptyString('student_id');

        $validator
            ->integer('faculty_id')
            ->notEmptyString('faculty_id');

        $validator
            ->integer('program_id')
            ->notEmptyString('program_id');

        $validator
            ->integer('semester_id')
            ->requirePresence('semester_id', 'create')
            ->notEmptyString('semester_id');

        $validator
            ->integer('campus_id')
            ->notEmptyString('campus_id');

        $validator
            ->scalar('matrix')
            ->maxLength('matrix', 15)
            ->requirePresence('matrix', 'create')
            ->notEmptyString('matrix');

        $validator
            ->scalar('ic_number')
            ->maxLength('ic_number', 20)
            ->requirePresence('ic_number', 'create')
            ->notEmptyString('ic_number');

        $validator
            ->scalar('kod_kursus_dipohon')
            ->maxLength('kod_kursus_dipohon', 10)
            ->requirePresence('kod_kursus_dipohon', 'create')
            ->notEmptyString('kod_kursus_dipohon');

        $validator
            ->scalar('nama_kursus_dipohon')
            ->maxLength('nama_kursus_dipohon', 255)
            ->requirePresence('nama_kursus_dipohon', 'create')
            ->notEmptyString('nama_kursus_dipohon');

        $validator
            ->scalar('kod_terdahulu')
            ->maxLength('kod_terdahulu', 10)
            ->requirePresence('kod_terdahulu', 'create')
            ->notEmptyString('kod_terdahulu');

        $validator
            ->scalar('nama_kursus_terdahulu')
            ->maxLength('nama_kursus_terdahulu', 255)
            ->requirePresence('nama_kursus_terdahulu', 'create')
            ->notEmptyString('nama_kursus_terdahulu');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['student_id'], 'Students'), ['errorField' => 'student_id']);
        $rules->add($rules->existsIn(['faculty_id'], 'Faculties'), ['errorField' => 'faculty_id']);
        $rules->add($rules->existsIn(['program_id'], 'Programs'), ['errorField' => 'program_id']);
        $rules->add($rules->existsIn(['campus_id'], 'Campuses'), ['errorField' => 'campus_id']);

        return $rules;
    }
}

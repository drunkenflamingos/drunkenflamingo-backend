<?php
declare(strict_types=1);

namespace App\Model\Table;


use App\Model\Entity\HomeworksAssignment;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HomeworksAssignments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBies
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBies
 * @property \Cake\ORM\Association\BelongsTo $Assignments
 * @property \Cake\ORM\Association\BelongsTo $Homeworks
 *
 * @method HomeworksAssignment get($primaryKey, $options = [])
 * @method HomeworksAssignment newEntity($data = null, array $options = [])
 * @method HomeworksAssignment[] newEntities(array $data, array $options = [])
 * @method HomeworksAssignment|bool save(EntityInterface $entity, $options = [])
 * @method HomeworksAssignment patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method HomeworksAssignment[] patchEntities($entities, array $data, array $options = [])
 * @method HomeworksAssignment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class HomeworksAssignmentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');
        $this->addBehavior('CreatedModifiedBy');
        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by_id' => 'new',
                    'modified_by_id' => 'always',
                ],
            ],
            'propertiesMap' => [
                'created_by_id' => '_footprint.id',
                'modified_by_id' => '_footprint.id',
            ],
        ]);


        $this->belongsTo('Assignments', [
            'foreignKey' => 'assignment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Homeworks', [
            'foreignKey' => 'homework_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['assignment_id'], 'Assignments'));
        $rules->add($rules->existsIn(['homework_id'], 'Homeworks'));

        return $rules;
    }
}

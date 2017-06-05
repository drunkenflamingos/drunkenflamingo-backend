<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Behavior\CreatedModifiedByBehavior;
use App\Model\Entity\Answer;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Answers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Assignments
 * @property \Cake\ORM\Association\BelongsTo $Homeworks
 * @property \Cake\ORM\Association\HasMany $AnswerFeedbacks
 *
 * @method Answer get($primaryKey, $options = [])
 * @method Answer newEntity($data = null, array $options = [])
 * @method Answer[] newEntities(array $data, array $options = [])
 * @method Answer|bool save(EntityInterface $entity, $options = [])
 * @method Answer patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Answer[] patchEntities($entities, array $data, array $options = [])
 * @method Answer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin CreatedModifiedByBehavior
 */
class AnswersTable extends Table
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

        $this->hasMany('AnswerFeedbacks', [
            'foreignKey' => 'answer_id',
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

        $validator
            ->boolean('is_done')
            ->allowEmpty('is_done');

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

        return $rules;
    }
}

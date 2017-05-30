<?php
declare(strict_types=1);

namespace App\Model\Table;


use App\Model\Behavior\CreatedModifiedByBehavior;
use App\Model\Entity\AnswerFeedback;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnswerFeedbacks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Answers
 *
 * @method AnswerFeedback get($primaryKey, $options = [])
 * @method AnswerFeedback newEntity($data = null, array $options = [])
 * @method AnswerFeedback[] newEntities(array $data, array $options = [])
 * @method AnswerFeedback|bool save(EntityInterface $entity, $options = [])
 * @method AnswerFeedback patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method AnswerFeedback[] patchEntities($entities, array $data, array $options = [])
 * @method AnswerFeedback findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin TimestampBehavior
 * @mixin CreatedModifiedByBehavior
 */
class AnswerFeedbacksTable extends Table
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

        $this->setDisplayField('title');

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

        $this->belongsTo('Answers', [
            'foreignKey' => 'answer_id',
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

        $validator
            ->requirePresence('title', 'create')
            ->maxLength('title', 255)
            ->notEmpty('title');

        $validator
            ->allowEmpty('text');

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
        $rules->add($rules->existsIn(['answer_id'], 'Answers'));

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;


use App\Model\Entity\AnswerWordFeedback;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnswerWordFeedbacks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AnswerWords
 *
 * @method AnswerWordFeedback get($primaryKey, $options = [])
 * @method AnswerWordFeedback newEntity($data = null, array $options = [])
 * @method AnswerWordFeedback[] newEntities(array $data, array $options = [])
 * @method AnswerWordFeedback|bool save(EntityInterface $entity, $options = [])
 * @method AnswerWordFeedback patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method AnswerWordFeedback[] patchEntities($entities, array $data, array $options = [])
 * @method AnswerWordFeedback findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class AnswerWordFeedbacksTable extends Table
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
                'Model.beforeRules' => [
                    'created_by_id' => 'new',
                    'modified_by_id' => 'always',
                ],
            ],
            'propertiesMap' => [
                'created_by_id' => '_footprint.id',
                'modified_by_id' => '_footprint.id',
            ],
        ]);
        $this->addBehavior('Search.Search'); // Search!

        $this->belongsTo('AnswerWords', [
            'foreignKey' => 'answer_word_id',
            'joinType' => 'INNER',
        ]);

        $this->searchManager()
            ->value('answer_word_id');
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
            ->uuid('answer_word_id')
            ->requirePresence('answer_word_id', 'create')
            ->notEmpty('answer_word_id', 'create');

        $validator
            ->allowEmpty('text');

        $validator
            ->integer('score')
            ->allowEmpty('score');

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
        $rules->add($rules->existsIn(['answer_word_id'], 'AnswerWords'));
        $rules->add($rules->isUnique(['answer_word_id', 'created_by_id']));

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\AnswerWord;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AnswerWords Model
 *
 * @property \Cake\ORM\Association\BelongsTo $WordClasses
 * @property \Cake\ORM\Association\BelongsTo $Answers
 * @property \Cake\ORM\Association\HasMany $AnswerWordFeedbacks
 *
 * @method AnswerWord get($primaryKey, $options = [])
 * @method AnswerWord newEntity($data = null, array $options = [])
 * @method AnswerWord[] newEntities(array $data, array $options = [])
 * @method AnswerWord|bool save(EntityInterface $entity, $options = [])
 * @method AnswerWord patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method AnswerWord[] patchEntities($entities, array $data, array $options = [])
 * @method AnswerWord findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class AnswerWordsTable extends Table
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
        $this->addBehavior('Search.Search'); // Search!
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

        $this->belongsTo('WordClasses', [
            'foreignKey' => 'word_class_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Answers', [
            'foreignKey' => 'answer_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('AnswerWordFeedbacks', [
            'foreignKey' => 'answer_word_id',
        ]);

        $this->searchManager()
            ->value('answer_id')
            ->value('word_class_id')
            ->value('word_placement');
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
            ->uuid('answer_id')
            ->requirePresence('answer_id')
            ->notEmpty('answer_id', 'create');

        $validator
            ->integer('word_placement')
            ->requirePresence('word_placement', 'create')
            ->notEmpty('word_placement');

        $validator
            ->allowEmpty('definition');

        $validator
            ->allowEmpty('synonym');

        $validator
            ->allowEmpty('sentence');

        $validator
            ->allowEmpty('help_text');

        $validator
            ->boolean('is_skipped')
            ->allowEmpty('is_skipped');

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
        $rules->add($rules->existsIn(['word_class_id'], 'WordClasses'));
        $rules->add($rules->existsIn(['answer_id'], 'Answers'));
        $rules->add($rules->isUnique(['created_by_id', 'answer_id', 'word_placement']));

        return $rules;
    }
}

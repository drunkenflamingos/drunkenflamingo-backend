<?php
declare(strict_types=1);

namespace App\Model\Table;


use App\Model\Entity\WordClass;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WordClasses Model
 *
 * @property \Cake\ORM\Association\HasMany $AnswerWords
 *
 * @method WordClass get($primaryKey, $options = [])
 * @method WordClass newEntity($data = null, array $options = [])
 * @method WordClass[] newEntities(array $data, array $options = [])
 * @method WordClass|bool save(EntityInterface $entity, $options = [])
 * @method WordClass patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method WordClass[] patchEntities($entities, array $data, array $options = [])
 * @method WordClass findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WordClassesTable extends Table
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

        $this->hasMany('AnswerWords', [
            'foreignKey' => 'word_class_id',
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
            ->notEmpty('title');

        $validator
            ->requirePresence('identifier', 'create')
            ->notEmpty('identifier')
            ->add('identifier', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('description');

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
        $rules->add($rules->isUnique(['identifier']));

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;


use App\Model\Entity\HomeworksUser;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HomeworksUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBies
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBies
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Homeworks
 *
 * @method HomeworksUser get($primaryKey, $options = [])
 * @method HomeworksUser newEntity($data = null, array $options = [])
 * @method HomeworksUser[] newEntities(array $data, array $options = [])
 * @method HomeworksUser|bool save(EntityInterface $entity, $options = [])
 * @method HomeworksUser patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method HomeworksUser[] patchEntities($entities, array $data, array $options = [])
 * @method HomeworksUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class HomeworksUsersTable extends Table
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

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'finder' => 'withTrashed',
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

        $validator
            ->dateTime('published_from')
            ->allowEmpty('published_from');

        $validator
            ->dateTime('published_to')
            ->allowEmpty('published_to');

        $validator
            ->dateTime('deadline')
            ->allowEmpty('deadline');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['homework_id'], 'Homeworks'));

        return $rules;
    }
}

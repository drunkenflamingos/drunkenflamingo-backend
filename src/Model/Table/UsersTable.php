<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBy
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBy
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsToMany $Roles
 *
 * @method User get($primaryKey, $options = [])
 * @method User newEntity($data = null, array $options = [])
 * @method User[] newEntities(array $data, array $options = [])
 * @method User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method User[] patchEntities($entities, array $data, array $options = [])
 * @method User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');
        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by_id' => 'new',
                    'modified_by_id' => 'always',
                ],
            ],
        ]);

        $this->belongsTo('CreatedBy', [
            'foreignKey' => 'created_by_id',
            'joinType' => 'INNER',
            'className' => 'Users',
        ]);
        $this->belongsTo('ModifiedBy', [
            'foreignKey' => 'modified_by_id',
            'joinType' => 'INNER',
            'className' => 'Users',
        ]);
        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER',
        ]);


        $this->hasMany('UsersRoles');

        $this->belongsToMany('Roles', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'users_roles',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->allowEmpty('password');

        $validator
            ->allowEmpty('phone_number');

        $validator
            ->allowEmpty('file_dir');

        $validator
            ->integer('file_size')
            ->allowEmpty('file_size');

        $validator
            ->allowEmpty('file_type');

        $validator
            ->allowEmpty('file_name');

        $validator
            ->allowEmpty('reset_token');

        $validator
            ->dateTime('reset_expires')
            ->allowEmpty('reset_expires');

        $validator
            ->boolean('is_activated')
            ->allowEmpty('is_activated');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['created_by_id'], 'CreatedBy'));
        $rules->add($rules->existsIn(['modified_by_id'], 'ModifiedBy'));
        $rules->add($rules->existsIn(['language_id'], 'Languages'));

        return $rules;
    }

    public function beforeSave(Event $event, User $entity, ArrayObject $options)
    {
        if (empty($entity->language_id)) {
            $entity->language_id = TableRegistry::get('Languages')->findByIsoCode('da-DK')->first()->id;
        }
    }
}

<?php

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use League\OAuth2\Client\Provider\AbstractProvider;

/**
 * UserOauthTokens Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserOauthToken get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserOauthToken newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserOauthToken[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserOauthToken|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserOauthToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserOauthToken[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserOauthToken findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserOauthTokensTable extends Table
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

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->allowEmpty('refresh_token');

        $validator
            ->dateTime('expires')
            ->allowEmpty('expires');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /**
     * @param Event $event
     * @param AbstractProvider $provider
     * @param array $data
     */
    public function createOrUpdate(Event $event, AbstractProvider $provider, array $data)
    {
        if (!isset($data['token']) || !$data['token']) {
            return;
        }

        return; // void
    }
}

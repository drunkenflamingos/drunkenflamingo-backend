<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\UserOauthToken;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use League\OAuth2\Client\Provider\AbstractProvider;

/**
 * UserOauthTokens Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method UserOauthToken get($primaryKey, $options = [])
 * @method UserOauthToken newEntity($data = null, array $options = [])
 * @method UserOauthToken[] newEntities(array $data, array $options = [])
 * @method UserOauthToken|bool save(EntityInterface $entity, $options = [])
 * @method UserOauthToken patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method UserOauthToken[] patchEntities($entities, array $data, array $options = [])
 * @method UserOauthToken findOrCreate($search, callable $callback = null, $options = [])
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
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
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
     * @param RulesChecker $rules The rules object to be modified.
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
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

<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\UserOauthToken;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Google;

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
        $this->addBehavior('Muffin/Trash.Trash');

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
            ->nonNegativeInteger('expires')
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
        $usersTable = TableRegistry::get('Users');

        /** @var \League\OAuth2\Client\Token\AccessToken $token */
        $token = $data['token'];

        if (!isset($token) || !$token) {
            return;
        }

        switch (get_class($provider)) {
            case Facebook::class:
                $type = 'facebook';
                break;
            case Google::class:
                $type = 'google';
                break;
            default:
                $type = 'generic';
                break;
        }

        $user = $usersTable->get($data['id']);
        $existingToken = $this->find()
            ->where([
                'UserOauthTokens.user_id' => $user->id,
                'UserOauthTokens.type' => $type,
            ])
            ->order(['expires' => 'DESC'])
            ->first();

        if ($existingToken === null) {
            $userOauthToken = $this->newEntity([
                'user_id' => $user->id,
                'type' => $type,
                'token' => $token->getToken(),
                'refresh_token' => $token->getRefreshToken(),
                'expires' => $token->getExpires(),
            ]);
        } else {
            $userOauthToken = $this->patchEntity($existingToken, [
                'token' => $token->getToken(),
                'expires' => $token->getExpires(),
            ]);

            $refreshToken = $token->getRefreshToken();

            if (!empty($refreshToken)) {
                $userOauthToken->refresh_token = $refreshToken;
            }
        }

        $this->save($userOauthToken);
    }
}

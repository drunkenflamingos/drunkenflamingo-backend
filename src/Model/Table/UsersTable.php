<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use ArrayObject;
use Cake\Event\Event;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

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

        $this->setDisplayField('name');

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
        $this->addBehavior('Search.Search'); // Search!
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo' => [
                'path' => 'webroot{DS}files{DS}uploads{DS}{model}{DS}{field}{DS}',
                'fields' => [
                    'dir' => 'file_dir',
                    'size' => 'file_size',
                    'type' => 'file_dir',
                ],
            ],
        ]);

        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER',
            'finder' => 'withTrashed',
        ]);

        $this->hasMany('UsersRoles');
        $this->hasMany('UserOauthTokens');

        $this->belongsToMany('Courses', [
            'through' => 'CoursesUsers',
        ]);

        $this->belongsToMany('Organizations', [
            'foreignKey' => 'user_id',
            'targetForignKey' => 'organization_id',
            'joinTable' => 'users_roles',
        ]);

        $this->belongsToMany('Roles', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'users_roles',
        ]);

        $this->searchManager()
            ->value('name')
            ->value('email')
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'wildcardAny' => '?',
                'field' => [
                    $this->aliasField('name'),
                    $this->aliasField('email'),
                ],
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
        $rules->add($rules->existsIn(['language_id'], 'Languages'));

        return $rules;
    }

    public function beforeSave(Event $event, User $entity, ArrayObject $options)
    {
        if (empty($entity->language_id)) {
            $entity->language_id = TableRegistry::get('Languages')->findByIsoCode('da-DK')->first()->id;
        }
    }

    public function findActive(Query $q, array $options)
    {
        return $q->where(['Users.is_active' => true]);
    }

    public function findInOrganizationWithRoleIdentifier(Query $q, array $options)
    {
        return $q->matching('UsersRoles', function (Query $q) use ($options) {
            if (array_key_exists('role_identifier', $options)) {
                $q = $q->matching('Roles', function (Query $q) use ($options) {
                    if (is_array($options['role_identifier']) && array_key_exists(0, $options['role_identifier'])) {
                        return $q->where(['Roles.identifier IN' => $options['role_identifier']]);
                    }

                    return $q->where(['Roles.identifier' => $options['role_identifier']]);
                });
            } elseif (is_array($options['role_id']) && array_key_exists(0, $options['role_id'])) {
                //More than 1 role id
                $q = $q->where(['UsersRoles.role_id IN' => $options['role_id']]);
            } else {
                //1 specific role id
                $q = $q->where(['UsersRoles.role_id' => $options['role_id']]);
            }

            return $q
                ->where(['UsersRoles.organization_id' => $options['organization_id']]);
        });
    }

    public function findNotInCourse(Query $q, array $options)
    {
        return $q->notMatching('Courses', function (Query $q) use ($options) {
            return $q->where(['Courses.id' => $options['course_id']]);
        });
    }

    public function createNewUser(Event $event, AbstractProvider $provider, array $data): array
    {
        /** @var AccessToken $token */
        $token = $data['token'];

        $entity = $this->newEntity([
            'name' => $data['displayName'],
            'email' => $data['email'],
            'password' => null,
            'is_activated' => true,
            //'file' => file_get_contents($data['image']['url']),
            'user_oauth_tokens' => [
                [
                    'type' => 'google',
                    'token' => $token->getToken(),
                    'refresh_token' => $token->getRefreshToken(),
                    'expires' => new FrozenTime($token->getExpires()),
                ],
            ],
        ]);

        $this->save($entity);

        return $entity->toArray(); // user data to be used in session
    }
}

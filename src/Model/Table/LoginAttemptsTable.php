<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\LoginAttempt;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LoginAttempts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method LoginAttempt get($primaryKey, $options = [])
 * @method LoginAttempt newEntity($data = null, array $options = [])
 * @method LoginAttempt[] newEntities(array $data, array $options = [])
 * @method LoginAttempt|bool save(EntityInterface $entity, $options = [])
 * @method LoginAttempt patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method LoginAttempt[] patchEntities($entities, array $data, array $options = [])
 * @method LoginAttempt findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LoginAttemptsTable extends Table
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
            'joinType' => 'LEFT',
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
            ->ipv4('ip4')
            ->allowEmpty('ip4');

        $validator
            ->ipv6('ip6')
            ->allowEmpty('ip6');

        $validator
            ->boolean('success');

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

    public function logUnauthenticatedAttempt(array $array = [])
    {
        $user = $this->Users->find()->where(['Users.email' => $array['email']])->first();

        $loginAttempt = $this->newEntity([
            'user_id' => $user !== null ? $user->id : null,
            'ip4' => $array['ipv4'],
            'ip6' => $array['ipv6'],
            'success' => false,
        ]);

        $this->save($loginAttempt);
    }
}

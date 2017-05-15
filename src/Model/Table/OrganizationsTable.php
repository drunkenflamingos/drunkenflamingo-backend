<?php

namespace App\Model\Table;

use App\Model\Entity\Organization;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBy
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBy
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $UsersRoles
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method Organization get($primaryKey, $options = [])
 * @method Organization newEntity($data = null, array $options = [])
 * @method Organization[] newEntities(array $data, array $options = [])
 * @method Organization|bool save(EntityInterface $entity, $options = [])
 * @method Organization patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Organization[] patchEntities($entities, array $data, array $options = [])
 * @method Organization findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationsTable extends Table
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
        $this->addBehavior('Muffin/Slug.Slug', [
            'onUpdate' => true,
        ]);

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

        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ContactPeople', [
            'foreignKey' => 'contact_person_id',
            'joinType' => 'INNER',
            'className' => 'Users',
        ]);

        $this->hasMany('UsersRoles', [
            'foreignKey' => 'organization_id',
        ]);

        $this->hasMany('Courses', [
            'foreignKey' => 'organization_id',
        ]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'organization_id',
            'targetForignKey' => 'organization_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('invoice_email');

        $validator
            ->allowEmpty('phone_number');

        $validator
            ->integer('vat_number')
            ->allowEmpty('vat_number');

        $validator
            ->allowEmpty('street_name');

        $validator
            ->allowEmpty('zip_code');

        $validator
            ->allowEmpty('city');

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
        $rules->add($rules->existsIn(['language_id'], 'Languages'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use App\Model\Entity\Language;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Languages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBy
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBy
 * @property \Cake\ORM\Association\HasMany $Organizations
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method Language get($primaryKey, $options = [])
 * @method Language newEntity($data = null, array $options = [])
 * @method Language[] newEntities(array $data, array $options = [])
 * @method Language|bool save(EntityInterface $entity, $options = [])
 * @method Language patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Language[] patchEntities($entities, array $data, array $options = [])
 * @method Language findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LanguagesTable extends Table
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

        $this->displayField('name');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');

        $this->addBehavior('CreatedModifiedBy');

        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by_id' => 'new',
                    'modified_by_id' => 'always',
                    'organization_id' => 'new',
                ],
            ],
            'propertiesMap' => [
                'created_by_id' => '_footprint.id',
                'modified_by_id' => '_footprint.id',
                'organization_id' => '_footprint.active_organization_id',
            ],
        ]);
        $this->hasMany('Organizations', [
            'foreignKey' => 'language_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'language_id',
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
            ->requirePresence('iso_code', 'create')
            ->notEmpty('iso_code');

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
        return $rules;
    }
}

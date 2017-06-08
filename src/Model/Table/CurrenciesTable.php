<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Currency;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Currencies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBy
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBy
 *
 * @method Currency get($primaryKey, $options = [])
 * @method Currency newEntity($data = null, array $options = [])
 * @method Currency[] newEntities(array $data, array $options = [])
 * @method Currency|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method Currency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method Currency[] patchEntities($entities, array $data, array $options = [])
 * @method Currency findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class CurrenciesTable extends Table
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('iso_code', 'create')
            ->add('iso_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
            ->notEmpty('iso_code');

        $validator
            ->requirePresence('short_name', 'create')
            ->notEmpty('short_name');

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
        $rules->isUnique('iso_code');

        return $rules;
    }
}

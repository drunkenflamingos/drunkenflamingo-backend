<?php
declare(strict_types=1);

namespace App\Model\Table;


use Cake\Database\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBies
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBies
 * @property \Cake\ORM\Association\BelongsTo $Organizations
 *
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class CoursesTable extends Table
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

        $this->addBehavior('Search.Search'); // Search!
        $this->addBehavior('Timestamp');
        $this->addBehavior('CreatedModifiedBy');
        $this->addBehavior('Muffin/Trash.Trash');
        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by_id' => 'new',
                    'modified_by_id' => 'always',
                    'organization_id' => 'new',
                ],
                'Model.beforeRules' => [
                    'created_by_id' => 'new',
                    'modified_by_id' => 'always',
                    'organization_id' => 'always',
                ],
            ],
            'propertiesMap' => [
                'created_by_id' => '_footprint.id',
                'modified_by_id' => '_footprint.id',
                'organization_id' => '_footprint.active_organization_id',
            ],
        ]);

        $this->belongsToMany('Users', [
            'through' => 'CoursesUsers',
        ]);
        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
            'joinType' => 'INNER',
        ]);

        $this->searchManager()
            ->value('grade')
            ->value('name')
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'wildcardAny' => '?',
                'field' => [
                    $this->aliasField('grade'),
                    $this->aliasField('name'),
                ],
            ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('grade')
            ->requirePresence('grade', 'create')
            ->notEmpty('grade');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));
        $rules->add($rules->isUnique(['grade', 'name', 'organization_id']), [
            'errorField' => 'name',
            'message' => __('You can only have 1 combination of grade and name'),
        ]);

        return $rules;
    }

    /**
     * @param Query $q
     * @param array $options
     * @return Query
     */
    public function findDefaultOrder(Query $q, array $options): Query
    {
        return $q->order(['Courses.grade', 'Courses.name']);
    }
}

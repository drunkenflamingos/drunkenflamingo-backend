<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Assignment;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assignments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Organizations
 * @property \Cake\ORM\Association\HasMany $Answers
 * @property \Cake\ORM\Association\BelongsToMany $Homeworks
 *
 * @method Assignment get($primaryKey, $options = [])
 * @method Assignment newEntity($data = null, array $options = [])
 * @method Assignment[] newEntities(array $data, array $options = [])
 * @method Assignment|bool save(EntityInterface $entity, $options = [])
 * @method Assignment patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Assignment[] patchEntities($entities, array $data, array $options = [])
 * @method Assignment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class AssignmentsTable extends Table
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

        $this->setDisplayField('title');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');
        $this->addBehavior('CreatedModifiedBy');
        $this->addBehavior('Search.Search'); // Search!
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

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Answers', [
            'foreignKey' => 'assignment_id',
        ]);
        $this->belongsToMany('Homeworks', [
            'through' => 'HomeworksAssignments',
        ]);

        $this->searchManager()
            ->value('title')
            ->value('is_locked')
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'field' => [
                    'title',
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->allowEmpty('text');

        $validator
            ->boolean('is_locked')
            ->allowEmpty('is_locked');

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

        //Avoid unlocking assignments if it's already locked, and it's in use in either an answer or a homework
        $rules->add(function (Assignment $entity, array $options): bool {
            if ($entity->getDirty('is_locked')) {
                if ($entity->getOriginal('is_locked') === true && $entity->is_locked !== true) {
                    return $entity->isInUse() === false;
                }
            }

            return true;
        }, 'AlreadyUsedCannotBeUnlocked', [
            'errorField' => 'is_locked',
            'message' => __("You cannot unlock an assignment after it has been because it's already in use"),
        ]);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Homework;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Homeworks Model
 *
 * @property
 * @property \Cake\ORM\Association\BelongsTo $Organizations
 * @property \Cake\ORM\Association\BelongsToMany $Assignments
 * @property \Cake\ORM\Association\BelongsToMany $Courses
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method Homework get($primaryKey, $options = [])
 * @method Homework newEntity($data = null, array $options = [])
 * @method Homework[] newEntities(array $data, array $options = [])
 * @method Homework|bool save(EntityInterface $entity, $options = [])
 * @method Homework patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method Homework[] patchEntities($entities, array $data, array $options = [])
 * @method Homework findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \App\Model\Behavior\CreatedModifiedByBehavior
 */
class HomeworksTable extends Table
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

        $this->hasMany('HomeworksCourses');
        $this->hasMany('HomeworksUsers');
        $this->hasMany('Answers');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
            'joinType' => 'INNER',
        ]);


        $this->belongsToMany('Assignments', [
            'through' => 'HomeworksAssignments',
        ]);

        $this->belongsToMany('Courses', [
            'through' => 'HomeworksCourses',
        ]);

        $this->belongsToMany('Users', [
            'through' => 'HomeworksUsers',
        ]);

        $this->searchManager()
            ->value('name')
            ->add('course_id', 'Search.Callback', [
                'callback' => function (Query $query, array $args, $filter) {
                    if (empty($args['course_id'])) {
                        return $query;
                    }

                    return $query->matching('Courses', function (Query $q) use ($args) {
                        return $q->where(['Courses.id' => $args['course_id']]);
                    });
                },
            ])
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'field' => [
                    'name',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('text');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): \Cake\ORM\RulesChecker
    {
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));

        return $rules;
    }

    public function findActiveAtCourses(Query $q, array $options): Query
    {
        return $q
            ->matching('HomeworksCourses', function (Query $q) use ($options) {
                if (!empty($options['course_id'])) {
                    $q->where(['HomeworksCourses.course_id' => $options['course_id']]);
                }

                return $q
                    ->where([
                        'HomeworksCourses.published_from <=' => $options['time'],
                        'HomeworksCourses.published_to >=' => $options['time'],
                    ]);
            });
    }

    public function findActiveAtUsers(Query $q, array $options): Query
    {
        return $q
            ->matching('HomeworksUsers', function (Query $q) use ($options) {
                return $q
                    ->where([
                        'HomeworksCourses.published_from <=' => $options['time'],
                        'HomeworksCourses.published_to >=' => $options['time'],
                    ]);
            });
    }
}

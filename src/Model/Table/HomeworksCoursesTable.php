<?php

namespace App\Model\Table;

use App\Model\Entity\HomeworksCourse;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HomeworkCourses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CreatedBy
 * @property \Cake\ORM\Association\BelongsTo $ModifiedBy
 * @property \Cake\ORM\Association\BelongsTo $Courses
 * @property \Cake\ORM\Association\BelongsTo $Homeworks
 *
 * @method HomeworksCourse get($primaryKey, $options = [])
 * @method HomeworksCourse newEntity($data = null, array $options = [])
 * @method HomeworksCourse[] newEntities(array $data, array $options = [])
 * @method HomeworksCourse|bool save(EntityInterface $entity, $options = [])
 * @method HomeworksCourse patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method HomeworksCourse[] patchEntities($entities, array $data, array $options = [])
 * @method HomeworksCourse findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HomeworksCoursesTable extends Table
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

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Homeworks', [
            'foreignKey' => 'homework_id',
            'joinType' => 'INNER',
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
            ->dateTime('published_from')
            ->requirePresence('published_from', 'create')
            ->notEmpty('published_from');

        $validator
            ->dateTime('published_to')
            ->allowEmpty('published_to');

        $validator
            ->dateTime('deadline')
            ->allowEmpty('deadline');

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
        //TODO published_from must be < published_to
        //TODO deadline must be > published_from && > published_to (if set)

        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        $rules->add($rules->existsIn(['homework_id'], 'Homeworks'));

        return $rules;
    }

    public function findPublishedAt(Query $q, array $options)
    {
        return $q->where([
            'published_from >=' => $options[0],
            'published_to' <= $options[0],
        ]);
    }
}

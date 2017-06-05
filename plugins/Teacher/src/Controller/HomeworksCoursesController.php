<?php

namespace Teacher\Controller;

use App\Model\Entity\Course;
use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * HomeworksCourses Controller
 *
 * @property \App\Model\Table\HomeworksCoursesTable $HomeworksCourses
 */
class HomeworksCoursesController extends AppController
{
    public $modelClass = 'App.HomeworksCourses';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['index', 'view']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->matching('Courses', function (Query $q) {
                    return $q->where([
                        'Courses.organization_id' => $this->Auth->user('active_organization_id'),
                    ]);
                });
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query
                ->matching('Courses', function (Query $q) {
                    return $q->where([
                        'Courses.organization_id' => $this->Auth->user('active_organization_id'),
                    ]);
                });
        });
    }

    public function add()
    {
        $this->Crud->on('beforeSave', function (Event $event) {
            $event->getSubject()->entity->homework_id = $this->request->getQuery('homework_id');
        });

        $courses = $this->HomeworksCourses->Courses->find()
            ->where(['Courses.organization_id' => $this->Auth->user('active_organization_id')])
            ->order([
                'Courses.grade',
                'Courses.name',
            ])
            ->combine(
                'id',
                function (Course $course) {
                    return sprintf('%s.%s', $course->grade, $course->name);
                });

        $this->set(compact('courses'));

        return $this->Crud->execute();
    }

    public function edit($id = null)
    {
        return $this->Crud->execute();
    }

    public function delete($id = null)
    {
        return $this->Crud->execute();
    }
}




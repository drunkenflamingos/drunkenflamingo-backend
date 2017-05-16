<?php

namespace Teacher\Controller;

use App\Model\Entity\Course;
use Cake\Event\Event;
use Teacher\Controller\AppController;

/**
 * Homework Controller
 *
 * @property \App\Model\Table\HomeworksTable $Homeworks
 */
class HomeworksController extends AppController
{
    public $modelClass = 'App.Homeworks';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->where([
                'Homeworks.organization_id' => $this->Auth->user('active_organization_id'),
            ]);

            if ($this->request->getQuery('show_all') !== 'true') {
                $event->getSubject()->query->where([
                    'Homeworks.created_by_id' => $this->Auth->user('id'),
                ]);
            }
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query->where([
                'Homeworks.organization_id' => $this->Auth->user('active_organization_id'),
            ]);

            if ($this->request->getQuery('show_all') !== 'true') {
                $event->getSubject()->query->where([
                    'Homeworks.created_by_id' => $this->Auth->user('id'),
                ]);
            }
        });

        $this->Crud->listener('relatedModels')->relatedModels(['Courses'], 'add');
    }

    public function index()
    {
        return $this->Crud->execute();
    }

    public function view($id = null)
    {
        return $this->Crud->execute();
    }

    public function add()
    {
        $courses = $this->Homeworks->Courses->find()
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




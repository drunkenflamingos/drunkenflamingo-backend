<?php
declare(strict_types=1);

namespace TeacherAdmin\Controller;

use Cake\Event\Event;
use TeacherAdmin\Controller\AppController;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 */
class CoursesController extends AppController
{
    public $paginate = [
        'sort' => 'Courses.grade'
    ];

    public $modelClass = 'App.Courses';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (\Cake\Event\Event $event) {
            $event->subject->query->where(['Courses.organization_id' => $this->Auth->user('active_organization_id')]);
        });

        $this->Crud->on('beforePaginate', function (\Cake\Event\Event $event) {
            $event->subject->query->where(['Courses.organization_id' => $this->Auth->user('active_organization_id')]);
        });
    }

    public function index()
    {

//        For filtering... couldn't make UI look proper
//        $names = $this->Courses->find()
//            ->find('list', [
//                'keyField' => 'id',
//                'valueField' => 'name',
//            ])
//            ->group(['name'])
//            ->order(['name' => 'asc'])
//            ->toArray();
//
//        $grades = $this->Courses->find()
//            ->find('list', [
//                'keyField' => 'id',
//                'valueField' => 'grade',
//            ])
//            ->group(['grade'])
//            ->order(['grade' => 'asc'])
//            ->toArray();
//
//        $this->set(compact('names', 'grades'));

        return $this->Crud->execute();
    }

    public function view($id = null)
    {
        $this->Crud->on('beforeFind', function (\Cake\Event\Event $event) {
            $event->subject->query->contain(['Users']);
        });

        return $this->Crud->execute();
    }

    public function add()
    {
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




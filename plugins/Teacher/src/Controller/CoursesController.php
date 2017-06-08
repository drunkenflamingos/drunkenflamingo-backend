<?php
declare(strict_types=1);

namespace Teacher\Controller;

use Cake\Event\Event;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 */
class CoursesController extends AppController
{
    public $modelClass = 'App.Courses';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['add', 'edit', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (\Cake\Event\Event $event) {
            $event->getSubject()->query
                ->where(['Courses.organization_id' => $this->Auth->user('active_organization_id')]);
        });

        $this->Crud->on('beforePaginate', function (\Cake\Event\Event $event) {
            $event->getSubject()->query
                ->where(['Courses.organization_id' => $this->Auth->user('active_organization_id')]);
        });
    }

    public function index()
    {
        return $this->Crud->execute();
    }

    public function view($id = null)
    {
        return $this->Crud->execute();
    }
}




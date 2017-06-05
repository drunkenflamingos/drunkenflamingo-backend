<?php

namespace Student\Controller;

use Cake\Event\Event;

/**
 * Assignments Controller
 */
class AssignmentsController extends AppController
{
    public $modelClass = 'Assignments';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['add', 'edit', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
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

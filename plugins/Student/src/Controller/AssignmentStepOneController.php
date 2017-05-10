<?php
namespace Student\Controller;

use Cake\Event\Event;

/**
 * Assignments Step 1 Controller
 */
class AssignmentStepOneController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['index', 'add', 'edit', 'view', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function index()
    {

    }
}

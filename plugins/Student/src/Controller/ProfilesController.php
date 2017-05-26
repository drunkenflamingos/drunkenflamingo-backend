<?php
declare(strict_types=1);

namespace Student\Controller;

use Cake\Event\Event;

/**
 * Dashboard Controller
 */
class ProfilesController extends AppController
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

<?php

namespace Admin\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Dashboard Controller
 */
class DashboardController extends AppController
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

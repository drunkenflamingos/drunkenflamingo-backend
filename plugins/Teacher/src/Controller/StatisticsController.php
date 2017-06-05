<?php
declare(strict_types=1);

namespace Teacher\Controller;

use Cake\Event\Event;
use Teacher\Controller\AppController;

/**
 * Statistics Controller
 *
 */
class StatisticsController extends AppController
{
    public $modelClass = null;

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['index', 'view', 'add', 'edit', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function index()
    {

    }

    public function hardestWords()
    {

    }
}




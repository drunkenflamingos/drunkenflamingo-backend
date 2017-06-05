<?php
declare(strict_types=1);

namespace Student\Controller;

use Cake\Event\Event;

/**
 * Badges Controller
 *
 */
class BadgesController extends AppController
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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

    }
}

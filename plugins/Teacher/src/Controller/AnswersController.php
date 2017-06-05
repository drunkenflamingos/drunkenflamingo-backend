<?php
declare(strict_types=1);

namespace Teacher\Controller;

use Cake\Event\Event;

/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 */
class AnswersController extends AppController
{
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




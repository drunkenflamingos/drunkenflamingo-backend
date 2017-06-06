<?php
declare(strict_types=1);

namespace Teacher\Controller;

use Cake\Event\Event;

/**
 * Assignments Controller
 *
 * @property \App\Model\Table\AssignmentsTable $Assignments
 */
class AssignmentsController extends AppController
{
    public $modelClass = 'App.Assignments';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->where([
                'organization_id' => $this->Auth->user('active_organization_id'),
            ]);
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query->where([
                'organization_id' => $this->Auth->user('active_organization_id'),
            ]);
        });

        //Because of bugs with homeworks._ids.0 not being recognized correctly
        $this->Security->setConfig('unlockedActions', ['add']);
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




<?php
declare(strict_types=1);

namespace Student\Controller;

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
            $event->getSubject()->query
                ->where([
                    'Assignments.organization_id' => $this->Auth->user('active_organization_id'),
                    'Assignments.is_locked' => true,
                ])
            ->contain(['CreatedBy']);
        });
    }

    public function view($id = null)
    {
        return $this->Crud->execute();
    }
}




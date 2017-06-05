<?php

namespace Teacher\Controller\Homeworks;

use Cake\Event\Event;
use Cake\ORM\Query;
use Teacher\Controller\AppController;

/**
 * Assignments Controller
 *
 * @property \App\Model\Table\HomeworksAssignmentsTable $HomeworksAssignments
 */
class AssignmentsController extends AppController
{
    public $modelClass = 'App.HomeworksAssignments';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable('add', 'view', 'edit');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $homework = $this->HomeworksAssignments->Homeworks->find()
            ->where([
                'Homeworks.organization_id' => $this->Auth->user('active_organization_id'),
                'Homeworks.id' => $this->request->getParam('homework_id'),
            ])
            ->firstOrFail();

        $this->Crud->on('beforeFind', function (Event $event) use ($homework) {
            $event->getSubject()->query
                ->matching('Homeworks', function (Query $q) use ($homework) {
                    return $q->where(['Homeworks.id' => $homework->id]);
                });
        });
    }

    public function delete($id = null)
    {
        return $this->Crud->execute();
    }

}




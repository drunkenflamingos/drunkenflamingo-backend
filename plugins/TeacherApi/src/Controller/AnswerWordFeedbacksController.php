<?php
declare(strict_types=1);

namespace TeacherApi\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * AnswerWordFeedbacks Controller
 *
 * @property \App\Model\Table\AnswerWordFeedbacksTable $AnswerWordFeedbacks
 */
class AnswerWordFeedbacksController extends AppController
{
    public $modelClass = 'App.AnswerWordFeedbacks';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->matching('AnswerWords.Answers.Assignments', function (Query $q) {
                    return $q->where(['Assignments.organization_id' => $this->Auth->user('active_organization_id')]);
                });
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query
                ->matching('AnswerWords.Answers.Assignments', function (Query $q) {
                    return $q->where(['Assignments.organization_id' => $this->Auth->user('active_organization_id')]);
                });
        });
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




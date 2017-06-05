<?php
declare(strict_types=1);

namespace Student\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;
use Student\Controller\AppController;

/**
 * AnswerFeedbacks Controller
 *
 * @property \App\Model\Table\AnswerFeedbacksTable $AnswerFeedbacks
 */
class AnswerFeedbacksController extends AppController
{
    public $modelClass = 'App.AnswerFeedbacks';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['add', 'edit', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query->matching('Answers', function (Query $q) {
                return $q->where(['Answers.created_by_id' => $this->Auth->user('id')]);
            });
        });

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->matching('Answers', function (Query $q) {
                return $q->where(['Answers.created_by_id' => $this->Auth->user('id')]);
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
}




<?php
declare(strict_types=1);

namespace StudentApi\Controller;

use Cake\Event\Event;

/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 */
class AnswersController extends AppController
{
    public $modelClass = 'App.Answers';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->where(['Answers.created_by_id' => $this->Auth->user('id')]);
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query->where(['Answers.created_by_id' => $this->Auth->user('id')]);
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




<?php
declare(strict_types=1);

namespace Teacher\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * Assignments Controller
 *
 * @property \App\Model\Table\AssignmentsTable $Assignments
 * @property \App\Model\Table\AnswerWordsTable $AnswerWords
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

        $this->loadModel('AnswerWords');

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
        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->contain([
                "CreatedBy",
                "ModifiedBy",
                "Organizations",
            ]);
        });

        $this->Crud->on('afterFind', function (Event $event) {
            $wordsWithErrors = $this->AnswerWords->find()
                ->matching('Answers.Assignments', function (Query $q) {
                    return $q->where(['Assignments.organization_id' => $this->Auth->user('active_organization_id')]);
                })
                ->matching('AnswerWordFeedbacks', function (Query $q) {
                    return $q->where(['AnswerWordFeedbacks.score <' => 100]);
                })
                ->count();

            $wordsWithoutErrors = $this->AnswerWords->find()
                ->matching('Answers.Assignments', function (Query $q) {
                    return $q->where(['Assignments.organization_id' => $this->Auth->user('active_organization_id')]);
                })
                ->matching('AnswerWordFeedbacks', function (Query $q) {
                    return $q->where(['AnswerWordFeedbacks.score' => 100]);
                })
                ->count();

            $skippedWords = $this->AnswerWords->find()
                ->where([
                    'AnswerWords.is_skipped' => true,
                ])
                ->matching('Answers.Assignments', function (Query $q) {
                    return $q->where(['Assignments.organization_id' => $this->Auth->user('active_organization_id')]);
                })
                ->count();

            $this->set(compact(
                'wordsWithErrors',
                'wordsWithoutErrors',
                'skippedWords'
            ));
        });

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




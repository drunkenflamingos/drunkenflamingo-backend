<?php

namespace Teacher\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public $modelClass = 'App.Users';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['add', 'edit', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $studentRole = $this->Users->Roles->findByIdentifier('student')->firstOrFail();

        $this->Crud->on('beforeFind', function (Event $event) use ($studentRole) {
            $event->getSubject()->query->find('InOrganizationWithRoleIdentifier', [
                'organization_id' => $this->Auth->user('active_organization_id'),
                'role_id' => $studentRole->id,
            ]);
        });

        $this->Crud->on('beforePaginate', function (Event $event) use ($studentRole) {
            $event->getSubject()->query->find('InOrganizationWithRoleIdentifier', [
                'organization_id' => $this->Auth->user('active_organization_id'),
                'role_id' => $studentRole->id,
            ]);
        });
    }

    public function index()
    {
        return $this->Crud->execute();
    }

    public function view($id = null)
    {
        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->contain([
                    'Answers',
                    'DoneAnswers',
                    'AnswerWords',
                ]);
        });

        $this->Crud->on('afterFind', function (Event $event) {
            $wordsWithErrors = $this->Users->AnswerWords->find()
                ->where(['AnswerWords.created_by_id' => $this->Auth->user('id')])
                ->matching('AnswerWordFeedbacks', function (Query $q) {
                    return $q->where(['AnswerWordFeedbacks.score <' => 100]);
                })
                ->count();

            $wordsWithoutErrors = $this->Users->AnswerWords->find()
                ->where(['AnswerWords.created_by_id' => $this->Auth->user('id')])
                ->matching('AnswerWordFeedbacks', function (Query $q) {
                    return $q->where(['AnswerWordFeedbacks.score' => 100]);
                })
                ->count();

            $skippedWords = $this->Users->AnswerWords->find()
                ->where([
                    'AnswerWords.is_skipped' => true,
                    'AnswerWords.created_by_id' => $this->Auth->user('id'),
                ])
                ->count();

            $wordsWithouFeedback = $this->Users->AnswerWords->find()
                ->where(['AnswerWords.created_by_id' => $this->Auth->user('id')])
                ->notMatching('AnswerWordFeedbacks')
                ->count();

            $this->set(compact(
                'wordsWithErrors',
                'wordsWithoutErrors',
                'skippedWords',
                'wordsWithouFeedback'
            ));
        });

        return $this->Crud->execute();
    }
}

<?php
declare(strict_types=1);

namespace Teacher\Controller;

use Cake\Event\Event;

/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 * @property \App\Model\Table\AnswerWordsTable AnswerWords
 */
class AnswersController extends AppController
{
    public $modelClass = 'App.Answers';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['add', 'view', 'delete']);

        $this->Crud->mapAction('markAllCorrect', [
            'className' => 'Crud.View',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('AnswerWords');

        $user = $this->Answers->CreatedBy->get($this->Auth->user('id'));
        $jwtToken = $user->getJwtToken();

        $this->set(compact('jwtToken'));

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->matching('Homeworks', function (\Cake\ORM\Query $q) {
                return $q->where(['Homeworks.organization_id' => $this->Auth->user('active_organization_id')]);
            });
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query->matching('Homeworks', function (\Cake\ORM\Query $q) {
                return $q->where(['Homeworks.organization_id' => $this->Auth->user('active_organization_id')]);
            });
        });
    }

    public function index()
    {
        return $this->Crud->execute();
    }

    public function edit($id = null)
    {
        $this->Crud->action()->setConfig('saveOptions', [
            'associated' => [
                'AnswerFeedbacks',
            ],
        ]);

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->contain([
                    'CreatedBy',
                    'AnswerWords' => [
                        'WordClasses',
                    ],
                    'AnswerFeedbacks',
                    'Assignments',
                    'Homeworks',
                ]);
        });

        return $this->Crud->execute();
    }

    public function markAllCorrect($id = null)
    {
        $this->Crud->on('beforeFind', function (\Cake\Event\Event $event) {
            $event->getSubject()->query->contain([
                'AnswerWords' => ['AnswerWordFeedbacks'],
                'Assignments',
                'AnswerFeedbacks',
            ]);

        });

        $this->Crud->on('afterFind', function (\Cake\Event\Event $event) {
            $answer = $event->getSubject()->entity;

            $answerWords = $this->Answers->AnswerWords->find()
                ->where(['AnswerWords.answer_id' => $answer->id])
                ->extract('id')
                ->toArray();

            if (!empty($answerWords)) {
                $this->AnswerWords->AnswerWordFeedbacks->updateAll([
                    'score' => 100,
                ], [
                    'answer_word_id IN' => $answerWords,
                    'created_by_id' => $this->Auth->user('id'),
                ]);
            }

            if (!empty($answer->answer_words)) {
                /** @var \App\Model\Entity\AnswerWord $answerWord */
                foreach ($answer->answer_words as $answerWord) {
                    if (empty($answerWord->answer_word_feedbacks)) {
                        $answerWordFeedback = $this->AnswerWords->AnswerWordFeedbacks->newEntity([
                            'answer_word_id' => $answerWord->id,
                            'score' => 100,
                        ]);

                        $this->AnswerWords->AnswerWordFeedbacks->save($answerWordFeedback);
                    }
                }
            }

            return $this->redirect($this->referer());
        });


        return $this->Crud->execute();

    }
}




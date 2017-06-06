<?php
declare(strict_types=1);

namespace Student\Controller;

use Cake\Event\Event;
use Cake\Routing\Router;

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

        $this->Crud->mapAction('stepOne', [
            'className' => 'Crud.Edit',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);
        $this->Crud->mapAction('stepTwo', [
            'className' => 'Crud.Edit',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);
        $this->Crud->mapAction('stepThree', [
            'className' => 'Crud.Edit',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);
        $this->Crud->mapAction('finished', [
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

        $user = $this->Answers->CreatedBy->get($this->Auth->user('id'));
        $jwtToken = $user->getJwtToken();

        $this->set(compact('jwtToken'));

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
        $this->Crud->on('beforeRedirect', function (Event $event) {
            $event->getSubject()->url = Router::url([
                'action' => 'stepOne',
                $event->getSubject()->entity->id,
            ]);
        });

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

    public function stepOne($id = null)
    {
        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->contain(['Assignments']);
        });

        return $this->Crud->execute();
    }

    public function stepTwo($id = null)
    {
        $this->Answers->AnswerWords->setSaveStrategy('replace');
        $this->Crud->action()->setConfig('saveOptions', [
            'associated' => [
                'AnswerWords',
            ],
        ]);

        $this->Crud->on('afterFind', function (Event $event) {
            $answer = $event->getSubject()->entity;

            $firstAnswerWord = $this->Answers->AnswerWords->find()
                ->where(['AnswerWords.answer_id' => $answer->id]);

            if ($firstAnswerWord->isEmpty()) {
                $this->Flash->error(__('You have to select words first'));

                return $this->redirect(Router::url([
                    'action' => 'stepOne',
                    $answer->id,
                ]));
            }
        });


        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->contain(['AnswerWords', 'Assignments']);
        });


        return $this->Crud->execute();
    }

    public function stepThree($id = null)
    {
        $this->loadModel('WordClasses');

        $wordClasses = $this->WordClasses->find('list')->order(['WordClasses.title'])->toArray();

        $this->set(compact('wordClasses'));

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->contain(['Assignments']);
        });

        $this->Crud->on('afterFind', function (Event $event) {
            $answer = $event->getSubject()->entity;

            if ($this->request->getQuery('answer_word_id') === null) {
                $firstAnswerWord = $this->Answers->AnswerWords->find()
                    ->where(['AnswerWords.answer_id' => $answer->id])
                    ->order(['AnswerWords.word_placement' => 'ASC'])
                    ->limit(1)
                    ->first();

                if ($firstAnswerWord === null) {
                    $this->Flash->error(__('You have to select words first'));

                    return $this->redirect(Router::url([
                        'action' => 'stepOne',
                        $answer->id,
                    ]));
                }

                return $this->redirect(Router::url([
                    'action' => 'stepThree',
                    $answer->id,
                    '?' => ['answer_word_id' => $firstAnswerWord->id] + $this->request->getQuery(),
                ]));
            }

            $answerWord = $this->Answers->AnswerWords->get($this->request->getQuery('answer_word_id'));
            $previousAnswerWord = $this->Answers->AnswerWords->find()
                ->where([
                    'AnswerWords.answer_id' => $answer->id,
                    'AnswerWords.word_placement <' => $answerWord->word_placement,
                ])
                ->order(['AnswerWords.word_placement' => 'DESC'])
                ->limit(1)
                ->first();

            $nextAnswerWord = $this->Answers->AnswerWords->find()
                ->where([
                    'AnswerWords.answer_id' => $answer->id,
                    'AnswerWords.word_placement >' => $answerWord->word_placement,
                ])
                ->order(['AnswerWords.word_placement' => 'ASC'])
                ->limit(1)
                ->first();

            $this->set(compact('answerWord', 'previousAnswerWord', 'nextAnswerWord'));
        });

        return $this->Crud->execute();
    }

    public function finished($id = null)
    {
        $this->Crud->on('afterFind', function (Event $event) {
            $answer = $event->getSubject()->entity;
            $answer = $this->Answers->patchEntity($answer, [
                'is_done' => true,
            ]);

            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('Assignment was finished successfully'));

                return $this->redirect(['controller' => 'Answers', 'action' => 'index']);
            }

            $this->Flash->error(__('An error happened'));
        });

        return $this->Crud->execute();

    }
}




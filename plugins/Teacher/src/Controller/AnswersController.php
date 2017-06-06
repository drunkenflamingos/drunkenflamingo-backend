<?php
declare(strict_types=1);

namespace Teacher\Controller;

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

        $this->Crud->disable(['add', 'edit', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

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

    public function view($id = null)
    {
        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->contain([
                    'CreatedBy',
                    'AnswerWords' => [
                        'WordClasses'
                    ],
                    'Assignments',
                    'Homeworks',
                ]);
        });

        return $this->Crud->execute();
    }
}




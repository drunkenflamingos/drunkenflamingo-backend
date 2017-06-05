<?php
declare(strict_types=1);

namespace Student\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\Query;

/**
 * Homeworks Controller
 *
 * @property \App\Model\Table\HomeworksTable $Homeworks
 */
class HomeworksController extends AppController
{
    public $modelClass = 'App.Homeworks';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $type = $this->request->getQuery('type') === 'user' ? 'user' : 'courses';

        $this->Crud->on('beforePaginate', function (Event $event) use ($type) {
            if ($type === 'user') {
                $event->getSubject()->query
                    ->find('ActiveAtUsers', ['time' => Time::now()])
                    ->matching('Users', function (Query $q) {
                        return $q->where(['Users.id' => $this->Auth->user('id')]);
                    });
            } else {
                $event->getSubject()->query
                    ->find('ActiveAtCourses', ['time' => Time::now()])
                    ->matching('Courses.Users', function (Query $q) {
                        return $q->where(['Users.id' => $this->Auth->user('id')]);
                    });
            }

            $event->getSubject()->query
                ->contain([
                    'Assignments.Answers' => function (Query $q) {
                        return $q->where(['Answers.created_by_id' => $this->Auth->user('id')]);
                    },
                ]);
        });

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->contain([
                    'Assignments.Answers' => function (Query $q) {
                        return $q->where(['Answers.created_by_id' => $this->Auth->user('id')]);
                    },
                ]);
        });

        $this->set(compact('type'));
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




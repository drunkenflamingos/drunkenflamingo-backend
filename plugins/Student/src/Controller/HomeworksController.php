<?php
declare(strict_types=1);

namespace Student\Controller;

use Cake\Event\Event;
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

        $type = $this->request->getQuery('type') === 'courses' ? 'courses' : 'user';

        $this->Crud->on('beforePaginate', function (Event $event) use ($type) {
            if ($type === 'courses') {
                $event->getSubject()->query->matching('Courses.Users', function (Query $q) {
                    return $q->where(['Users.id' => $this->Auth->user('id')]);
                });
            } else {
                $event->getSubject()->query->matching('Users', function (Query $q) {
                    return $q->where(['Users.id' => $this->Auth->user('id')]);
                });
            }
        });

        $this->Crud->on('beforeFind', function (Event $event) use ($type) {
            if ($type === 'courses') {
                $event->getSubject()->query->matching('Courses.Users', function (Query $q) {
                    return $q->where(['Users.id' => $this->Auth->user('id')]);
                });
            } else {
                $event->getSubject()->query->matching('Users', function (Query $q) {
                    return $q->where(['Users.id' => $this->Auth->user('id')]);
                });
            }
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




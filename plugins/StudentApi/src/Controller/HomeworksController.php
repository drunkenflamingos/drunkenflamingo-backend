<?php
declare(strict_types=1);

namespace StudentApi\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Exception\BadRequestException;
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

        $courses = $this->Homeworks->Courses->find()
            ->select(['id'])
            ->matching('Users', function (Query $q) {
                return $q->where(['Users.id' => $this->Auth->user('id')]);
            });

        if ($courses->isEmpty())
        {
            throw new BadRequestException('No courses for user');
        }

        $courses = $courses->toArray();

        $this->Crud->on('beforeFind', function (Event $event) use ($courses) {
            $event->getSubject()->query
                ->where(['Homeworks.organization_id' => $this->Auth->user('active_organization_id')])
                ->matching('HomeworksCourses', function (Query $q) use ($courses) {
                    return $q
                        ->find('publishedAt', [Time::now()])
                        ->where(['HomeworksCourses.course_id IN' => $courses]);
                });
        });

        $this->Crud->on('beforePaginate', function (Event $event) use ($courses) {
            $event->getSubject()->query
                ->where(['Homeworks.organization_id' => $this->Auth->user('active_organization_id')])
                ->matching('HomeworksCourses', function (Query $q) use ($courses) {
                    return $q
                        ->find('publishedAt', [Time::now()])
                        ->where(['HomeworksCourses.course_id IN' => $courses]);
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




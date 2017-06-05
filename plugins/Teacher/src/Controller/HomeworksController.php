<?php
declare(strict_types=1);

namespace Teacher\Controller;

use App\Model\Entity\Course;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\Routing\Router;
use Teacher\Controller\AppController;

/**
 * Homework Controller
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

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query->where([
                'Homeworks.organization_id' => $this->Auth->user('active_organization_id'),
            ]);

            if ($this->request->getQuery('show_all') !== 'true') {
                $event->getSubject()->query->where([
                    'Homeworks.created_by_id' => $this->Auth->user('id'),
                ]);
            }
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query->where([
                'Homeworks.organization_id' => $this->Auth->user('active_organization_id'),
            ]);

            if ($this->request->getQuery('show_all') !== 'true') {
                $event->getSubject()->query->where([
                    'Homeworks.created_by_id' => $this->Auth->user('id'),
                ]);
            }
        });

        $this->Crud->listener('relatedModels')->relatedModels(['Courses'], 'add');
    }

    public function index()
    {
        $courses = $this->Homeworks->Courses->find()
            ->find('DefaultOrder')
            ->where(['Courses.organization_id' => $this->Auth->user('active_organization_id')]);

        if (!empty($this->request->getQuery('course_id'))) {
            $selectedCourse = $this->Homeworks->Courses->find()
                ->where([
                    'Courses.id' => $this->request->getQuery('course_id'),
                    'Courses.organization_id' => $this->Auth->user('active_organization_id'),
                ])
                ->firstOrFail();

            $this->set(compact('selectedCourse'));
        }

        $this->set(compact('courses'));

        return $this->Crud->execute();
    }

    public function view($id = null)
    {
        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->contain([
                    'CreatedBy',
                    'Courses',
                    'Users',
                    'Assignments',
                    'Answers' => [
                        'CreatedBy',
                        'Assignments',
                    ],
                ]);
        });

        return $this->Crud->execute();
    }

    public function add()
    {
        $this->Crud->on('beforeRedirect', function (Event $event) {
            $event->getSubject()->url = Router::url([
                'action' => 'view',
                $event->getSubject()->entity->id,
            ]);
        });

        $courses = $this->Homeworks->Courses->find()
            ->where(['Courses.organization_id' => $this->Auth->user('active_organization_id')])
            ->order([
                'Courses.grade',
                'Courses.name',
            ])
            ->combine(
                'id',
                function (Course $course) {
                    return sprintf('%s.%s', $course->grade, $course->name);
                });

        $this->set(compact('courses'));

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

    public function addExistingAssignment($id = null)
    {
        $homework = $this->Homeworks->find()
            ->where([
                'Homeworks.organization_id' => $this->Auth->user('active_organization_id'),
                'Homeworks.id' => $id,
            ])
            ->firstOrFail();

        if ($this->request->is(['POST'])) {
            $assignment = $this->Homeworks->Assignments->find()
                ->where([
                    'Assignments.organization_id' => $this->Auth->user('active_organization_id'),
                    'Assignments.is_locked' => true,
                    'Assignments.id' => $this->request->getData('assignment_id'),
                ])
                ->firstOrFail();

            $this->Homeworks->Assignments->link($homework, [$assignment]);

            $this->Flash->success(__('Assignment added to homework'));

            if (!empty($this->request->getQuery('redirect_url'))) {
                return $this->redirect($this->request->getQuery('redirect_url'));
            }

            return $this->redirect($this->referer());
        }

        $assignments = $this->Homeworks->Assignments->find()
            ->where([
                'Assignments.organization_id' => $this->Auth->user('active_organization_id'),
                'Assignments.is_locked' => true,
            ])
            ->notMatching('Homeworks', function (Query $q) use ($homework) {
                return $q->where(['Homeworks.id' => $homework->id]);
            });

        $this->set('assignments', $this->paginate($assignments));
    }
}




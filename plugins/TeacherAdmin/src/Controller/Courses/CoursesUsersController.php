<?php
declare(strict_types=1);

namespace TeacherAdmin\Controller\Courses;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\Routing\Router;
use TeacherAdmin\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class CoursesUsersController extends AppController
{
    public $modelClass = 'App.CoursesUsers';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['edit', 'view', 'index']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->listener('relatedModels')->relatedModels(['Users'], 'add');

        $organizationsQuery = function (Query &$q) {
            $q
                ->matching('Users.Organizations', function (Query $q) {
                    return $q->where(['Organizations.id' => $this->Auth->user('active_organization_id')]);
                })
                ->matching('Courses.Organizations', function (Query $q) {
                    return $q->where(['Organizations.id' => $this->Auth->user('active_organization_id')]);
                });
        };

        $this->Crud->on('relatedModel', function (Event $event) {
            if ($event->getSubject()->association->name() === 'Users') {
                $event->getSubject()->query
                    ->find('NotInCourse', ['course_id' => $this->request->getParam('course_id')])
                    ->find('InOrganizationWithRoleIdentifier', [
                        'organization_id' => $this->Auth->user('active_organization_id'),
                        'role_identifier' => 'student',
                    ]);
            }
        });

        $this->Crud->on('beforeFind', function (Event $e) use ($organizationsQuery) {
            $organizationsQuery($e->getSubject()->query);
        });

        $this->Crud->on('beforePaginate', function (Event $e) use ($organizationsQuery) {
            $organizationsQuery($e->getSubject()->query);
        });

        $this->Crud->on('beforeRedirect', function (\Cake\Event\Event $event) {
            $event->getSubject()->url = Router::url([
                'prefix' => false,
                'plugin' => 'TeacherAdmin',
                'controller' => 'Courses',
                'action' => 'view',
                $this->request->getParam('course_id'),
            ]);
        });
    }

    public function add()
    {
        return $this->Crud->execute();
    }

    public function delete($id = null)
    {

        return $this->Crud->execute();
    }
}




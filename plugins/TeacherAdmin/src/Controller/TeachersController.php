<?php

namespace TeacherAdmin\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class TeachersController extends AppController
{
    public $modelClass = 'App.Users';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $teacherRoles = $this->Users->Roles->find()
            ->where(['Roles.identifier IN' => ['teacher', 'teacher_admin']])
            ->extract('id')
            ->toArray();

        $this->Crud->on('beforeFind', function (Event $event) use ($teacherRoles) {
            $event->getSubject()->query->find('InOrganizationWithRoleIdentifier', [
                'organization_id' => $this->Auth->user('active_organization_id'),
                'role_id' => $teacherRoles,
            ]);
        });

        $this->Crud->on('beforePaginate', function (Event $event) use ($teacherRoles) {
            $event->getSubject()->query
                ->find('InOrganizationWithRoleIdentifier', [
                    'organization_id' => $this->Auth->user('active_organization_id'),
                    'role_id' => $teacherRoles,
                ])
                ->contain([
                    'UsersRoles.Roles' => function (Query $q) {
                        return $q->where(['UsersRoles.organization_id' => $this->Auth->user('active_organization_id')]);
                    },
                ]);
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
        $teacherRole = $this->Users->Roles->findByIdentifier('teacher')->firstOrFail();

        $this->set(compact('teacherRole'));

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




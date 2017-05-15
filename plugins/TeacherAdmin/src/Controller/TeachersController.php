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
                ])
                ->distinct('Users.id');
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

    public function changeRole($id = null)
    {
        $this->request->allowMethod(['POST']);

        $user = $this->Users->find()
            ->where(['Users.id' => $id])
            ->firstOrFail();

        $role = $this->Users->Roles->find()
            ->where(['Roles.identifier' => $this->request->getData('type')])
            ->firstOrFail();

        $usersRoles = $this->Users->UsersRoles->find()
            ->where([
                'UsersRoles.user_id' => $user->id,
                'UsersRoles.organization_id' => $this->Auth->user('active_organization_id'),
            ]);

        if ($this->request->getData('action') === 'add') {
            $usersRoles = $usersRoles->where(['UsersRoles.role_id' => $role->id]);

            if ($usersRoles->count() > 1) {
                $this->Flash->error(__('Teacher already has this role'));

                return $this->redirect($this->request->referer());
            }

            $userRole = $this->Users->UsersRoles->newEntity([
                'user_id' => $user->id,
                'role_id' => $role->id,
                'organization_id' => $this->Auth->user('active_organization_id'),
            ]);

            $this->Users->UsersRoles->save($userRole);

            $this->Flash->success(__('Role added toteacher'));

            return $this->redirect($this->request->referer());
        }

        if ($this->request->getData('action') === 'delete') {
            if (!($usersRoles->count() > 1)) {
                $this->Flash->error(__('Teacher only has this role'));

                return $this->redirect($this->request->referer());
            }

            $usersRoles = $usersRoles
                ->where(['UsersRoles.role_id' => $role->id])
                ->first();

            $this->Users->UsersRoles->delete($usersRoles);

            $this->Flash->success(__('Role removed from teacher'));

            return $this->redirect($this->request->referer());
        }

        $this->Flash->error(__('An error happened'));

        return $this->redirect($this->request->referer());

    }
}




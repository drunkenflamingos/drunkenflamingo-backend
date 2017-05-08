<?php

namespace TeacherAdmin\Controller;

use Cake\Event\Event;
use TeacherAdmin\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public $modelClass = 'App.Users';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $studentRole = $this->Users->Roles->findByIdentifier('student')->firstOrFail();

        $this->Crud->on('beforeFind', function (\Cake\Event\Event $event) use ($studentRole) {
            $event->getSubject()->query->find('InOrganizationWithRoleIdentifier', [
                'organization_id' => $this->Auth->user('active_organization_id'),
                'role_id' => $studentRole->id,
            ]);
        });

        $this->Crud->on('beforePaginate', function (\Cake\Event\Event $event) use ($studentRole) {
            $event->getSubject()->query->find('InOrganizationWithRoleIdentifier', [
                'organization_id' => $this->Auth->user('active_organization_id'),
                'role_id' => $studentRole->id,
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
        $studentRole = $this->Users->Roles->findByIdentifier('student')->firstOrFail();

        $this->set(compact('studentRole'));

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




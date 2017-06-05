<?php

namespace Teacher\Controller;

use Cake\Event\Event;
use Teacher\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public $modelClass = 'Users';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['add', 'edit', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $studentRole = $this->Users->Roles->findByIdentifier('student')->firstOrFail();

        $this->Crud->on('beforeFind', function (Event $event) use ($studentRole) {
            $event->getSubject()->query->find('InOrganizationWithRoleIdentifier', [
                'organization_id' => $this->Auth->user('active_organization_id'),
                'role_id' => $studentRole->id,
            ]);
        });

        $this->Crud->on('beforePaginate', function (Event $event) use ($studentRole) {
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
}

<?php

namespace Student\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * Organizations Controller
 *
 * @property \App\Model\Table\OrganizationsTable $Organizations
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\RolesTable $Roles
 */
class OrganizationsController extends AppController
{
    public $modelClass = 'App.Organizations';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['add', 'edit', 'index', 'view', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Users');
        $this->loadModel('Roles');
    }

    public function picker()
    {
        $organizations = $this->Organizations->find()
            ->matching('UsersRoles', function (Query $q) {
                return $q->where(['UsersRoles.user_id' => $this->Auth->user('id')]);
            });

        if ($organizations->isEmpty()) {
            $this->Flash->success(__("Create your first organization"));

            return $this->redirect([
                'action' => 'add',
            ]);
        }

        $this->set(compact('organizations'));
    }

    public function pick($id)
    {
        $organization = $this->Organizations->findById($id)->firstOrFail();

        $user = $this->Users->get($this->Auth->user('id'));
        $user->active_organization_id = $organization->id;
        $this->Users->save($user);

        $this->Auth->setUser($user->toArray());

        return $this->redirect([
            'controller' => 'Dashboard',
            'action' => 'index',
        ]);
    }
}

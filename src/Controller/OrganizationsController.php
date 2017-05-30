<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\Utility\Inflector;

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

        $this->Crud->disable(['add', 'edit', 'view', 'index', 'delete']);
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
            ->contain([
                'UsersRoles.Roles' => function (Query $q) {
                    return $q->where(['UsersRoles.user_id' => $this->Auth->user('id')]);
                },
            ])
            ->matching('UsersRoles', function (Query $q) {
                return $q->where(['UsersRoles.user_id' => $this->Auth->user('id')]);
            })
            ->distinct('Organizations.id');

        if ($organizations->isEmpty()) {
            return $this->redirect([
                'action' => 'waiting',
            ]);
        }

        $this->set(compact('organizations'));
    }

    public function pick($id)
    {
        $organization = $this->Organizations->find()
            ->where(['Organizations.id' => $id])
            ->matching('UsersRoles', function (Query $q) {
                return $q->where([
                    'UsersRoles.user_id' => $this->Auth->user('id'),
                    'UsersRoles.role_id' => $this->request->getData('role_id'),
                ]);
            })
            ->firstOrFail();

        $role = $this->Roles->get($this->request->getData('role_id'));

        $defaultPlugin = Inflector::classify($role->identifier);

        $user = $this->Users->get($this->Auth->user('id'));
        $user->active_organization_id = $organization->id;
        $this->Users->save($user);
        $this->Auth->setUser($user->toArray());

        return $this->redirect([
            'plugin' => $defaultPlugin,
            'controller' => 'Dashboard',
            'action' => 'index',
        ]);
    }

    public function waiting()
    {

    }
}

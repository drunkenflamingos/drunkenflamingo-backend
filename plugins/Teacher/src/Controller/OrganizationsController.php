<?php
namespace Teacher\Controller;

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
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Users');
        $this->loadModel('Roles');
    }

    public function index()
    {
        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->subject()->query
                ->matching('UsersRoles', function (Query $q) {
                    return $q->where(['user_id' => $this->Auth->user('id')]);
                });
        });

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->subject()->query
                ->matching('UsersRoles', function (Query $q) {
                    return $q->where(['user_id' => $this->Auth->user('id')]);
                });
        });

        return $this->Crud->execute();
    }

    public function add()
    {
        $this->Crud->on('afterSave', function (Event $event) {
            //Connect the users_roles
            $ownerRoleId = $this->Roles->findByIdentifier('owner')->firstOrFail()->id;

            $userRole = $this->Organizations->UsersRoles->newEntity([
                'user_id' => $this->Auth->user('id'),
                'organization_id' => $event->subject()->entity->id,
                'role_id' => $ownerRoleId,
            ]);

            $this->Organizations->UsersRoles->save($userRole);
        });

        return $this->Crud->execute();
    }

    public function view($id)
    {
        return $this->Crud->execute();
    }

    public function edit($id)
    {
        $this->Crud->listener('relatedModels')->relatedModels(['Languages', 'ContactPeople'], 'edit');

        $contactPersonInOrganization = $this->Organizations->ContactPeople->find()
            ->matching('UsersRoles.Organizations', function (Query $q) use ($id) {
                return $q->where(['Organizations.id' => $id]);
            });

        $this->set('contact_people', $contactPersonInOrganization);

        return $this->Crud->execute();
    }

    public function delete($id)
    {
        return $this->Crud->execute();
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

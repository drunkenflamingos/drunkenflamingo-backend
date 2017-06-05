<?php

namespace Teacher\Controller;

use App\Model\Entity\Course;
use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * HomeworksUsers Controller
 *
 * @property \App\Model\Table\HomeworksUsersTable $HomeworksUsers
 */
class HomeworksUsersController extends AppController
{
    public $modelClass = 'App.HomeworksUsers';

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['index', 'view']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->matching('Homeworks', function (Query $q) {
                    return $q->where(['Homeworks.organization_id' => $this->Auth->user('active_organization_id')]);
                })
                ->matching('Users', function (Query $q) {
                    return $q->find('InOrganizationWithRoleIdentifier', [
                        'organization_id' => $this->Auth->user('active_organization_id'),
                        'role_identifier' => 'student',
                    ]);
                });
        });
    }

    public function add()
    {
        $this->Crud->on('beforeSave', function (Event $event) {
            $event->getSubject()->entity->homework_id = $this->request->getQuery('homework_id');
        });

        $users = $this->HomeworksUsers->Users
            ->find('InOrganizationWithRoleIdentifier', [
                'organization_id' => $this->Auth->user('active_organization_id'),
                'role_identifier' => 'student',
            ])
            ->order([
                'Users.name',
            ])
            ->combine('id', 'name');

        $this->set(compact('users'));

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




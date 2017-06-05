<?php
declare(strict_types=1);

namespace Teacher\Controller;

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
                ->matching('Courses', function (Query $q) {
                    return $q->where([
                        'Courses.organization_id' => $this->Auth->user('active_organization_id'),
                    ]);
                });
        });

        $this->Crud->on('beforePaginate', function (Event $event) {
            $event->getSubject()->query
                ->matching('Courses', function (Query $q) {
                    return $q->where([
                        'Courses.organization_id' => $this->Auth->user('active_organization_id'),
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
            ->find('list')
            ->find('InOrganizationWithRoleIdentifier', [
                'role_identifier' => 'student',
                'organization_id' => $this->Auth->user('active_organization_id'),
            ])
            ->order(['Users.name']);


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




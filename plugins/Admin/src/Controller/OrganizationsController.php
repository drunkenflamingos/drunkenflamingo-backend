<?php
declare(strict_types=1);

namespace Admin\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;

/**
 * Organizations Controller
 *
 * @property \App\Model\Table\OrganizationsTable $Organizations
 */
class OrganizationsController extends AppController
{
    public $isAdmin = false;
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
        return $this->Crud->execute();
    }

    public function add()
    {
        $teacherAdmin = $this->Roles->findByIdentifier('teacher_admin')->firstOrFail();

        $this->set(compact('teacherAdmin'));

        $this->Crud->on('beforeSave', function (Event $event) {
        });

        $this->Crud->on('afterSave', function (Event $event) {
            //Set the newly created user as contact person
            $userId = $event->getSubject()->entity->users[0]->id;

            $newEntity = $this->Organizations->patchEntity($event->getSubject()->entity, [
                'contact_person_id' => $userId,
            ]);

            $this->Organizations->save($newEntity);
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
}




<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * Organizations Controller
 *
 * @property \Admin\Model\Table\OrganizationsTable $Organizations
 */
class OrganizationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);

        $action = $this->Crud->action();
        $action->config('scaffold.fields', ['name', 'vat_number']);
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




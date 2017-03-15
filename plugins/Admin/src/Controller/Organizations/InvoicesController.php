<?php
namespace Admin\Controller\Organizations;

use Admin\Controller\AppController;

/**
 * Invoices Controller
 *
 * @property \Admin\Model\Table\InvoicesTable $Invoices
 */
class InvoicesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Invoices');
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




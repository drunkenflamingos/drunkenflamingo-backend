<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Event\Event;

/**
 * Currencies Controller
 *
 * @property \App\Model\Table\CurrenciesTable $Currencies
 */
class CurrenciesController extends AppController
{
    public $isAdmin = true;

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Currencies');

        if ($this->request->param('action') !== 'index') {
            $action = $this->Crud->action();
            $action->config('scaffold.fields', ['name', 'iso_code', 'short_name']);
        }
    }

    public function index()
    {
        $action = $this->Crud->action();
        $action->config('scaffold.fields', ['name', 'iso_code', 'short_name']);

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




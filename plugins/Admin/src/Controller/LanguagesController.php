<?php
declare(strict_types=1);

namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Event\Event;

/**
 * Languages Controller
 *
 * @property \App\Model\Table\LanguagesTable $Languages
 */
class LanguagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Languages');

        $action = $this->Crud->action();
        $action->setConfig('scaffold.fields', ['name', 'iso_code']);
    }

    public function index()
    {
        return $this->Crud->execute();
    }

    public function add()
    {
        return $this->Crud->execute();
    }

    public function view($id)
    {
        return $this->Crud->execute();
    }

    public function edit($id)
    {
        return $this->Crud->execute();
    }

    public function delete($id)
    {
        return $this->Crud->execute();
    }
}

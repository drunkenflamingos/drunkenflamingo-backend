<?php
declare(strict_types=1);

namespace Admin\Controller;

use Cake\Event\Event;

/**
 * WordClasses Controller
 *
 * @property \App\Model\Table\WordClassesTable $WordClasses
 */
class WordClassesController extends AppController
{
    public $isAdmin = true;
    public $modelClass = 'App.WordClasses';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $action = $this->Crud->action();
        $action->setConfig('scaffold.fields', ['title', 'identifier', 'description']);
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




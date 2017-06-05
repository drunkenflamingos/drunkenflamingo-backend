<?php
declare(strict_types=1);

namespace Teacher\Controller;

use Teacher\Controller\AppController;

/**
 * Answers Controller
 *
 * @property \Teacher\Model\Table\AnswersTable $Answers
 */
class AnswersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
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




<?php

namespace Teacher\Controller;

use Cake\Event\Event;
use Cake\ORM\Query;


/**
 * Classes Controller
 *
 * @property \App\Model\Table\ClassesTable $Classes
 */
class ClassesController extends AppController
{
    public $modelClass = 'App.Classes';

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->on('beforeFilter', function (Event $event) {
            $event->getSubject()->query
                ->matching('Organizations', function (Query $q) {
                    return $q->where(['Organizations.id' => $this->Auth->user('active_organization_id')]);
                });
        });

        $this->Crud->on('beforeFind', function (Event $event) {
            $event->getSubject()->query
                ->matching('Organizations', function (Query $q) {
                    return $q->where(['Organizations.id' => $this->Auth->user('active_organization_id')]);
                });
        });
    }

    public function index()
    {
        $this->Crud->on('beforeRender', function (Event $event) {
            debug($event->getSubject());
            die;
        });

        return $this->Crud->execute();
    }

    public function view($id = null)
    {
        return $this->Crud->execute();
    }
}




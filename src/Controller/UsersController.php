<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use ReCaptcha\ReCaptcha;

/**
 * Login Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->Auth->allow(['register']);

        $this->Crud->disable(['add', 'index', 'view', 'edit', 'delete']);

        $this->Crud->mapAction('register', [
            'className' => 'CrudUsers.Register',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);

        $this->Crud->mapAction('logout', [
            'className' => 'CrudUsers.Logout',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);

        $this->Crud->mapAction('login', [
            'className' => 'CrudUsers.Login',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Users');
    }

    public function login()
    {
        if (!empty($this->Auth->user('id'))) {
            $this->Flash->info(__("You're already logged in! :-)"));

            return $this->redirect(['plugin' => 'User', 'controller' => 'Organizations', 'action' => 'picker']);
        }

        $this->Crud->on('beforeLogin', function (Event $event) {

            $recaptcha = new ReCaptcha(Configure::read('Recaptcha.secretkey'));
            $resp = $recaptcha->verify($this->request->data('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

            if ($resp->isSuccess()) {
                $event->stopPropagation();
            } else {
                $this->Flash->error(__('Captcha failed...'));
                $event->stopPropagation();
            }
        });

        return $this->Crud->execute();
    }

    public function register()
    {
        $this->Crud->on('afterRegister', function (Event $event) {
            if ($event->subject()->success === true) {
                $this->Auth->setUser($event->subject()->entity->toArray());

                return $this->redirect([
                    'plugin' => 'User',
                    'controller' => 'Organizations',
                    'action' => 'add',
                ]);
            }
        });

        $this->Crud->on('beforeRedirect', function (Event $event) {
            $event->subject()->url = Router::url([
                'controller' => 'Users',
                'action' => 'view',
            ]);
        });

        return $this->Crud->execute();
    }

    public function logout()
    {
        return $this->Crud->execute();
    }
}




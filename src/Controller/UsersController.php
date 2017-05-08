<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\BadRequestException;
use Cake\Routing\Router;
use League\OAuth2\Client\Provider\Google;
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

        $this->Auth->allow(['register', 'loginOauth', 'oauthGoogle']);

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

            return $this->redirect(['plugin' => null, 'controller' => 'Organizations', 'action' => 'picker']);
        }

        $this->Crud->on('beforeLogin', function (Event $event) {
            $recaptcha = new ReCaptcha(Configure::read('Recaptcha.secretkey'));
            $resp = $recaptcha->verify($this->request->getData('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

            if (!$resp->isSuccess()) {
                $event->stopPropagation();
                $this->Flash->error(__('Captcha failed...'));
                return $this->redirect($this->referer());
            }
        });

        $this->Crud->on('afterLogin', function (Event $event) {
            //Post-login logic
        });

        return $this->Crud->execute();
    }

    public function register()
    {
        $this->Crud->on('afterRegister', function (Event $event) {
            if ($event->getSubject()->success === true) {
                $this->Auth->setUser($event->getSubject()->entity->toArray());

                return $this->redirect([
                    'plugin' => null,
                    'controller' => 'Organizations',
                    'action' => 'picker',
                ]);
            }
        });

        return $this->Crud->execute();
    }

    public function logout()
    {
        return $this->Crud->execute();
    }

    public function oauthGoogle()
    {
        $provider = new Google(Configure::read('Muffin/OAuth2.providers.google.options'));

        $authUrl = $provider->getAuthorizationUrl();

        $session = $this->request->session();
        $session->write('oauth2state', $provider->getState());

        if ($this->request->getQuery('redirect') !== null) {
            $session->write('oauth2redirectAfterLogin', $this->request->getQuery('redirect'));
        }

        return $this->redirect($authUrl);
    }

    public function loginOauth()
    {
        $session =$this->request->session();
        if ($session->read('oauth2state') !== $this->request->getQuery('state')) {
            //XSS?
            throw new BadRequestException(__('Invalid state'));
        }

        $user = $this->Auth->identify();

        if ($user) {
            $this->Auth->setUser($user);

            $this->Flash->success(__('You got logged in'));

            if ($session->read('oauth2redirectAfterLogin') !== null) {
                return $this->redirect($session->read('oauth2redirectAfterLogin'));
            }

            return $this->redirect($this->Auth->redirectUrl());
        }

        $this->Flash->error(__('An error happened'));

        return $this->redirect(['action' => 'login']);
    }
}




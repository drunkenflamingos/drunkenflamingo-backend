<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * ResetPasswords Controller
 *
 * @property \App\Model\Table\ResetPasswordsTable $ResetPasswords
 */
class ResetPasswordsController extends AppController
{
    public $modelClass = 'Users';

    public function initialize()
    {
        parent::initialize();

        $this->Auth->allow(['forgotPassword', 'resetPassword']);

        $this->Crud->disable(['add', 'edit', 'view', 'delete', 'index']);

        $this->Crud->mapAction('resetPassword', [
            'tokenField' => 'reset_token',
            'className' => 'CrudUsers.ResetPassword',
            'messages' => [
                'success' => [
                    'params' => ['class' => 'alert alert-success alert-dismissible'],
                ],
                'error' => [
                    'params' => ['class' => 'alert alert-danger alert-dismissible'],
                ],
            ],
        ]);

        $this->Crud->mapAction('forgotPassword', [
            'tokenField' => 'reset_token',
            'className' => 'CrudUsers.ForgotPassword',
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
    }

    public function resetPassword()
    {
        $this->Crud->on('verifyToken', function (Event $event) {
            $token = $event->getSubject()->token;
            $user = $event->getSubject()->query->first();

            if ($token === $user->reset_token) {
                $event->getSubject()->verified = true;
            }
        });

        return $this->Crud->execute();
    }

    public function forgotPassword()
    {
        $this->Crud->on('afterForgotPassword', function (Event $event) {
            $event->getSubject()->entity->sendForgotPasswordMail();
        });

        return $this->Crud->execute();
    }


}

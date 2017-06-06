<?php

namespace App\Mailer;

use App\Model\Entity\User;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;

/**
 * User mailer.
 */
class UserMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'User';

    public function forgotPassword(User $user)
    {
        $this
            ->to($user->email)
            ->setSubject(__('Forgot password for Wordy'))
            ->set([
                'user' => $user,
                'resetUrl' => Router::url([
                    'prefix' => false,
                    'plugin' => false,
                    'controller' => 'ResetPasswords',
                    'action' => 'resetPassword',
                    $user->token,
                ], true),
            ]);
    }
}

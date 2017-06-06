<?php
declare(strict_types=1);

namespace StudentApi\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Auth Controller
 *

 */
class AuthController extends AppController
{
    public $modelClass = null;

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['index', 'view', 'add', 'edit', 'delete']);


        $this->Auth->allow(['token']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Security->setConfig('unlockedActions', ['token']);
        $this->eventManager()->off($this->Csrf);
    }

    public function token()
    {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }
        $this->set([
            'success' => true,
            'data' => [
                'token' => JWT::encode(
                    [
                        'sub' => $user['id'],
                        'exp' => time() + 604800,
                    ],
                    Security::salt()
                ),
            ],
            '_serialize' => ['success', 'data'],
        ]);
    }
}




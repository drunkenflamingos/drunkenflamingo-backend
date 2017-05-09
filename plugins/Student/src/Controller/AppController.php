<?php

namespace Student\Controller;

use App\Controller\AppController as BaseController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * @property \App\Model\Table\UsersTable $Users
 */
class AppController extends BaseController
{

    public function initialize()
    {
        parent::initialize();

        $this->Auth->setConfig('authError', __('Unauthorized to student section'));
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('Users');

        $userId = $this->Auth->user('id');

        $user = $this->Users->get($userId);

        if ($user->active_organization_id === null && !($this->request->param('controller') === 'Organizations' && ($this->request->param('action') === 'add') || $this->request->param('action') === 'picker')) {
            return $this->redirect([
                'controller' => 'Organizations',
                'action' => 'picker',
            ]);
        }
    }

    public function isAuthorized(array $user): bool
    {
        $organizationId = $user['active_organization_id'];
        $userId = $user['id'];

        try {
            $usersRole = TableRegistry::get('UsersRoles')->find()
                ->where([
                    'UsersRoles.user_id' => $userId,
                    'UsersRoles.organization_id' => $organizationId,
                ])
                ->matching('Roles', function (Query $q) {
                    return $q->where(['Roles.identifier' => 'student']);
                })
                ->firstOrFail();
        } catch (RecordNotFoundException $e) {
            return false;
        }

        return $usersRole !== null && parent::isAuthorized($user);
    }
}

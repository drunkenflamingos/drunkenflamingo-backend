<?php
declare(strict_types=1);

namespace TeacherAdmin\Controller;

use App\Controller\AppController as BaseController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class AppController extends BaseController
{
    public function initialize()
    {
        parent::initialize();

        $this->Auth->setConfig('authError', __('Unauthorized to Teacher administration'));
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
                    return $q->where(['Roles.identifier' => 'teacher_admin']);
                })
                ->contain(['Roles'])
                ->firstOrFail();
        } catch (RecordNotFoundException $e) {
            return false;
        }

        return $usersRole->role->identifier === 'teacher_admin' && parent::isAuthorized($user);
    }

}

<?php

namespace TeacherApi\Controller;


use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class AppController extends \Api\Controller\AppController
{
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
                    return $q->where(['Roles.identifier' => 'teacher']);
                })
                ->contain(['Roles'])
                ->firstOrFail();
        } catch (RecordNotFoundException $e) {
            return false;
        }

        return $usersRole->role->identifier === 'teacher' && parent::isAuthorized($user);
    }

}

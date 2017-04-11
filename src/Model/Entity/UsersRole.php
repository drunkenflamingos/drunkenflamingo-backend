<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersRole Entity
 *
 * @property string $id
 * @property string $created_by_id
 * @property string $modified_by_id
 * @property string $user_id
 * @property string $role_id
 * @property string $organization_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 *
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $modified_by
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Organization $organization
 */
class UsersRole extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'role_id' => true,
        'organization_id' => true,
    ];
}

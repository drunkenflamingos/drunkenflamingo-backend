<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id
 * @property string $created_by_id
 * @property string $modified_by_id
 * @property string $language_id
 * @property string $active_organization_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone_number
 * @property string $file_dir
 * @property int $file_size
 * @property string $file_type
 * @property string $file_name
 * @property string $reset_token
 * @property \Cake\I18n\Time $reset_expires
 * @property bool $is_activated
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 *
 * @property \App\Model\Entity\Organization $active_organization
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $modified_by
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\Role[] $roles
 */
class User extends Entity
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
        'language_id' => true,
        'active_organization_id' => true,
        'name' => true,
        'email' => true,
        'password' => true,
        'file' => true,
        'file_dir' => true,
        'file_size' => true,
        'file_type' => true,
        'file_name' => true,
        'user_oauth_tokens' => true,
        'users_roles' => true,
        'roles' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'file_dir',
        'file_size',
        'file_type',
        'file_name',
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}

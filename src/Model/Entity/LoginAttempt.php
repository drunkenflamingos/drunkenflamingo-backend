<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LoginAttempt Entity
 *
 * @property string $id
 * @property string $user_id
 * @property bool $success
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 */
class LoginAttempt extends Entity
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
        'ip4' => true,
        'ip6' => true,
        'success' => true,
    ];
}

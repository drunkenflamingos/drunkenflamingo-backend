<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Utility\Text;
use Firebase\JWT\JWT;

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
 * @property string $token
 * @property Time $reset_expires
 * @property bool $is_activated
 * @property Time $created
 * @property Time $modified
 * @property Time $deleted
 *
 * @property \App\Model\Entity\Organization $active_organization
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $modified_by
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\Role[] $roles
 * @property \App\Model\Entity\LoginAttempt[] $loginAttempts
 */
class User extends Entity
{
    use MailerAwareTrait;
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

        return null;
    }

    public function getJwtToken()
    {
        return JWT::encode(
            [
                'sub' => $this->id,
                'exp' => time() + 604800,
            ],
            Security::salt()
        );
    }

    public function sendForgotPasswordMail()
    {
        $this->token = Text::uuid();
        $this->reset_expires = Time::now()->addDays(7);

        if (TableRegistry::get('Users')->save($this)) {
            $this->getMailer('User')->send('forgotPassword', [$this]);
        }
    }

    public function triggerSuccessfullLogin(string $ipv4 = null, string $ipv6 = null)
    {
        $loginAttempts = TableRegistry::get('LoginAttempts');

        $loginAttempt = $loginAttempts->newEntity([
            'user_id' => $this->id,
            'ip4' => $ipv4,
            'ip6' => $ipv6,
            'success' => true,
        ]);

        $loginAttempts->save($loginAttempt);
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organization Entity
 *
 * @property string $id
 * @property string $created_by_id
 * @property string $modified_by_id
 * @property string $contact_person_id
 * @property string $language_id
 * @property string $country_id
 * @property string $name
 * @property string $invoice_email
 * @property string $phone_number
 * @property int $vat_number
 * @property string $street_name
 * @property string $zip_code
 * @property string $city
 * @property string $file_dir
 * @property int $file_size
 * @property string $file_type
 * @property string $file_name
 * @property bool $is_activated
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 *
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $modified_by
 * @property \App\Model\Entity\User $contact_person
 * @property \App\Model\Entity\Language $default_language
 * @property \App\Model\Entity\User[] $users
 */
class Organization extends Entity
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
        'contact_person_id' => true,
        'language_id' => true,
        'country_id' => true,
        'name' => true,
        'invoice_email' => true,
        'phone_number' => true,
        'vat_number' => true,
        'street_name' => true,
        'zip_code' => true,
        'city' => true,
        'file_dir' => true,
        'file_size' => true,
        'file_type' => true,
        'file_name' => true,
        'slug' => true,
        'is_activated' => true,
        'users' => true,
    ];
}

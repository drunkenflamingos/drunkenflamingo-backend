<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Country Entity
 *
 * @property string $id
 * @property string $currency_id
 * @property string $language_id
 * @property string $name
 * @property string $iso_code
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 *
 * @property \App\Model\Entity\Currency $currency
 * @property \App\Model\Entity\Language $language
 * @property \App\Model\Entity\Bank[] $banks
 * @property \App\Model\Entity\Contact[] $contacts
 * @property \App\Model\Entity\Organization[] $organizations
 */
class Country extends Entity
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
        '*' => true,
        'id' => false,
    ];
}

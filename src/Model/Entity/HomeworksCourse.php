<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HomeworksCourse Entity
 *
 * @property string $id
 * @property string $created_by_id
 * @property string $modified_by_id
 * @property string $course_id
 * @property string $homework_id
 * @property \Cake\I18n\FrozenTime $published_from
 * @property \Cake\I18n\FrozenTime $published_to
 * @property \Cake\I18n\FrozenTime $deadline
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $modified_by
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\Homeworks $homework
 */
class HomeworksCourse extends Entity
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
        'course_id' => true,
        'homework_id' => true,
        'published_from' => true,
        'published_to' => true,
        'deadline' => true,
    ];
}

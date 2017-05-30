<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AnswerWord Entity
 *
 * @property string $id
 * @property string $created_by_id
 * @property string $modified_by_id
 * @property string $word_class_id
 * @property int $word_placement
 * @property string $definition
 * @property string $synonym
 * @property string $sentence
 * @property string $help_text
 * @property bool $is_skipped
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\User $created_by
 * @property \App\Model\Entity\User $modified_by
 * @property \App\Model\Entity\WordClass $word_class
 * @property \App\Model\Entity\AnswerWordFeedback[] $answer_word_feedbacks
 */
class AnswerWord extends Entity
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
        'word_class_id' => true,
        'word_placement' => true,
        'definition' => true,
        'synonym' => true,
        'sentence' => true,
        'help_text' => true,
        'is_skipped' => true,
    ];
}

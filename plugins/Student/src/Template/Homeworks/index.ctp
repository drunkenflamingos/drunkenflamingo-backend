<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
use App\Model\Entity\Answer;
use App\Model\Entity\Assignment;
use App\Model\Entity\Homework;

$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Homework'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group-raised">
    <?php if ($this->request->getQuery('type') === 'courses'): ?>
        <?= $this->Html->link(__('Show direct'),
            ['?' => ['type' => 'user'] + $this->request->getQuery()],
            ['class' => 'btn']
        ) ?>
    <?php else: ?>
        <?= $this->Html->link(__('From course'),
            ['?' => ['type' => 'courses'] + $this->request->getQuery()],
            ['class' => 'btn']
        ) ?>
    <?php endif ?>
</div>
<?php $this->end(); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('name'); ?></th>
        <th><?= $this->Paginator->sort('deadline'); ?></th>
        <th><?= __('Solved'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($homeworks as $homework): ?>
        <tr>
            <td>
                <?= $this->Html->link(
                    h($homework->name),
                    ['action' => 'view', $homework->id]
                ) ?>
            </td>
            <td>
                <?php
                $deadline = $homework->_matchingData['HomeworksCourses']->deadline ?? $homework->_matchingData['HomeworksUsers']->deadline ?? null;
                ?>

                <?php if (!empty($deadline)) : ?>
                    <?= $deadline->i18nFormat() ?> (<?= $deadline->diffForHumans() ?>)
                <?php else: ?>
                    <?= __('None') ?>
                <?php endif; ?>
            </td>
            <td>
                <?php
                if (!empty($homework->assignments)): ?>
                <?php
                $assignmentsInHomework = count($homework->assignments);
                $answers = collection($homework->assignments)->countBy(function (Assignment $entity) {
                    if (empty($entity->answers)) {
                        return 'none';
                    }

                    $answers = collection($entity->answers)
                        ->countBy(function (Answer $answer) {
                            return $answer->is_done ? 'done' : 'incomplete';
                        })
                        ->toArray();

                    return array_key_exists('done', $answers) ? 'answered' : 'none';
                })
                    ->toArray();

                $completed = $answers['answered'] ?? 0;
                ?>

                <?php if ($completed === $assignmentsInHomework) : ?>
                <span class="label label-success">
                <?php else: ?>
                    <span class="label label-warning">
                <?php endif; ?>
                <?= \Cake\I18n\Number::toPercentage(round(($completed / $assignmentsInHomework) * 100),
                    0) ?>
                    </span>
                    <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator text-center">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>

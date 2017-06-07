<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Answers'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('Assignments.title', __('Assignment')); ?></th>
        <th><?= $this->Paginator->sort('Homeworks.name', __('Homework name')); ?></th>
        <th><?= $this->Paginator->sort('Answers.is_done', __('Completed')); ?></th>
        <th><?= $this->Paginator->sort('Answers.created'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($answers as $answer): ?>
        <tr>
            <td>
                <?= $this->Html->link(h($answer->assignment->title), [
                    'controller' => 'Assignments',
                    'action' => 'view',
                    $answer->assignment_id,
                ]) ?>
            </td>
            <td>
                <?= $this->Html->link(h($answer->homework->name), [
                    'controller' => 'Homeworks',
                    'action' => 'view',
                    $answer->homework_id,
                ]) ?>
            </td>
            <td><?= h($answer->is_done ? __('Yes') : __('No')) ?></td>
            <td><?= h($answer->created) ?></td>
            <td>
                <?php if ($answer->is_done): ?>
                    <?= $this->Html->link(__('View'), [
                        'controller' => 'Answers',
                        'action' => 'finished',
                        $answer->id,
                    ]) ?>
                    <?= $this->Table->actionSeparator(); ?>
                <?php endif ?>
                <?= $this->Html->link(__('Edit'), [
                    'controller' => 'Answers',
                    'action' => 'stepOne',
                    $answer->id,
                ]) ?>
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

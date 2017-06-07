<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Answer Feedback'); ?></h1>
<?php $this->end(); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('CreatedBy.name',__('Teacher')); ?></th>
        <th><?= $this->Paginator->sort('Answers.Assignments.title',__('Assignment title')); ?></th>
        <th><?= $this->Paginator->sort('AnswerFeedbacks.title',__('Subject')); ?></th>
        <th><?= $this->Paginator->sort('AnswerFeedbacks.created',__('Created')); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($answerFeedbacks as $answerFeedback): ?>
        <tr>
            <td><?= h($answerFeedback->created_by->name) ?></td>
            <td><?= h($answerFeedback->answer->assignment->title) ?></td>
            <td><?= h($answerFeedback->title) ?></td>
            <td><?= h($answerFeedback->created) ?></td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'), ['action' => 'view', $answerFeedback->id], ['title' => __('View')]),
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

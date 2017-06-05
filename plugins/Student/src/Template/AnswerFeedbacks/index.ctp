<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Answer Feedback'); ?></h1>
<?php $this->end(); ?>

<?php
$this->start('content_buttons');
?>
<div class="btn-group-raised">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('New Answer Feedback'), [
        'action' => 'add',
    ], [
        'class' => 'btn btn-primary',
        'escape' => false,
    ]) ?>
</div>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('content_buttons') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('id'); ?></th>
        <th><?= $this->Paginator->sort('created_by_id'); ?></th>
        <th><?= $this->Paginator->sort('modified_by_id'); ?></th>
        <th><?= $this->Paginator->sort('answer_id'); ?></th>
        <th><?= $this->Paginator->sort('title'); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th><?= $this->Paginator->sort('modified'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($answerFeedbacks as $answerFeedback): ?>
        <tr>
            <td><?= h($answerFeedback->id) ?></td>
            <td><?= h($answerFeedback->created_by_id) ?></td>
            <td><?= h($answerFeedback->modified_by_id) ?></td>
            <td><?= h($answerFeedback->answer_id) ?></td>
            <td><?= h($answerFeedback->title) ?></td>
            <td><?= h($answerFeedback->created) ?></td>
            <td><?= h($answerFeedback->modified) ?></td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'),
                        ['action' => 'view', $homework->id]
                    ),
                    $this->Html->link(__('Edit'),
                        ['action' => 'edit', $homework->id]
                    ),
                    $this->Form->postLink(__('Delete'),
                        ['action' => 'delete', $homework->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $homework->name),]
                    ),
                ]) ?>

            </td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'), ['action' => 'view', $answerFeedback->id], ['title' => __('View')]),
                    $this->Html->link(__('Edit'), ['action' => 'edit', $answerFeedback->id], ['title' => __('Edit')]),
                    $this->Form->postLink(__('Delete'), ['action' => 'delete', $answerFeedback->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $answerFeedback->id),
                        'title' => __('Delete'),
                    ]),
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

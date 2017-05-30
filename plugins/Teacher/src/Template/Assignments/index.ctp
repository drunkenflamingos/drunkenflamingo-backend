<?php
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Assignment'); ?></h1>
<?php $this->end(); ?>

<?php
$this->start('content_buttons');
?>
<div class="btn-group-raised">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('New Assignment'), [
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
        <th><?= $this->Paginator->sort('organization_id'); ?></th>
        <th><?= $this->Paginator->sort('title'); ?></th>
        <th><?= $this->Paginator->sort('is_locked'); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($assignments as $assignment): ?>
        <tr>
            <td><?= h($assignment->id) ?></td>
            <td><?= h($assignment->created_by_id) ?></td>
            <td><?= h($assignment->modified_by_id) ?></td>
            <td><?= h($assignment->organization_id) ?></td>
            <td><?= h($assignment->title) ?></td>
            <td><?= h($assignment->is_locked) ?></td>
            <td><?= h($assignment->created) ?></td>
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
                    $this->Html->link(__('View'), ['action' => 'view', $assignment->id], ['title' => __('View')]),
                    $this->Html->link(__('Edit'), ['action' => 'edit', $assignment->id], ['title' => __('Edit')]),
                    $this->Form->postLink(__('Delete'), ['action' => 'delete', $assignment->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $assignment->id),
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

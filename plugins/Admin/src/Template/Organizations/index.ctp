<?php
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Organizations'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group">
    <?= $this->Html->link('<i class="material-icons">add_circle_outline</i> ' . __('Create'), [
        'action' => 'add',
    ], [
        'class' => 'btn btn-default',
        'escape' => false,
    ]) ?>
</div>
<?php $this->end(); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('name'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($organizations as $organization): ?>
        <tr>
            <td><?= h($organization->name) ?></td>
            <td class="actions">
                <?= $this->Form->postLink('', ['action' => 'pick', $organization->id],
                    ['title' => __('Select'), 'class' => 'btn btn-default glyphicon glyphicon glyphicon-log-in']) ?>
                <?= $this->Html->link('', ['action' => 'view', $organization->id],
                    ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $organization->id],
                    ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $organization->id], [
                    'confirm' => __('Are you sure you want to delete {0}?', $organization->name),
                    'title' => __('Delete'),
                    'class' => 'btn btn-default glyphicon glyphicon-trash',
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

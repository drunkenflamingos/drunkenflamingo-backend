<?php
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Classes'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('New class'), [
        'action' => 'add',
    ], [
        'class' => 'btn btn-primary btn-raised btn-block',
        'escape' => false,
    ]) ?>
</div>
<?php $this->end(); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('grade'); ?></th>
        <th><?= $this->Paginator->sort('name'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($courses as $course): ?>
        <tr>
            <td><?= $this->Number->format($course->grade) ?></td>
            <td><?= h($course->name) ?></td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'), [
                        'action' => 'view',
                        $course->id,
                    ]),
                    $this->Html->link(__('Edit'), [
                        'action' => 'edit',
                        $course->id,
                    ]),
                    $this->Form->postLink(__('Delete'), ['action' => 'delete', $course->id],
                        ['confirm' => __('Are you sure you want to delete {0}?', "$course->grade $course->name"),]),
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>

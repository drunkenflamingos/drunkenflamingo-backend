<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Courses'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
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
                <?= $this->Html->link(__('View'), [
                    'action' => 'view',
                    $course->id,
                ]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="text-center">
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

</div>
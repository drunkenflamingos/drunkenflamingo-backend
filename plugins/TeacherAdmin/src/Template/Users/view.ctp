<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= h($user->name); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group">
    <?= $this->Html->link(__('Edit pupil'), ['action' => 'edit', $user->id], [
        'class' => 'btn',
    ]) ?>
    <?= $this->Form->postLink(__('Delete user'), ['action' => 'delete', $user->id],
        [
            'class' => 'btn',
            'confirm' =>
                __('Are you sure you want to delete {0}?', [h($user->name)]),
        ]) ?>
    <?= $this->Html->link(__('List pupils'), ['action' => 'index'], ['class' => 'btn',]) ?>
    <?= $this->Html->link(__('New pupil'), ['action' => 'add'], ['class' => 'btn',]) ?>
</div>
<?php $this->end(); ?>

<h1>TODO</h1>

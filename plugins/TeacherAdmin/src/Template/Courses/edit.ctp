<?php
declare(strict_types=1);
/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Edit class'); ?></h1>

<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group">
    <?= $this->Html->link(__('Edit class'), ['action' => 'edit', $course->id], [
        'class' => 'btn',
    ]) ?>
    <?= $this->Form->postLink(__('Delete class'), ['action' => 'delete', $course->id],
        [
            'class' => 'btn',
            'confirm' => __('Are you sure you want to delete {0}?', $course->id),
        ]) ?>
    <?= $this->Html->link(__('List classes'), ['action' => 'index'], ['class' => 'btn',]) ?>
    <?= $this->Html->link(__('New class'), ['action' => 'add'], ['class' => 'btn',]) ?>
</div>
<?php $this->end(); ?>

<?= $this->Form->create($course); ?>
<fieldset>
    <?php
    echo $this->Form->control('grade', [
        'type' => 'select',
        'options' => range(0, 10),
    ]);
    echo $this->Form->control('name');
    ?>
</fieldset>
<?= $this->Form->button('<i class="material-icons">save</i> ' . __('Save'), [
    'class' => 'btn btn-raised btn-primary',
    'escape' => false,
]) ?>
<?= $this->Form->end() ?>

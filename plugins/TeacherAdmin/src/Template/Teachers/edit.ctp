<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
    <h1><?= __('Edit {0}', $teacher->name); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
    <div class="btn-group btn-group-raised">
        <?= $this->Html->link(__('List Teachers'), ['action' => 'index',], ['class' => 'btn btn-default']) ?>
    </div>
<?php $this->end(); ?>

<?= $this->Form->create($teacher); ?>
    <fieldset>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        ?>
    </fieldset>
<?= $this->Form->button(__('Save and create new'), [
    'name' => '_add',
    'value' => true,
    'class' => 'btn btn-success btn-raised',
]); ?>
<?= $this->Form->button(__('Save'), [
    'class' => 'btn btn-success btn-raised',
]); ?>
<?= $this->Form->end() ?>
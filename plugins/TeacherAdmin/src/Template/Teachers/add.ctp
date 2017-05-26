<?php
declare(strict_types=1);
/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
    <h1><?= __('Add teacher'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
    <div class="btn-group btn-group-raised">
        <?= $this->Html->link(__('List teachers'), ['action' => 'index',], ['class' => 'btn btn-default']) ?>
    </div>

<?php $this->end(); ?>

<?= $this->Form->create($teacher); ?>
    <fieldset>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        echo $this->Form->control('users_roles.0.organization_id', [
            'type' => 'hidden',
            'value' => $this->request->session()->read('Auth.User.active_organization_id'),
        ]);
        echo $this->Form->control('users_roles.0.role_id', [
            'type' => 'hidden',
            'value' => $teacherRole->id,
        ]);
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
<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */

$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Change password'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<?= $this->Form->create($changePassword); ?>
<fieldset>

    <?= $this->Form->control('user_id', [
        'type' => 'hidden',
        'value' => $user->id,
    ]); ?>

    <?php if (!empty($user->password)): ?>
        <?= $this->Form->control('current_password', [
            'type' => 'password',
            'value' => '',
        ]); ?>
    <?php endif; ?>

    <?= $this->Form->control('new_password', [
        'type' => 'password',
        'value' => '',
        'label' => __('New password'),
    ]); ?>

    <?= $this->Form->control('new_password_repeat', [
        'type' => 'password',
        'value' => '',
        'label' => __('Repeat new password'),
    ]); ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

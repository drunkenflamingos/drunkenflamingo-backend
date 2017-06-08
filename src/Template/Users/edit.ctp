<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */

$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Edit user'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group-raised">
    <?= $this->Html->link(__('Change password'),
        ['action' => 'changePassword'],
        ['class' => 'btn']
    ) ?>
</div>
<?php $this->end(); ?>

<?= $this->Form->create($user); ?>
<fieldset>
    <?php
    echo $this->Form->control('redirect_url', [
        'value' => $this->request->referer(),
        'type' => 'hidden',
    ]);
    echo $this->Form->control('language_id', ['options' => $languages]);
    echo $this->Form->control('name');
    echo $this->Form->control('email');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

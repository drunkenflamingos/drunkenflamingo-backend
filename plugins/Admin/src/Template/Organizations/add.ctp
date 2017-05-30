<?php
declare(strict_types=1);
/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<?= $this->Form->create($organization); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Organization']) ?></legend>

    <?= $this->Form->control('default_language_id', [
        'type' => 'hidden',
        'value' => $this->request->session()->read('Auth.User.language_id'),
    ]); ?>

    <?= $this->Form->control('name'); ?>
    <?= $this->Form->control('vat_number'); ?>

    <label><?= __('Organization administrator'); ?></label>

    <?= $this->Form->control('users.0.name') ?>
    <?= $this->Form->control('users.0.email',[
            'label' => __('Google email')
    ]) ?>
    <?= $this->Form->control('users.0._joinData.role_id', [
        'type' => 'hidden',
        'value' => $teacherAdmin->id,
    ]) ?>
</fieldset>
<?= $this->Form->button(__('Add'), ['class' => 'btn btn-primary btn-raised']); ?>
<?= $this->Form->end() ?>

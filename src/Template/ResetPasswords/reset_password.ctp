<?php
declare(strict_types=1);

/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$this->extend('/Layout/dashboard');
?>

<div class="well well-lg">
    <?= $this->Form->create(null, [
        'type' => 'POST',
    ]); ?>
    <fieldset>
        <legend>
            <?= __('Reset password'); ?>
        </legend>

        <div>
            <?= $this->Form->control('password', [
                'type' => 'password',
                'value' => '',
                'label' => __('New password'),
            ]); ?>

            <?= $this->Form->control('password_repeat', [
                'type' => 'password',
                'value' => '',
                'label' => __('Repeat new password'),
            ]); ?>

            <?= $this->Form->button(__('Save'), [
                'class' => 'btn btn-lg btn-block btn-primary btn-raised',
            ]); ?>

        </div>
    </fieldset>
    <?= $this->Form->end(); ?>
</div>

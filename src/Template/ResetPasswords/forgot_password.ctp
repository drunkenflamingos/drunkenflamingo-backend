<?php
declare(strict_types=1);

/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$this->extend('/Layout/dashboard');
?>

<div class="col-xs-12 col-md-8 col-md-offset-2">

    <div class="btn-group">
        <?= $this->Html->link('<i class="material-icons">arrow_left</i> ' . __('Back'),
            [
                'controller' => 'Users',
                'action' => 'login',
            ], [
                'class' => 'btn',
                'escape' => false,
            ]) ?>
    </div>

    <div class="well well-lg">
        <?= $this->Form->create(null, [
            'type' => 'POST',
        ]); ?>
        <fieldset>
            <legend>
                <?= __('Forgot password'); ?>
            </legend>

            <p><?= __('We will send you an email with a link to reset your password'); ?></p>

            <?= $this->Form->control('email', [
                'placeholder' => __('Enter email...'),
                'label' => false,
            ]); ?>

            <?= $this->Form->button(__('Reset my password'), [
                'class' => 'btn btn-lg btn-block btn-primary btn-raised',
            ]); ?>
        </fieldset>
        <?= $this->Form->end(); ?>
    </div>
</div>

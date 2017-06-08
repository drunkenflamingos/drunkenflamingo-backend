<?php
declare(strict_types=1);
/**
 * @var \Cake\View\View $this
 */
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
        <?= $this->Form->create($user, ['type' => 'POST']); ?>

        <?= $this->Form->control('is_activated', [
            'type' => 'hidden',
            'value' => 1,
        ]); ?>

        <h2><?= __('Create user'); ?></h2>

        <?= $this->Form->control('email', [
            'placeholder' => __('jens.a@gmail.com'),
            'label' => __('Email'),
        ]); ?>

        <?= $this->Form->control('password', [
            'placeholder' => '*********',
            'label' => __('Password'),
        ]); ?>

        <?= $this->Form->control('name', [
            'placeholder' => __('Jens Andersen'),
            'label' => __('Your name'),
        ]); ?>

        <?= $this->Form->button(__('Register'), [
            'class' => 'btn btn-lg btn-raised btn-block btn-primary',
        ]); ?>

        <?= $this->Form->end(); ?>
    </div>
</div>

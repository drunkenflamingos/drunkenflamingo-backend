<?php
/**
 * @var \Cake\View\View $this
 */
$this->extend('/Layout/dashboard');
?>

<div class="col-xs-12 col-sm-8 col-sm-offset-2">
    <div class="well well-lg">
        <?= $this->Form->create($user, ['type' => 'POST']); ?>

        <h2><?= __('Create user'); ?></h2>

        <?= $this->Form->input('email', [
            'placeholder' => __('jens.a@gmail.com'),
            'label' => __('Email'),
        ]); ?>

        <?= $this->Form->input('password', [
            'placeholder' => '*********',
            'label' => __('Password'),
        ]); ?>

        <?= $this->Form->input('name', [
            'placeholder' => __('Jens Andersen'),
            'label' => __('Your name'),
        ]); ?>

        <?= $this->Form->button(__('Register'), [
            'class' => 'btn btn-lg btn-primary btn-block',
        ]); ?>

        <?= $this->Form->end(); ?>
    </div>
</div>

<?php
/**
 * @var \Cake\View\View $this
 */
$this->extend('/Layout/dashboard');
?>

<div class="col-xs-12 col-sm-8 col-sm-offset-2">
    <div class="well well-lg">
        <?= $this->Form->create(null, ['type' => 'POST', 'class' => 'form-horizontal']); ?>
        <fieldset>
            <legend>
                <?= __('Login'); ?>
            </legend>


            <?= $this->Form->input('email', [
                'placeholder' => __('jens.a@gmail.com'),
                'label' => false,
            ]); ?>

            <?= $this->Form->input('password', [
                'placeholder' => '*********',
                'label' => false,
            ]); ?>

            <?= $this->Form->button(__('Login'), [
                'class' => 'btn btn-lg btn-block btn-primary btn-raised',
            ]); ?>

            <?= $this->Html->Link(__('Register new user'), [
                'action' => 'register',
            ], [
                'class' => 'btn btn-lg btn-default btn-block btn-raised',
            ]); ?>
        </fieldset>
        <?= $this->Form->end(); ?>
    </div>
</div>

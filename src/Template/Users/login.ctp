<?php
/**
 * @var \Cake\View\View $this
 */
$this->extend('/Layout/dashboard');
?>

<?php $this->start('script'); ?>
<?= $this->fetch('script') ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php $this->end(); ?>

<div class="well well-lg">
    <?= $this->Form->create(null, [
        'type' => 'POST',
        'align' => [
        ],
    ]); ?>
    <fieldset>
        <legend>
            <?= __('Login'); ?>
        </legend>

        <div>
            <?= $this->Form->input('email', [
                'placeholder' => __('jens.a@gmail.com'),
                'label' => false,
            ]); ?>

            <?= $this->Form->input('password', [
                'placeholder' => '*********',
                'label' => false,
            ]); ?>

            <div class="g-recaptcha" data-sitekey="6LclExkUAAAAAG0AH3QZAXihUZFvd0cellU4BRV0"></div>

            <?= $this->Form->input('remember_me', [
                'label' => __('Husk mig'),
                'type' => 'checkbox',
            ]); ?>

            <?= $this->Form->button(__('Login'), [
                'class' => 'btn btn-lg btn-block btn-primary btn-raised',
            ]); ?>

            <?= $this->Html->Link(__('Register new user'), [
                'action' => 'register',
            ], [
                'class' => 'btn btn-lg btn-default btn-block btn-raised',
            ]); ?>
        </div>
    </fieldset>
    <?= $this->Form->end(); ?>
</div>

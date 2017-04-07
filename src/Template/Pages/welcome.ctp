<?php
/**
 * @var \Cake\View\View $this
 */
$this->extend('../Layout/cover');
?>

<h1><?= __('Welcome.'); ?></h1>

<br>

<h3>
    <?= __('Lets make reading great again!'); ?>
</h3>

<div class="col-xs-12 col-sm-10 col-sm-offset-1">
    <?= $this->Html->link('Login', [
        'controller' => 'Users',
        'action' => 'login',
    ], [
        'class' => 'btn btn-lg btn-default btn-block',
    ]); ?>
</div>

<div class="col-xs-12 col-sm-10 col-sm-offset-1">
    <br>
</div>

<div class="col-xs-12 col-sm-10 col-sm-offset-1">
    <?= $this->Html->link(__('I just want a user...'), [
        'controller' => 'Users',
        'action' => 'login',
    ], [
        'class' => 'btn btn-sm btn-default btn-block',
    ]); ?>
</div>

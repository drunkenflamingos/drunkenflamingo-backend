<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
    <h1><?= __('Waiting for invitation...'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?= $this->Html->link('<i class="material-icons">refresh</i> ' . __('Refresh'), [
    'action' => 'picker',
], [
    'class' => 'btn btn-primary btn-raised btn-block',
    'escape' => false,
]) ?>
<?php $this->end(); ?>
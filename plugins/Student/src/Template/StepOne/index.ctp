<?php
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Step 1'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<h1>Hello world</h1>
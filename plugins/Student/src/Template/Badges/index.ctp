<?php
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');
?>

<link href="/webroot/css/style.css" rel="stylesheet">

<?php $this->start('content_header'); ?>
<h1 align="center"><?= __('Rewards'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('MEEHHH'); ?>
<?php $this->end(); ?>

<hr noshade="">

<h2>Streaks</h2>

<span class="label label-streak"># dage</span> <!-- Swap # with auto-updating number of streaks -->

<hr noshade="">

<h2>Badges</h2>


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

<hr title="break-line" noshade="">

<h2 align="center">Streaks</h2>

<span class="label label-streak"># dage</span> <!-- Swap # with auto-updating number of streaks -->

<hr title="break-line" noshade="">

<h2 align="center">Badges</h2>


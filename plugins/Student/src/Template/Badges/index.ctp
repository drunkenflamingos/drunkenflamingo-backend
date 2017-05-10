<?php
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');
?>

<link href="/webroot/css/style.css" rel="stylesheet">

<?php $this->start('content_header'); ?>
<?php $this->end(); ?>

<?php $this->start('MEEHHH'); ?>
<?php $this->end(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-offset-5">
            <h1>Rewards</h1>
        </div>
    </div>
    <hr class="black-line" noshade="">
    <div class="row">
        <div class="col-lg-12 col-sm-offset-5">
            <h2>Streaks</h2>
            <span class="label label-streak"># dage</span> <!-- Swap # with auto-updating number of streaks -->
        </div>
    </div>
    <hr noshade="">
    <div class="row">
        <div class="col-lg-12 col-sm-offset-5">
            <h2>Badges</h2>
        </div>
    </div>
</div>
<?php
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-offset-5">
            <h1>Opgaver</h1>
        </div>
    </div>
    <hr class="black-line" noshade="">
    <div class="row">
        <div class="col-lg-12 col-sm-offset-5">
            <h4 class="assignment-text">Vælg en opgave og vis hvad du kan, <br> og lær det du ikke kan endnu</h4>
        </div>
    </div>
    <!-- Her skal være opgave knapper der har titlen på hver opgave, og som fører til opgaven. Der skal være én knap til hver opgave der er! -->
</div>


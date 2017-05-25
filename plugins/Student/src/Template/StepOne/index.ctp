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
            <h1 class="assignmentTitle">Opgave 1</h1>
        </div>
    </div>
    <hr class="black-line" noshade="">

    <div class="row">
        <div class="col-lg-12">
            <h4 class="assignmentDescription">Her skal du læse teksten <br> og markere de ord du ikke forstår <br> og gerne vil arbejde med</h4>
        </div>
    </div>
</div>

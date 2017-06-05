<?php
$this->extend('/Layout/dashboard');

?>

<?php $this->start('content_header'); ?>
<h1><?= h($course->getCombinedName()) ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group-raised">
    <?= $this->Html->link('<i class="material-icons">list</i> ' . __('List courses'), [
        'action' => 'index',
    ], [
        'class' => 'btn',
        'escape' => false,
    ]) ?>

</div>
<?php $this->end(); ?>

<h1>TODO</h1>
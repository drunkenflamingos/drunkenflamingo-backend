<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');

?>

<?php $this->start('content_header'); ?>
<h1><?= __('Statistics'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="btn-group btn-group-justified btn-group-raised">
            <?= $this->Html->link(__('Hardest words'),[
                    'action' => 'hardestWords',
            ],['class' => 'btn']) ?>

            <?= $this->Html->link(__('Pupil statistics'),[
                'action' => 'hardestWords',
            ],['class' => 'btn disabled']) ?>

            <?= $this->Html->link(__('Course statistics'),[
                'action' => 'hardestWords',
            ],['class' => 'btn disabled']) ?>
        </div>
    </div>
</div>
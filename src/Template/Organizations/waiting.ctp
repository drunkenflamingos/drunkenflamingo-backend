<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('../Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
    <h1 class="text-center"><?= __('Thank you for signing up - we will be in touch!'); ?></h1>
<?php $this->end(); ?>

<?php /*
<?php$this->start('content_buttons'); ?>
<?= $this->Html->link('<i class="material-icons">refresh</i> ' . __('Refresh'), [
    'action' => 'picker',
], [
    'class' => 'btn btn-primary btn-raised btn-block',
    'escape' => false,
]) ?>
<?php $this->end();?>
 */
?>
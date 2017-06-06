<?php
declare(strict_types=1);

/**
 * @var \App\View\AppView $this
 */

$this->extend('/Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Answer'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>

<?php $this->end(); ?>


<h1>TODO</h1>
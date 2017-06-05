<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= h($user->name); ?></h1>
<?php $this->end(); ?>

<h1>TODO</h1>

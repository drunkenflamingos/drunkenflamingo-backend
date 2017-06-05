<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Answer'); ?></h1>
<?php $this->end(); ?>
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($answer->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= h($answer->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created By Id') ?></td>
            <td><?= h($answer->created_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified By Id') ?></td>
            <td><?= h($answer->modified_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Assignment Id') ?></td>
            <td><?= h($answer->assignment_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Homework Id') ?></td>
            <td><?= h($answer->homework_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($answer->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($answer->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Deleted') ?></td>
            <td><?= h($answer->deleted) ?></td>
        </tr>
        <tr>
            <td><?= __('Is Done') ?></td>
            <td><?= $answer->is_done ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>


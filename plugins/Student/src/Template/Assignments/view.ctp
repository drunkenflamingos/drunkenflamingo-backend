<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($assignment->title) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Created by') ?></td>
            <td><?= h($assignment->created_by->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($assignment->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Text') ?></td>
            <td><?= $this->Text->autoParagraph(h($assignment->text)); ?></td>
        </tr>
    </table>
</div>


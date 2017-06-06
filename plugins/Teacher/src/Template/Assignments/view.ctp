<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Assignment'); ?></h1>
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
            <td><?= __('Created By Id') ?></td>
            <td><?= h($assignment->created_by->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($assignment->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($assignment->created->i18nFormat()) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($assignment->modified->i18nFormat()) ?></td>
        </tr>
        <tr>
            <td><?= __('Locked') ?></td>
            <td><?= $assignment->is_locked ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Text') ?></td>
            <td><?= $this->Text->autoParagraph(h($assignment->text)); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"> Statistics </h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Correctly answered tasks') ?></td>
            <td><?= __('TODO') ?></td>
        </tr>
        <tr>
            <td><?= __('Incorrectly answered tasks') ?></td>
            <td><?= __('TODO') ?></td>
        </tr>
        <tr>
            <td><?= __('Skipped tasks') ?></td>
            <td><?= __('TODO') ?></td>
        </tr>
    </table>

</div>


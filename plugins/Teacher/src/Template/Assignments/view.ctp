<?php
$this->extend('/Layout/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Assignment'), ['action' => 'edit', $assignment->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Assignment'), ['action' => 'delete', $assignment->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->id)]) ?> </li>
<li><?= $this->Html->link(__('List Assignments'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Edit Assignment'), ['action' => 'edit', $assignment->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Delete Assignment'), ['action' => 'delete', $assignment->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->id)]) ?> </li>
    <li><?= $this->Html->link(__('List Assignments'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Assignment'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>

<h1> View assignment </h1>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($assignment->title) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= h($assignment->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created By Id') ?></td>
            <td><?= h($assignment->created_by->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified By Id') ?></td>
            <td><?= h($assignment->modified_by->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Organization Id') ?></td>
            <td><?= h($assignment->organization->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($assignment->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($assignment->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($assignment->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Deleted') ?></td>
            <td><?= h($assignment->deleted) ?></td>
        </tr>
        <tr>
            <td><?= __('Is Locked') ?></td>
            <td><?= $assignment->is_locked ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Text') ?></td>
            <td><?= $this->Text->autoParagraph(h($assignment->text)); ?></td>
        </tr>
    </table>
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


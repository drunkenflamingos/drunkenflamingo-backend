<?php
declare(strict_types=1);
$this->extend('/Layout/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Homework'), ['action' => 'edit', $homework->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Homework'), ['action' => 'delete', $homework->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $homework->id)]) ?> </li>
<li><?= $this->Html->link(__('List Homework'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Homework'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Edit Homework'), ['action' => 'edit', $homework->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Delete Homework'), ['action' => 'delete', $homework->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $homework->id)]) ?> </li>
    <li><?= $this->Html->link(__('List Homework'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Homework'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($homework->name) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= h($homework->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created By Id') ?></td>
            <td><?= h($homework->created_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified By Id') ?></td>
            <td><?= h($homework->modified_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Organization Id') ?></td>
            <td><?= h($homework->organization_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($homework->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($homework->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($homework->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Deleted') ?></td>
            <td><?= h($homework->deleted) ?></td>
        </tr>
        <tr>
            <td><?= __('Text') ?></td>
            <td><?= $this->Text->autoParagraph(h($homework->text)); ?></td>
        </tr>
    </table>
</div>


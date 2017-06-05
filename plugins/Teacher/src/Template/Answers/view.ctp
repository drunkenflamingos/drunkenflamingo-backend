<?php
declare(strict_types=1);

$this->extend('/Layout/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?> </li>
<li><?= $this->Html->link(__('List Answers'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Edit Answer'), ['action' => 'edit', $answer->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Delete Answer'), ['action' => 'delete', $answer->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]) ?> </li>
    <li><?= $this->Html->link(__('List Answers'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Answer'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
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


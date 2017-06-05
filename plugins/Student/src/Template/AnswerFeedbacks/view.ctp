<?php
declare(strict_types=1);

$this->extend('/Layout/dashboard');


$this->start('tb_actions');
?>
<li><?= $this->Html->link(__('Edit Answer Feedback'), ['action' => 'edit', $answerFeedback->id]) ?> </li>
<li><?= $this->Form->postLink(__('Delete Answer Feedback'), ['action' => 'delete', $answerFeedback->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $answerFeedback->id)]) ?> </li>
<li><?= $this->Html->link(__('List Answer Feedbacks'), ['action' => 'index']) ?> </li>
<li><?= $this->Html->link(__('New Answer Feedback'), ['action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('Edit Answer Feedback'), ['action' => 'edit', $answerFeedback->id]) ?> </li>
    <li><?= $this->Form->postLink(__('Delete Answer Feedback'), ['action' => 'delete', $answerFeedback->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $answerFeedback->id)]) ?> </li>
    <li><?= $this->Html->link(__('List Answer Feedbacks'), ['action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Answer Feedback'), ['action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($answerFeedback->title) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= h($answerFeedback->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created By Id') ?></td>
            <td><?= h($answerFeedback->created_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified By Id') ?></td>
            <td><?= h($answerFeedback->modified_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Answer Id') ?></td>
            <td><?= h($answerFeedback->answer_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($answerFeedback->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($answerFeedback->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($answerFeedback->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Deleted') ?></td>
            <td><?= h($answerFeedback->deleted) ?></td>
        </tr>
        <tr>
            <td><?= __('Text') ?></td>
            <td><?= $this->Text->autoParagraph(h($answerFeedback->text)); ?></td>
        </tr>
    </table>
</div>


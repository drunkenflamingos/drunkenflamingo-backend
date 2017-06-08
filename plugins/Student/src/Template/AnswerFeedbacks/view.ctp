<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Answer Feedback'); ?></h1>
<?php $this->end(); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($answerFeedback->title) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Answer') ?></td>
            <td><?= h($answerFeedback->answer_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Subject') ?></td>
            <td><?= h($answerFeedback->title) ?></td>
        </tr>
        <tr>
            <td><?= __('Message') ?></td>
            <td><?= $this->Text->autoParagraph($answerFeedback->text) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($answerFeedback->created->i18nFormat()) ?></td>
        </tr>
    </table>
</div>


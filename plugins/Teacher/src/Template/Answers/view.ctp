<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');

$assignment = $answer->assignment;
$words = mb_split(' ', $assignment->text);
?>


<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

    <h1><?= __('Answer'); ?></h1>

    <div class="panel panel-default">
        <!-- Panel header -->
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <tr>
                <td><?= __('Created by') ?></td>
                <td>
                    <?= $this->Html->link(h($answer->created_by->name), [
                        'controller' => 'Users',
                        'action' => 'view',
                        $answer->created_by->id,
                    ]) ?>
                </td>
            </tr>
            <tr>
                <td><?= __('Assignment') ?></td>
                <td>
                    <?= $this->Html->link(h($answer->assignment->title), [
                        'controller' => 'Assignments',
                        'action' => 'view',
                        $answer->assignment->id,
                    ]) ?>
                </td>
            </tr>
            <tr>
                <td><?= __('Homework') ?></td>
                <td>
                    <?= $this->Html->link(h($answer->homework->name), [
                        'controller' => 'Homeworks',
                        'action' => 'view',
                        $answer->homework->id,
                    ]) ?>
                </td>
            </tr>
            <tr>
                <td><?= __('Created') ?></td>
                <td><?= h($answer->created->i18nFormat()) ?></td>
            </tr>
            <tr>
                <td><?= __('Modified') ?></td>
                <td><?= h($answer->modified->i18nFormat()) ?></td>
            </tr>
            <tr>
                <td><?= __('Completed') ?></td>
                <td><?= $answer->is_done ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
    </div>

    <?= $this->Form->create($answer, [
        'url' => [
            'controller' => '',
        ],
    ]) ?>

    <?php if (!empty($answer->answer_words)): ?>
        <h2><?= __('Words in answer'); ?></h2>
        <?php foreach ($answer->answer_words as $answerWord) : ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?= $words[$answerWord->word_placement] ?>

                        <?php if ($answerWord->is_skipped): ?>
                            <div class="pull-right">
                                <span class="label label-danger"><?= __('Skipped'); ?></span>
                            </div>
                        <?php endif; ?>
                    </h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td><?= __('Definition'); ?></td>
                        <td><?= h($answerWord->definition) ?></td>
                    </tr>

                    <tr>
                        <td><?= __('Word class'); ?></td>
                        <td><?= $answerWord->word_class->title ?? null ?></td>
                    </tr>

                    <tr>
                        <td><?= __('Synonym'); ?></td>
                        <td><?= h($answerWord->synonym) ?></td>
                    </tr>

                    <tr>
                        <td><?= __('Sentence'); ?></td>
                        <td><?= $this->Text->autoParagraph($answerWord->sentence) ?></td>
                    </tr>

                    <tr>
                        <td><?= __('Help text'); ?></td>
                        <td><?= h($answerWord->help_text) ?></td>
                    </tr>
                </table>
            </div>
        <?php endforeach ?>
    <?php endif; ?>
</div>
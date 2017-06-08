<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');

$answersInTotal = count($user->answers);
$doneAnswers = count($user->done_answers);
$answerWordsCreated = count($user->answer_words);

?>


<h1><?= __('Statistics for {0}', [h($user->name)]) ?></h1>

<div class="well">
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?= __('Answers created'); ?></th>
            <th><?= __('Answers done'); ?></th>
            <th><?= __('Words submitted'); ?></th>
            <th><?= __('Words with no errors'); ?></th>
            <th><?= __('Words with error'); ?></th>
            <th><?= __('Words skipped'); ?></th>
            <th><?= __('Words without feedback'); ?></th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td><?= $answersInTotal ?></td>
            <td><?= $doneAnswers ?></td>
            <td><?= $answerWordsCreated ?></td>
            <td><?= $wordsWithoutErrors ?>    </td>
            <td><?= $wordsWithErrors ?></td>
            <td><?= $skippedWords ?></td>
            <td><?= $wordsWithouFeedback ?></td>
        </tr>
        </tbody>
    </table>
</div>

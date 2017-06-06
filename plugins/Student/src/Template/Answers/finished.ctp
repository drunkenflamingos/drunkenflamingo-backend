<?php
declare(strict_types=1);

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AnswerWord|null $nextAnswerWord
 * @var \App\Model\Entity\AnswerWord|null $previousAnswerWord
 * @var \App\Model\Entity\AnswerWord $answerWord
 */

use Cake\Routing\Router;

$this->extend('/Layout/dashboard');

$assignment = $answer->assignment;
$words = mb_split(' ', $assignment->text);
?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<?= $this->fetch('css') ?>
<style type="text/css">
    .assignmentWord:hover {
        background-color: #00bcd4;
        cursor: pointer;
    }
</style>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<?= $this->fetch('script') ?>
<script type="text/javascript">
    $(function () {
    })
</script>
<?php $this->end(); ?>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="well well-sm">
        <h3 class="text-center">
            <?= __('TODO TEKST'); ?>
        </h3>
    </div>
</div>

<?= $this->Form->create($answerWord); ?>
<?php if (empty($nextAnswerWord)): ?>
    <?php
    //Last one!
    //TODO
    //TODO
    //TODO
    ?>
    <h1>TODO</h1>
<?php else : ?>
    <?= $this->Form->control('redirect_url', [
        'type' => 'hidden',
        'value' => Router::url([
            'action' => 'stepThree',
            '?' => ['answer_word_id' => $nextAnswerWord->id] + $this->request->getQuery(),
        ]),
    ]) ?>
<?php endif; ?>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="well">
    </div>


</div>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <?= $this->Form->button('<i class="material-icons">home</i> ' . __('Next'), [
        'class' => 'btn btn-block btn-raised btn-default',
    ]) ?>
</div>
<?= $this->Form->end(); ?>




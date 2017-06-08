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
        $('.answerWordHelp').on('click', function (event) {
            var $element = $(event.target).parent();
            var answerWordId = $element.data('answerwordid');

            var $helpBoxElement = $('#' + answerWordId + '_help');
            var $isSkippedInputElement = $('#' + answerWordId + '_is_skipped');

            if ($helpBoxElement.hasClass('hidden')) {
                $helpBoxElement.removeClass('hidden');
                $isSkippedInputElement.prop('checked', true);
                $isSkippedInputElement.val(1);
            } else {
                $helpBoxElement.addClass('hidden');
                $isSkippedInputElement.prop('checked', false);
                $isSkippedInputElement.val(0);
            }
        })
    })
</script>
<?php $this->end(); ?>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="well well-sm">
        <h1 class="text-center">
            <?= h(ucfirst($words[$answerWord->word_placement])) ?>
        </h1>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <!--<div class="pull-left">
        <?= $this->Html->link('<i class="material-icons">help_outline</i>',
        '#', [
            'class' => 'answerWordHelp',
            'data-answerwordid' => $answerWord->id,
            'escape' => false,
            'class' => 'btn btn-default',
        ]) ?>
    </div>-->
    <div class="pull-right">
        <?= $this->Html->link('<i class="material-icons">open_in_new</i> ' . __('Ordnet.dk'),
            'http://ordnet.dk/ddo', [
                'target' => '_blank',
                'class' => 'btn btn-default',
                'escape' => false,
            ]) ?>
    </div>
</div>

<?= $this->Form->create($answer); ?>

<?= $this->Form->control('answer_words.0.id', [
    'type' => 'hidden',
    'value' => $answerWord->id,
]) ?>

<?= $this->Form->control('answer_words.0.answer_id', [
    'type' => 'hidden',
    'value' => $answerWord->answer_id,
]) ?>

<?= $this->Form->control('answer_words.0.word_placement', [
    'type' => 'hidden',
    'value' => $answerWord->word_placement,
]) ?>

<?php if (empty($nextAnswerWord)): ?>
    <?= $this->Form->control('redirect_url', [
        'type' => 'hidden',
        'value' => Router::url([
            'action' => 'finished',
            $answer->id,
        ]),
    ]) ?>
<?php else : ?>
    <?= $this->Form->control('redirect_url', [
        'type' => 'hidden',
        'value' => Router::url([
            'action' => 'stepThree',
            $answer->id,
            '?' => ['answer_word_id' => $nextAnswerWord->id] + $this->request->getQuery(),
        ]),
    ]) ?>
<?php endif; ?>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="well">

        <!--Word-->
        <div class="panel panel-primary">
            <div class="panel-body <?= !empty($answerWord->help_text) ? '' : 'hidden' ?>"
                 id="<?= $answerWord->id ?>_help">
                <?= $this->Form->control('answer_words.0.is_skipped', [
                    'type' => 'hidden',
                    'id' => $answerWord->id . '_is_skipped',
                ]) ?>
                <?= $this->Form->control('answer_words.0.help_text', [
                    'type' => 'text',
                    'label' => __('Help'),
                    'placeholder' => __('Enter your question(s)'),
                ]) ?>
            </div>
        </div>

        <!--Definition-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <?= __('Definition'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?= $this->Text->autoParagraph($answerWord->definition) ?>
            </div>
        </div>

        <!--Word class-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <?= __('Word class'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?= $this->Form->control('answer_words.0.word_class_id', [
                    'type' => 'select',
                    'label' => false,
                ]) ?>
            </div>
        </div>

        <!--Synonym-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <?= __('Synonym'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?= $this->Form->control('answer_words.0.synonym', [
                    'type' => 'text',
                    'label' => false,
                    'placeholder' => __('Enter synonym') . '...',
                ]) ?>
            </div>
        </div>

        <!--Sentence-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <?= __('Sentence'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?= $this->Form->control('answer_words.0.sentence', [
                    'type' => 'text',
                    'label' => false,
                    'placeholder' => __('Enter sentence') . '...',
                ]) ?>
            </div>
        </div>

    </div>


</div>


<div class="col-xs-6 col-sm-6 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2">
    <?php if (!empty($previousAnswerWord)): ?>
        <?= $this->Html->link('<i class="material-icons">arrow_back</i> ' . __('Previous'), [
            'action' => 'stepThree',
            $answer->id,
            '?' => ['answer_word_id' => $previousAnswerWord->id],
        ], [
            'class' => 'btn btn-block btn-raised btn-default',
            'escape' => false,
        ]) ?>
    <?php endif; ?>
</div>
<div class="col-xs-6 col-sm-6 col-md-5 col-lg-4">
    <?php if (!empty($nextAnswerWord)): ?>
        <?= $this->Form->button('<i class="material-icons">arrow_forward</i> ' . __('Next'), [
            'class' => 'btn btn-block btn-raised btn-default',
        ]) ?>
    <?php else: ?>
        <?= $this->Form->button('<i class="material-icons">save</i> ' . __('Finish'), [
            'class' => 'btn btn-block btn-raised btn-success',
        ]) ?>
    <?php endif; ?>
</div>


<?= $this->Form->end(); ?>




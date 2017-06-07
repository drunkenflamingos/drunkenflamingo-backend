<?php
declare(strict_types=1);

/**
 * @var \App\View\AppView $this
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
        <h3 class="text-center">
            <?= __('Write the meaning of the words'); ?>
        </h3>
    </div>
</div>

<?= $this->Form->create($answer); ?>
<?= $this->Form->control('redirect_url', [
    'type' => 'hidden',
    'value' => Router::url(['action' => 'stepThree', $answer->id]),
]) ?>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="well">
        <?php foreach ($answer->answer_words as $key => $answerWord): ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <small class="pull-left ">
                            <?= $key + 1 ?>
                        </small>
                        <div class="pull-right">
                            <?= $this->Html->link('<i style="font-size:14pt;" class="material-icons">open_in_new</i> ' . __('Ordnet.dk'),
                                'http://ordnet.dk/ddo', [
                                    'style' => 'color:white;',
                                    'target' => '_blank',
                                    'escape' => false,
                                ]) ?>
                            <?= $this->Table->actionSeparator() ?>
                            <?= $this->Html->link('<i style="font-size: 14pt;" class="material-icons">help_outline</i>',
                                '#', [
                                    'class' => 'answerWordHelp',
                                    'data-answerwordid' => $answerWord->id,
                                    'escape' => false,
                                    'style' => 'color:white;',
                                ]) ?>
                        </div>
                        <div class="text-center">
                            <?= h($words[$answerWord->word_placement]) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="panel-body">
                    <?= $this->Form->control('answer_words.' . $key . '.id', [
                        'type' => 'hidden',
                        'value' => $answerWord->id,
                    ]) ?>
                    <?= $this->Form->control('answer_words.' . $key . '.answer_id', [
                        'type' => 'hidden',
                        'value' => $answer->id,
                    ]) ?>

                    <?= $this->Form->control('answer_words.' . $key . '.is_skipped', [
                        'type' => 'hidden',
                        'id' => $answerWord->id . '_is_skipped',
                    ]) ?>

                    <?= $this->Form->control('answer_words.' . $key . '.definition', [
                        'type' => 'text',
                        'label' => false,
                        'placeholder' => __('Enter definition') . '...',
                        'tabindex' => $key + 1,
                    ]) ?>

                    <div class="hidden" id="<?= $answerWord->id ?>_help">
                        <?= $this->Form->control('answer_words.' . $key . '.help_text', [
                            'type' => 'text',
                            'label' => false,
                            'placeholder' => __('Enter your question(s)'),
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <?= $this->Form->button('<i class="material-icons">arrow_forward</i> ' . __('Next'), [
        'class' => 'btn btn-block btn-raised btn-default',
    ]) ?>
</div>
<?= $this->Form->end(); ?>




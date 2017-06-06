<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
use Cake\Routing\Router;

$this->extend('/Layout/dashboard');

$assignment = $answer->assignment;
$words = mb_split(' ', $assignment->text);
?>

<?php $this->start('script') ?>
<?= $this->fetch('script') ?>
<script type="text/javascript">
    var answerId = '<?= $answer->id ?>';
    var answerWordFeedbackUrl = '<?= Router::url([
        'plugin' => 'TeacherApi',
        'controller' => 'AnswerWordFeedbacks',
    ], true) ?>';

    function createAnswerWord(score, message, answerWordId) {
        return $.ajax({
            method: 'POST',
            dataType: 'json',
            url: answerWordFeedbackUrl,
            headers: {
                Authorization: "Bearer <?=$jwtToken?>"
            },
            data: {
                answer_word_id: answerWordId,
                score: score || 0,
                text: message || null
            }
        });
    }

    function markWordCorrect($element) {
        $element.addClass('btn-warning');

        var answerWordId = $element.data('answerwordid');
        var score = 100; //100% score means correct
        var text = getFeedbackText(answerWordId);

        createAnswerWord(score, text, answerWordId)
            .done(function (data, textStatus, jQXHR) {
                $element
                    .removeClass('btn-warning')
                    .addClass('btn-success')
                    .addClass('disabled');
            }).error(function (data, textStatus, jQXHR) {
            alert('An error happened');
            $element.removeClass('btn-warning')
        })
    }

    function markWordWrong($element) {
        $element.addClass('btn-warning');

        var answerWordId = $element.data('answerwordid');
        var score = 0; //100% score means correct
        var text = getFeedbackText(answerWordId);

        createAnswerWord(score, text, answerWordId)
            .done(function (data, textStatus, jQXHR) {
                $element
                    .removeClass('btn-warning')
                    .addClass('btn-danger')
                    .addClass('disabled');
            }).error(function (data, textStatus, jQXHR) {
            alert('An error happened');
            $element.removeClass('btn-warning')
        })
    }

    function loadInitialAnswerWordFeedback() {
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: answerWordFeedbackUrl,
            headers: {
                Authorization: "Bearer <?=$jwtToken?>"
            },
            data: {
                answer_id: answerId,
            }
        }).done(function (data, textStatus, jQXHR) {
            var amountOfRecords = data.data.length;
            if (amountOfRecords > 0) {
                for (var i = 0; i < amountOfRecords; i++) {
                    insertFeedback(data.data[i]);
                }
            }
        });
    }

    function insertFeedback(feedback) {
        var $feedbackField = $('#' + feedback.answer_word_id + '_feedbackField');
        var $feedbackContainer = $('#' + feedback.answer_word_id + '_feedbackContainer');

        if (feedback.score === 100) {
            var $element = $('#' + feedback.answer_word_id + '_accept');

            $element
                .addClass('btn-success')
                .addClass('disabled');
        } else {
            var $element = $('#' + feedback.answer_word_id + '_deny');

            $element
                .addClass('btn-danger')
                .addClass('disabled');
        }

        if (feedback.text) {
            $feedbackContainer.removeClass('hidden');
            $feedbackField.val(feedback.text);
        }

        $feedbackField.data('answerwordfeedbackid', feedback.id);
    }

    function getFeedbackText(answerWordId) {
        return $('#' + answerWordId + '_feedbackField').val()
    }

    function saveFeedbackText(answerWordId, feedbackText, answerWordFeedbackId) {
        console.log(answerWordId);
        console.log(feedbackText);
        console.log(answerWordFeedbackId);

        //Check if edit or create
        if (answerWordFeedbackId) {
            //Edit
            return $.ajax({
                method: 'PUT',
                dataType: 'json',
                url: answerWordFeedbackUrl + '/' + answerWordFeedbackId,
                headers: {
                    Authorization: "Bearer <?=$jwtToken?>"
                },
                data: {
                    text: feedbackText || null
                }
            });
        }

        return $.ajax({
            method: 'POST',
            dataType: 'json',
            url: answerWordFeedbackUrl,
            headers: {
                Authorization: "Bearer <?=$jwtToken?>"
            },
            data: {
                answer_word_id: answerWordId,
                text: feedbackText || null
            }
        });
    }

    $(function () {
        loadInitialAnswerWordFeedback();

        $('.answerWordCorrect').on('click', function (event) {
            var $clicked = $(event.target);
            var $clickedButton = $clicked.prop('nodeName') === 'A' ? $clicked : $clicked.parent();

            markWordCorrect($clickedButton);
        });

        $('.answerWordWrong').on('click', function (event) {
            var $clicked = $(event.target);
            var $clickedButton = $clicked.prop('nodeName') === 'A' ? $clicked : $clicked.parent();

            markWordWrong($clickedButton);
        });

        $('.feedbackButton').on('click', function (event) {
            var $clicked = $(event.target);
            var $clickedButton = $clicked.prop('nodeName') === 'I' ? $clicked.parent() : $clicked;
            var answerWordId = $clickedButton.data('answerwordid');

            $('#' + answerWordId + '_feedbackContainer').removeClass('hidden');
        });

        $('.feedbackInput').on('blur', function (event) {
            var $field = $(event.target);
            var value = $field.val();
            var answerWordId = $field.data('answerwordid') || null;
            var answerWordFeedbackId = $field.data('answerwordfeedbackid') || null;

            saveFeedbackText(answerWordId, value, answerWordFeedbackId)
        });
    })
</script>
<?php $this->end(); ?>


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
                <div class="panel-footer">
                    <div class="hidden" id="<?= $answerWord->id ?>_feedbackContainer">
                        <?= $this->Form->control('answer_word_feedback_text', [
                            'type' => 'text',
                            'placeholder' => __('Enter feedback') . '...',
                            'label' => false,
                            'class' => 'input-sm feedbackInput',
                            'id' => $answerWord->id . '_feedbackField',
                            'data-answerwordid' => $answerWord->id,
                        ]) ?>
                    </div>

                    <div class="text-center">
                        <a id="<?= $answerWord->id ?>_accept"
                           class="btn btn-fab-mini btn-fab answerWordCorrect"
                           data-answerwordid="<?= $answerWord->id ?>">
                            <i class="material-icons">check</i>
                        </a>

                        <a id="<?= $answerWord->id ?>_feedback"
                           class="btn btn-fab-mini btn-fab feedbackButton"
                           data-answerwordid="<?= $answerWord->id ?>">
                            <i class="material-icons">feedback</i>
                        </a>

                        <a id="<?= $answerWord->id ?>_deny"
                           class="btn btn-fab-mini btn-fab answerWordWrong"
                           data-answerwordid="<?= $answerWord->id ?>">
                            <i class="material-icons">clear</i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif; ?>

    <div class="form-group">
        <div class="btn-group btn-group-justified btn-group-raised">
            <?= $this->Form->postLink('<i class="material-icons">done_all</i> ' . __('Mark all as correct'), [
                'action' => 'markAllCorrect',
                $answer->id,
            ], [
                'class' => 'btn',
                'escape' => false,
            ]) ?>
        </div>
    </div>

    <div class="well">
        <h2><?= __('General feedback'); ?></h2>

        <?= $this->Form->create($answer); ?>

        <?= $this->Form->control('redirect_url', [
            'value' => $this->request->getUri()->getPath(),
            'type' => 'hidden',
        ]) ?>

        <?php if (!empty($answer->answer_feedbacks)): ?>
            <?= $this->Form->control('answer_feedbacks.0.id', [
                'value' => $answer->answer_feedbacks[0]->id,
            ]) ?>
        <?php endif; ?>

        <?= $this->Form->control('answer_feedbacks.0.title') ?>
        <?= $this->Form->control('answer_feedbacks.0.text') ?>

        <?= $this->Form->button('<i class="material-icons">save</i>  ' . __('Save'), [
            'class' => 'btn btn-raised btn-block btn-primary',
        ]) ?>

        <?= $this->Form->end() ?>
    </div>
</div>


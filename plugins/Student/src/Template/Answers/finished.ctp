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

    $(function () {
        loadInitialAnswerWordFeedback();
    })
</script>
<?php $this->end(); ?>


<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

    <h1><?= __('Answer'); ?></h1>

    <?= $this->Html->link('<i class="material-icons">arrow_left</i> ' . __('Back'),
        $this->request->referer(), [
            'class' => 'btn',
            'escape' => false,
        ]) ?>

    <div class="panel panel-default">
        <!-- Panel header -->
        <table class="table table-striped" cellpadding="0" cellspacing="0">
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
                                <span class="label label-danger"><?= __('Help wanted'); ?></span>
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

                    <?php if(!empty($answerWord->help_text)): ?>
                    <tr>
                        <td><?= __('Help text'); ?></td>
                        <td><?= h($answerWord->help_text) ?></td>
                    </tr>
                    <?php endif?>
                </table>

            </div>
        <?php endforeach ?>
    <?php endif; ?>

    <?php if (!empty($answer->answer_feedbacks)): ?>
    <h2><?= __('General feedback'); ?></h2>

    <?php foreach ($answer->answer_feedbacks as $answerFeedback): ?>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= h($answerFeedback->created_by->name) ?>
                </h3>
            </div>

            <table class="table table-striped">
                <tr>
                    <td><?= __('Subject'); ?></td>
                    <td><?= h($answerFeedback->title) ?></td>
                </tr>

                <tr>
                    <td><?= __('Message'); ?></td>
                    <td><?= $this->Text->autoParagraph($answer->answer_feedbacks[0]->text) ?></td>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

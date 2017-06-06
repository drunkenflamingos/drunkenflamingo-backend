<?php
declare(strict_types=1);

/**
 * @var \App\View\AppView $this
 */

use Cake\Routing\Router;

$this->extend('/Layout/dashboard');

$answerId = $this->request->getParam('pass')[0];
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
    var addAnswerWordUrl = '<?= Router::url([
        'plugin' => 'StudentApi',
        'controller' => 'AnswerWords',
        'action' => 'add',
    ], true) ?>';

    var removeAnswerWordUrl = '<?= Router::url([
        'plugin' => 'StudentApi',
        'controller' => 'AnswerWords',
        'action' => 'delete',
    ], true) ?>';

    var answerWordsIndex = '<?= Router::url([
        'plugin' => 'StudentApi',
        'controller' => 'AnswerWords',
        'action' => 'index',
    ], true) ?>';

    var answerId = '<?=$answerId?>';

    function addWordToAssignment(wordNumber) {
        return $.ajax({
            method: 'POST',
            dataType: 'json',
            url: addAnswerWordUrl,
            headers: {
                Authorization: "Bearer <?=$jwtToken?>"
            },
            data: {
                answer_id: answerId,
                word_placement: wordNumber
            }
        });
    }

    function removeWordFromAssignment(answerWordId) {
        return $.ajax({
            method: 'DELETE',
            dataType: 'json',
            url: removeAnswerWordUrl + '/' + answerWordId,
            headers: {
                Authorization: "Bearer <?=$jwtToken?>"
            }

        });
    }


    function markWord($jqueryElement) {
        $jqueryElement.addClass('bg-warning');

        var className = $jqueryElement.attr('class').split(/\s+/)[0];

        //Backend uses 0-indexing
        var wordNumber = className.substr(4, className.length) - 1;

        addWordToAssignment(wordNumber)
            .done(function (data, textStatus, jQXHR) {
                $jqueryElement.removeClass('bg-warning');
                $jqueryElement.addClass('bg-info');
                $jqueryElement.data('answerWordId', data.data.id);
            })
    }

    function unMarkWord($jqueryElement) {
        $jqueryElement.removeClass('bg-info');
        $jqueryElement.addClass('bg-warning');

        var className = $jqueryElement.attr('class').split(/\s+/)[0];
        var answerWordId = $jqueryElement.data('answerWordId');

        removeWordFromAssignment(answerWordId)
            .done(function (data, textStatus, jQXHR) {
                $jqueryElement.removeClass('bg-warning');
                $jqueryElement.removeData('answerWordId');
            })
    }

    function loadInitialAnswerWords() {
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: answerWordsIndex,
            headers: {
                Authorization: "Bearer <?=$jwtToken?>"
            },
            data: {
                answer_id: answerId,
                sort: "word_placement",
                order: "ASC"
            }
        }).done(function (data, textStatus, jQXHR) {
            var amountOfRecords = data.data.length;
            if (amountOfRecords > 0) {
                for (var i = 0; i < amountOfRecords; i++) {
                    setWordAsMarked(data.data[i]);
                }
            }
        });
    }

    function setWordAsMarked(answerWord) {
        //Backend uses 0-indexing
        var $word = $('.word' + (answerWord.word_placement + 1));

        $word
            .addClass('bg-info')
            .data('answerWordId', answerWord.id);
    }

    $(function () {
        $(".hoverableText").lettering('words').children('span').addClass('assignmentWord');

        loadInitialAnswerWords();

        $('.assignmentWord').on('click', function (event) {
            var $clickedWord = $(event.target);

            if (typeof $clickedWord.data('answerWordId') === 'undefined') {
                markWord($clickedWord);
            } else {
                unMarkWord($clickedWord);
            }
        })
    })
</script>
<?php $this->end(); ?>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="well well-sm">
        <h3 class="text-center">
            <?= __("Pick words from the text you don't know yet"); ?>
        </h3>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="btn-group pull-right">
        <?= $this->Html->link('<i class="material-icons">open_in_new</i> ' . __('Ordnet.dk'),
            'http://ordnet.dk/ddo', [
                'class' => 'btn btn-default',
                'target' => '_blank',
                'escape' => false,
            ]) ?>
        <?= $this->Html->link('<i class="material-icons">help_outline</i>', '#helpModal', [
            'class' => 'btn btn-default',
            'escape' => false,
        ]) ?>
    </div>
</div>


<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="well">
        <div class="hoverableText"
             style="font-size: 16pt;"><?= $this->Text->autoParagraph(h($answer->assignment->text)) ?></div>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
    <div class="form-group">
        <div class="btn-group btn-group-justified btn-group-raised">
            <?= $this->Html->link('<i class="material-icons">arrow_forward</i> ' . __('Next'), [
                'action' => 'stepTwo',
                $answer->id,
            ], [
                'class' => 'btn btn-default',
                'escape' => false,
            ]) ?>
        </div>
    </div>
</div>




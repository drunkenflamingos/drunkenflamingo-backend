<?php
/**
 * @var \Cake\View\View $this
 */
declare(strict_types=1);

$this->extend('/Layout/dashboard');

$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= h($homework->name) ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<?php if (!empty($homework->text)): ?>
    <div class="well well-sm">
        <h4><?= __('Description'); ?></h4>
        <?= $this->Text->autoParagraph(h($homework->text)) ?>
    </div>
<?php endif; ?>


<h2><?= __('Assignments'); ?></h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th><?= __('Name'); ?></th>
        <th class="actions"></th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($assignments)): ?>
        <?php foreach ($assignments as $assignment): ?>
            <tr>
                <td>
                    <?= $this->Html->link(h($assignment->title), [
                        'controller' => 'Assignments',
                        'action' => 'view',
                        $assignment->id,
                    ]) ?>
                </td>
                <td>
                    <?php if (!empty($assignment->answers)): ?>
                        <?php if (count($assignment->answers) > 1): ?>
                            <?php foreach ($assignment->answers as $key => $answer): ?>
                                <?= $key !== 0 ? $this->Table->actionSeparator() : null; ?>
                                <?= $this->Html->link(__('Answer {0}', [$key + 1]), [
                                    'controller' => 'Answers',
                                    'action' => 'view',
                                    $answer->id,
                                ]) ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php $isDone = $assignment->answers[0]->is_done; ?>
                            <?= $this->Html->link(
                                $isDone ?
                                    __('Edit (from {0})', [$assignment->answers[0]->modified->i18nFormat()]) :
                                    __('Continue'), [
                                'controller' => 'Answers',
                                'action' => 'stepOne',
                                $assignment->answers[0]->id,
                            ]) ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?= $this->Form->postLink(__('Start'), [
                            'controller' => 'Answers',
                            'action' => 'add',
                        ], [
                            'data' => [
                                'assignment_id' => $assignment->id,
                                'homework_id' => $homework->id,
                            ],
                        ]) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td>
                <?= __('No assignments found'); ?>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>


<?php
declare(strict_types=1);

/**
 * @var $this \Cake\View\View
 * @var $homework \App\Model\Entity\Homework
 */

$this->extend('/Layout/dashboard');

?>

<?php $this->start('content_header'); ?>
<h1><?= h($homework->name) ?></h1>
<?php $this->end(); ?>

<?php
/**
 *
 * Details
 *
 */
?>
<?php $this->start('homeworkDetails'); ?>

<h2><?= __('Details'); ?></h2>

<div class="btn-group-raised">
    <?= $this->Html->link('<i class="material-icons">edit</i> ' . __('Edit'), [
        'action' => 'edit',
        $homework->id,
    ], [
        'class' => 'btn btn-primary',
        'escape' => false,
    ]) ?>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Title') ?></td>
            <td><?= h($homework->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Created by') ?></td>
            <td><?= h($homework->created_by->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($homework->created->i18nFormat()) ?></td>
        </tr>
        <tr>
            <td><?= __('Last modified') ?></td>
            <td><?= h($homework->modified->i18nFormat()) ?></td>
        </tr>
        <tr>
            <td><?= __('Description'); ?></td>
            <td><?= $this->Text->autoParagraph(h($homework->text)); ?></td>
        </tr>
    </table>
</div>
<?php $this->end(); ?>

<?php
/**
 *
 * Courses
 *
 */
?>

<?php $this->start('homeworkCourses'); ?>
<h2><?= __('Courses assigned'); ?></h2>

<div class="btn-group-raised btn-group-sm">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('Add course'), [
        'controller' => 'HomeworksCourses',
        'action' => 'add',
        '?' => [
            'homework_id' => $homework->id,
            'redirect_url' => $this->request->getRequestTarget(),
        ],
    ], [
        'class' => 'btn',
        'escape' => false,
    ]) ?>
</div>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th><?= __('Name'); ?></th>
        <th><?= __('Published from'); ?></th>
        <th><?= __('Published to'); ?></th>
        <th><?= __('Deadline'); ?></th>
        <th><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($homework->courses)): ?>
        <tr>
            <td colspan="4"><?= __('No courses'); ?></td>
        </tr>
    <?php else: ?>
        <?php foreach ($homework->courses as $course): ?>
            <tr>
                <td>
                    <?= sprintf('%s. %s', $this->Number->format($course->grade), h($course->name)) ?>
                </td>
                <td>
                    <?= !empty($course->_joinData->published_from) ? $course->_joinData->published_from->i18nFormat() : __('N/A') ?>
                </td>
                <td>
                    <?= !empty($course->_joinData->published_to) ? $course->_joinData->published_to->i18nFormat() : __('N/A') ?>
                </td>
                <td>
                    <?= !empty($course->_joinData->deadline) ? $course->_joinData->deadline->i18nFormat() : __('N/A') ?>
                </td>
                <td class="actions">
                    <?= $this->Table->actions([
                        $this->Html->link(__('Edit'), [
                            'controller' => 'HomeworksCourses',
                            'action' => 'edit',
                            $course->_joinData->id,
                            '?' => ['redirect_url' => $this->request->getRequestTarget()],
                        ]),
                        $this->Form->postLink(__('Delete'),
                            [
                                'controller' => 'HomeworksCourses',
                                'action' => 'delete',
                                $course->_joinData->id,
                            ],
                            [
                                'confirm' => __('Are you sure you want to delete this?'),
                                'data' => [
                                    'redirect_url' => $this->request->getRequestTarget(),
                                ],
                            ]),
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif ?>
    </tbody>
</table>
<?php $this->end(); ?>


<?php
/**
 *
 * Users
 *
 */
?>
<?php $this->start('homeworkUsers'); ?>
<h2><?= __('Users assigned'); ?></h2>

<div class="btn-group-raised btn-group-sm">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('Add user'),
        [
            'controller' => 'HomeworksUsers',
            'action' => 'add',
            '?' => [
                'homework_id' => $homework->id,
                'redirect_url' => $this->request->getRequestTarget(),
            ],
        ],
        [
            'class' => 'btn',
            'escape' => false,
        ]) ?>
</div>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th><?= __('Name'); ?></th>
        <th><?= __('Published from'); ?></th>
        <th><?= __('Published to'); ?></th>
        <th><?= __('Deadline'); ?></th>
        <th><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($homework->users)): ?>
        <tr>
            <td colspan="5"><?= __('No users found'); ?></td>
        </tr>
    <?php else: ?>
        <?php foreach ($homework->users as $user): ?>
            <tr>
                <td>
                    <?= h($user->name) ?>
                </td>
                <td>
                    <?= !empty($user->_joinData->published_from) ? $user->_joinData->published_from->i18nFormat() : __('N/A') ?>
                </td>
                <td>
                    <?= !empty($user->_joinData->published_to) ? $user->_joinData->published_to->i18nFormat() : __('N/A') ?>
                </td>
                <td>
                    <?= !empty($user->_joinData->deadline) ? $user->_joinData->deadline->i18nFormat() : __('N/A') ?>
                </td>
                <td class="actions">
                    <?= $this->Table->actions([
                        $this->Html->link(__('Edit'), [
                            'controller' => 'HomeworksCourses',
                            'action' => 'edit',
                            $user->_joinData->id,
                            '?' => ['redirect_url' => $this->request->getRequestTarget()],
                        ]),
                        $this->Form->postLink(__('Delete'),
                            [
                                'controller' => 'HomeworksCourses',
                                'action' => 'delete',
                                $user->_joinData->id,
                            ],
                            [
                                'confirm' => __('Are you sure you want to delete this?'),
                                'data' => [
                                    'redirect_url' => $this->request->getRequestTarget(),
                                ],
                            ]),
                    ]) ?>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif ?>
    </tbody>
</table>
<?php $this->end(); ?>

<?php
/**
 *
 * Assignments
 *
 */
?>
<?php $this->start('homeworkAssignments'); ?>
<h2><?= __('Assignments'); ?></h2>

<div class="btn-group-raised btn-group-sm">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('Add new assignment'),
        [
            'controller' => 'Assignments',
            'action' => 'add',
            '?' => [
                'homework_id' => $homework->id,
                'redirect_url' => $this->request->getRequestTarget(),
            ],
        ],
        [
            'class' => 'btn',
            'escape' => false,
        ]) ?>
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('Add existing assignment'),
        [
            'controller' => 'Homeworks',
            'action' => 'addExistingAssignment',
            $homework->id,
            '?' => ['redirect_url' => $this->request->getRequestTarget()],
        ],
        [
            'class' => 'btn',
            'escape' => false,
        ]) ?>
</div>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th><?= __('Title'); ?></th>
        <th><?= __('Locked'); ?></th>
        <th><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($homework->assignments)): ?>
        <tr>
            <td colspan="3"><?= __('No assignments'); ?></td>
        </tr>
    <?php else: ?>
        <?php foreach ($homework->assignments as $assignment): ?>
            <tr>
                <td><?= h($assignment->title) ?></td>

                <td>
                    <?php if ($assignment->is_locked): ?>
                        <i class="material-icons text-success">lock_outline</i>
                    <?php else: ?>
                        <i class="material-icons text-warning">lock_open</i>
                    <?php endif; ?>

                </td>

                <td class="actions">
                    <?= $this->Table->actions([
                        $this->Html->link(__('View'), [
                            'controller' => 'Assignments',
                            'action' => 'view',
                            $assignment->id,
                        ]),
                        $this->Html->link(__('Edit'), [
                            'controller' => 'Assignments',
                            'action' => 'edit',
                            $assignment->id,
                            '?' => ['redirect_url' => $this->request->getRequestTarget()],
                        ]),
                        $this->Form->postLink(__('Delete'),
                            [
                                'prefix' => 'Homeworks',
                                'controller' => 'Assignments',
                                'action' => 'delete',
                                'homework_id' => $homework->id,
                                $assignment->_joinData->id,
                            ],
                            [
                                'confirm' => __('Are you sure you want to delete this?'),
                                'data' => [
                                    'redirect_url' => $this->request->getRequestTarget(),
                                ],
                            ]),
                    ]) ?>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif ?>
    </tbody>
</table>
<?php $this->end(); ?>

<?php
/**
 *
 * Assignments
 *
 */
?>
<?php $this->start('homeworkAnswers'); ?>
<h2><?= __('Answers'); ?></h2>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th><?= __('Time'); ?></th>
        <th><?= __('Pupil'); ?></th>
        <th><?= __('Assignment'); ?></th>
        <th><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($homework->answers)): ?>
        <tr>
            <td colspan="3"><?= __('No answers yet'); ?></td>
        </tr>
    <?php else: ?>
        <?php foreach ($homework->answers as $answer): ?>
            <tr>
                <td><?= $answer->created->i18nFormat() ?></td>
                <td>
                    <?= $this->Html->link(h($answer->created_by->name), [
                        'controller' => 'Users',
                        'action' => 'view',
                        $answer->created_by->id,
                    ]) ?>
                </td>
                <td>
                    <?= $this->Html->link(h($answer->assignment->title), [
                        'controller' => 'Assignments',
                        'action' => 'view',
                        $answer->assignment->id,
                    ]) ?>
                </td>
                <td class="actions">
                    <?= $this->Table->actions([
                        $this->Html->link(__('View'), [
                            'controller' => 'Answers',
                            'action' => 'view',
                            $answer->id,
                        ]),
                    ]) ?>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif ?>
    </tbody>
</table>
<?php $this->end(); ?>


<?php
/**
 *
 * Actual content
 *
 */
?>

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#homeworkView" data-toggle="tab" aria-expanded="true">
            <?= __('Details'); ?>
        </a>
    </li>

    <li>
        <a href="#homeworkCourses" data-toggle="tab" aria-expanded="false">
            <?= __('Courses'); ?>
        </a>
    </li>

    <li>
        <a href="#homeworkUsers" data-toggle="tab" aria-expanded="false">
            <?= __('Users'); ?>
        </a>
    </li>

    <li>
        <a href="#homeworkAssignments" data-toggle="tab" aria-expanded="false">
            <?= __('Assignments'); ?>
        </a>
    </li>
    <li>
        <a href="#homeworkAnswers" data-toggle="tab" aria-expanded="false">
            <?= __('Answers'); ?>
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade active in" id="homeworkView">
        <?= $this->fetch('homeworkDetails') ?>
    </div>
    <div class="tab-pane fade" id="homeworkCourses">
        <?= $this->fetch('homeworkCourses') ?>
    </div>
    <div class="tab-pane fade" id="homeworkUsers">
        <?= $this->fetch('homeworkUsers') ?>
    </div>
    <div class="tab-pane fade" id="homeworkAssignments">
        <?= $this->fetch('homeworkAssignments') ?>
    </div>
    <div class="tab-pane fade" id="homeworkAnswers">
        <?= $this->fetch('homeworkAnswers') ?>
    </div>
</div>

<?php
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Classes'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group">
    <?= $this->Html->link(__('Edit class'), ['action' => 'edit', $course->id], [
        'class' => 'btn',
    ]) ?>
    <?= $this->Form->postLink(__('Delete class'), ['action' => 'delete', $course->id],
        [
            'class' => 'btn',
            'confirm' =>
                __('Are you sure you want to delete {0}?', [
                    sprintf('%s.%s', h($course->grade), h($course->name)),
                ]),
        ]) ?>
    <?= $this->Html->link(__('List classes'), ['action' => 'index'], ['class' => 'btn',]) ?>
    <?= $this->Html->link(__('New class'), ['action' => 'add'], ['class' => 'btn',]) ?>
</div>
<?php $this->end(); ?>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= sprintf('%s.%s', h($course->grade), h($course->name)); ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= ($course->created->i18nFormat()) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($course->modified->i18nFormat()) ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Pupils') ?></h3>
    </div>
    <div class="panel-body">
        <div class="btn-group">
            <?= $this->Html->link(__('Add pupil'), [
                'prefix' => 'Courses',
                'controller' => 'CoursesUsers',
                'action' => 'add',
                'course_id' => $course->id,
            ], [
                'class' => 'btn',
            ]) ?>
        </div>
        <table class="table table-striped" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('name'); ?></th>
                <th><?= $this->Paginator->sort('email'); ?></th>
                <th class="actions"><?= __('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($course->users as $user): ?>
                <tr>
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td class="actions">
                        <?= $this->Form->postLink('', [
                            'prefix' => 'Courses',
                            'controller' => 'CoursesUsers',
                            'action' => 'delete',
                            'course_id' => $course->id,
                            $user->_joinData->id,
                        ], [
                            'confirm' => __('Are you sure you want to delete {0} from class?', $user->name),
                            'title' => __('Delete'),
                            'class' => 'btn btn-default glyphicon glyphicon-trash',
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


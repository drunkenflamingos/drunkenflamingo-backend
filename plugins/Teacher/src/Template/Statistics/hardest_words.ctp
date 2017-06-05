<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');

?>

<?php $this->start('content_header'); ?>
<h1><?= __('Hardest words'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group">
    <div class="btn-group">
        <a href="#" data-target="#" class="btn btn-raised dropdown-toggle" data-toggle="dropdown"
           aria-expanded="false">
            <?php
            if (isset($selectedCourse)): ?>
                <?= sprintf("Showing %s", h($selectedCourse->getCombinedName())) ?>
            <?php else: ?>
                <?= __('Select course'); ?>
            <?php endif ?>
            <i class="material-icons">arrow_drop_down</i>
        </a>
        <ul class="dropdown-menu">
            <?php
            if (isset($selectedCourse)): ?>
                <li>
                    <?= $this->Html->link(__('Show all'), [
                        '?' => ['course_id' => null] + $this->request->getQuery(),
                    ]) ?>
                </li>
                <?= sprintf("Course: %s", h($selectedCourse->getCombinedName())) ?>
            <?php endif ?>

            <?php foreach ($courses as $course) : ?>
                <li>
                    <?= $this->Html->link($course->getCombinedName(), [
                        '?' => ['course_id' => $course->id] + $this->request->getQuery(),
                    ]) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

    <div class="btn-group">
        <a href="#" data-target="#" class="btn btn-raised dropdown-toggle" data-toggle="dropdown"
           aria-expanded="false">
            <?php
            if (isset($selectedCourse)): ?>
                <?= sprintf("User: %s", h($selectedCourse->getCombinedName())) ?>
            <?php else: ?>
                <?= __('Select pupil'); ?>
            <?php endif ?>
            <i class="material-icons">arrow_drop_down</i>
        </a>
        <ul class="dropdown-menu">
            <?php
            if (isset($selectedUser)): ?>
                <li>
                    <?= $this->Html->link(__('Show all'), [
                        '?' => ['user_id' => null] + $this->request->getQuery(),
                    ]) ?>
                </li>
                <?= sprintf("Showing %s", h($selectedUser->name)) ?>
            <?php endif ?>

            <?php foreach ($users as $user) : ?>
                <li>
                    <?= $this->Html->link($user->name, [
                        '?' => ['user_id' => $user->id] + $this->request->getQuery(),
                    ]) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="input-group">
            <?= $this->Form->create(null, ['type' => 'GET']) ?>
            <?= $this->Form->control('word', [
                'placeholder' => __('Search') . '...',
                'label' => false,
                'value' => $this->request->getQuery('word'),
            ]) ?>
            <?= $this->Form->end(); ?>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="material-icons">search</i>
                </button>
            </span>
        </div>
    </div>
</div>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= __('Word'); ?></th>
        <th><?= __('Amount of errors'); ?></th>
        <th><?= __('Amount of skips'); ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
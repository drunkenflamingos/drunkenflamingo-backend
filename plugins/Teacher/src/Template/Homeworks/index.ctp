<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');

?>

<?php $this->start('content_header'); ?>
<h1><?= __('Homework'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group-raised">
    <div class="btn-group">
        <?= $this->Html->link('<i class="material-icons">add</i> ' . __('New homework'), [
            'action' => 'add',
        ], [
            'class' => 'btn btn-primary',
            'escape' => false,
        ]) ?>
        <a href="#"
           data-target="#"
           class="btn btn-primary dropdown-toggle"
           data-toggle="dropdown"
           aria-expanded="false">
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <?= $this->Html->link('<i class="material-icons">add</i> ' . __('Without course'), [
                    'action' => 'add',
                    '?' => ['addNoCourse' => true],
                ], [
                    'escape' => false,
                ]) ?>
            </li>
        </ul>
    </div>

    <div class="btn-group">
        <a href="bootstrap-elements.html" data-target="#" class="btn btn-raised dropdown-toggle" data-toggle="dropdown"
           aria-expanded="false">
            <?= __('Show only for'); ?>
            <?php
            if (isset($selectedCourse)): ?>
                <?= h($selectedCourse->getCombinedName()) ?>
            <?php endif ?>
            <span class="caret"></span>
            <div class="ripple-container"></div>
        </a>
        <ul class="dropdown-menu">
            <li>
                <?= $this->Html->link(sprintf('-- %s --', __('All')), [
                    '?' => ['course_id' => ''] + $this->request->getQuery(),
                ]) ?>
            </li>
            <?php foreach ($courses as $course) : ?>
                <li>
                    <?= $this->Html->link($course->getCombinedName(), [
                        '?' => ['course_id' => $course->id] + $this->request->getQuery(),
                    ]) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

</div>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xs-12">
        <?= $this->Form->create(null, ['type' => 'GET']) ?>
        <div class="input-group">
            <?= $this->Form->control('q', [
                'placeholder' => __('Search') . '...',
                'label' => false,
                'value' => $this->request->getQuery('q'),
            ]) ?>

            <span class="input-group-btn">
                <button class="btn btn-default">
                    <i class="material-icons">search</i>
                </button>
            </span>

        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('name'); ?></th>
        <th><?= $this->Paginator->sort('text'); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($homeworks as $homework): ?>
        <tr>
            <td><?= h($homework->name) ?></td>
            <td><?= h($homework->text) ?></td>
            <td><?= $homework->created->i18nFormat() ?></td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'),
                        ['action' => 'view', $homework->id]
                    ),
                    $this->Html->link(__('Edit'),
                        ['action' => 'edit', $homework->id]
                    ),
                    $this->Form->postLink(__('Delete'),
                        ['action' => 'delete', $homework->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $homework->name),]
                    ),
                ]) ?>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="paginator text-center">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
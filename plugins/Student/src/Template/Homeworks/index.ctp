<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Homework'); ?></h1>
<?php $this->end(); ?>

<?php
$this->start('content_buttons');
?>
<div class="btn-group-raised">
    <?php if ($this->request->getQuery('type') === 'courses'): ?>
        <?= $this->Html->link(__('Show direct', [
                '?' => ['type' => 'user'] + $this->request->getQueryParams()
        ])) ?>
    <?php else: ?>
        <?= $this->Html->link(__("Show course's", [
            '?' => ['type' => 'user'] + $this->request->getQueryParams()
        ])) ?>
    <?php endif?>
    <div class="btn-group">
        <a href="#" data-target="#" class="btn btn-raised dropdown-toggle" data-toggle="dropdown"
           aria-expanded="false">
            <?= __('Show for'); ?>
            <?php
            if (isset($selectedCourse)): ?>
                <?= h($selectedCourse->getCombinedName()) ?>
            <?php endif ?>
            <i class="material-icons">arrow_drop_down</i>
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
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('content_buttons') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('id'); ?></th>
        <th><?= $this->Paginator->sort('created_by_id'); ?></th>
        <th><?= $this->Paginator->sort('modified_by_id'); ?></th>
        <th><?= $this->Paginator->sort('organization_id'); ?></th>
        <th><?= $this->Paginator->sort('name'); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th><?= $this->Paginator->sort('modified'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($homeworks as $homework): ?>
        <tr>
            <td><?= h($homework->id) ?></td>
            <td><?= h($homework->created_by_id) ?></td>
            <td><?= h($homework->modified_by_id) ?></td>
            <td><?= h($homework->organization_id) ?></td>
            <td><?= h($homework->name) ?></td>
            <td><?= h($homework->created) ?></td>
            <td><?= h($homework->modified) ?></td>
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
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'), ['action' => 'view', $homework->id], ['title' => __('View')]),
                    $this->Html->link(__('Edit'), ['action' => 'edit', $homework->id], ['title' => __('Edit')]),
                    $this->Form->postLink(__('Delete'), ['action' => 'delete', $homework->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $homework->id),
                        'title' => __('Delete'),
                    ]),
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

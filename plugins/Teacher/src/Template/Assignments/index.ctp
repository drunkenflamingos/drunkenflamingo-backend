<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Assignment'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group-raised">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('New Assignment'), [
        'action' => 'add',
    ], [
        'class' => 'btn btn-primary',
        'escape' => false,
    ]) ?>
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
        <th><?= $this->Paginator->sort('title'); ?></th>
        <th><?= $this->Paginator->sort('is_locked', __('Status')); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($assignments as $assignment): ?>
        <tr>
            <td><?= h($assignment->title) ?></td>
            <td><?= '<i class="material-icons">' . ($assignment->is_locked ? 'lock_outline' : 'lock_open') . '</i>' ?></td>
            <td><?= h($assignment->created->i18nFormat()) ?></td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'),
                        ['action' => 'view', $assignment->id]
                    ),
                    $this->Html->link(__('Edit'),
                        ['action' => 'edit', $assignment->id]
                    ),
                    $this->Form->postLink(__('Delete'),
                        ['action' => 'delete', $assignment->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->title),]
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

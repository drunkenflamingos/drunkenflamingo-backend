<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('Answers'); ?></h1>
<?php $this->end(); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('created_by_id'); ?></th>
        <th><?= $this->Paginator->sort('modified_by_id'); ?></th>
        <th><?= $this->Paginator->sort('assignment_id'); ?></th>
        <th><?= $this->Paginator->sort('homework_id'); ?></th>
        <th><?= $this->Paginator->sort('is_done'); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($answers as $answer): ?>
        <tr>
            <td><?= h($answer->created_by_id) ?></td>
            <td><?= h($answer->modified_by_id) ?></td>
            <td><?= h($answer->assignment_id) ?></td>
            <td><?= h($answer->homework_id) ?></td>
            <td><?= h($answer->is_done) ?></td>
            <td><?= h($answer->created) ?></td>
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
                    $this->Html->link(__('View'), ['action' => 'view', $answer->id], ['title' => __('View')]),
                    $this->Html->link(__('Edit'), ['action' => 'edit', $answer->id], ['title' => __('Edit')]),
                    $this->Form->postLink(__('Delete'), ['action' => 'delete', $answer->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $answer->id),
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

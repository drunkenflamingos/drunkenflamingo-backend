<?php
/* @var $this \Cake\View\View */

$this->extend('/Layout/dashboard');

$homeworkId = $this->request->getParam('pass')[0];
?>



<?php $this->start('content_header'); ?>
<h1><?= __('Add assignment'); ?></h1>
<?php $this->end(); ?>


<div class="row">
    <div class="col-xs-12">
        <?= $this->Form->create(null, ['type' => 'GET']) ?>
        <?= $this->Form->hidden('redirect_url', [
            'value' => $this->request->getQuery('redirect_url'),
        ]); ?>
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

<table class="table table-striped">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('title'); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($assignments as $assignment): ?>
        <tr>
            <td><?= h($assignment->title) ?></td>
            <td><?= h($assignment->created->i18nFormat()) ?></td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'),
                        [
                            'controller' => 'Assignments',
                            'action' => 'view',
                            $assignment->id,
                        ]
                    ),
                    $this->Form->postLink(__('Select'), [
                        $homeworkId,
                        '?' => [
                            'redirect_url' => $this->request->getQuery('redirect_url'),
                        ],
                        $this->request->getParam('homework_id'),
                    ], [
                        'data' => [
                            'assignment_id' => $assignment->id,
                        ],
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

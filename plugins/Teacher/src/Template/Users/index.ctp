<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');

?>

<?php $this->start('content_header'); ?>
<h1><?= __('Pupils'); ?></h1>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="input-group">
            <?= $this->Form->create(null, ['type' => 'GET']) ?>
            <?= $this->Form->control('q', [
                'placeholder' => __('Search') . '...',
                'label' => false,
                'value' => $this->request->getQuery('q'),
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
        <th><?= $this->Paginator->sort('name'); ?></th>
        <th><?= $this->Paginator->sort('email'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= h($user->name) ?></td>
            <td><?= h($user->email) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="text-center">
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

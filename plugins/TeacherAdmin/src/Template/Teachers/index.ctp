<?php
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= __('Teachers'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group-raised">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('New teacher'), [
        'action' => 'add',
    ], [
        'class' => 'btn btn-primary',
        'escape' => false,
    ]) ?>

</div>
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
        <th><?= __('Role(s)'); ?></th>
        <th class="actions"><?= __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($teachers as $teacher): ?>
        <?php
        $isTeacherAdmin = !collection($teacher->users_roles)->match(['role.identifier' => 'teacher_admin'])->isEmpty();
        $isNormalTeacher = !collection($teacher->users_roles)->match(['role.identifier' => 'teacher'])->isEmpty();
        ?>
        <tr>
            <td><?= h($teacher->name) ?></td>
            <td><?= h($teacher->email) ?></td>
            <td>
                <?= $isTeacherAdmin ? sprintf('<div class="label label-primary">%s</div>', __('Admin')) : null ?>
                <?= $isNormalTeacher ? sprintf('<div class="label label-primary">%s</div>', __('Teacher')) : null ?>
            </td>
            <td class="actions">
                <?= $this->Table->actions([
                    $this->Html->link(__('View'), ['action' => 'view', $teacher->id]),
                    $this->Html->link(__('Edit'), ['action' => 'edit', $teacher->id]),
                    $this->Form->postLink(__('Delete'), ['action' => 'delete', $teacher->id], [
                        'confirm' => __('Are you sure you want to delete {0}?', $teacher->name),
                    ])
                ]) ?>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>

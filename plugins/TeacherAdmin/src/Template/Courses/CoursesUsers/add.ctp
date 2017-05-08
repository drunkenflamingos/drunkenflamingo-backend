<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1>
    <?= __('Add pupil to class') ?>
</h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group">
    <?= $this->Html->link(__('View class'), [
        'prefix' => false,
        'controller' => 'Courses',
        'action' => 'view',
        $this->request->getParam('course_id'),
    ], [
        'class' => 'btn',
    ]) ?>
</div>
<?php $this->end(); ?>

<?= $this->Form->create($coursesUser); ?>
<fieldset>
    <?php
    echo $this->Form->control('user_id', [
        'empty' => '-- ' . __('Vælg') . ' --',
        'class' => 'select2',
    ]);
    echo $this->Form->hidden('course_id', [
        'value' => $this->request->getParam('course_id'),
    ]);
    ?>
</fieldset>
<?= $this->Form->button(__("Add"), [
    'class' => 'btn btn-raised btn-primary',
]); ?>
<?= $this->Form->end() ?>

<?php
/**
 * @var \Cake\View\View $this
 */

$this->extend('Layout/dashboard');
?>

<div class="col-xs-12">
    <?= $this->Html->link('<i class="material-icons">add_circle_outline</i> ' . __('Create'), [
        'action' => 'add',
    ], [
        'class' => 'btn btn-lg btn-block btn-raised btn-primary',
        'escape' => false,
    ]) ?>
</div>

<div class="col-xs-12">
    <?php foreach ($organizations as $organization) : ?>
        <?= $this->Form->postLink($organization->name . ' <i class="material-icons">keyboard_arrow_right</i>', [
            'action' => 'pick',
            $organization->id,
        ], [
            'class' => 'btn btn-lg btn-block btn-raised btn-primary',
            'escape' => false,
        ]) ?>
    <?php endforeach; ?>
</div>


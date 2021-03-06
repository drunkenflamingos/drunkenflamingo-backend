<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\I18n\Time;

$this->extend('Layout/dashboard');
?>
<?= $this->Form->create($homeworksCourse); ?>

<div class="col-xs-12 col-md-8 col-md-offset-2">

    <div class="btn-group">
        <?= $this->Html->link('<i class="material-icons">arrow_left</i> ' . __('Back'),
            $this->request->referer(), [
                'class' => 'btn',
                'escape' => false,
            ]) ?>

    </div>

    <div class="well">
        <?= $this->Form->create($homeworksCourse); ?>
        <fieldset>
            <?php
            echo $this->Form->control('course_id', [
                'type' => 'select',
                'options' => $courses,
                'empty' => '-- ' . __('Choose') . ' --',
                'label' => __('Course'),
            ]);
            echo $this->Form->control('published_from', [
                'type' => 'datetime',
                'value' => Time::now(),
                'label' => __('Available from'),
            ]);
            echo $this->Form->control('published_to', [
                'type' => 'datetime',
                'value' => Time::now()->addDays(1),
                'label' => __('Available to'),
            ]);
            echo $this->Form->control('deadline', [
                'value' => Time::now()->addDays(1),
                'type' => 'datetime',
                'label' => __('Deadline'),
            ]);
            ?>
        </fieldset>
        <?= $this->Form->button('<i class="material-icons">save</i> ' . __('Save'), [
            'class' => 'btn btn-raised btn-primary',
            'escape' => false,
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

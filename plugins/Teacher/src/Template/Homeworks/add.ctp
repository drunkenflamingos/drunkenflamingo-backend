<?php
declare(strict_types=1);

/**
 * @var \App\View\AppView $this
 */

use Cake\I18n\Time;

$this->extend('Layout/dashboard');
?>

<div class="col-xs-12 col-md-8 col-md-offset-2">
    <div class="well">
        <?= $this->Form->create($homework); ?>
        <fieldset>
            <?php
            echo $this->Form->control('name');
            echo $this->Form->control('text', ['label' => __('Description')]);
            ?>

            <?php if ($this->request->getQuery('addNoCourse') !== '1') : ?>
                <div class="form-group">
                    <h2><?= __('Quick-add course'); ?></h2>
                </div>

                <?php
                echo $this->Form->control('homeworks_courses.0.course_id', [
                    'type' => 'select',
                    'options' => $courses,
                    'empty' => '-- ' . __('Choose') . ' --',
                    'label' => __('Course'),
                ]);
                echo $this->Form->control('homeworks_courses.0.published_from', [
                    'type' => 'datetime',
                    'value' => Time::now(),
                    'label' => __('Tilgængelig fra'),
                ]);
                echo $this->Form->control('homeworks_courses.0.published_to', [
                    'type' => 'datetime',
                    'value' => Time::now()->addDays(1),
                    'label' => __('Tilgængelig til'),
                ]);
                echo $this->Form->control('homeworks_courses.0.deadline', [
                    'value' => Time::now()->addDays(1),
                    'type' => 'datetime',
                    'label' => __('Deadline'),
                ]); ?>
            <?php endif ?>
        </fieldset>
        <?= $this->Form->button('<i class="material-icons">save</i> ' . __('Save'), [
            'class' => 'btn btn-raised btn-primary',
            'escape' => false,
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

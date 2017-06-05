<?php
declare(strict_types=1);

use Cake\I18n\Time;

/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<div class="col-xs-12 col-md-8 col-md-offset-2">

    <div class="btn-group">
        <?= $this->Html->link('<i class="material-icons">arrow_left</i> ' . __('Back'),
            $this->request->referer(), [
                'class' => 'btn',
                'escape' => false,
            ]) ?>

    </div>

    <div class="well">
        <?= $this->Form->create($homework); ?>
        <fieldset>
            <?php
            echo $this->Form->control('name');
            echo $this->Form->control('text');
            ?>
        </fieldset>
        <?= $this->Form->button('<i class="material-icons">save</i> ' . __('Save'), [
            'class' => 'btn btn-raised btn-primary',
            'escape' => false,
        ]) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php
declare(strict_types=1);
/**
 * @var \App\View\AppView $this
 */

$this->extend('/Layout/dashboard');
?>

<div class="col-xs-12 col-md-8 col-md-offset-2">
    <div class="well">
        <?= $this->Form->create($assignment); ?>
        <fieldset>
            <h1><?= __('Add assignment'); ?></h1>

            <?php if (!empty($this->request->getQuery('homework_id'))): ?>
                <?= $this->Form->hidden('homeworks._ids.0', [
                    'value' => $this->request->getQuery('homework_id'),
                ]); ?>
            <?php endif; ?>

            <?php
            echo $this->Form->control('title');

            echo $this->Form->control('text', [
                'label' => __('Text content'),
            ]);

            echo $this->Form->control('is_locked');
            ?>
        </fieldset>

        <?= $this->Form->button('<i class="material-icons">save</i> ' . __('Save'), [
            'class' => 'btn btn-raised btn-primary',
            'escape' => false,
        ]) ?>

        <?= $this->Form->end() ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<?= $this->Form->create($course); ?>
<fieldset>
    <legend><?= __('Add class') ?></legend>
    <?php
    echo $this->Form->control('grade', [
        'type' => 'select',
        'options' => range(0, 10),
    ]);
    echo $this->Form->control('name');
    ?>
</fieldset>
<?= $this->Form->button('<i class="material-icons">save</i> ' . __('Save'), [
    'class' => 'btn btn-raised btn-primary',
    'escape' => false,
]) ?>
<?= $this->Form->end() ?>

<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<?= $this->Form->create($homework); ?>
<fieldset>
    <legend><?= __('Edit homework') ?></legend>
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

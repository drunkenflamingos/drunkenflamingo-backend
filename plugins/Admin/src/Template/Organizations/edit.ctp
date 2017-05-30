<?php
declare(strict_types=1);
/**
 * @var \App\View\AppView $this
 */
?>
<?php
$this->extend('Layout/dashboard');

?>
<?= $this->Form->create($organization); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Organization']) ?></legend>
    <?php
    echo $this->Form->control('name');
    echo $this->Form->control('vat_number');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

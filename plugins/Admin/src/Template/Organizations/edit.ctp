<?php
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
    echo $this->Form->control('contact_person_id');
    echo $this->Form->control('default_language_id', ['options' => $languages]);
    echo $this->Form->control('country_id');
    echo $this->Form->control('name');
    echo $this->Form->control('vat_number');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

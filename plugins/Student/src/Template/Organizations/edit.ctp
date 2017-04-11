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
    echo $this->Form->input('contact_person_id');
    echo $this->Form->input('default_language_id', ['options' => $languages]);
    echo $this->Form->input('country_id');
    echo $this->Form->input('name');
    echo $this->Form->input('vat_number');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

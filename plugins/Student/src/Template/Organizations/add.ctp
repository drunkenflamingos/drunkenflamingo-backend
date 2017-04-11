<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('Layout/dashboard');
?>

<?= $this->Form->create($organization); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Organization']) ?></legend>

    <?php
    echo $this->Form->input('contact_person_id', [
        'type' => 'hidden',
        'value' => $this->request->session()->read('Auth.User.id'),
    ]);

    echo $this->Form->input('default_language_id', [
        'type' => 'hidden',
        'value' => $this->request->session()->read('Auth.User.language_id'),
    ]);
    echo $this->Form->input('name');
    echo $this->Form->input('vat_number');
    ?>

</fieldset>
<?= $this->Form->button(__('Add'), ['class' => 'btn btn-primary btn-raised']); ?>
<?= $this->Form->end() ?>

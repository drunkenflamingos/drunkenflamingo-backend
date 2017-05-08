<?php
$this->extend('Layout/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($organization->name) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= h($organization->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created By Id') ?></td>
            <td><?= h($organization->created_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified By Id') ?></td>
            <td><?= h($organization->modified_by_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Contact Person Id') ?></td>
            <td><?= h($organization->contact_person_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Default Language Id') ?></td>
            <td><?= h($organization->default_language_id) ?></td>
        </tr>
        <tr>
            <td><?= __('Name') ?></td>
            <td><?= h($organization->name) ?></td>
        </tr>
        <tr>
            <td><?= __('Vat Number') ?></td>
            <td><?= h($organization->vat_number) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($organization->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($organization->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Deleted') ?></td>
            <td><?= h($organization->deleted) ?></td>
        </tr>
    </table>
</div>


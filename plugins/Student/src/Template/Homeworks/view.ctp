<?php
declare(strict_types=1);

$this->extend('/Layout/dashboard');

$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= h($homework->name) ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<?php if (!empty($homework->text)): ?>
    <div class="well well-sm">
        <h4><?= __('Description'); ?></h4>
        <?= $this->Text->autoParagraph(h($homework->text)) ?>
    </div>
<?php endif; ?>


<h2><?= __('Assignments'); ?></h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($homework->assignments)): ?>
        <?php foreach ($homework->assignments as $assignment): ?>
            <tr>
                <td></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan=""></td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>


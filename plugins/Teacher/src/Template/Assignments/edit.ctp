<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php
$this->extend('/Layout/dashboard');

$this->start('tb_actions');
?>
<li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $assignment->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->id)]
    )
    ?>
</li>
<li><?= $this->Html->link(__('List Assignments'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
        $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $assignment->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->id)]
        )
        ?>
    </li>
    <li><?= $this->Html->link(__('List Assignments'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($assignment); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Assignment']) ?></legend>
    <?php
    echo $this->Form->control('created_by_id');
    echo $this->Form->control('modified_by_id');
    echo $this->Form->control('organization_id');
    echo $this->Form->control('title');
    echo $this->Form->control('text');
    echo $this->Form->control('is_locked');
    echo $this->Form->control('deleted');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php
declare(strict_types=1);

$this->extend('/Layout/dashboard');

$this->start('tb_actions');
?>
<li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $answer->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]
    )
    ?>
</li>
<li><?= $this->Html->link(__('List Answers'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
        $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $answer->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $answer->id)]
        )
        ?>
    </li>
    <li><?= $this->Html->link(__('List Answers'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($answer); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Answer']) ?></legend>
    <?php
    echo $this->Form->control('created_by_id');
    echo $this->Form->control('modified_by_id');
    echo $this->Form->control('assignment_id');
    echo $this->Form->control('homework_id');
    echo $this->Form->control('is_done');
    echo $this->Form->control('deleted');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

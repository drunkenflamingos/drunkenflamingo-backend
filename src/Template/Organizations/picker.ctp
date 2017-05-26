<?php
declare(strict_types=1);
/**
 * @var \Cake\View\View $this
 * @var \App\Model\Entity\Organization[] $organizations
 */

$this->extend('../Layout/dashboard');
?>

<div class="col-xs-12">
    <?= $this->Html->link('<i class="material-icons">add_circle_outline</i> ' . __('Create'), [
        'action' => 'add',
    ], [
        'class' => 'btn btn-lg btn-block btn-raised btn-primary',
        'escape' => false,
    ]) ?>
</div>

<div class="col-xs-12">
    <?php foreach ($organizations as $organization) : ?>
        <?php foreach ($organization->users_roles as $userRoles) : ?>
            <?= $this->Form->postLink(sprintf(
                '%s - %s <i class="material-icons">keyboard_arrow_right</i>',
                $organization->name,
                $userRoles->role->name
            ), [
                'action' => 'pick',
                $organization->id,
            ], [
                'class' => 'btn btn-lg btn-block btn-raised btn-primary',
                'escape' => false,
                'data' => [
                    'role_id' => $userRoles->role->id,
                ],
            ]) ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>


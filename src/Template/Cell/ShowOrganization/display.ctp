<?php
declare(strict_types=1);
if (isset($organization)) : ?>
    <?= $this->Html->link($organization->name, [
        'prefix' => false,
        'controller' => 'Dashboard',
        'action' => 'index',
    ]); ?>
<?php else: ?>
    <?= h(__('No organization')); ?>
<?php endif; ?>

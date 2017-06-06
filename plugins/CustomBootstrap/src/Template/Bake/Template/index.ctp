<%

use Cake\Utility\Inflector;
%>
<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard'); ?>

<?php $this->start('content_header'); ?>
<h1><?= __('<%= $singularHumanName %>'); ?></h1>
<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<div class="btn-group-raised">
    <?= $this->Html->link('<i class="material-icons">add</i> ' . __('New <%= $singularHumanName %>'), [
            'action' => 'add'
    ], [
        'class' => 'btn btn-primary',
        'escape' => false,
    ]) ?>
</div>
<%
$done = [];
foreach ($associations as $type => $data):
    foreach ($data as $alias => $details):
        if ($details['controller'] != $this->name && !in_array($details['controller'], $done)):
            %>
    <li><?= $this->Html->link(__('List <%= Inflector::humanize($details["controller"]) %>'), ['controller' => '<%= $details["controller"] %>', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New <%= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) %>'), ['controller' => '<%= $details["controller"] %>', 'action' => 'add']); ?></li>
<%
            $done[] = $details['controller'];
        endif;
    endforeach;
endforeach;
%>
<?php $this->end(); ?>

<%
$fields = collection($fields)
        ->filter(function($field) use ($schema) {
            return !in_array($schema->columnType($field), ['binary', 'text']);
        })
        ->take(7);
%>
<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
<% foreach ($fields as $field): %>
            <th><?= $this->Paginator->sort('<%= $field %>'); ?></th>
<% endforeach; %>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
        <tr>
<%
            foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['BelongsTo'])) {
                    foreach ($associations['BelongsTo'] as $alias => $details) {
                        if ($field === $details['foreignKey']) {
                            $isKey = true;
                            %>
            <td>
                <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
            </td>
<%
                            break;
                        }
                    }
                }
                if ($isKey !== true) {
                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                        %>
            <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                    } else {
                        %>
            <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
<%
                    }
                }
            }

            $pk = '$' . $singularVar . '->' . $primaryKey[0];
            %>
            <td class="actions">
                <?= $this->Table->actions([
                $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>], ['title' => __('View')]),
                $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>], ['title' => __('Edit')]),
                $this->Form->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>], ['confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>), 'title' => __('Delete')])
                ]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator text-center">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>

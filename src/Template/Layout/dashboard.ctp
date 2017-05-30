<?php
declare(strict_types=1);

/* @var $this \Cake\View\View */
use Cake\Core\Configure;

$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
$this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->controller, $this->request->action]) . '" ');
$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
<?php
$plugin = $this->request->getParam('plugin');
$element = !empty($plugin) ? $plugin . '.' : '';
$element .= 'navbar';

echo $this->element($element);
?>

<div class="container-fluid">
    <div class="main">

<?php if (!empty($this->fetch('content_header'))) : ?>
    <div class="row">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <?= $this->fetch('content_header') ?>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($this->fetch('content_buttons'))) : ?>
    <div class="row">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <?= $this->fetch('content_buttons') ?>
        </div>
    </div>
<?php endif; ?>

    <div class="row">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
<?php
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash)) {
        echo $this->Flash->render();
    }
    $this->end();
}
$this->end();

$this->start('tb_body_end');
echo '</body>';
$this->end();

$this->append('content', '</div></div></div></div>');
echo $this->fetch('content');

<?php
declare(strict_types=1);

/**
 * @var \Cake\View\View $this
 */

?>
<div class="navbar navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-brand">
                <?= $this->Html->image('logo_white_transparent.png', [
                    'class' => 'img-responsive',
                    'style' => 'height: 32px;',
                    'url' => \Cake\Routing\Router::url(['controller' => 'Dashboard', 'action' => 'index']),
                ]) ?>
            </div>

        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?= $this->fetch('tb_actions') ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">mode_edit</i> ' . __('Homework'),
                        [
                            'controller' => 'Homeworks',
                            'action' => 'index',
                        ], ['escape' => false,]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">assignment</i> ' . __('Answers'),
                        [
                            'controller' => 'Answers',
                            'action' => 'index',
                        ], ['escape' => false,]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">feedback</i> ' . __('Feedback'),
                        [
                            'controller' => 'AnswerFeedbacks',
                            'action' => 'index',
                        ], ['escape' => false,]) ?>
                </li>

                <li class="nav-divider"></li>

                <li class="dropdown">
                    <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="material-icons">account_circle</i> <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <?= $this->Html->link(
                                '<i class="material-icons">domain</i> ' . __('Organizations'),
                                [
                                    'plugin' => null,
                                    'controller' => 'Organizations',
                                    'action' => 'picker',
                                ], ['escape' => false,]) ?>
                        </li>

                        <li>
                            <?= $this->Html->link(
                                '<i class="material-icons">settings</i> ' . __('Settings'),
                                [
                                    'plugin' => false,
                                    'controller' => 'Users',
                                    'action' => 'edit',
                                ], ['escape' => false,]) ?>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <?= $this->Html->link(
                                '<i class="material-icons">directions_run</i> ' . __('Log out'),
                                [
                                    'plugin' => null,
                                    'controller' => 'Users',
                                    'action' => 'logout',
                                ], ['escape' => false]) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
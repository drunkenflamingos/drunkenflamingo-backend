<?php
/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

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

            <?= $this->Html->link(
                $this->cell('User.ShowOrganization') . ' <b class="caret"></b>',
                [
                    'plugin' => 'User',
                    'controller' => 'Organizations',
                    'action' => 'picker',
                ], [
                'class' => 'navbar-brand',
                'escape' => false,
            ]) ?>

        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?= $this->fetch('tb_actions') ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-divider"></li>
                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">show_chart</i> ' . __('Dashboard'),
                        [
                            'controller' => 'Dashboard',
                            'action' => 'index',
                        ], ['escape' => false,]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">save</i> ' . __('Agreements'),
                        [
                            'controller' => 'Agreements',
                            'action' => 'index',
                        ], ['escape' => false]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">layers</i> ' . __('Invoices'),
                        [
                            'controller' => 'Invoices',
                            'action' => 'index',
                        ], ['escape' => false]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">shopping_basket</i> ' . __('Vouchers'),
                        [
                            'controller' => 'Vouchers',
                            'action' => 'index',
                        ], ['escape' => false]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">contacts</i> ' . __('Contacts'),
                        [
                            'controller' => 'Contacts',
                            'action' => 'index',
                        ], ['escape' => false,]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">account_balance_wallet</i> ' . __('Bank accounts'),
                        [
                            'plugin' => 'User',
                            'controller' => 'BankAccounts',
                            'action' => 'index',
                        ], ['escape' => false,]) ?>
                </li>

                <li>
                    <?= $this->Html->link(
                        '<i class="material-icons">swap_horiz</i> ' . __('Transactions'),
                        [
                            'plugin' => 'User',
                            'controller' => 'Transactions',
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
                                    'plugin' => 'User',
                                    'controller' => 'Organizations',
                                    'action' => 'index',
                                ], ['escape' => false,]) ?>
                        </li>

                        <li>
                            <?= $this->Html->link(
                                '<i class="material-icons">settings_input_composite</i> ' . __('Integrations'),
                                [
                                    'plugin' => 'User',
                                    'controller' => 'ErpIntegrations',
                                    'action' => 'index',
                                ], ['escape' => false,]) ?>
                        </li>

                        <li>
                            <?= $this->Html->link(
                                '<i class="material-icons">account_balance</i> ' . __('Banks'),
                                [
                                    'plugin' => 'User',
                                    'controller' => 'Banks',
                                    'action' => 'index',
                                ], ['escape' => false,]) ?>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <?= $this->Form->postLink(
                                '<i class="material-icons">loop</i> ' . __('Delete demo-data'),
                                [
                                    'plugin' => 'User',
                                    'controller' => 'BankAccounts',
                                    'action' => 'deleteDemoData',
                                ], [
                                'escape' => false,
                                'confirm' => __('Er du sikker på du vil slette ALT?'),
                            ]) ?>
                        </li>

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
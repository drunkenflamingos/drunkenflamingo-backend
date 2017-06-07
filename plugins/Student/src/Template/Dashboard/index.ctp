<?php
declare(strict_types=1);
/**
 * @var \Cake\View\View $this
 */
use Cake\I18n\Number;

$this->extend('Layout/dashboard');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="text-center">
            <?= $this->Html->image($gravatarUrl, [
                'class' => 'img-circle',
                'style' => 'width:240px',
            ]) ?>
        </div>

        <h1 class="text-center"><?= __('Welcome, {0}',
                [$this->request->session()->read('Auth.User.name')]) ?></h1>

        <p class="lead text-center">
            <?php if ($streak > 5): ?>
                <?= __("Awesome! You're on a streak with {0} days in a row!", [$streak]); ?>
            <?php else: ?>
                <?= __("You're on the right direction! This is your {0} day in a streak!", [
                    Number::ordinal($streak, ['locale' => $language->iso_code]),
                ]); ?>
            <?php endif; ?>
        </p>
    </div>
</div>

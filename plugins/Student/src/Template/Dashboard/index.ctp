<?php
declare(strict_types=1);
/**
 * @var \Cake\View\View $this
 */
$this->extend('Layout/dashboard');
?>

<div class="container">
    <div class="row profile">
        <div class="col-lg-12">
            <div class="profile-sidebar">

                <div class="text-center">
                    <?= $this->Html->image($gravatarUrl, [
                        'class' => 'img-circle',
                    ]) ?>
                </div>

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?= __('Velkommen, {0}', [$this->request->session()->read('Auth.User.name')]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

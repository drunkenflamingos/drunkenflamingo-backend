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

                <div class="profile-userpic" align="center">
                    TODO: Users Google image here
                </div>

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?= $this->request->session()->read('Auth.User.name') ?>
                    </div>
                    <div class="profile-usertitle-job">
                        Klasse: (TODO)
                    </div>
                </div>

                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-success btn-sm">Badges</button>
                    <button type="button" class="btn btn-success btn-sm">Streaks</button>
                </div>

            </div>
        </div>

    </div>
</div>
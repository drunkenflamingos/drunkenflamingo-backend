<?php
declare(strict_types=1);
/* @var $this \Cake\View\View */
$this->extend('Layout/dashboard');
?>

<?php $this->start('content_header'); ?>
<h1><?= h($user->name); ?></h1>
<?php $this->end(); ?>

<div class="container-fluid">
    <div class="main">
        <div class="row">
            <div class="col-xs-12 col-md-offset-1 col-md-10">
                <h1>Statistics</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-offset-1 col-md-10">
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tasks done</th>
                            <th>Tasks with error</th>
                            <th>Tasks skipped</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>assignment 1</td>
                            <td>assignment 2</td>
                            <td>assignment 3</td>
                        </tr>
                        <tr>
                            <td>assignment 4</td>
                            <td>assignment 5</td>
                            <td>assignment 6</td>
                        </tr>
                    </tbody>
                </table>

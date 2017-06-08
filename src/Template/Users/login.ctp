<?php
declare(strict_types=1);

/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$this->extend('/Layout/dashboard');

$preferredBrowserLang = $this->request->acceptLanguage()[0];

$hasFacebook = !empty(Configure::read('Muffin/OAuth2.providers.facebook.options.clientSecret'));
$hasGoogle = !empty('Muffin/OAuth2.providers.google.options.clientSecret');


?>

<?php $this->start('script'); ?>
<?= $this->fetch('script') ?>
<script src='https://www.google.com/recaptcha/api.js?hl=<?= $preferredBrowserLang ?>'></script>
<?php $this->end(); ?>

<div class="col-xs-12 col-md-8 col-md-offset-2">
    <div class="well well-lg">
        <?= $this->Form->create(null, [
            'type' => 'POST',
        ]); ?>
        <fieldset>
            <legend class="text-center">
                <?= __('Welcome back!'); ?>
            </legend>

            <div>
                <?= $this->Form->control('email', [
                    'placeholder' => __('Enter email...'),
                    'label' => false,
                ]); ?>

                <?= $this->Form->control('password', [
                    'placeholder' => __('Enter password...'),
                    'label' => false,
                ]); ?>

                <div class="g-recaptcha" data-sitekey="<?= Configure::read('Recaptcha.publickey') ?>"></div>

                <?= $this->Form->button(__('Login'), [
                    'class' => 'btn btn-lg btn-block btn-primary btn-raised',
                ]); ?>

                <?= $this->Html->Link(__('Register new user'), [
                    'action' => 'register',
                ], [
                    'class' => 'btn btn-lg btn-default btn-block btn-raised',
                ]); ?>
            </div>
        </fieldset>
        <?= $this->Form->end(); ?>

        <div>
            <hr>

            <h4 class="text-center"><?= __('Or...'); ?></h4>

            <?php if ($hasGoogle): ?>
                <?= $this->Form->postLink(
                    __('Login with Google'), [
                    'action' => 'oauthGoogle',
                    '?' => [
                        'redirect' => $this->request->getQuery('redirect'),
                    ],
                ], [
                    'class' => 'btn btn-lg btn-block btn-default btn-raised',
                ]); ?>
            <?php endif; ?>

            <?php if ($hasFacebook): ?>
                <?= $this->Form->postLink(
                    __('Login with Facebook'), [
                    'action' => 'oauthFacebook',
                    '?' => [
                        'redirect' => $this->request->getQuery('redirect'),
                    ],
                ], [
                    'class' => 'btn btn-lg btn-block btn-default btn-raised',
                ]); ?>
            <?php endif; ?>

            <?= $this->Html->link(__('Forgot pasword'), [
                'controller' => 'ResetPasswords',
                'action' => 'forgotPassword',
            ], [
                'class' => 'btn btn-lg btn-block btn-default btn-raised',
            ]) ?>
        </div>
    </div>
</div>

<?php
/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$this->extend('/Layout/dashboard');

$this->prepend('meta',
    $this->Html->meta('google-signin-client_id', Configure::read('Google.auth.client.id')));
?>

<?php $this->start('script'); ?>
<?= $this->fetch('script') ?>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<script src='https://www.google.com/recaptcha/api.js?hl=<?= $preferredBrowserLang ?>'></script>

<script>
    function onSuccess(googleUser) {
        var id_token = googleUser.getAuthResponse().id_token;

        $('#google_oauth2_token').val(id_token);
        $('#googleOauthForm').submit();
    }

    function onFailure(error) {
        console.log(error);
    }

    function renderButton() {
        gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 240,
            'height': 50,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
    }
</script>
<?php $this->end(); ?>

<div id="my-signin2"></div>

<div class="hidden">
    <?= $this->Form->create(null, [
        'type' => 'POST',
        'id' => 'googleOauthForm',
//        'url' => 'oauth/google',
    ]); ?>

    <?= $this->Form->control('code', [
        'id' => 'google_oauth2_token',
        'type' => 'hidden',
    ]); ?>

    <?= $this->Form->end(); ?>
</div>

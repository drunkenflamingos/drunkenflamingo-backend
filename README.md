# Drunkenflamingo

## Installation

1. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar install`.

If Composer is installed globally, run
```bash
composer install
```

You should now be able to visit the path to where you installed the app and see the default home page.

### Configuration

By default, this skeleton will use [josegonzalez/php-dotenv](https://github.com/josegonzalez/php-dotenv) to load configuration from the following files:

- `config/app.php`
- `config/.env`
    - if this file does not exist, `config/.env.default`

For "global" configuration that does not change between environments, you should modify `config/app.php`. As this file is ignored by default, you should *also* endeavor to add sane defaults to `app.default.php`.

For configuration that varies between environments, you should modify the `config/.env` file. This file is a bash-compatible file that contains `export KEY_1=VALUE` statements. Underscores in keys are used to expand the key into a nested array, similar to how `\Cake\Utility\Hash::expand()` works.

As a convenience, certain variables are remapped automatically by the `config/env.php` file. You may add other paths at your leisure to this file.

### Asset Compression

The [markstory/asset_compress](https://github.com/markstory/asset_compress) plugin is installed and enabled by default. It is used by the CrudView plugin, but does not currently have an integration with the default layout.

### Crud Defaults

By default, the [crud](https://github.com/friendsofcake/crud) plugin has been enabled with all known customizations. Simply creating a controller will enable all CRUD-actions in the default RESTful api mode.

#### Crud View Defaults

[Crud View](https://github.com/friendsofcake/crud-view) is installed - you may turn it on automatically for a controller by setting the controller's `$isAdmin` property to `true`.

Note that the `scaffold.brand` is set to the constant `APP_NAME`, which can be modified in your `config/.env.default` or `config/.env` files.

### Customizing Bake

There now exists a `config/bake_cli.php`. This file should contain all bake-related event handlers. It is used to speed up the re-bake process such that we don't need to go in and re-add customizations.

As an example, the following event handler will add the `Josegonzalez/Upload.Upload` plugin to the `Users.photo` field:

```php
EventManager::instance()->on('Bake.beforeRender.Model.table', function (Event $event) {
    $view = $event->subject();
    $name = Hash::get($view->viewVars, 'name', null);
    if ($name == 'Users') {
        $behaviors = Hash::normalize(Hash::get($view->viewVars, 'behaviors', []));
        $behaviors['Josegonzalez/Upload.Upload'] = ['photo' => []];
        $view->set('behaviors', $behaviors);
    }
});
```

Please refer to the [bake documentation](http://book.cakephp.org/3.0/en/bake/development.html) for more details.

### Error Handling

Custom error handlers that ship errors to external error tracking services are set via the [josegonzalez/php-error-handers](https://github.com/josegonzalez/php-error-handlers) package. To configure one, you can add the following key configuration to your `config/app.php`:

```php
[
    'Error' => [
        'config' => [
            'handlers' => [
                // configuring the BugsnagHandler via an env var
                'BugsnagHandler' => [
                    'apiKey' => env('BUGSNAG_APIKEY', null)
                ],
            ],
        ],
    ],
];
```

Then simply set the proper environment variable in your `config/.env` or in your platform's configuration management tool.

### Heroku Support

Heroku and other PaaS-software are supported by default. If deploying to Heroku, simply run the following and - assuming you have the proper remote configuration - everything should work as normal:

```shell
git push heroku master
```

Migrations for the core application will run by default. If you wish to run migrations for plugins, you will need to modify the key `scripts.compile` in your `composer.json`.

### Queuing

Queuing support is provided through the [Queuesadilla](https://github.com/josegonzalez/php-queuesadilla) php package, with a [CakePHP plugin](https://github.com/josegonzalez/cakephp-queuesadilla) providing integration.

You can start a queue off the `jobs` mysql table:

```shell
# ensure everything is migrated and the jobs table exists
bin/cake migrations migrate

# default queue
bin/cake queuesadilla

# also the default queue
bin/cake queuesadilla --queue default

# some other queue
bin/cake queuesadilla --queue some-other-default

# use a different engine
bin/cake queuesadilla --engine redis
```

You can customize the engine configuration under the `Queuesadilla.engine` array in `config/app.php`. At the moment, it defaults to a config compatible with your application's mysql database config.

Need to queue something up?

```php
// assuming mysql engine
use josegonzalez\Queuesadilla\Engine\MysqlEngine;
use josegonzalez\Queuesadilla\Queue;

// get the engine config:
$config = Configure::read('Queuesadilla.engine');

// instantiate the things
$engine = new MysqlEngine($config);
$queue = new Queue($engine);

// a function in the global scope
function some_job($job)
{
    var_dump($job->data());
}
$queue->push('some_job', [
    'id' => 7,
    'message' => 'hi'
]);
```

See [here](https://github.com/josegonzalez/php-queuesadilla/blob/master/docs/defining-jobs.md) for more information on defining jobs.

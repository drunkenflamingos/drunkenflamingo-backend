<?php
declare(strict_types=1);

namespace Admin\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use CrudView\Menu\MenuDivider;
use CrudView\Menu\MenuItem;

class AppController extends BaseController
{
    public $isAdmin = true;

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $action = $this->Crud->action();
        $action->setConfig('scaffold.site_title', 'Wordy admin');
        $action->setConfig('scaffold.sidebar_navigation', $this->crudSideBar());
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
    }

    public function isAuthorized(array $user): bool
    {
        return array_key_exists('is_root', $user) && $user['is_root'] === true;
    }

    protected function crudSideBar()
    {
        return [
            new MenuItem(
                __('Organizations'),
                ['controller' => 'Organizations', 'action' => 'index']
            ),
            new MenuDivider(),
            new MenuItem(
                __('Currencies'),
                ['controller' => 'Currencies', 'action' => 'index']
            ),
            new MenuItem(
                __('Languages'),
                ['controller' => 'Languages', 'action' => 'index']
            ),
            new MenuItem(
                __('Roles'),
                ['controller' => 'Roles', 'action' => 'index']
            ),
            new MenuItem(
                __('Word classes'),
                ['controller' => 'WordClasses', 'action' => 'index']
            ),
            new MenuDivider(),
            new MenuItem(
                'Log Out',
                ['controller' => 'Users', 'action' => 'logout']
            ),
        ];
    }
}

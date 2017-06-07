<?php
declare(strict_types=1);
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Datasource\Exception\MissingModelException;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Crud\Controller\ControllerTrait;
use Muffin\Footprint\Auth\FootprintAwareTrait;
use UnexpectedValueException;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 * @property \Crud\Controller\Component\CrudComponent $Crud
 */
class AppController extends Controller
{
    use ControllerTrait;
    use FootprintAwareTrait;

    /**
     * Whether or not to treat a controller as
     * if it were an admin controller or not.
     *
     * Used to turn CrudView on and off at a class-level
     *
     * @var bool
     */
    protected $isAdmin = false;

    /**
     * A list of actions where the CrudView.View
     * listener should be enabled. If an action is
     * in this list but `isAdmin` is false, the
     * action will still be rendered via CrudView.View
     *
     * @var array
     */
    protected $adminActions = [];

    /**
     * A list of actions where the Crud.SearchListener
     * and Search.PrgComponent should be enabled
     *
     * @var array
     */
    protected $searchActions = ['index', 'lookup'];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Users',
                    'fields' => ['username' => 'email', 'password' => 'password'],
                ],
                'Muffin/OAuth2.OAuth' => [
                    'userModel' => 'Users',
                    'fields' => ['username' => 'email', 'password' => 'password'],
                ],
            ],
            'authorize' => 'Controller',
            'loginAction' => [
                'prefix' => false,
                'plugin' => null,
                'controller' => 'Login',
                'action' => 'index',
            ],
            'logoutRedirect' => [
                'prefix' => false,
                'plugin' => null,
                'controller' => 'Login',
                'action' => 'index',
            ],
            'loginRedirect' => [
                'prefix' => false,
                'plugin' => null,
                'controller' => 'Organizations',
                'action' => 'picker',
            ],
            'unauthorizedRedirect' => [
                'prefix' => false,
                'plugin' => null,
                'controller' => 'Organizations',
                'action' => 'picker',
            ],
            'authError' => __('Du skal logge ind for at se denne side'),
            'storage' => 'Session',
            'checkAuthIn' => 'Controller.initialize',
        ]);

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'index' => [
                    'className' => 'Crud.Index',
                    'messages' => [
                        'success' => [
                            'params' => ['class' => 'alert alert-success alert-dismissible'],
                        ],
                        'error' => [
                            'params' => ['class' => 'alert alert-danger alert-dismissible'],
                        ],
                    ],
                ],
                'add' => [
                    'className' => 'Crud.Add',
                    'messages' => [
                        'success' => [
                            'params' => ['class' => 'alert alert-success alert-dismissible'],
                        ],
                        'error' => [
                            'params' => ['class' => 'alert alert-danger alert-dismissible'],
                        ],
                    ],
                ],
                'edit' => [
                    'className' => 'Crud.Edit',
                    'messages' => [
                        'success' => [
                            'params' => ['class' => 'alert alert-success alert-dismissible'],
                        ],
                        'error' => [
                            'params' => ['class' => 'alert alert-danger alert-dismissible'],
                        ],
                    ],
                ],
                'view' => [
                    'className' => 'Crud.View',
                    'messages' => [
                        'success' => [
                            'params' => ['class' => 'alert alert-success alert-dismissible'],
                        ],
                        'error' => [
                            'params' => ['class' => 'alert alert-danger alert-dismissible'],
                        ],
                    ],
                ],
                'delete' => [
                    'className' => 'Crud.Delete',
                    'messages' => [
                        'success' => [
                            'params' => ['class' => 'alert alert-success alert-dismissible'],
                        ],
                        'error' => [
                            'params' => ['class' => 'alert alert-danger alert-dismissible'],
                        ],
                    ],
                ],
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog',
                'Crud.RelatedModels',
                'Crud.Redirect',
            ],
        ]);

        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->loadComponent('Csrf');

        if (!Configure::read('debug')) {
            $this->Security->requireSecure();
        }

        if ($this->isAdmin || in_array($this->request->action, $this->adminActions)) {
            $this->Crud->addListener('CrudView.View');
        }

        if (in_array($this->request->action, $this->searchActions) && $this->modelClass !== null) {
            list($plugin, $tableClass) = pluginSplit($this->modelClass);
            try {
                if ($this->$tableClass->behaviors()->hasMethod('filterParams')) {
                    $this->Crud->addListener('Crud.Search');
                    $this->loadComponent('Search.Prg', [
                        'actions' => $this->searchActions,
                    ]);
                }
            } catch (MissingModelException $e) {
            } catch (UnexpectedValueException $e) {
            }
        }
    }

    /**
     * Before filter callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     * @throws \Cake\Core\Exception\Exception
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($this->Crud->isActionMapped()) {
            $this->Crud->action()->setConfig('scaffold.brand', Configure::read('App.name'));
        }

        $this->loadModel('Languages');
        $this->loadModel('Users');

        if (!empty($this->Auth->user('id'))) {
            $user = $this->Users->get($this->Auth->user('id'));

            $gravatarUrl = $user->getGravatarImageUrl();

            $this->set(compact('gravatarUrl'));

            $language = $this->Languages->get($user->language_id);
        } else {
            $language = $this->Languages->find()->where(['Languages.iso_code' => 'en-US'])->firstOrFail();
        }

        I18n::locale($language->iso_code);

        $isRest = in_array($this->response->type(), ['application/json', 'application/xml'], true);
        $isAdmin = $this->isAdmin || in_array($this->request->action, $this->adminActions);

        if (!$isRest && $isAdmin) {
            $this->viewBuilder()->setClassName('CrudView\View\CrudView');
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $isRest = in_array($this->response->type(), ['application/json', 'application/xml']);

        if (!array_key_exists('_serialize', $this->viewVars) && $isRest) {
            $this->set('_serialize', true);
        }
    }


    /**
     * Forces usage of SSL on all of the system.
     *
     * @param $type
     * @return \Cake\Http\Response|null
     */
    public function forceSSL($type)
    {
        if ($type === 'secure') {
            return $this->redirect('https://' . env('SERVER_NAME') . $this->request->getUri()->getPath());
        }
    }

    public function isAuthorized(array $user): bool
    {
        return true;
    }
}

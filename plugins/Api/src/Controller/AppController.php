<?php

namespace Api\Controller;

use Cake\Controller\Controller as BaseController;
use Cake\Core\Configure;
use Cake\Datasource\Exception\MissingModelException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Crud\Controller\Component\CrudComponent;
use Crud\Controller\ControllerTrait;
use Muffin\Footprint\Auth\FootprintAwareTrait;
use UnexpectedValueException;

/**
 * @property CrudComponent $Crud
 */
class AppController extends BaseController
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

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            'authenticate' => [
                'ADmad/JwtAuth.Jwt' => [
                    'userModel' => 'Users',
                    'scope' => ['Users.is_activated' => 1],
                    'fields' => [
                        'username' => 'id',
                    ],
                    'parameter' => 'token',
                    // Boolean indicating whether the "sub" claim of JWT payload
                    'queryDatasource' => true,
                ],
                'Form' => [
                    'scope' => ['Users.is_activated' => 1],
                ],
            ],
            'authorize' => 'Controller',
            'authError' => __('This page requires authentication'),
            'loginAction' => false,
            'unauthorizedRedirect' => false,
            'storage' => 'Memory',
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
                'CrudJsonApi.JsonApi',
                'Crud.RelatedModels',
                'Crud.Redirect',
            ],
        ]);

        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);

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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);

//        TODO
//        $this->loadModel('Languages');
//
//        if (!empty($this->Auth->user('language_id'))) {
//            $language = $this->Languages->get($this->Auth->user('language_id'));
//        } else {
//            $language = $this->Languages->find()->where(['Languages.short_code' => 'en_US'])->firstOrFail();
//        }
//
//        I18n::locale($language->short_code);

        //Enable someurl?include=companies,languages$
        if ($this->request->getQuery('include') !== null) {
            $includeParams = explode(',', $this->request->getQuery('include'));

            foreach ($includeParams as $param) {
                $param = Inflector::camelize($param);
                $this->paginate['contain'][] = $param;
            }

            //Enable for view also
            $this->Crud->on('beforeFind', function (Event $event) {
                foreach ($this->paginate['contain'] as $param) {
                    $event->getSubject()->query->contain($param);
                }
            });
        }

        $this->Crud->on('afterPaginate', function (Event $event) {
            foreach ($event->getSubject()->entities as $entity) {
                unset($entity->_matchingData);
            }
        });

        $this->Crud->on('afterFind', function (Event $event) {
            unset($event->getSubject()->entity->_matchingData);
        });
    }

    public function isAuthorized(array $user): bool
    {
        $organizationId = $user['active_organization_id'];
        $userId = $user['id'];

        try {
            $usersRole = TableRegistry::get('UsersRoles')->find()
                ->where([
                    'UsersRoles.user_id' => $userId,
                    'UsersRoles.organization_id' => $organizationId,
                ])
//                TODO
//                ->matching('Roles', function (Query $q) {
//                    return $q->where(['Roles.identifier' => 'student']);
//                })
                ->firstOrFail();
        } catch (RecordNotFoundException $e) {
            return false;
        }

        return $usersRole !== null;
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        if (!array_key_exists('_serialize', $this->viewVars)) {
            $this->set('_serialize', true);
        }

        //Default
        if ($this->viewBuilder()->getClassName() === null) {
            $this->viewBuilder()->setClassName('Json');
        }
    }
}

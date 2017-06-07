<?php
declare(strict_types=1);

namespace Student\Controller;

use Cake\Event\Event;
use Cake\I18n\Date;

/**
 * Dashboard Controller
 * @property \App\Model\Table\LoginAttemptsTable $LoginAttempts
 */
class DashboardController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->Crud->disable(['index', 'add', 'edit', 'view', 'delete']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('LoginAttempts');
    }

    public function index()
    {
        $user = $this->LoginAttempts->Users->get($this->Auth->user('id'), ['contain' => ['Languages']]);
        $language = $user->language;

        $streak = 0;

        $loginAttempts = $this->LoginAttempts->find();
        $loginAttempts
            ->select(['date' => 'DATE(LoginAttempts.created)'], ['date' => 'date'])
            ->where([
                'LoginAttempts.success' => true,
                'LoginAttempts.user_id' => $this->Auth->user('id'),
            ])
            ->group('date')
            ->order(['date' => 'DESC']);

        $currentDate = Date::now();

        if (!$loginAttempts->isEmpty()) {

            $loginAttempts = $loginAttempts->toArray();
            $latestLogin = new Date($loginAttempts[0]->date);

            $streak = 1;

            if ($latestLogin->isSameDay($latestLogin)) {
                $earlierLogin = null;
                $currentLogin = null;

                $amountOfLogins = count($loginAttempts);

                $continue = true;
                $counter = 1;

                while ($continue && $counter < $amountOfLogins) {
                    $currentLogin = new Date($loginAttempts[$counter]->date);
                    $earlierLogin = new Date($loginAttempts[$counter - 1]->date);

                    if ($currentLogin->diffInDays($earlierLogin) === 1) {
                        $streak++;
                    } else {
                        $continue = false;
                    }


                    $counter++;
                }
            }
        }

        $this->set(compact('streak','language'));
    }
}

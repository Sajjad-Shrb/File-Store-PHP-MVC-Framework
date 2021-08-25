<?php

namespace app\utils\middlewares;

use app\app\models\User;
use app\core\Application;

class AuthMiddleware
{
    protected string $action;

    protected array $admin_actions = [
        'index',
        'showAdminDashboardPage',
        'showManageUsersPage',
        'updateUsers',
        'showSettingPage',
        'config',
        'showFilesPage',
        'verifyFiles',
        'deleteFiles',
        'showUserDashboardPage',
        'showProfilePage',
        'editProfile',
        'showFilesPage',
        'logout'
    ];

    protected array $verifier_actions = [
        'index',
        'showAdminDashboardPage',
        'showFilesPage',
        'verifyFiles',
        'deleteFiles',
        'showUserDashboardPage',
        'showProfilePage',
        'editProfile',
        'showFilesPage',
        'showRegisterForm',
        'register',
        'showLoginForm',
        'login',
        'logout'
    ];

    protected array $user_actions = [
        'index',
        'showUserDashboardPage',
        'showProfilePage',
        'editProfile',
        'showFilesPage',
        'showRegisterForm',
        'register',
        'showLoginForm',
        'login',
        'logout'
    ];

    protected array $guest_actions = [
        'index',
        'showRegisterForm',
        'register',
        'showLoginForm',
        'login',
    ];

    public function __construct($action) {
        $this->action = $action;
    }

    public function execute()
    {
        $user = new User();
        $is_login = $user->is_login();
        $type = $this->getSession('type');

        if($is_login) {
            if($type == 2) {
                if(
                    !in_array($this->action, $this->verifier_actions)
                )
                throw new \Exception('Dear Verifier, You don\'t have permission to access this page', 403);
            }

            elseif($type == 3) {
                if(
                    !in_array($this->action, $this->user_actions)
                )
                throw new \Exception('Dear User, You don\'t have permission to access this page. <br> Just admins and verifiers can see this page', 403);
            }
        }

        else {
            if(
                !in_array($this->action, $this->guest_actions)
            )
            throw new \Exception('Dear Guest, You don\'t have permission to access this page. <br> You must <a href = "register">register</a> or <a href = "login">login</a>', 403);
        }
    }

    public function getSession($key)
    {
        return Application::$app->session->get($key);
    }
}
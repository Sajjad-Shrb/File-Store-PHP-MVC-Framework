<?php

namespace app\app\controllers;

use app\app\models\File;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\app\models\User;

class   UserController extends Controller
{
    public ?array $requests;

    public function index(Request $request)
    {
        $this->requests = $request->getBody();

        if (
            (($this->path == '/user/register') ||
                ($this->path == '/register')) &&
            ($this->method == 'get')
        )
            $this->action = 'showRegisterForm';

        elseif (
            (($this->path == '/user/register') ||
                ($this->path == '/register')) &&
            ($this->method == 'post')
        )
            $this->action = 'register';

        elseif (
            (($this->path == '/user/login') ||
                ($this->path == '/login')) &&
            ($this->method == 'get')
        )
            $this->action = 'showLoginForm';

        elseif (
            (($this->path == '/user/login') ||
                ($this->path == '/login')) &&
            ($this->method == 'post')
        )
            $this->action = 'login';

        elseif (
            (($this->path == '/user/logout') ||
                ($this->path == '/logout')) &&
            ($this->method == 'get')
        )
            $this->action = 'logout';

        elseif (
            (($this->path == '/user') ||
                ($this->path == '/user/dashboard')) &&
            ($this->method == 'get')
        )
            $this->action = 'showUserDashboardPage';

        elseif ((($this->path == '/user/profile') && ($this->method == 'get')))
            $this->action = 'showProfilePage';

        elseif ((($this->path == '/user/profile') && ($this->method == 'post')))
            $this->action = 'editProfile';

        elseif ((($this->path == '/user/files') && ($this->method == 'get')))
            $this->action = 'showFilesPage';

        elseif ((($this->path == '/user/trades') && ($this->method == 'get')))
            $this->action = 'showTradesPage';

        elseif (
            preg_match("/(\/user\/)\w+/", $this->path)
        ) {
            $this->input = substr($this->path, strrpos($this->path, '/') + 1);

            $this->action = 'showPublicUserProfile';
        }

        return call_user_func([__CLASS__, $this->action], $this->path);
    }

    public function showRegisterForm()
    {
        if ($this->is_login()) {
            $this->redirect('/');
            return;
        }

        return $this->render('register');
    }

    public function register()
    {
        $data = $this->requests;

        $data['type'] = 3;

        $user = new User();
        $user->loadData($data);

        if ($user->insert()) {
            $this->setSession('id', $user->lastInsertID());
            $this->setSession('username', $data['username']);
            $this->setSession('name', $data['name']);
            $this->setSession('email', $data['email']);
            $this->setSession('num_files', $data['num_files']);
            $this->setSession('type', $data['type']);
            $this->setSession('credit', $data['credit']);

            $this->redirect('/');
        }
    }

    public function showLoginForm()
    {
        if ($this->is_login()) {
            $this->redirect('/');
            return;
        }

        return $this->render('login');
    }

    public function login()
    {
        $data = $this->requests;
        $data['password'] = sha1($data['password']);

        $user = new User();
        $user->loadData($data);

        if ($data = $user->findOne($data)) {
            $this->setSession('id', $data[0]['id']);
            $this->setSession('username', $data[0]['username']);
            $this->setSession('name', $data[0]['name']);
            $this->setSession('email', $data[0]['email']);
            $this->setSession('num_files', $data[0]['num_files']);
            $this->setSession('type', $data[0]['type']);
            $this->setSession('credit', $data[0]['credit']);

            $this->redirect('/');

            return 'Login successfully';
        } else {
            return $this->render("login", ["message" => "Login Failed!"]);
        }
    }

    public function logout()
    {
        Application::$app->session->destroy();
        $this->redirect('/');
    }

    public function is_login()
    {
        return Application::$app->user->is_login();
    }

    public function provideUserProfileRoutes()
    {
        $user = new User;

        $users = $user->findAllbyUsername();

        for ($i = 0; $i < $user->count(); $i++) {
            $username = $users[$i]['username'];
            $username = strtolower($username);
            Application::$app->router->routing("/user/$username", self::class);
        }
    }

    public function showPublicUserProfile($username)
    {
        $user = new User;
        $where = [
            'username' => substr($username, strrpos($username, '/') + 1)
        ];
        $user = $user->findOne($where);

        $params = [
            'user' => $user[0]
        ];

        return $this->render("public-profile", $params);
    }

    public function showUserDashboardPage()
    {
        $this->setLayout('user');

        $params = [
            'id' => $this->getSession('id'),
            'username' => $this->getSession('username'),
            'name' => $this->getSession('name'),
            'email' => $this->getSession('email'),
            'num_files' => $this->getSession('num_files'),
            'type' => $this->getSession('type'),
            'credit' => $this->getSession('credit'),
        ];

        return $this->render('user/dashboard', $params);
    }

    public function showProfilePage()
    {
        $this->setLayout('user');

        $username = Application::$app->session->get('username');


        $user = (new User)->findOne([
            'username' => $username
        ]);

        $params = [
            'user' => $user[0]
        ];
        return $this->render('user/profile', $params);
    }

    public function editProfile()
    {
        $this->setLayout('user');

        $data = $this->requests;

        $data['password'] = sha1($data['password']);

        $previousUsername = Application::$app->session->get('username');

        $where = [
            'username' => $previousUsername
        ];

        $user = new User();

        $user->update($data, $where);
        Application::$app->session->set('name', $data['name']);
        Application::$app->session->set('username', $data['username']);
        Application::$app->session->set('email', $data['email']);
        Application::$app->session->set('password', $data['password']);

        return $this->showProfilePage();
    }

    public function showFilesPage()
    {
        $this->setLayout('user');

        $current_user = $this->getSession('username');

        $file = new File;
        $file = $file->findOne([
            'username' => $current_user
        ]);

        $params = [
            'file' => $file,
            'file_count' => count($file)
        ];

        return $this->render('user/files', $params);
    }
}

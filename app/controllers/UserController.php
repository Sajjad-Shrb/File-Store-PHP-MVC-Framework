<?php

namespace app\app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\app\models\User;

class UserController extends Controller
{
    public ?array $requests;

    public function index(Request $request)
    {
        $this->requests = $request->getBody();

        if ($this->path == '/user/register' && $this->method == 'get')
            $this->action = 'showRegisterForm';
        elseif ($this->path == '/user/register' && $this->method == 'post')
            $this->action = 'register';
        elseif ($this->path == '/user/login' && $this->method == 'get')
            $this->action = 'showLoginForm';
        elseif ($this->path == '/user/login' && $this->method == 'post')
            $this->action = 'login';
        elseif ($this->path == '/user/logout' && $this->method == 'get')
            $this->action = 'logout';

        return call_user_func([__CLASS__, $this->action]);
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
            Application::$app->session->set('id', $user->lastInsertID());
            Application::$app->session->set('username', $data['username']);
            Application::$app->session->set('name', $data['name']);
            Application::$app->session->set('email', $data['email']);

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
            Application::$app->session->set('id', $data['id']);
            Application::$app->session->set('username', $data['username']);
            Application::$app->session->set('name', $data['name']);
            Application::$app->session->set('email', $data['email']);

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
}
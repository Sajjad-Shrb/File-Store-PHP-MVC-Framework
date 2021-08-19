<?php

namespace app\app\controllers;

use app\app\models\User;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\utils\middlewares\AuthMiddleware;

class AuthController extends Controller
{
    public function __construct($action)
    {
        $this->action = $action;

        $this->registerMiddleware(new AuthMiddleware($this->action));
    }

    public function showRegisterForm()
    {
        if ($this->is_login()) {
            $this->redirect('/');
            return;
        }

        return $this->render('register');
    }

    public function register(Request $request)
    {
        $data = $request->getBody();

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

    public function login(Request $request)
    {
        $data = $request->getBody();
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
}

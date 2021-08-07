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

        if ($this->path == '/register' && $this->method == 'get')
            $this->action = 'showRegisterForm';
        elseif ($this->path == '/register' && $this->method == 'post')
            $this->action = 'register';
        elseif ($this->path == '/login' && $this->method == 'get')
            $this->action = 'showLoginForm';
        elseif ($this->path == '/login' && $this->method == 'post')
            $this->action = 'login';
        elseif ($this->path == '/logout' && $this->method == 'get')
            $this->action = 'logout';

        return call_user_func([__CLASS__, $this->action]);
    }

    public function showRegisterForm()
    {
        if($id = Application::$app->session->get('id')){
            Application::$app->response->redirect('/');
            return;
        }

        return $this->render('register');
    }

    public function register()
    {
        $data = $this->requests;

        $user = new User();
        $user->loadData($data);

        if ($user->add()) {
            Application::$app->session->set('id', $user->lastInsertID());
            Application::$app->session->set('username', $data['username']);
            Application::$app->session->set('name', $data['name']);
            Application::$app->session->set('email', $data['email']);

            Application::$app->response->redirect('/');
        }
    }

    public function showLoginForm()
    {
        return $this->render('login');
    }

    public function login()
    {
        $data = $this->requests;

        // var_dump($data);
        // exit;

        $user = new User();
        $user->loadData($data);

        if ($data = $user->findOne($data)) {
            Application::$app->session->set('id', $data['id']);
            Application::$app->session->set('username', $data['username']);
            Application::$app->session->set('name', $data['name']);
            Application::$app->session->set('email', $data['email']);

            Application::$app->response->redirect('/');

            return 'Login successfully';

        } else {
            return $this->render("login", ["message" => "Login Failed!"]);
        }
    }

    public function logout()
    {
    }
}

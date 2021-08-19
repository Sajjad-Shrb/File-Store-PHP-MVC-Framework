<?php

namespace app\app\controllers;

use app\app\models\File;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\app\models\User;
use app\utils\middlewares\AuthMiddleware;

class UserController extends Controller
{
    public function __construct($action = '')
    {
        $this->action = $action;

        $this->registerMiddleware(new AuthMiddleware($this->action));
        $this->setLayout('user');
    }

    public function provideUserProfileRoutes()
    {
        $user = new User;

        $users = $user->selectUserName();

        for ($i = 0; $i < $user->count(); $i++) {
            $username = $users[$i]['username'];
            $username = strtolower($username);
            Application::$app->router->get("/user/$username", self::class);
        }
    }

    public function showPublicUserProfile($username)
    {
        $user = new User;
        $where = [
            'username' => substr($username, strrpos($username, '/') + 1)
        ];
        $user = $user->selectAllWhere($where);

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


        $user = (new User)->selectAllWhere([
            'username' => $username
        ]);

        $params = [
            'user' => $user[0]
        ];
        return $this->render('user/profile', $params);
    }

    public function editProfile(Request $request)
    {
        $this->setLayout('user');

        $data = $request->getBody();

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
        $file = $file->selectAllWhere([
            'username' => $current_user
        ]);

        $params = [
            'file' => $file,
            'file_count' => count($file)
        ];

        return $this->render('user/files', $params);
    }
}

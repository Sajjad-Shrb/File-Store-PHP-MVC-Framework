<?php 

namespace app\app\controllers;

use app\app\models\User;
use app\core\Controller;
use app\core\Request;

class AdminController extends Controller
{
    public ?array $requests;

    public function index(Request $request)
    {
        $this->setLayout('admin');

        $this->requests = $request->getBody();

        if ($this->path == '/admin' && $this->method == 'get')
            $this->action = 'showAdminDashboardPage';
        elseif ($this->path == '/admin' && $this->method == 'post')
            $this->action = 'admin';
        elseif ($this->path == '/admin/users' && $this->method == 'get')
            $this->action = 'showManageUsersPage';
        elseif ($this->path == '/admin/users' && $this->method == 'post')
            $this->action = 'update';
            
        return call_user_func([__CLASS__, $this->action]);
    }

    public function showAdminDashboardPage()
    {
        return $this->render('admin/dashboard');
    }

    public function showManageUsersPage()
    {       
        return $this->render('admin/users');
    }

    //Active, Deactive and ChangeAccessLevel
    public function update()
    {
        $data = $this->requests;

        var_dump($data);
        exit;
        $where = [
            'id' => intval($data['id'])
        ];
        unset($data['id']);

        $user = new User();

        return $user->update($data, $where);
    }
}
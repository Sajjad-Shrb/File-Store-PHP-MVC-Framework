<?php 

namespace app\app\controllers;

use app\app\models\User;
use app\app\models\Config;
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
        elseif ($this->path == '/admin/setting' && $this->method == 'get')
            $this->action = 'showSettingPage';
        elseif ($this->path == '/admin/setting' && $this->method == 'post')
            $this->action = 'config';
            
        return call_user_func([__CLASS__, $this->action]);
    }

    public function showAdminDashboardPage()
    {
        return $this->render('admin/dashboard');
    }

    public function showManageUsersPage()
    {       
        $user = new User;
        $params = [
            'user' => $user,
            'users' => $user->findAll(),
            'user_count' => $user->count()
        ];
        return $this->render('admin/users', $params);
    }

    //Active, Deactive and ChangeAccessLevel
    public function update()
    {
        $data = $this->requests;

        $where = [
            'id' => intval($data['id'])
        ];
        unset($data['id']);

        $user = new User();

        $user->update($data, $where);
        return $this->showManageUsersPage();
    }

    public function showSettingPage()
    {
        $config = new Config;
        $params = [
            'rows' => $config->findAll(),
            'rows_count' => $config->count()
        ];
        return $this->render('admin/setting', $params);
    }

    public function config()
    {
        /**
         * //TODO: Generate Invalid Data request (key_name == allowed_file_types)
         */
        $data = $this->requests; 

        $where = [
            'key_name' => "\"" . $data['key_name'] . "\""
        ];

        unset($data['key_name']);
        
        $data['value'] = json_encode($data['value']);

        $config = new Config();

        $config->update($data, $where);
        return $this->showSettingPage();
    }
}
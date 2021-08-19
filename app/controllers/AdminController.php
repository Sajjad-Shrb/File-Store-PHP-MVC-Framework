<?php 

namespace app\app\controllers;

use app\app\models\User;
use app\app\models\Config;
use app\app\models\File;
use app\core\Controller;
use app\core\Request;
use app\utils\middlewares\AuthMiddleware;

class AdminController extends Controller
{
    public function __construct($action)
    {
        $this->action = $action;

        $this->registerMiddleware(new AuthMiddleware($this->action));
        $this->setLayout('admin');
    }

    public function showAdminDashboardPage()
    {
        $this->setLayout('admin');
 
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

    //Active, Deactive and ChangeAccessLevel of Users
    public function updateUsers(Request $request)
    {
        $data = $request->getBody();

        $where = [
            'id' => intval($data['id'])
        ];
    
        unset($data['id']);
        unset($data['_method']);

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

    public function config(Request $request)
    {
        $data = $request->getBody();

        $where = [
            'key_name' => "\"" . $data['key_name'] . "\""
        ];

        unset($data['key_name']);
        unset($data['_method']);
        
        $data['value'] = json_encode($data['value']);

        $config = new Config();

        $config->update($data, $where);
        return $this->showSettingPage();
    }

    public function showFilesPage()
    {
        $file = new File;
        $params = [
            'file' => $file,
            'files' => $file->findAll(),
            'file_count' => $file->count()
        ];
        
        return $this->render('admin/files', $params);
    }

    //verify, unverify
    public function verifyFiles(Request $request)
    {
        $data = $request->getBody();

        $file = new File();
        $where = [
            'id' => intval($data['id'])
        ];
        
        unset($data['id']);

        unset($data['_method']);

        $file->update($data, $where);
        return $this->showFilesPage();
        
    }

    public function deleteFiles(Request $request)
    {
        $data = $request->getBody();

        $file = new File();
        $where = [
            'id' => intval($data['id'])
        ];
        
        unset($data['id']);
        
        unset($data['_method']);
        
        $file->delete($where);
        return $this->showFilesPage();
    }
}
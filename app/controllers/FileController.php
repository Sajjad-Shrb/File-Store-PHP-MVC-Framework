<?php 

namespace app\app\controllers;

use app\app\models\User;
use app\app\models\Config;
use app\app\models\File;
use app\core\Controller;
use app\core\Request;

class FileController extends Controller
{
    public ?array $requests;

    public function index(Request $request)
    {
        $this->setLayout('admin');

        $this->requests = $request->getBody();

        if ($this->path == '/admin/files' && $this->method == 'get')
            $this->action = 'showFilesPage';
        elseif ($this->path == '/admin/files' && $this->method == 'post')
            $this->action = 'verify';
            
        return call_user_func([__CLASS__, $this->action]);
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

    //verify, unverify and delete
    public function verify()
    {
        $data = $this->requests;

        $file = new File();
        $where = [
            'id' => intval($data['id'])
        ];
        
        unset($data['id']);

        //verify & unverify
        if($data['_method'] == 'put'){
            unset($data['_method']);

            $file->update($data, $where);
            return $this->showFilesPage();
        }
        
        //delete
        elseif($data['_method'] == 'delete'){
            unset($data['_method']);
            
            $file->delete($where);
            return $this->showFilesPage();
        }
    }

}
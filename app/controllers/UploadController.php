<?php

namespace app\app\controllers;

use app\app\models\File;
use app\app\models\User;
use app\core\Application;
use app\core\Controller;
use app\core\Database;
use app\core\Request;

class UploadController extends Controller
{
    public ?array $requests;

    public function index(Request $request)
    {
        $this->requests = $request->getBody();

        if ($this->path == '/upload' && $this->method == 'get')
            $this->action = 'showUploadPage';
        elseif ($this->path == '/upload' && $this->method == 'post')
            $this->action = 'upload';

        return call_user_func([__CLASS__, $this->action]);
    }
    
    public function showUploadPage()
    {
        return $this->render('upload');
    }

    public function addFileToServer(File $file)
    {
        if (!empty($_FILES['uploaded_file'])) {
            $username = Application::$app->session->get('username');
            $filename = $_FILES['uploaded_file']['name'];
            
            $tmpname = $_FILES['uploaded_file']['tmp_name'];
            $filetype = $_FILES['uploaded_file']['type'];
            $filesize = (($_FILES['uploaded_file']['size'])/1024)/1024;

            $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            $dirpath = "uploads/guests/";
    
            if ((new User)->is_login()) {
                $username = Application::$app->session->get('username');
                $dirpath = "uploads/$username/";
            }

            if(!is_dir($dirpath))
                mkdir($dirpath, 0777, true);
            
            $filepath = Application::$root_dir . '/public/' . $dirpath . $filename;

            $just_name = explode('.', $filename)[0];
            
            $i = 1;
            while(file_exists($filepath)) {
                $filepath = Application::$root_dir . '/public/' . $dirpath . $just_name . "_$i" . '.' . $file_extension;
                $i++;
            }

            $url = $_SERVER['HTTP_ORIGIN'] . '/'. $dirpath . $filename;

            if (move_uploaded_file($tmpname, $filepath)) {
                echo "The file " . $filename . " has been uploaded";
            } else {
                echo "There was an error uploading the file, please try again!";
            }

            $data = [
                'username' => $username,
                'name' => $filename,
                'type' => $filetype,
                'extension' => $file_extension,
                'size' => $filesize,
                'path' => $filepath,
                'url' => $url
            ];

            $file->loadData($data);
        }
    }

    public function upload()
    {
        $file = new File();
        
        $this->addFileToServer($file);
        
        $file->insert();
        
        return $this->render('upload');
    }
}
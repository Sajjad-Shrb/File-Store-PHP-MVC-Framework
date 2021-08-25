<?php

namespace app\app\controllers;

use app\app\models\File;
use app\app\models\User;
use app\core\Application;
use app\core\Controller;

class UploadController extends Controller
{
    public function showUploadPage()
    {
        return $this->render('upload');
    }

    public function addFileToServer(File $file)
    {
        if (!empty($_FILES['uploaded_file'])) {
            $username = Application::$app->session->get('username') ?? 'guest';
            if($username === false)
                $username = null;
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
            
            $filepath = Application::$ROOT_DIR . '/public/' . $dirpath . $filename;

            $just_name = explode('.', $filename)[0];
            
            $i = 1;
            while(file_exists($filepath)) {
                $filename = $just_name . "_$i" . '.' . $file_extension;
                $filepath = Application::$ROOT_DIR . '/public/' . $dirpath . $just_name . "_$i" . '.' . $file_extension;
                $i++;
            }

            $url = $_SERVER['HTTP_ORIGIN'] . '/'. $dirpath . $filename;

            if (move_uploaded_file($tmpname, $filepath)) {
                echo "The file " . $filename . " has been uploaded";
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

                return true;
            } else {
                echo "There was an error uploading the file, please try again!";
                return false;
            }
        }
    }

    public function upload()
    {
        $file = new File();
        
        if($this->addFileToServer($file))
            $file->insert();
        
        return $this->render('upload');
    }
}
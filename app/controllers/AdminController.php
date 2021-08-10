<?php 

namespace app\app\controllers;

use app\core\Controller;
use app\core\Request;

class AdminController extends Controller
{
    public ?array $requests;

    public function index(Request $request)
    {
        $this->requests = $request->getBody();

        if ($this->path == '/admin' && $this->method == 'get')
            $this->action = 'showAdminPage';
        elseif ($this->path == '/admin' && $this->method == 'post')
            $this->action = 'admin';

        return call_user_func([__CLASS__, $this->action]);
    }

    public function showAdminPage()
    {
        $this->setLayout('admin');
        return $this->render('admin');
    }

}
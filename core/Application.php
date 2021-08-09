<?php 

namespace app\core;

use app\app\models\User;

class Application
{
    public static $root_dir;
    public static Application $app;
    
    public Controller $controller;
    public Database $db;
    public Request $request;
    public Response $response;
    public Router $router;
    public String $layout = 'main';
    public View $view;
    public Session $session;
    public ?User $user = null;

    public function __construct($root_dir)
    {
        static::$root_dir = $root_dir;
        static::$app = $this;

        $this->controller = new Controller();
        $this->db = new Database();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();
        $this->user = new User();
    }

    public function run() {
        echo $this->router->resolve();
    }
}
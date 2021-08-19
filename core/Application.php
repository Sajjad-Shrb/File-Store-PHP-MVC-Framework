<?php 

namespace app\core;

use app\app\models\User;

class Application
{
    public static Application $app;
    public static $ROOT_DIR;
    public String $layout = 'main';
    
    public Request $request;
    public Response $response;
    public Router $router;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public View $view;
    public ?User $user = null;

    public function __construct($root_dir)
    {
        static::$app = $this;
        static::$ROOT_DIR = $root_dir;
        
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database();
        $this->session = new Session();
        $this->view = new View();
        $this->user = new User();
    }

    public function run() {
        echo $this->router->resolve();
    }
}
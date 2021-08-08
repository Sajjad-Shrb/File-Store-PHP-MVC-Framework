<?php 

namespace app\core;

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

    }

    public function run() {
        echo $this->router->resolve();
    }
}
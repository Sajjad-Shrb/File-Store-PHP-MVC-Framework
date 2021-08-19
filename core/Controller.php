<?php 

namespace app\core;

use app\utils\middlewares\AuthMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $input = '';
    public string $action = '';
    public string $path = '';
    public string $method = '';

    protected array $middlewares = [];

    public function __construct()
    {
        Application::$app->controller = $this;
    }

    public function setLayout($layout): void
    {
        $this->layout = $layout;
        Application::$app->controller = $this;
    }
    
    public function loadView($view, $params = []): string
    {
        return Application::$app->view->loadView($view, $params);
    }

    public function render($view, $params = []): string
    {
        return Application::$app->view->render($view, $params);
    }

    public function setSession($key, $value)
    {
        Application::$app->session->set($key, $value);
    }

    public function getSession($key)
    {
        return Application::$app->session->get($key);
    }

    public function redirect($url)
    {
        return Application::$app->response->redirect($url);
    }

    public function registerMiddleware(AuthMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
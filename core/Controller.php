<?php 

namespace app\core;

class Controller
{
    //TODO: define Other Layouts
    //TODO: middle wears
    public string $layout = 'main';
    public string $input = '';
    public string $action = '';
    public string $path = '';
    public string $method = '';

    public function __construct()
    {
        ///////TODO: checkMethod Call//////

        Application::$app->controller = $this;
    }

    public function checkMethod()
    {
        ///////TODO: checkMethod Implement//////
    }

    public function setLayout($layout): void
    {
        $this->layout = $layout;
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
}
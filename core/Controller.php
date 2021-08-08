<?php 

namespace app\core;

class Controller
{
    //TODO: define Other Layouts
    //TODO: middle wears
    public string $layout = 'main';
    public string $action = '';
    public string $path = '';
    public string $method = '';

    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }
    
    public function render($view, $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function redirect($url)
    {
        return Application::$app->response->redirect($url);
    }
}
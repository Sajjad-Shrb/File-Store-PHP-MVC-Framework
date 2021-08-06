<?php 

namespace app\core;

class View 
{
    public function loadLayout($layout)
    {
        ob_start();
        include_once Application::$root_dir."/views/layouts/$layout.php";
        return ob_get_clean();
    }
    
    public function loadView($view, $params)
    {
        foreach ($params as $key => $value)
            $$key = $value;

        ob_start();
        include Application::$root_dir."/views/$view.php";
        return ob_get_clean();
    }

    public function renderView($view, array $params)
    {
        $layout = Application::$app->layout;

        if (Application::$app->controller)
            $layout = Application::$app->controller->layout;

        $layout = $this->loadLayout($layout);
        $view = $this->loadView($view, $params);

        return str_replace('{{content}}', $view, $layout);
    }
}
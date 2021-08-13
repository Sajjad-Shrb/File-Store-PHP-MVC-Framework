<?php 

namespace app\core;

class View 
{
    public function loadLayout($layout)
    {
        ob_start();
        include_once Application::$root_dir."/app/views/layouts/$layout.php";
        return ob_get_clean();
    }
    
    public function loadView($view, $params)
    {       
        $view = strtolower($view);
        extract($params);
        
        ob_start();
        include Application::$root_dir."/app/views/$view.php";
        return ob_get_clean();
    }

    public function render($view, array $params)
    {

        $layout = Application::$app->layout;
        
        if (Application::$app->controller)
            $layout = Application::$app->controller->layout;

        $view = $this->loadView($view, $params);       
        $layout = $this->loadLayout($layout);
        
        return str_replace('{{content}}', $view, $layout);
    }
}
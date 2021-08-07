<?php

namespace app\core;

class Router
{
    private Request $request;
    private Response $response;
    private array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function route($path, $callback)
    {
        $callback = [$callback, 'index'];
        $this->routes[$path] = $callback;
    }

    // public function get($path, $callback)
    // {
    //     $this->routes["get"][$path] = $callback;
    // }

    // public function post($path, $callback)
    // {
    //     $this->routes["post"][$path] = $callback;
    // }

    public function renderView($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function resolve()
    {
        $path = $this->request->getPath();

        $callback = $this->routes[$path] ?? false;

        if($callback === false) {
            $this->response->setStatusCode(404);
            $this->response->setStatusMessage("Page Not Found!");

            return $this->response->renderView();
        }

        elseif (is_string($callback)){
            return $this->renderView($callback);
        }

        elseif(is_array($callback)) {
            $callback[0] = new $callback[0];
            $controller = $callback[0];
            
            $controller->action = $callback[1];

            return call_user_func($callback, $this->request);
        }

        else {
            return call_user_func($callback);
        }
    }
}

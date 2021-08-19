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

    public function get($path, $callback)
    {
        $path = rtrim($path, '/');

        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $path = rtrim($path, '/');

        $this->routes["post"][$path] = $callback;
    }

    public function put($path, $callback)
    {
        $path = rtrim($path, '/');

        $this->routes["put"][$path] = $callback;
    }

    public function delete($path, $callback)
    {
        $path = rtrim($path, '/');

        $this->routes["delete"][$path] = $callback;
    }

    public function render($callback, $params = [])
    {
        return Application::$app->view->render($callback, $params);
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false) {
            $this->response->setStatusCode(404);
            $this->response->setStatusMessage("Page Not Found!");

            return $this->response->render();
        }

        elseif (is_string($callback)){
            return $this->render($callback);
        }

        elseif(is_array($callback)) {
            $callback[0] = new $callback[0]($callback[1]);
            $controller = $callback[0];
            
            $controller->path = $path;
            $controller->method = $method;
            $controller->action = $callback[1];

            Application::$app->controller = $controller;

            $middlewares = $controller->getMiddlewares();
            foreach ($middlewares as $middleware) {
                try {
                    $middleware->execute();
                } catch(\Exception $e) {
                    $this->response->setStatusCode($e->getCode());
                    $this->response->setStatusMessage($e->getMessage());
        
                    return $this->response->render();
                }
            }
            
            return call_user_func($callback, $this->request);
        }

        else {
            return call_user_func($callback);
        }
    }
}

<?php

namespace app\core;

class Request
{
    public function getPath(): string
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        
        $path = rtrim($path, '/');

        if ($pos = strpos($path, '?'))
            return substr($path, 0, $pos);
        else
            return strtolower($path);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getBody()
    {
        $body = null;
        
        if($this->getMethod() == "get") {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->getMethod() == "post") {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
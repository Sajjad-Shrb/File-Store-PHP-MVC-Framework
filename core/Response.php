<?php

namespace app\core;

class Response
{
    private int $status_code = 200;
    private string $status_message = "";

    public function setStatusCode(int $status_code): void
    {
        http_response_code($status_code);
        $this->status_code = http_response_code($status_code);
    }

    public function getStatusCode(): int
    {
       return $this->status_code;
    }

    public function setStatusMessage(string $status_message): void
    {
        $this->status_message = $status_message;
    }

    public function getStatusMessage(): string
    {
        return $this->status_message;
    }

    public function render()
    {
        $layout = Application::$app->view->loadLayout("error");
        $str = str_replace("{{status_code}}", $this->status_code, $layout);
        return str_replace("{{status_message}}", $this->status_message, $str);
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}

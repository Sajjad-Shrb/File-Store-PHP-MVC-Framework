<?php

use app\core\Application;

$id =       Application::$app->session->get('id');
$username = Application::$app->session->get('username');
$name =     Application::$app->session->get('name');
$email =    Application::$app->session->get('email');

if ($id)
    echo "You are logged in. your mail is: $email |  <a href=\"/logout\">Logout</a>";
else
    echo "You are Guest! | <a href=\"/login\">Login</a> or <a href=\"/register\">Register</a>" ;
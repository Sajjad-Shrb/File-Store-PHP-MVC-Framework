
<?php

use app\core\Application;

$email = Application::$app->session->get('email');

if ($email)
    echo "You are logged in. your mail is: $email |  <a href=\"/logout\">Logout</a>";
else
    echo "You are Guest! | <a href=\"/login\">Login</a> or <a href=\"/register\">Register</a>" ;

echo $table;
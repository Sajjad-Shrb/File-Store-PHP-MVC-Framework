<?php

use app\app\controllers\HomeController;
use app\app\controllers\UploadController;
use app\app\controllers\UserController;
use app\core\Application;

require "../vendor/autoload.php";

$app = new Application(dirname(__DIR__));

//TODO: Use root path

$app->router->routing("/", HomeController::class);
$app->router->routing("/home", HomeController::class);
$app->router->routing("/home/index", HomeController::class);

$app->router->routing("/user/register", UserController::class);
$app->router->routing("/user/login", UserController::class);

$app->router->routing("/user/logout", UserController::class);

$app->router->routing("/upload", UploadController::class);

//TODO: implement non-automatic routing
// $app->router->routing("/register", 'register');

// $app->router->get("/register", [SiteController::class, "register"]);
// $app->router->post("/register", [SiteController::class, "register"]);

// $app->router->get("/login", [SiteController::class, "login"]);
// $app->router->post("/login", [SiteController::class, "login"]);

// $app->router->get("/logout", [SiteController::class, "logout"]);

// $app->router->get("/reserve", [UserController::class, "reserve"]);

// $app->router->get("/admin", [UserController::class, "admin"]);
// $app->router->post("/admin", [UserController::class, "admin"]);

// $app->router->get("/profile", [UserController::class, "profile"]);
// $app->router->post("/profile", [UserController::class, "profile"]);

$app->run();
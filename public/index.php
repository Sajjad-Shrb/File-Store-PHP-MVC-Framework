<?php

use app\controllers\SiteController;
use app\controllers\UserController;
use app\core\Application;

require "../vendor/autoload.php";

$app = new Application(dirname(__DIR__));

//TODO: Use root path

$app->router->get("/", [SiteController::class, "home"]); //ok
$app->router->get("/home", [SiteController::class, "home"]); //ok

$app->router->get("/register", [SiteController::class, "register"]);
$app->router->post("/register", [SiteController::class, "register"]);

$app->router->get("/login", [SiteController::class, "login"]);
$app->router->post("/login", [SiteController::class, "login"]);

$app->router->get("/logout", [SiteController::class, "logout"]);

$app->router->get("/reserve", [UserController::class, "reserve"]);

$app->router->get("/admin", [UserController::class, "admin"]);
$app->router->post("/admin", [UserController::class, "admin"]);

$app->router->get("/profile", [UserController::class, "profile"]);
$app->router->post("/profile", [UserController::class, "profile"]);

$app->run();
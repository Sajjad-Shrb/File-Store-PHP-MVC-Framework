<?php

use app\app\controllers\AdminController;
use app\app\controllers\AuthController;
use app\app\controllers\HomeController;
use app\app\controllers\UploadController;
use app\app\controllers\UserController;
use app\core\Application;

require "../vendor/autoload.php";

$app = new Application(dirname(__DIR__));

//TODO: Use root path

$app->router->get("/", [HomeController::class, 'index']);
$app->router->get("/home", [HomeController::class, 'index']);
$app->router->get("/index", [HomeController::class, 'index']);
$app->router->get("/home/index", [HomeController::class, 'index']);

$app->router->get("/register", [AuthController::class, 'showRegisterForm']);
$app->router->get("/user/register", [AuthController::class, 'showRegisterForm']);

$app->router->post("/register", [AuthController::class, 'register']);
$app->router->post("/user/register", [AuthController::class, 'register']);

$app->router->get("/login", [AuthController::class, 'showLoginForm']);
$app->router->get("/user/login", [AuthController::class, 'showLoginForm']);

$app->router->post("/login", [AuthController::class, 'login']);
$app->router->post("/user/login", [AuthController::class, 'login']);

$app->router->get("/user/logout", [AuthController::class, 'logout']);
$app->router->get("/logout", [AuthController::class, 'logout']);

$app->router->get("/user", [UserController::class, 'showUserDashboardPage']);
$app->router->get("/user/dashboard", [UserController::class, 'showUserDashboardPage']);

$app->router->get("/user/profile", [UserController::class, 'showProfilePage']);
$app->router->put("/user/profile", [UserController::class, 'editProfile']);

$app->router->get("/user/files", [UserController::class, 'showFilesPage']);

(new UserController) -> provideUserProfileRoutes();

$app->router->get("/upload", [UploadController::class, 'showUploadPage']);
$app->router->post("/upload", [UploadController::class, 'upload']);

$app->router->get("/admin", [AdminController::class, 'showAdminDashboardPage']);

$app->router->get("/admin/users", [AdminController::class, 'showManageUsersPage']);
$app->router->put("/admin/users", [AdminController::class, 'updateUsers']);

$app->router->get("/admin/setting", [AdminController::class, 'showSettingPage']);
$app->router->put("/admin/setting", [AdminController::class, 'config']);

$app->router->get("/admin/files", [AdminController::class, 'showFilesPage']);
$app->router->put("/admin/files", [AdminController::class, 'verifyFiles']);
$app->router->delete("/admin/files", [AdminController::class, 'deleteFiles']);

$app->run();
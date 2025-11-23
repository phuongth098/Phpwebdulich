<?php
// public/index.php
require_once '../src/Config/Database.php';
require_once '../src/Controllers/HomeController.php';
require_once '../src/Controllers/CategoryController.php';
require_once '../src/Controllers/PostController.php';
require_once '../src/Controllers/AboutController.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = explode('/', filter_var($url, FILTER_SANITIZE_URL));

$controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$method = $url[1] ?? 'index';
$params = array_slice($url, 2);

$file = "../src/Controllers/{$controllerName}.php";

if (file_exists($file)) {
    $controller = new $controllerName();
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
    } else {
        echo "Method $method not found!";
    }
} else {
    echo "Controller $controllerName not found!";
}
<?php

require_once 'routes/web.php';

$url = $_GET['url'] ?? '';

if (array_key_exists($url, $routes)) {

    $controllerName = $routes[$url]['controller'];
    $method = $routes[$url]['method'];

    require_once "controllers/$controllerName.php";

    $controller = new $controllerName();
    $controller->$method();

} else {
    echo "Página não encontrada!";
}
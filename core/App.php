<?php

// Very small front-controller style "framework" to support MVC.

class App
{
    public static function run(): void
    {
        $route = $_GET['route'] ?? 'home/home';
        [$controllerName, $action] = array_pad(explode('/', $route, 2), 2, 'index');

        $controllerClass = ucfirst($controllerName) . 'Controller';
        $controllerFile = __DIR__ . '/../controllers/' . $controllerClass . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo 'Page not found';
            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo 'Controller not found';
            return;
        }

        $controller = new $controllerClass();
        if (!method_exists($controller, $action)) {
            http_response_code(404);
            echo 'Action not found';
            return;
        }

        $controller->$action();
    }
}


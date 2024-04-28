<?php
include 'controllers/HomeController.php';
include 'controllers/LoginController.php';
include 'controllers/RegisterController.php';
include 'controllers/AdminController.php';


class Router {
    private $routes;

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function route(string $url) {
        // Rimuovi la query string e il frammento URL
        $url = strtok($url, '?#');

        // Assicurati che l'URL non termini con una barra
        $url = rtrim($url, '/');

        // Se l'URL è vuoto, reindirizza alla home page
        if (empty($url)) {
            $url = '/';
        }

        if (array_key_exists($url,  $this->routes)) {
            $action = $this->routes[$url];
            list($controller, $method) = explode('@', $action);

            require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/framework/controllers/' . $controller . '.php';

            $controllerInstance = new $controller();

            $controllerInstance->$method();
        } else {
            echo '404 - Pagina non trovata';
            exit;
        }
    }

    public function dispatch() {
        $requestUri = $_SERVER['REQUEST_URI'];

        // se l'url proviene da /backend non esegue il routing
        if (strpos($requestUri, '/backend') === 0) {
            return;
        }

        $this->route($requestUri);
    }
}

$routes = [
    '/' => 'HomeController@index',
    '/login' => 'LoginController@index',
    '/register' => 'RegisterController@index',
    '/admin/dashboard' => 'AdminController@dashboard',
    '/admin/login' => 'LoginController@adminLogin',
    '/user/profile' => 'UserController@profile',
];

$router = new Router($routes);

$router->dispatch();
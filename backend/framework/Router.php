<?php
include 'controllers/HomeController.php';
include 'controllers/AboutController.php';

/**
 * Classe Router che gestisce il routing delle richieste HTTP.
 */
class Router {
    private $routes;

    /**
     * Costruttore della classe Router.
     *
     * @param array $routes Un array associativo contenente le rotte del sistema.
     */
    public function __construct($routes) {
        $this->routes = $routes;
    }

    /**
     * Gestisce il routing della richiesta HTTP.
     *
     * @param string $url L'URL richiesto.
     */
    public function route($url) {
        if (array_key_exists($url,  $this->routes)) {
            $action = $this->routes[$url];
            list($controller, $method) = explode('@', $action);

            require_once __DIR__ . '../controllers/' . $controller . '.php';

            $controllerInstance = new $controller();

            $controllerInstance->$method();
        } else {
            echo '404 - Pagina non trovata';
        }
    }

    /**
     * Esegue il dispatching della richiesta HTTP corrente.
     */
    public function dispatch()
    {

    }
}

$routes = [
    '/' => 'HomeController@index',
    '/about' => 'AboutController@index',
];

$router = new Router($routes);

$router->route($_SERVER['REQUEST_URI']);

<?php

/**
 * Defines the routes for the application.
 *
 * @var array $routes An array of routes where the key is the URL path and the value is the corresponding controller and method.
 */
$routes = [
  '/' => 'HomeController@index',
  '/about' => 'AboutController@index',
];


/**
 * Funzione per gestire il routing delle richieste
 *
 * @param array $routes Array contenente le rotte disponibili
 * @param string $url URL richiesto
 * @return void
 */
function route($routes, $url) {
  // Verifica se l'URL richiesto è presente nell'array delle rotte
  if (array_key_exists($url, $routes)) {
    // Ottieni la rotta corrispondente all'URL
    $route = $routes[$url];
    
    // Divide la stringa della rotta per ottenere il nome del controller e del metodo
    $controller = explode('@', $route)[0];
    $method = explode('@', $route)[1];
    require_once __DIR__ . '/../controllers/' . $controller . '.php';
    $controller = new $controller();
    $controller->$method();
  } else {
    echo '404 - Pagina non trovata';
  }
}

// Esegui il routing della richiesta corrente
route($routes, $_SERVER['REQUEST_URI']);


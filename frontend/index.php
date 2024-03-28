<?php
//session_start();
global $routes;
include '../backend/framework/Router.php';
/*
if(session_id() == '' || !isset($_SESSION)) {
    echo 'Session not started ';
} else {
    echo 'Session started ';
}*/

//echo $_SESSION['is_auth_page'] ? 'true' : 'false';

if ($_SERVER['REQUEST_URI'] === '/login' || $_SERVER['REQUEST_URI'] === '/register') {
    $_SESSION['is_auth_page'] = true;
} else {
    $_SESSION['is_auth_page'] = false;
}

$router = new Router($routes);

$router->dispatch();
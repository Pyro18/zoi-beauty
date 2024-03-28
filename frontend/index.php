<?php
session_start();
global $routes;
include '../backend/framework/Router.php';


$router = new Router($routes);

$router->dispatch();
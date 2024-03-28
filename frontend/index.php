<?php
include '../backend/framework/Router.php';


$router = new Router($routes);

$router->dispatch();
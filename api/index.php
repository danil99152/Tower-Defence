<?php
error_reporting(1);

require_once '..\Application\Router\Router.php';

$router = new Router();

header('Content-Type: application/json');
echo json_encode($router->answer((object) $_GET));
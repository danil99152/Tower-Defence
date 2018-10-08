<?php
error_reporting(1);

require_once '..\Application\Router\Router.php';

$router = new Router();

echo json_encode($router->answer((object) $_GET));
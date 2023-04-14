<?php

require_once 'lib/database.php';
require_once 'lib/extras.php';
require_once 'views/home/home.controller.php';

require_style('public/style.css');

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];
$request_method = $_SERVER["REQUEST_METHOD"];


$routes = [
  [
    'path' => '/\/ pedido \/ (\d) \/ (nome|hora)? \/?/x',
    'controller' => 'PedidoController'
  ],
  [
    'path' => '/\/home \/?/x',
    'controller' => 'HomeController'
  ],
];


foreach ($routes as $route) {
  if (preg_match($route['path'], $path, $matches)) {
    if ($path != $matches[0]) badrequest();
    call_user_func($route['controller']);
  }
}

// if the path was accepted but not found:
notfound();

function notfound()
{
  http_response_code(404);
  include 'views/notfound.php';
  exit();
}

function badrequest()
{
  http_response_code(400);
  exit();
}

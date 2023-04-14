<?php

require_once 'lib/database.php';
require_once 'lib/extras.php';
require_once 'views/home/home.controller.php';
require_once 'api/menu/menu.php';

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];
$request_method = $_SERVER["REQUEST_METHOD"];

// the 'methods' key is there only for documentation purposes.
$routes = [
  [
    'path' => '/\/ pedido \/ (\d) \/ (nome|hora)? \/?/x',
    'methods' => ['GET'],
    'controller' => 'PedidoController'
  ],
  [
    'path' => '/\/api\/menu\/?/x',
    'methods' => ['GET'],
    'controller' => 'API\Menu\Controller',
  ],
];


foreach ($routes as $route) {
  if (preg_match($route['path'], $path, $matches)) {
    if ($path != $matches[0]) badrequest();
    call_user_func($route['controller']);
  }
}

notfound();                          // if the path was accepted but not found

<?php

require_once 'lib/extras.php';
require_once 'views/home/home.controller.php';

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];
$request_method = $_SERVER["REQUEST_METHOD"];

// the 'methods' keys are here only for documentation purposes.
$routes = [
  [
    'path' => '/\/(table\/(\d(.+)?)\/?)?/x',
    'controller' => 'Home\Controller',
  ],
];

foreach ($routes as $route) {
  if (preg_match($route['path'], $path, $matches)) {
    if ($path != $matches[0]) notfound();
    call_user_func($route['controller'], $route['path']);
  }
}

badrequest();                         // if the path was accepted but not found

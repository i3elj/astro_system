<?php

require_once 'lib/extras.php';
require_once 'controllers/home/home.controller.php';
require_once 'controllers/auth/auth.controller.php';

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];

$routes = [
  // 'path' => '/\/table\/(\d(.+)?)\/?/x',
  [
    'path' => AuthController::path,
    'handler' => 'AuthController::Handler'
  ]
];

if ($path == '/') HomeController::Handler();

foreach ($routes as $route) {
  if (preg_match($route['path'], $path, $matches)) {
    if ($path != $matches[0]) {
      notfound();
    }

    $route['handler']();
  }
}

badrequest();                         // if the path was accepted but not found

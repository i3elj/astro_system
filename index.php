<?php

require_once 'lib/extras.php';
require_once 'views/partials/head.php';
require_once 'router.php';
require_once 'controllers/home/home.controller.php';
require_once 'controllers/auth/auth.controller.php';

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];

$routes = [
  [
    'path' => AuthController::path,
    'view' => 'AuthController'
  ],
  [
    'path' => HomeController::path,
    'view' => 'HomeController'
  ]
];

create_router($routes, $path);

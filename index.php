<?php

require_once 'lib/router.php';
require_once 'lib/extras.php';
require_once 'controllers/import.php';
require_once 'views/partials/import.php';

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];

$routes = [
	['path' => '/\/mesas/', 'controller' => 'Mesas'],
	['path' => '/\/menu/', 'controller' => 'Menu'],
	['path' => '/\/dashboard/', 'controller' => 'Dashboard'],
	['path' => '/\/signup/', 'controller' => 'SignUp'],
	['path' => '/\/login/', 'controller' => 'Login'],
	['path' => '/\//', 'controller' => 'Home']
];

create_router($routes, $path);

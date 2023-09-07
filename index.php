<?php

require_once 'lib/router.php';
require_once 'lib/extras.php';
require_once 'src/controllers/import.php';

$parsed_uri = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed_uri['path'];

$api_routes = [
	['path' => '/api/mesa', 'controller' => '\Mesas\Api'],
	['path' => '/api/cardapio/item', 'controller' => '\Cardapio\Api'],
];

$routes = [
	['path' => '/home', 'controller' => '\Home\Controller'],
	['path' => '/mesas', 'controller' => '\Mesas\Controller'],
	['path' => '/cardapio', 'controller' => '\Cardapio\Controller'],
	['path' => '/cardapio/new', 'controller' => '\Cardapio\New\Controller'],
	['path' => '/dashboard', 'controller' => '\Dashboard\Controller'],
	['path' => '/signup', 'controller' => '\Signup\Controller'],
	['path' => '/login', 'controller' => '\Login\Controller'],
];

create_router($routes, $api_routes, $path);

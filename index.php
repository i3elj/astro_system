<?php

require_once 'lib/router.php';
require_once 'lib/extras.php';
require_once 'controllers/import.php';

$parsed_uri = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed_uri['path'];

$api_routes = [
	[
		'path' => '/api/some/level/mesa',
		'controller' => 'Mesas',
		'method' => 'GET'
	],
	[
		'path' => '/api/cardapio/item',
		'controller' => 'Cardapio',
		'method' => 'POST'
	],
];

$routes = [
	[
		'path' => '/home',
		'controller' => 'Home',
	],
	[
		'path' => '/mesas',
		'controller' => 'Mesas',
	],
	[
		'path' => '/cardapio',
		'controller' => 'Cardapio',
	],
	[
		'path' => '/dashboard',
		'controller' => 'Dashboard',
	],
	[
		'path' => '/signup',
		'controller' => 'SignUp',
	],
	[
		'path' => '/login',
		'controller' => 'Login',
	],
	// ['path' => '/\//', 'controller' => 'LandingPage'], not implemented
	// ['path' => '/\/caixa/', 'controller' => 'Caixa'], not implemented
];

create_router($routes, $api_routes, $path);

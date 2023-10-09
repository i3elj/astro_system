<?php

require_once 'lib/router.php';
require_once 'lib/extras.php';
require_once 'src/controllers/import.php';

$parsed_uri = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed_uri['path'];
$file_types = get_filetype_regex('css', 'js', 'png');

$static_routes = [
	"routes" => [
		"/\/src\/views\/.*$file_types$/",
		"/\/public\/.*$file_types$/",
	],
	"filetype_regex" => $file_types,
];

$api_routes = [
	['path' => '/api/mesa', 'controller' => '\Mesas\Api'],
	['path' => '/api/cardapio/item', 'controller' => '\Cardapio\Api'],
];

$routes = [
	['path' => ['/', '/home'],  'controller' => '\Home\Controller'],
	['path' => '/mesas',        'controller' => '\Mesas\Controller'],
	['path' => '/cardapio',     'controller' => '\Cardapio\Controller'],
	['path' => '/cardapio/new', 'controller' => '\Cardapio\New\Controller'],
	['path' => '/dashboard',    'controller' => '\Dashboard\Controller'],
	['path' => '/signup',       'controller' => '\Signup\Controller'],
	['path' => '/login',        'controller' => '\Login\Controller'],
];

create_router($routes, $api_routes, $path, $static_routes, $file_types);

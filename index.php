<?php

require_once 'lib/router.php';
require_once 'lib/extras.php';
require_once 'controllers/import.php';
require_once 'views/partials/import.php';

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];

$routes = [
	['path' => '/\/home/', 'controller' => 'Home'],
	// ['path' => '/\/caixa/', 'controller' => 'Caixa'], not implemented
	['path' => '/\/mesas/', 'controller' => 'Mesas'],
	['path' => '/\/cardapio/', 'controller' => 'Cardapio'],
	['path' => '/\/dashboard/', 'controller' => 'Dashboard'],
	['path' => '/\/signup/', 'controller' => 'SignUp'],
	['path' => '/\/login/', 'controller' => 'Login'],
	// ['path' => '/\//', 'controller' => 'LandingPage'], not implemented
];

create_router($routes, $path);

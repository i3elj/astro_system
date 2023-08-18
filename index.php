<?php

require_once 'lib/extras.php';
require_once 'views/partials/head.php';
require_once 'router.php';
require_once 'controllers/import.php';

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsed_uri['path'];

$routes = [
	[
		'path' => DashboardController::path,
		'view' => 'DashboardController'
	],
	[
		'path' => SignUpController::path,
		'view' => 'SignUpController'
	],
	[
		'path' => LoginController::path,
		'view' => 'LoginController'
	],
	[
		'path' => HomeController::path,
		'view' => 'HomeController'
	]
];

create_router($routes, $path);

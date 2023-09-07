<?php

/**
 * Create a router based on regex.
 *
 * @param array $routes Holds an associative array that have a key value pair,
 * where `'path'` represents the endpoint and `'controller'` represents which
 * controller will take care of that endpoint.
 *
 *      - `[ 'path' => '/home', 'controller' => 'HomeController' ]`
 *
 * @param array $api_routes Holds an associative array that have a key value
 * pair, where `'path'` represents the endpoint and `'controller'` represents
 * which  controller will take care of that endpoint.
 *
 *      - `[ 'path' => '/api/user', 'controller' => 'User', 'method' => 'GET' ]`
 *
 * @param string $path The current path the client are on.
 * @return void
 */
function create_router($routes, $api_routes, $path)
{
	if ($path == '/') {
		header('location: /home');
		exit(0);
	}

	$contains_api = strpos($path, 'api/') !== false;
	$call_handler = function ($route, $path) {
		if ($route['path'] == $path) {
			$view = new $route['controller']($path);
			$view->Handler();
		}
	};

	if ($contains_api)
		foreach ($api_routes as $route) $call_handler($route, $path);
	else
		foreach ($routes as $route) $call_handler($route, $path);

	notfound();
}

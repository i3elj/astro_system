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
 * @param array $static_route It's an array containing two fields, `routes`
 * wich holds an array containing the regular expression for each static file
 * route, and the `filetype_regex` field, which holds a regular expression for
 * containing a inclusive pattern matching for each filetype.
 * @param string $path The current path the client are on.
 * @return void
 */
function create_router($routes, $api_routes, $path, $static_routes)
{
	$filetype_regex = $static_routes["filetype_regex"];
	$static_routes = $static_routes["routes"];

	foreach ($static_routes as $route) {
		$file_path = preg_grep($route, explode("\n", $path));

		if ($file_path) {
			$file = file_get_contents(".$file_path[0]");

			if (!$file) bad_request();

			$current_ft = get_current_filetype($file_path[0], $filetype_regex);
			header("content-type: text/$current_ft");
			echo $file;
			exit(0);
		}
	}

	if ($path == '/') {
		header("location: /home");
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

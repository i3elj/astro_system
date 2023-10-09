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

	if (str_contains($path, "/public") or str_contains($path, "/src/views")) {
		foreach ($static_routes as $route) {
			$file_path = preg_grep($route, explode("\n", $path))[0] ?: false;

			if ($file_path) {
				$file = file_get_contents(".$file_path") ?: _404();
				$content_type = get_content_type($file_path, $filetype_regex);
				header("content-type: $content_type");
				echo $file;
				exit(0);
			}
		}
	}

	$contains_api = strpos($path, 'api/') !== false;
	$call_handler = function ($route, $path) {
		if (is_array($route['path'])) {
			foreach ($route['path'] as $possible_path)
				if ($possible_path == $path) {
					$controller = new $route['controller']($path);
					$controller->Handler();
				}
		}

		if ($route['path'] == $path) {
			$controller = new $route['controller']($path);
			$controller->Handler();
		}
	};

	if ($contains_api)
		foreach ($api_routes as $route) $call_handler($route, $path);
	else
		foreach ($routes as $route) $call_handler($route, $path);

	page_notfound();
}

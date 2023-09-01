<?php

/**
 * Log variables to the console
 *
 * @param array $values Holds each value that will be send to the client.
 */
function logger(...$values)
{
	foreach ($values as $key => $value) {
		error_log('\t\tLOGGER:: $key: $value', 4);
	}
}

/**
 * Dump and die. Sends variables to the client and kills the connection.
 *
 * @param array $values Holds each value that will be send to the client.
 */
function dd(...$values)
{
	echo '<pre>';
	foreach ($values as $value) {
		var_dump($value);
	}
	echo '</pre>';
	die(0);
}

function require_style(string $file)
{
	echo '<style>';
	require_once $file;
	echo '</style>';
}

function require_script(string $file, string $args = '')
{
	echo "<script type='text/javascript' $args >";
	require_once $file;
	echo '</script>';
}

/**
 * Returns a basic page with 404 'not found' status code.
 */
function notfound()
{
	http_response_code(404);
	include 'views/notfound.php';
	exit(0);
}

/**
 * Returns a 400 'bad request' status code.
 */
function bad_request()
{
	http_response_code(400);
	exit(0);
}

/**
 * Returns a 400 'bad request' status code and a json body.
 */
function bad_api_request()
{
	http_response_code(400);
	echo json_encode(['message' => 'bad request']);
	exit(0);
}

function get_route_params(string $path, array $keys): array
{
	$parsed_uri = parse_url($_SERVER['REQUEST_URI']);
	$required_path = $parsed_uri['path'];

	preg_match($path, $required_path, $matches);

	$params_array = [];
	foreach ($keys as $key) {
		if (preg_match($key, $matches[0], $matches)) {
			array_push($params_array, $matches[0]);
		}
	}

	return $params_array;
}

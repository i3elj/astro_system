<?php

/**
 * Log variables to the console
 *
 * @param array $values Holds each value that will be send to the client.
 */
function logger(...$values)
{
	foreach ($values as $key => $value) {
		error_log("\t\tLOGGER:: $key: $value", 4);
	}
}

/**
 * Does the same thing as $_POST, but with htmlspecialchars wrapped around it
 *
 * @param string $varname The name of the variable comming through a post
 * request.
 */
function POST($varname)
{
	return htmlspecialchars($_POST[$varname]);
}

/**
 * Return the current filetype given a string with an extension ending like
 * `.css` or `.js`
 */
function get_content_type(string $path, string $filetypes): string
{
	preg_match("/$filetypes/", $path, $matches);
	return match ($matches[1]) {
		"js" => "text/javascript",
		"css" => "text/css",
		default => $matches[1],
	};
}

/**
 * Return a regular expression string containing all possible filetypes under
 * `(file_type1|file_type2|file_type3...)`
 *
 * @param array $file_types Array containing every file type
 */
function get_filetype_regex(...$file_types)
{
	return "\.(" . join('|', $file_types) . ")";
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
function page_notfound()
{
	http_response_code(404);
	include 'src/views/notfound.html';
	exit(0);
}


/**
 * Returns a 404 'not found' status code.
 */
function _404()
{
	http_response_code(404);
	logger("AAAAAAAAAAAAAAAAAA");
	exit(0);
}

/**
 * Returns a 400 'bad request' status code.
 */
function _400()
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

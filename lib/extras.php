<?php

function dd($arr_of_values)
{
  echo "<pre>";
  foreach ($arr_of_values as $value) {
    var_dump($value);
  }
  echo "</pre>";
  exit();
}

function require_style(string $file)
{
  echo '<style>';
  require_once $file;
  echo '</style>';
}

function require_script(string $file, string $args = "")
{
  echo '<script type="text/javascript" ' . $args . '>';
  require_once $file;
  echo '</script>';
}

function notfound()
{
  http_response_code(404);
  include 'views/notfound.php';
  exit();
}

function badrequest()
{
  http_response_code(400);
  exit();
}

function get_route_params(string $path, array $keys): array
{
  $parsed_uri = parse_url($_SERVER["REQUEST_URI"]);
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

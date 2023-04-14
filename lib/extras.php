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
  echo '<script type="text/javascript">' . $args;
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

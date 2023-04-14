<?php

function dd($arr_of_value)
{
    echo "<pre>";
    foreach ($arr_of_value as $value) {
        var_dump($value);
    }
    echo "</pre>";
    exit();
}

function require_once_style(string $file)
{
  echo '<style>';
  require_once $file;
  echo '</style>';
}

function require_once_script(string $file)
{
  echo '<script type="text/javascript">';
  require_once $file;
  echo '</script>';
}

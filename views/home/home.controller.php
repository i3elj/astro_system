<?php

namespace Home;

use Database;

function Controller($path)
{
  match ($_SERVER["REQUEST_METHOD"]) {
    "GET" => build_view($path),
    "POST" => add_order($path),
    default => badrequest(),
  };
}

{



function build_view($path)
{
  $params = get_route_params($path, ['/(\d(.+)?)/']);
  $tables = Database\load_db()["restaurants"][0]["tables"];

  foreach ($tables as $table) {
    if ((int)$table["id"] == (int)$params[0]) {
      $selected_table = $table;
    }
  }

  $title = "Astro System";
  require_style('public/style.css');
  require_style('views/home/home.style.css');
  require_script('views/home/home.js');
  require_once 'views/home/home.view.php';

  exit(0);
}

<?php

namespace Home;

function Controller()
use Database;

function Controller($path)
{
  match ($_SERVER["REQUEST_METHOD"]) {
    "GET" => build_view($path),
    "POST" => add_order($path),
    default => badrequest(),
  };
}

function build_view()
{
    $title = "Astro System";
    require_style('views/home/home.style.css');
    require_script('views/home/home.js');
    require_once 'views/home/home.view.php';
    exit();
}

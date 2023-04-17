<?php

namespace Home;

function Controller()
{
    match ($_SERVER["REQUEST_METHOD"]) {
        "GET" => build_view(),
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

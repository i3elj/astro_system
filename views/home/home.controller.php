<?php

function HomeController()
{
    match ($_SERVER["REQUEST_METHOD"]) {
        "GET" => build_view(),
        default => badrequest(),
    };
}

function build_view()
{
    $title = "Astro System";
    require_once_style('views/home/home.style.css');
    require_once_script('views/home/home.main.js');
    require_once 'views/home/home.view.php';
    exit();
}

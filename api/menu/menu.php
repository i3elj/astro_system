<?php

namespace API\Menu;

function Controller()
{
    match ($_SERVER["REQUEST_METHOD"]) {
        "GET" => response(),
        default => badrequest(),
    };
}

function response()
{
    header('Content-Type: application/json');
    echo json_encode(load_db()['menu']);
    exit();
}

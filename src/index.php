<?php

require("lib/extras.php");

$parsed_uri = parse_url($_SERVER["REQUEST_URI"]);

match ($parsed_uri['path']) {
    '/' => require_once('views/home/index.php'),
    '/pedido/editar' => require_once('views/pedido/index.php'),
    default => notfound(),
};

function notfound()
{
    http_response_code(404);

    require_once('views/notfound.php');

    die();
}

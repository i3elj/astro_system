<?php

function HomeController()
{
    match ($_SERVER["REQUEST_METHOD"]) {
        "GET" => build_view(),
        default => badrequest(),
    };
}


// TODO: this must be built in the front-end
function add_pedido()
{
    $last_id = get_last_pedido_id();
    add_pedidos_to_db([
        "id" => is_null($last_id) ? 0 : (int)$last_id + 1,
        "nome" => $_POST["nome"],
        "quantidade" => $_POST["quantidade"],
        "custo" => get_custo($_POST["nome"], (int)$_POST["quantidade"]),
        "hora" => date("H:i"),
        "status" => "Na fila"
    ]);
    build_view();
}

function get_custo(string $nome_do_prato, int $quantidade): int
{
    $pedidos = load_db()["pedidos"];
    foreach ($pedidos as $pedido) {
        if ($pedido["nome"] == $nome_do_prato) {
            return (int)$pedido["custo"] * $quantidade;
        }
    }
}

function build_view()
{
    $title = "Astro System";
    require_once_style('views/home/home.style.css');
    require_once_script('views/home/home.main.js');
    require_once 'views/home/home.view.php';
    exit();
}

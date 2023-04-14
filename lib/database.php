<?php

// function save_db() {}

function load_db()
{
    return json_decode(file_get_contents("../db.json"), true);
}

function get_price_list()
{
    $menu = load_db()["menu"];
    $price_list = [];
    foreach ($menu as $item) {
        $price_list[$item["nome"]] = $item["custo"];
    }
    return json_encode($price_list);
}

// TODO: must be built on the client
function query_by_id(int $id): array | null
{
    $pedidos = load_db()["pedidos"];
    $found = null;
    for ($i = 0; $i < sizeof($pedidos); $i++)
        if ((int)($pedidos[$i])["id"] == $id) $found = $pedidos[$i];
    return $found;
}

function get_last_pedido_id()
{
    return end(load_db()["pedidos"])["id"];
}

function add_pedidos_to_db($pedido)
{
    $database = load_db();
    array_push($database["pedidos"], $pedido);
    file_put_contents("../db.json", json_encode($database));
}

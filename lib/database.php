<?php

namespace Database;

function load_db()
{
    return json_decode(file_get_contents("db.json"), true);
}

function get_price_list(): array
{
    $menu = load_db()['restaurants'][0]["menu"];
    $price_list = [];
    foreach ($menu as $item) {
        $price_list[$item["name"]] = $item["price"];
    }
    return $price_list;
}

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

function add_pedidos_to_db(array $order, int $table_id)
{
    $database = load_db();

    array_push(
        $database['restaurants'][0]['tables'][$table_id - 1]['orders'],
        $order
    );

    file_put_contents("db.json", json_encode($database));
}

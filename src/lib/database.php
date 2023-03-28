<?php
function get_db_content()
{
    return json_decode(file_get_contents("../db.json"), true);
}

function query_by_id(int $id): array | null
{
    $pedidos = get_db_content()["pedidos"];
    $found = null;
    for ($i = 0; $i < sizeof($pedidos); $i++)
        if ((int)($pedidos[$i])["id"] == $id) $found = $pedidos[$i];
    return $found;
}

function add_pedidos_to_db($pedido)
{
    $database = get_db_content();
    array_push($database["pedidos"], $pedido);
    file_put_contents("../db.json", json_encode($database));
}

<?php
function get_db_content()
{
    $database = file_get_contents("./db.json");
    return json_decode($database, true);
}

function add_pedidos_to_db($pedido)
{
    $database = get_db_content();
    array_push($database["pedidos"], $pedido);
    file_put_contents("./db.json", json_encode($database));
}

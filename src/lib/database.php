<?php
function get_db_content()
{
    return json_decode(file_get_contents("../db.json"), true);
}

function add_pedidos_to_db($pedido)
{
    $database = get_db_content();
    array_push($database["pedidos"], $pedido);
    file_put_contents("../db.json", json_encode($database));
}

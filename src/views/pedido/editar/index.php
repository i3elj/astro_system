<?php

require("lib/database.php");

$id_was_sent = strlen($_GET["id"]) > 0;

if ($id_was_sent) {
    $pedido = query_by_id((int)$_GET["id"]);
    $nome = $pedido["nome"];
    $quantidade = $pedido["quantidade"];
    require_once("editarPedido.view.php");
} else {
    require_once("views/notfound.php");
}

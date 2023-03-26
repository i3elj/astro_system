<?php

require_once("lib/database.php");

/**
 * @param string $nome_do_prato
 * @param int $quantidade
 */
function get_custo($nome_do_prato, $quantidade)
{
    return match ($nome_do_prato) {
        "Surubim" => 128.50 * $quantidade,
        "Carne de Sol" => 88.80 * $quantidade,
        "Nego D'agua" => 60.00 * $quantidade,
        "Cangaceiro" => 92.50 * $quantidade,
        "Camarao na Moranga" => 210 * $quantidade,
        default => 0.00,
    };
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    add_pedidos_to_db([
        "nome" => $_POST["nome"],
        "quantidade" => $_POST["quantidade"],
        "custo" => get_custo($_POST["nome"], (int)$_POST["quantidade"]),
        "hora" => date("H:i"),
        "status" => "Na fila"
    ]);
}

$db = get_db_content();
$pedidos = $db["pedidos"];

require_once('home.view.php');

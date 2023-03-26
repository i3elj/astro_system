<!DOCTYPE html>
<html>

<head>
    <title>Astro System</title>
    <link rel="stylesheet" href="./style.css">
</head>

<?php
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

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

/**
 * @param string $nome_do_prato
 * @param int $quantidade
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
    array_push($pedidos, [
        "nome" => $_POST["nome"],
        "quantidade" => $_POST["quantidade"],
        "custo" => get_custo($_POST["nome"]),
        "hora" => date("H:i"),
        "status" => "Na fila"
    ]);
}
?>

<body>
    <main>
        <h1>Mesa 01</h1>
        <table>
            <tr>
                <th>Prato</th>
                <th>Quant.</th>
                <th>Preço</th>
                <th>Horário</th>
                <th>Status</th>
            </tr>
            <?php foreach ($pedidos as $pedido) : ?>
                <tr>
                    <td><?= $pedido["nome"] ?></td>
                    <td><?= $pedido["quantidade"] ?>x</td>
                    <td>R$ <?= $pedido["custo"] ?></td>
                    <td><?= $pedido["hora"] ?></td>
                    <td><?= $pedido["status"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <form action="/" method="POST">
            <div class='inputs'>
                <div class='input-field'>
                    <label for='nome'>Nome do Prato:</label>
                    <input type='text' name='nome' />
                </div>
                <div id='quant-field' class='input-field'>
                    <label for='quantidade'>Quantidade:</label>
                    <input type='number' name='quantidade' />
                </div>
            </div>
            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>

</html>

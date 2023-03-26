<!DOCTYPE html>
<html>

<head>
    <title>Astro System</title>
    <link rel="stylesheet" href="./style.css">
</head>

<?php
function get_custo($nome_do_prato)
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

$pedidos = [
    [
        "nome" => "Surubim",
        "quantidade" => 1,
        "custo" => 128.00,
        "hora" => "12:00",
        "status" => "Em preparo"
    ],
    [
        "nome" => "Nego d'agua",
        "quantidade" => 1,
        "custo" => 60.00,
        "hora" => "12:00",
        "status" => "Em preparo"
    ],
    [
        "nome" => "Carne de Sol",
        "quantidade" => 1,
        "custo" => 88.00,
        "hora" => "12:00",
        "status" => "Em preparo"
    ]
];

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

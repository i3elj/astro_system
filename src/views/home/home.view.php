<!DOCTYPE html>
<html>

<head>
    <title>Astro System</title>
    <link rel="stylesheet" href="../public/style.css">
</head>

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

<!DOCTYPE html>
<html>

<head>
    <title>Astro System</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Mesa 01</h1>
    <table>
        <tr>
            <th>Prato</th>
            <th>Quant.</th>
            <th>Preço</th>
            <th>Horário</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>Surubim</td>
            <td>1x</td>
            <td>R$ 128,00</td>
            <td>12:00</td>
            <td>Em Preparo</td>
        </tr>
    </table>
    <form>
        <div class='inputs'>
            <div class='input-field'>
                <label for='nome'>Nome do Prato:</label>
                <input type='text' name='nome' />
            </div>
            <div class='input-field'>
                <label for='quantidade'>Quantidade:</label>
                <input type='nuber' name='quantidade' />
            </div>
        </div>
        <button>Adicionar</button>
    </form>
    <?php echo "hello" ?>
</body>

</html>

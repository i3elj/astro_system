<head>
  <title><?= $title ?></title>
</head>

<body>
  <main>
    <h1>Mesa 01</h1>
    <table id="orderList">
      <tr>
        <th>Prato</th>
        <th>Quant.</th>
        <th>Preço</th>
        <th>Horário</th>
        <th>Status</th>
        <th>Mais Ações</th>
      </tr>
      <?php foreach ($pedidos as $i => $pedido) : ?>
        <tr>
          <td><?= $pedido["nome"] ?></td>
          <td><?= $pedido["quantidade"] ?>x</td>
          <td>R$ <?= $pedido["custo"] ?></td>
          <td><?= $pedido["hora"] ?></td>
          <td><?= $pedido["status"] ?></td>
          <td><a href="/pedido/editar?id=<?= $i ?>">Editar</a></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <form>
      <div class='inputs'>
        <div class='input-field'>
          <label for='name'>Nome do Prato:</label>
          <input id="name" type='text' name='name' />
        </div>
        <div id='quant-field' class='input-field'>
          <label for='amount'>Quantidade:</label>
          <input id="amount" type='number' name='amount' />
        </div>
      </div>
      <button type="button" onclick="addItem('nome', 'quantidade')">Adicionar</button>
    </form>
  </main>
</body>

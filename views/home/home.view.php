<head>
  <title><?= $title ?></title>
</head>

<body>
  <div id="tableList">
    <h3>Mesas</h3>
    <ul>
      <?php foreach ($tables as $table) : ?>
        <li>
          <a href='/table/<?= $table["id"] ?>'>
            Mesa <?= $table["id"] ?>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
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
    </table>

    <script>
      OrderList.init()
    </script>

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
      <button type="button" onclick="OrderList.addOrder()">Adicionar</button>
    </form>
  </main>
</body>

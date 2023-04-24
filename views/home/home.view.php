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
    <?php if ($params != null) : ?>
      <div>
        <h1 class="title">Mesa <?= $selected_table["id"] ?></h1>
        <table id="orderList">
          <tr>
            <th>Prato</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Horário</th>
            <th>Status</th>
            <th>Mais Ações</th>
          </tr>

          <?php foreach ($selected_table["orders"] as $order) : ?>
            <tr>
              <td class="table-dishName"><?= $order["dishName"] ?></td>
              <td class="table-quantity"><?= $order["quantity"] ?>x</td>
              <td class="table-price">R$ <?= $order["price"] ?></td>
              <td class="table-hour"><?= $order["hour"] ?></td>
              <td class="table-status"><?= $order["status"] ?></td>
            </tr>
          <?php endforeach ?>

          <tr>
            <?php $action_url = "/table/" . $selected_table['id']; ?>
            <form action=<?= $action_url ?> method="POST">
              <td colspan="2" class="td-input">
                <input id="name" type='text' name='dishName' />
              </td>
              <td colspan="2" class="td-input">
                <input id="amount" type='number' name='amount' />
              </td>
              <td colspan="2" class="td-input">
                <button type="submit">Adicionar</button>
              </td>
          </tr>
          </form>
        </table>
      </div>
    <?php endif ?>

  </main>
</body>

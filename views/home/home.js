class OrderList {
  /**
   * Used to load the menu from the database
   */
  async fetch_menu() {
    if (sessionStorage.getItem('menu') == null) {
      const response = await fetch('http://localhost:3000/api/menu');
      const menu = await response.json();
      sessionStorage.setItem('menu', JSON.stringify(menu));
    }
  }

  /**
   * Save the order to the sessionStorage inside a custom json string.
   *
   * @param {number} table_id The Id of the current selected table
   * @param order             The latest order added to the queue
   * @param order.name        The name of the dish
   * @param order.amount      How many of those the client ordered
   * @param order.price       Self-explanatory
   * @param order.datetime    The moment the order was added to the queue
   * @param order.status      The status of the order regarding the queue
   *
   * @return void
   */
  save_order(table_id, order) {
    let orders_queue = localStorage.getItem('orders-queue')

    if (orders_queue == null) {
      localStorage.setItem('orders-queue', JSON.stringify([order]))
    } else {
      let orders_queue_json = JSON.parse(orders_queue)
      orders_queue_json.push(order)
      localStorage.setItem('orders-queue', JSON.stringify(orders_queue_json))
    }
  }

  /**
   * @param {string} nome
   * @param {string} quantidade
   *
   * @return {void}
   */
  async add_order(table_id) {
    let name = document.getElementById('name').value;
    let amount = Number(document.getElementById('amount').value);

    await this.fetch_menu()

    const menu = JSON.parse(sessionStorage.getItem('menu'));

    let dish = {};
    for (var i = 0; i < menu.length; i++)
      if (menu[i].name == name) dish = menu[i]

    const datetime = new Date()
      .toLocaleTimeString('pt-BR', { hour: "numeric", minute: "numeric" });

    this.add_order_to_table(1, {
      name: name,
      amount: amount,
      price: amount * dish.price,
      datetime: datetime,
      status: "Na Fila"
    });
  }

  /**
   * @param {number} table_id
   * @param {any}    order
   */
  add_order_to_table(table_id, order) {
    document.getElementById('orderList').innerHTML += `
    <tr>
      <td>${order.name}</td>
      <td>${order.amount}</td>
      <td>R$ ${order.price}</td>
      <td>${order.datetime}</td>
      <td>${order.status}</td>
    </tr>
    `
    this.save_order(table_id, order);
  }
}

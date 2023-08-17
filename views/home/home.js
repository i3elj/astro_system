class OrderList {
  /**
   * Initializes the order list of the last session
   */
  static init() {
    const ordersQueue = localStorage.getItem('orders-queue');

    if (ordersQueue) {
      const orders = JSON.parse(ordersQueue);

      for (let i = 0; i < orders.length; i++) {
        document.getElementById('orderList').innerHTML += `
        <tr>
          <td>${orders[i].name}</td>
          <td>${orders[i].amount}</td>
          <td>R$ ${orders[i].price}</td>
          <td>${orders[i].datetime}</td>
          <td>${orders[i].status}</td>
        </tr>
        `
      }
    }
  }

  /**
   * Used to load the menu from the database
   */
  static async fetchMenu() {
    if (sessionStorage.getItem('menu') == null) {
      const response = await fetch('http://localhost:3000/api/menu');
      const menu = await response.json();
      sessionStorage.setItem('menu', JSON.stringify(menu));
    }
  }

  /**
   * Save the order to the sessionStorage inside a custom json string.
   *
   * @param order             The latest order added to the queue
   * @param order.name        The name of the dish
   * @param order.amount      How many of those the client ordered
   * @param order.price       Self-explanatory
   * @param order.datetime    The moment the order was added to the queue
   * @param order.status      The status of the order regarding the queue
   *
   * @return void
   */
  static saveOrder(order) {
    let ordersQueue = localStorage.getItem('orders-queue')

    if (ordersQueue == null) {
      localStorage.setItem('orders-queue', JSON.stringify([order]))
    } else {
      let ordersQueueJson = JSON.parse(ordersQueue)
      ordersQueueJson.push(order)
      localStorage.setItem('orders-queue', JSON.stringify(ordersQueueJson))
    }
  }

  /**
   * @param {string} nome
   * @param {string} quantidade
   *
   * @return {void}
   */
  static async addOrder() {
    let name = document.getElementById('name').value;
    let amount = Number(document.getElementById('amount').value);

    await this.fetchMenu()

    const menu = JSON.parse(sessionStorage.getItem('menu'));

    let dish = {};
    for (var i = 0; i < menu.length; i++)
      if (menu[i].name == name) dish = menu[i]

    const datetime = new Date()
      .toLocaleTimeString('pt-BR', { hour: "numeric", minute: "numeric" });

    this.addOrderToTable({
      name: name,
      amount: amount,
      price: amount * dish.price,
      datetime: datetime,
      status: "Na Fila"
    });
  }

  /**
    * @param order             The latest order added to the queue
    * @param order.name        The name of the dish
    * @param order.amount      How many of those the client have ordered
    * @param order.price       Self-explanatory
    * @param order.datetime    The moment the order was added to the queue
    * @param order.status      The status of the order regarding the queue
    *
    * @return void
    */
  static addOrderToTable(order) {
    document.getElementById('orderList').innerHTML += `
    <tr>
      <td>${order.name}</td>
      <td>${order.amount}</td>
      <td>R$ ${order.price}</td>
      <td>${order.datetime}</td>
      <td>${order.status}</td>
    </tr>
    `
    this.saveOrder(order);
  }
}

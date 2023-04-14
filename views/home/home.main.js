const url = "http://localhost:3000"

/**
 * @param {string} nome
 * @param {string} quantidade
 *
 * @return {void}
 */
async function fetchMenu() {
  if (sessionStorage.getItem('menu') == null) {
    const response = await fetch(`${url}/api/menu`);
    const menu = await response.json();
    sessionStorage.setItem('menu', JSON.stringify(menu));
  }
}

/**
 * @param {string} nome
 * @param {string} quantidade
 *
 * @return {void}
 */
function addItem(nome, quantidade) {
  let name = document.getElementById('name').value;
  let amount = Number(document.getElementById('amount').value);

  fetchMenu();

  const menu = JSON.parse(sessionStorage.getItem('menu'));

  let dish = {};
  for (var i = 0; i < menu.length; i++)
    if (menu[i].name == name) dish = menu[i];

  const price = amount * dish.price;
  const date = new Date();
  const datetime = date.getHours();
  const status = "Na Fila";

  addToTable(name, amount, price, datetime, status);
}

/**
 * @param {string} name
 * @param {number} amount
 * @param {number} price
 * @param {Date} datetime
 * @param {string} status
 */
function addToTable(name, amount, price, datetime, status) {
  let table = document.getElementById('orderList')
  table.innerHTML += `
    <tr>
      <td>${name}</td>
      <td>${amount}</td>
      <td>${price}</td>
      <td>${datetime}</td>
      <td>${status}</td>
    </tr>
    `
}

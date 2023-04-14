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

  async function addItem(nome, quantidade) {
    // let nomeValue = document.getElementById(nome).value
    // let quantidadeValue = document.getElementById(quantidade).value

    const pricelist = await fetch(`${url}/v1/api/pricelist`)
    console.log(pricelist.json())

    // addToTable(nomeValue, quantidadeValue, )
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


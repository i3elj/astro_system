function addItem() {
	const name = document.querySelector('input[name="name"]')
	const amount = document.querySelector('input[name="amount"]')
	const price = document.querySelector('input[name="price"]')

	const table = document.getElementsByTagName('tbody')[0]

	const newItem = `
		<tr class='tableRow'>
			<td class='tableBorder tableCell'>${name.value}</td>
			<td class='tableBorder tableCell'>${amount.value}</td>
			<td class='tableBorder tableCell'>${price.value}</td>
			<td class='tableBorder tableCell'>
				<button>Editar</button>
				<button>Excluir</button>
			</td>
		</tr>
	`

	table.innerHTML += newItem
}

window.addItem = addItem

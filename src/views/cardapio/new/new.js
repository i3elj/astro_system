function addItem() {
	const name = document.querySelector('input[name="name"]')
	const amount = document.querySelector('input[name="amount"]')
	const price = document.querySelector('input[name="price"]')

	const table = document.getElementById('ingredientsTable')

	const newItem = `
		<div class='tableRow'>
			<div class='tableCell'>
				<p>${name.value}</p>
			</div>
			<div class='tableCell'>
				<p>${amount.value}</p>
			</div>
			<div class='tableCell'>
				<p>R$ </p>
				<p>${price.value}</p>
			</div>
			<div class='tableCell'>
				<button class='button'>Editar</button>
				<button class='button'>Excluir</button>
			</div>
		</div>
	`

	table.innerHTML += newItem
}

window.addItem = addItem

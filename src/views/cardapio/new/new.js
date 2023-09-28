function loadIngredientsInMemory() {
	let ingredients = []
	document.querySelectorAll('.itemRow').forEach(el => {
		ingredients.push({
			name: el.children[0].innerText,
			amount: el.children[1].innerText,
			price: el.children[2].children[1].innerText
		})
	})

	sessionStorage.setItem('ingredients', JSON.stringify(ingredients))
}

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

/**
 * @param {number} index The ingredient's index
 * @return {void}
 */
function requestEdition(index) {
	const inputs = {
		name: document.querySelectorAll('input[name="name"]')[1],
		amount: document.querySelectorAll('input[name="amount"]')[1],
		price: document.querySelectorAll('input[name="price"]')[1]
	}

	const row = {
		name: document.querySelectorAll('.nameValue')[index],
		amount: document.querySelectorAll('.amountValue')[index],
		price: document.querySelectorAll('.priceValue')[index]
	}

	inputs.name.value = row.name.innerText
	inputs.amount.value = row.amount.innerText
	inputs.price.value = row.price.innerText

	document.querySelector('#addInputWrapper').style.display = 'none'
	document.querySelector('#editInputWrapper').style.display = 'flex'

	saveItem(index, inputs, row)
}

/**
 * @param {number} index The ingredient's index
 * @param {Object} inputs All inputs for editing the row
 * @param {Object} row Elements from the row
 * @return {void}
 */
function saveItem(index, inputs, row) {
	const saveButton = document.querySelector('.saveButton')
	saveButton.onclick = ev => {
		row.name.innerText = inputs.name.value
		row.amount.innerText = inputs.amount.value
		row.price.innerText = inputs.price.value

		document.querySelector('#addInputWrapper').style.display = 'flex'
		document.querySelector('#editInputWrapper').style.display = 'none'
	}
}

document.addEventListener('DOMContentLoaded', loadIngredientsInMemory)

window.addItem = addItem
window.requestEdition = requestEdition

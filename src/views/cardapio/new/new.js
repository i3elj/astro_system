/*
NOTES:
	every ingredient cell must have an eventListener to onchange event. Whenever
	the value changes the 'ingredientes' storage item should be updated at the
	correct location.
*/

/**
 * @param className {string}
 * @param fn {function(Element, number, NodeListOf<Element>): void}
 */
function mapOverHTML(className, fn) {
	document.querySelectorAll(className).forEach((v, k, p) => fn(v, k, p))
}

/**
 * Add eventListeners to every ingredient input field so everytime the user
 * decides to change any ingredient, the memory will be updated.
 *
 * TODO: it can be improved by adding the event listener only when first loading
 * the page and when adding a ingredient to the table.
 */
function addEventListenersToInputField() {
	mapOverHTML('.item_row', function (el, k, p) {
		let row = el.children
		for (let i = 0; i < row.length - 1; i++) {
			let inputField = row[i].children[0]
			inputField.addEventListener('input', loadIngredientsInMemory)
		}
	})
}

/**
 * Traverse every ingredient and loads it into memory
 */
function loadIngredientsInMemory() {
	let ingredients = []

	mapOverHTML('.item_row', function (el) {
		ingredients.push({
			name: el.children[0].children[0].value,
			amount: el.children[1].children[0].value,
			price: el.children[2].children[0].value
		})
	})

	sessionStorage.setItem('ingredients', JSON.stringify(ingredients))
}

/**
 * Returns the json equivalent of loaded ingredients in memory
 */
function loadIngredientsOffMemory() {
	return JSON.parse(sessionStorage.getItem('ingredients'))
}

/**
 * Adds an ingredient to memory json object
 */
function addIngredientToMemory(n, a, p) {
	let ingredients = loadIngredientsOffMemory()
	ingredients.push({ name: n, amount: a, price: p })
	sessionStorage.setItem('ingredients', JSON.stringify(ingredients))
}

/**
 * Adds an ingredient to html table and memory
 */
window.addItem = function () {
	let ingredients = loadIngredientsOffMemory()

	const name = document.querySelector('input[name="name"]').value
	const amount = document.querySelector('input[name="amount"]').value
	const price = document.querySelector('input[name="price"]').value
	const table = document.getElementById('ingredients_table')
	const index = ingredients.length

	const newItem = `
		<div class='table_row item_row'>
			<div class='table_cell'>
				<input class='name_value' value='${name}'/></div>
			<div class='table_cell'>
				<input class='amount_value' value='${amount}'></div>
			<div class='table_cell'>
				<input class='price_value' value='${price}'/></div>
			<div class='table_cell'>
				<button class='button'
					onclick='deleteItem(${index})'>Excluir</button></div>
		</div>
	`

	addIngredientToMemory(name, amount, price)
	table.innerHTML += newItem
	addEventListenersToInputField()
}

// TODO: implement
window.saveItem = () => undefined

document.addEventListener('DOMContentLoaded', function () {
	loadIngredientsInMemory()
	addEventListenersToInputField()
})

let intervalId = setInterval(loadIngredientsInMemory, 10000)
document.addEventListeners('beforeunload', clearInterval(intervalId))

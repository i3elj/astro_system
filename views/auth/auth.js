export async function post(path, form) {
	const formattedData = new URLSearchParams(new FormData(form))
	const res = await fetch(`http://localhost:3000${path}`, {
		method: 'POST',
		body: formattedData
	})

	return await res.json()
}

export function on_success(response) {
	const token = response.token
	const date = new Date()
	date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000)/*a week in ms*/)
	document.cookie = `authToken=${token};expires=${date.toUTCString()}`
	document.location = "http://localhost:3000/dashboard"
}

export function on_error(response) {
	const errorField = document.querySelector('#loginError')
	errorField.innerText = response.message
	errorField.style.color = '#e38585'

	if (response.field != undefined) {
		let field = document.querySelector(`input[name='${response.field}']`)
		field.classList.add("fieldError")
		field.focus()
		field.addEventListener("blur",
			() => field.classList.remove("fieldError"))
	}
}

export function logout() {
	document.cookie = "authToken=a;expires=Thu, 01 Jan 1970 00:00:01 GMT";
	document.location = "http://localhost:3000/login"
}

const auth = {
	on_error,
	on_success,
	post,
	logout
}

export default auth

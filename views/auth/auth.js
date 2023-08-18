export async function post(path, form) {
	const formattedData = new URLSearchParams(new FormData(form))
	const res = await fetch(`http://localhost:3000${path}`, {
		method: 'POST',
		body: formattedData
	})

	return await res.json()
}

export function handle_failed_response(res) {
	const errorField = document.querySelector('#loginError')
	errorField.innerText = res.message;
	errorField.style.color = '#e38585';
	if (res.field != undefined)
		document.querySelector(`input[name='${res.field}']`).focus()
}

export function logout() {
	document.cookie = "authToken=a;expires=Thu, 01 Jan 1970 00:00:01 GMT";
	document.location = "http://localhost:3000/login"
}

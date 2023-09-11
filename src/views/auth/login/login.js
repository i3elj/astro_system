import auth from '../auth.js'

export async function login() {
	const form = document.querySelector('#form')
	const response = await auth.post('/login', form)

	console.log(response.success)
	response.success ? auth.on_success(response) : auth.on_error(response)
}

window.login = login
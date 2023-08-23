import auth from '../auth.js'


let signup_field = document.querySelector("#submitButton")
let checkbox = document.querySelector("#tos")

checkbox.addEventListener('change', function () {
	if (!this.checked) signup_field.disabled = true
	else signup_field.disabled = false
})

export async function signup() {
	const form = document.querySelector("#form")
	const response = await auth.post('/signup', form)

	response.success ? auth.on_success(response) : auth.on_error(response)
}

window.signup = signup

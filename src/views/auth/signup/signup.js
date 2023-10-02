import { authEventListener, onErrorEventListener } from '../auth.js'

let signup_field = document.querySelector('#submitButton')
let checkbox = document.querySelector('#tos')

checkbox.addEventListener('change', function () {
	if (!this.checked) signup_field.disabled = true
	else signup_field.disabled = false
})

authEventListener("signup")
onErrorEventListener()

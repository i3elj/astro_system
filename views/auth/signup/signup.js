import { post, handle_failed_response } from '../auth.js'

let signup_field = document.querySelector("#submitButton")
let checkbox = document.querySelector("#tos")

checkbox.addEventListener('change', function () {
    if (!this.checked) signup_field.disabled = true
    else signup_field.disabled = false
})

export async function signup() {
    const form = document.querySelector("#form")
    const res = await post('/signup', form)

    if (!res.success) {
        handle_failed_response(res)
    } else {

    }
}

window.signup = signup

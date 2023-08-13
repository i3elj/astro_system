async function auth() {
    const email = document.querySelector('input[name="email"]')
    const password = document.querySelector('input[name="password"]')
    const errorField = document.querySelector('#loginError')

    if (email.value == "" || password.value == "")
        return

    const form = document.querySelector('#form')

    const data = new URLSearchParams(new FormData(form))
    const response = await fetch('http://localhost:3000/login', {
        method: 'POST',
        body: data
    })

    const { validEmail, validPassword } = await response.json()

    let errorMessage = "Wrong password!"

    if (!validEmail) {
        email.classList.add('fieldError')
        errorMessage = "Email doesn't exist!"
        email.focus()
    }

    if (!validPassword) password.classList.add('fieldError')
    if (validEmail && !validPassword) password.focus()

    if (!validEmail || !validPassword) {
        errorField.innerHTML = errorMessage
        errorField.style.display = 'initial'
    }
}

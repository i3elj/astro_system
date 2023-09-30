import URI from '../../../../public/lib/uri.js'

document.body.addEventListener("login", e => {
	const response = e.detail
	const token = response.token
	const date = new Date()
	date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000)/*a week in ms*/)
	document.cookie = `authToken=${token};expires=${date.toUTCString()}`
	document.location = `${URI}/dashboard`
})

document.body.addEventListener("onerror", e => {
	const response = e.detail
	let field = document.querySelector(`input[name='${response.field}']`)
	field.classList.add('fieldError')
	field.focus()
	field.addEventListener('blur', _ => field.classList.remove('fieldError'))
})

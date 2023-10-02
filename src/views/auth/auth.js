import URI from "../../../public/lib/uri.js"

export function logout() {
	document.cookie = 'authToken=a;expires=Thu, 01 Jan 1970 00:00:01 GMT';
	document.location = `${URI}/home`
}

const body = document.body

/**
 * This function act's accordingly to HTMX documentation. It's a wrapper for
 * adding an event listener to the <body> tag with a certain `eventName`, set
 * by the caller. This event is called by the back-end using the HX-Trigger
 * header. Php example: `header('HX-Trigger: {"onerror": ' . $response . '}');`
 * where the `$response` is a encoded json object, and the `"onerror"` is the
 * eventName to be triggered. This functions only serves for signing up and
 * loging.
 */
export function authEventListener(eventName) {
	body.addEventListener(eventName, e => {
		const response = e.detail
		const token = response.token
		const date = new Date()
		date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000)/*a week in ms*/)
		document.cookie = `authToken=${token};expires=${date.toUTCString()}`
		document.location = `${URI}/dashboard`
	})
}

/**
 * This functions act similarly to `authenticate()`. The difference is that this
 * function doesn't accept any event name. The event name is fixed. It's
 * "onerror" and nothing else.
 */
export function onErrorEventListener() {
	body.addEventListener("onerror", e => {
		const response = e.detail
		let field = document.querySelector(`input[name='${response.field}']`)
		field.classList.add('fieldError')
		field.focus()
		field.addEventListener('blur', _ =>
			field.classList.remove('fieldError'))
	})
}

const auth = { logout, onErrorEventListener, authEventListener }

export default auth

import URI from "../../../public/lib/uri.js"

export function logout() {
	document.cookie = 'authToken=a;expires=Thu, 01 Jan 1970 00:00:01 GMT';
	document.location = `${URI}/home`
}

const auth = {
	logout
}

export default auth

import { post, handle_failed_response } from '../auth.js'

export async function login() {
  const form = document.querySelector('#form')
  const response = await post('/login', form)

  if (response.success) {
    const token = response.token
    const date = new Date()
    date.setTime(date.getTime() + (7 * 24 * 60 * 60 * 1000)/*a week in ms*/)
    document.cookie = `authToken=${token};expires=${date.toUTCString()}`
    document.location = "http://localhost:3000/dashboard"
    return
  }

  handle_failed_response(response)
}

window.login = login

import { authEventListener, onErrorEventListener } from '../auth.js'

authEventListener("login")
onErrorEventListener("onError")

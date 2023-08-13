let signup = document.querySelector("input[type='submit']")
let checkbox = document.querySelector("#tos")

checkbox.addEventListener('change', function () {
    if (!this.checked) signup.disabled = true
    else signup.disabled = false
})

window.addEventListener("load", () => {
	let loadScreen = document.createElement("div")
	loadScreen.classList += "loading"
	loadScreen.style.height = window.innerHeight + "px"
	loadScreen.style.width = window.innerWidth + "px"

	document.getElementsByTagName("body")[0].appendChild(loadScreen)
})


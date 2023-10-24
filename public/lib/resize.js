function resize(event) {
	const mainContent = document.querySelector("#content_wrapper")
	const viewport = window.innerHeight
	const offset = mainContent.offsetTop
	mainContent.style.height = `${viewport - offset - 42}px`
}

window.addEventListener("resize", resize)
window.addEventListener("load", resize)

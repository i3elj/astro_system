window.addEventListener("resize", resize)
window.addEventListener("load", resize)

function resize(event) {
	const mainContent = document.querySelector("#mainContent")
	const viewport = window.innerHeight
	const offset = mainContent.offsetTop
	mainContent.style.height = `${viewport - offset - 22}px`
}

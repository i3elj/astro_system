<?php
require_once "views/partials/head.php";
require_once "views/partials/navbar.php"
?>

<!DOCTYPE html>
<html>

<?= Tags\head(
	title: "Astro System - Dashboard",
	styles: ["views/dashboard/dashboard.style.css"]
) ?>

<body>
	<?php if ($auth_token) : ?>
		<?= Tags\navbar($auth_token, $this->path) ?>
		<h1>Hey, you're logged in! Neat</h1>
		<button onclick="logout()">Log out</button>
	<?php else : ?>
		<script type="text/javascript">
			document.location = "http://localhost:3000/login"
		</script>
	<?php endif; ?>
</body>

<script type="module" src="views/dashboard/dashboard.js"></script>

</html>

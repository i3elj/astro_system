<?php
require_once "views/partials/head.php";
require_once "views/partials/navbar.php"
?>

<!DOCTYPE html>
<html>

<?= Tags\head(
	title: 'Astro System - Mesas',
	styles: ['views/mesas/mesas.style.css']
) ?>

<body>
	<?= Tags\navbar($auth_token, $this->path) ?>
	<h1>Hello from Mesas</h1>
</body>

<script type='text/javascript' src='views/mesas/mesas.js'></script>

</html>

<?php
require_once 'src/views/partials/head.php';
require_once 'src/views/partials/navbar.php'
?>

<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: 'Astro System - Dashboard',
	styles: ['/src/views/dashboard/dashboard.style.css']
) ?>

<body>
	<?= \Tags\navbar($is_logged, $this->path) ?>
	<h1>Hey, you're logged in! Neat</h1>
	<button onclick='logout()'>Log out</button>
</body>

<script type='module' src='/src/views/dashboard/dashboard.js'></script>

</html>

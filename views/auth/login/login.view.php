<!DOCTYPE html>
<html>

<?= \Tags\head(
	title: "Astro System - Login",
	styles: ['views/auth/auth.style.css']
) ?>

<body>
	<?= \Tags\navbar($auth_token, $path) ?>
	<main id="authContainer">
		<h1>Login</h1>
		<p id="loginError">Vazio</p>
		<form id="form" onsubmit="login(); return false">
			<input class="inputField" type="email" name="email" placeholder="Type your email" required />
			<input class="inputField" type="password" name="password" placeholder="Type your password" required />
			<input id="submitButton" type="submit" value="Authenticate" />
		</form>
	</main>
</body>

<script type="module" src="views/auth/login/login.js"></script>

</html>

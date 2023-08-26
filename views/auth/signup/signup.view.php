<!DOCTYPE html>
<html>

<?= Tags::head(
	title: 'Astro System - SignUp',
	styles: ['views/auth/auth.style.css']
) ?>

<body>
	<div id="authContainer">
		<h1>Sign Up</h1>
		<p id="loginError">Vazio</p>
		<form id="form" method="POST" onsubmit="signup(); return false">
			<input
				class="inputField"
				type="text"
				name="nickname"
				placeholder="Choose a nickname"
				required
			/>
			<input
				class="inputField"
				type="text"
				name="realname"
				placeholder="Real (full) name"
				required
			/>
			<div class="row">
				<input
					class="inputField"
					type="text"
					name="cpf"
					placeholder="CPF ex.000.111.222-33"
					pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}"
					maxlength="14"
					onfocus="this.select()"
					required
				/>
				<input
					class="inputField"
					type="tel"
					name="phonenumber"
					placeholder="+55 (33)91111-2222"
					pattern="\+[0-9]{2} \([0-9]{2}\)[0-9]{5}-[0-9]{4}"
					onfocus="this.select()"
					required
				/>
			</div>
			<div class="row">
				<input
					class="inputField"
					type="email"
					name="email"
					placeholder="Type your email"
					required
				/>
				<input
					class="inputField"
					type="email"
					placeholder="Confirm your email"
					required
				/>
			</div>
			<div class="row">
				<input
					class="inputField"
					type="password"
					name="password"
					placeholder="Type your password"
					required
				/>
				<input
					class="inputField"
					type="password"
					placeholder="Confirm your password"
					required
				/>
			</div>

			<div id="termsOfServiceContainer">
				<input id="tos" type="checkbox" name="tos" value="yes" />
				<label for="tos">I agree with the Terms of Service</label>
			</div>

			<input
				id="submitButton"
				type="submit"
				value="Sign"
				disabled
			/>
		</form>
	</div>

	<script type="module" src="views/auth/signup/signup.js"></script>

</body>

</html>

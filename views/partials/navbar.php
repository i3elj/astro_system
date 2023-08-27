<?php

namespace Tags;

function navbar($token, $path)
{ ?>
	<style>
		.navbar {
			display: flex;
			padding: 20px 34px;
			justify-content: space-between;
			align-items: center;
			align-self: stretch;
			border-bottom: 0.5px solid #2B2B2B;
			background: #F8F8F8;
		}

		.navbar-links {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 44px;
			height: 38px;
		}

		.logout {
			all: unset;
			font-size: 18px;
		}

		.profile {
			all: unset;
			height: 30px;
		}

		.navbar-buttons {
			display: flex;
			padding-top: 8px;
			justify-content: center;
			align-items: center;
			gap: 24px;
			height: 100%;
		}

		.link-container {
			display: flex;
			flex-direction: column;
			align-items: flex-start;
			padding-bottom: 8px;
		}

		.link-container>a {
			color: black;
			font-size: 18px;
		}

		.active {
			border-bottom: 2px solid black;
			margin-bottom: -2px;
		}
	</style>
	<nav class='navbar'>
		<a href="/" class='navbar-logo h2'>Astro</a>
		<div class='navbar-links'>

			<?php if (strlen($token) > 0) : ?>

				<div class='navbar-buttons'>
					<div class='link-container <?= $path == '/caixa' ? 'active' : null ?>'>
						<a href='/caixa'>Fechar Caixa</a>
					</div>

					<div class='link-container <?= $path == '/mesas' ? 'active' : null ?>'>
						<a href='/mesas'>Mesas</a>
					</div>

					<div class='link-container <?= $path == '/contabilidade' ? 'active' : null ?>'>
						<a href='/contabilidade'>Contabilidade</a>
					</div>

					<div class='link-container <?= $path == '/menu' ? 'active' : null ?>'>
						<a href='/menu'>Menu</a>
					</div>
				</div>

				<div class='vertical-line'></div>
				<button class='logout btn' onclick='logout()'>
					Log out
				</button>

				<a style='height: 30px' href='/profile' title="Profile Settings">
					<?= \Icons\Profile() ?>
				</a>

			<?php else : ?>

				<a href='/signup'>Sign Up</a>
				<a href='/login'>Log In</a>

			<?php endif; ?>
		</div>
	</nav>
<?php }

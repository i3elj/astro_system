<?php

namespace Signup;

require_once 'src/services/DatabaseConnection.php';

class Model
{
	use \Services\Database\Connection;

	/**
	 * Check if the provided user exists or not, based on it's unique id.
	 *
	 * @param string $cpf User's unique id.
	 * @return bool True if the user exists, false otherwise.
	 */
	protected function user_exist($cpf)
	{
		$rows = $this->queryReturn(
			'SELECT 1 FROM users WHERE cpf = ?;',
			[$cpf]
		);

		return sizeof($rows) == 1;
	}

	/**
	 * Create a new account for the user.
	 *
	 * @param array $user All the values which are necessary to register the
	 * user.
	 *
	 * 	- cpf, nickname, real name, email, password, token and phone_number.
	 *
	 * @return void
	 */
	protected function register($user)
	{
		$this->query(
			"INSERT INTO users(
				cpf, nickname,
				real_name, email,
				password, auth_token,
				phone_number, permissions, role
			) VALUES (?, ?, ?, ?, ?, ?, ?, 'superuser', 'owner');",
			$user
		);
	}
}

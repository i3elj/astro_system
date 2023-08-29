<?php

namespace Services;

trait Auth
{
	use \Database\Connection;

	/**
	 * Check if the provided email exists or not.
	 *
	 * @param string $email User's email
	 * @return bool True if the email is correct, false otherwise
	 */
	protected function checkEmail($email)
	{
		$rows = $this->queryReturn(
			"SELECT email FROM users WHERE email = ?;",
			[$email]
		);

		return sizeof($rows) == 1;
	}

	/**
	 * Check if the provided password exists or not.
	 *
	 * @param string $pwd User's password
	 * @param string $email User's email
	 * @return bool True if the password is correct, false otherwise
	 */
	protected function checkPassword($pwd, $email)
	{
		$rows = $this->queryReturn(
			"SELECT password FROM users WHERE email = ?;",
			[$email]
		);

		$db_pwd = $rows[0]['password'];
		return password_verify($pwd . $email, $db_pwd);
	}

	/**
	 * Check if the provided token is valid.
	 *
	 * @param string $token User's token
	 * @return bool True if the token exists, false otherwise.
	 */
	protected function is_authenticated($token): bool
	{
		$rows = $this->queryReturn(
			"SELECT auth_token FROM users WHERE auth_token = ?;",
			[$token]
		);

		return sizeof($rows) == 1;
	}

	/**
	 * Authenticate the user if the password and email are valid.
	 *
	 * @param string $pwd User's password
	 * @param string $email User's email
	 * @return string If authentication is successful it returns the user auth
	 * token
	 */
	protected function logUser($pwd, $email)
	{
		$rows = $this->queryReturn(
			"SELECT cpf, auth_token, password FROM users WHERE email = ?;",
			[$email]
		);

		$user_data = $rows[0];
		$new_auth_token = $this->updateAuthToken($user_data['cpf']);

		return $this->checkPassword($pwd, $email)
			? $new_auth_token
			: "Wrong Password!";
	}

	/**
	 * It updates the auth token of the user based on the current time.
	 *
	 * @param string $cpf A user unique identification key.
	 * @return string An Auth Token
	 */
	private function updateAuthToken($cpf)
	{
		$date = date("m/d/Y h:i:s a", time());
		$new_auth_token = password_hash($cpf . $date, PASSWORD_ARGON2I);

		$this->query(
			"UPDATE users SET auth_token = ? WHERE cpf = ?;",
			[$new_auth_token, $cpf]
		);

		return $new_auth_token;
	}
}

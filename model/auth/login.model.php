<?php

class LoginModel extends DatabaseModel
{
	/**
	 * @param string $email User's email
	 *
	 * @return bool True if the email is correct, false otherwise
	 */
	protected function checkEmail(string $email): bool
	{
		$rows = $this->queryReturn(
			"SELECT email FROM users WHERE email = ?;",
			[$email]
		);

		return sizeof($rows) == 1;
	}

	/**
	 * @param string $pwd User's password
	 * @param string $email User's email
	 *
	 * @return bool True if the password is correct, false otherwise
	 */
	protected function checkPassword(string $pwd, string $email): bool
	{
		$rows = $this->queryReturn(
			"SELECT password FROM users WHERE email = ?;",
			[$email]
		);

		$db_pwd = $rows[0]['password'];
		return password_verify($pwd . $email, $db_pwd);
	}

	/**
	 * @param string $pwd User's password
	 * @param string $email User's email
	 *
	 * @return If authentication is successful it returns the user auth token
	 */
	protected function logUser(string $pwd, string $email): string
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
	 * @param string $cpf
	 *
	 * @return string An Auth Token
	 */
	private function updateAuthToken(string $cpf): string
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

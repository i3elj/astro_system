<?php

class SignUpModel extends DatabaseModel
{
	protected function user_exist(string $cpf): bool
	{
		$stmt = $this->connect()->prepare(
			"SELECT 1 FROM users WHERE cpf = ?"
		);

		$succeeded = $stmt->execute([$cpf]);

		if (!$succeeded) {
			printf("Prepare statement error: " . $stmt);
			$stmt = null;
			exit(1);
		}

		return $stmt->rowCount() == 1;
	}

	protected function register(array $user): void
	{
		$stmt = $this->connect()->prepare(
			"INSERT INTO users(
				cpf,
				nickname,
				real_name,
				email,
				password,
				auth_token,
				phone_number,
				permissions,
				role
			) VALUES (?, ?, ?, ?, ?, ?, ?, 'superuser', 'owner');"
		);

		$succeeded = $stmt->execute($user);

		if (!$succeeded) {
			printf("Prepare statement error: " . $stmt);
			$stmt = null;
			exit(1);
		}
	}
}

<?php

class DatabaseModel
{
	protected function connect(): PDOException | PDO
	{
		$ENV = parse_ini_file('.env');

		$HOST = $ENV["DB_HOST"];
		$PORT = $ENV["DB_PORT"];
		$USER = $ENV["DB_USER"];
		$PWD  = $ENV["DB_PASSWORD"];
		$NAME = $ENV["DB_DATABASE"];

		$dsn =
			'pgsql:host=' . $HOST .
			';port='      . $PORT .
			';dbname='    . $NAME .
			';user='      . $USER .
			';password='  . $PWD;
		$pdo = new PDO($dsn, $USER, $PWD) or throw new PDOException();
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		return $pdo;
	}

	protected function query(string $query_string, array $values): void
	{
		$stmt = $this->connect()->prepare($query_string);

		$succeeded = $stmt->execute($values);

		if (!$succeeded) {
			printf("Prepare statement error: " . $stmt);
			$stmt = null;
			exit(1);
		}
	}

	protected function queryReturn(string $query_string, array $values): array
	{
		$stmt = $this->connect()->prepare($query_string);

		$succeeded = $stmt->execute($values);

		if (!$succeeded) {
			printf("Prepare statement error: " . $stmt);
			$stmt = null;
			exit(1);
		}

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
}

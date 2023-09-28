<?php

namespace Services\Database;

use \PDO;

trait Connection
{

	/**
	 * Connects to a database
	 *
	 * @return PDO | PDOException
	 */
	protected function connect()
	{
		$ENV = parse_ini_file('.env');

		$DB = $ENV['DB'];
		return match ($DB) {
			"postgres" => $this->pgsql_connect($ENV),
			"sqlite" => $this->sqlite_connect(),
			default => null,
		};
	}

	private function pgsql_connect($ENV)
	{
		$HOST = $ENV['DB_HOST'];
		$PORT = $ENV['DB_PORT'];
		$USER = $ENV['DB_USER'];
		$PWD  = $ENV['DB_PASSWORD'];
		$NAME = $ENV['DB_NAME'];

		$dsn = "pgsql:host=$HOST;port=$PORT;dbname=$NAME;user=$USER;password=$PWD";

		$pdo = new \PDO($dsn, $USER, $PWD) or throw new \PDOException();
		$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

		return $pdo;
	}

	private function sqlite_connect()
	{
		$pdo = new \PDO("sqlite:database.sql");
		$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

		return $pdo;
	}

	/**
	 * Runs a query in the database.
	 *
	 * @param string $query_string The query you want to run
	 * @param array $values All the values the query needs
	 * @return void
	 */
	protected function query($query_string, $values = [])
	{
		$stmt = $this->connect()->prepare($query_string);

		$succeeded = $stmt->execute($values);

		if (!$succeeded) {
			printf('Prepare statement error: ' . $stmt);
			$stmt = null;
			exit(1);
		}
	}

	/**
	 * Runs a query in the database and return the affected rows.
	 *
	 * @param string $query_string The query you want to run
	 * @param array $values All the values the query needs
	 * @return array
	 */
	protected function query_return($query_string, $values = [])
	{
		$stmt = $this->connect()->prepare($query_string);

		$succeeded = $stmt->execute($values);

		if (!$succeeded) {
			printf('Prepare statement error: ' . $stmt);
			$stmt = null;
			exit(1);
		}

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
}

<?php

require_once 'src/services/DatabaseConnection.php';
require_once 'lib/extras.php';

class SQLiteMigrations
{
	use \Services\DatabaseConnection;

	public function InitDatabase()
	{
		$this->CreateTables();
		$this->PopulateTables();
	}

	private function CreateTables()
	{
		$tables = [
			'users' => "CREATE TABLE users (
				cpf             TEXT PRIMARY KEY,
				nickname        TEXT NOT NULL,
				real_name       TEXT NOT NULL,
				email           VARCHAR NOT NULL,
				password        TEXT NOT NULL,
				auth_token      TEXT NOT NULL,
				phone_number    TEXT,
				permissions     TEXT,
				role TEXT NOT NULL
			);",
			'dishes' => " CREATE TABLE dishes (
				id              INTEGER PRIMARY KEY,
			    fk_user         TEXT NOT NULL,
			    name            TEXT NOT NULL,
			    cost            DECIMAL(10,2),
			    ingredients     TEXT NOT NULL
			);",
			'ingredients' => " CREATE TABLE ingredients (
			    id   INTEGER PRIMARY KEY,
			    name TEXT NOT NULL
			);",
			'tables' => " CREATE TABLE tables (
			    id              INTEGER PRIMARY KEY,
			    location        TEXT,
			    is_reserved     BOOLEAN NOT NULL,
			    is_occupied     BOOLEAN NOT NULL,
			    status          TEXT NOT NULL,
			    bill DECIMAL(10,2)
			);",
			'orders' => " CREATE TABLE orders (
			    id 				INTEGER PRIMARY KEY,
			    fk_table_id 	INTEGER NOT NULL,
			    fk_ordered_item INTEGER NOT NULL,
			    observations 	TEXT,
			    created_at 		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			    expiration_time TIMESTAMP DEFAULT (datetime('now', '+2 hours')),
			    FOREIGN KEY (fk_table_id) REFERENCES tables(id),
			    FOREIGN KEY (fk_ordered_item) REFERENCES dishes(id)
			);"
		];

		foreach ($tables as $table_name => $table) {
			$stmt = $this->connect()->prepare($table);
			$succeeded = $stmt->execute();

			if (!$succeeded) {
				printf("Prepare statement error: " . $stmt);
				$stmt = null;
				exit(1);
			}

			printf("GENERATING $table_name TABLE...\n");
		}
	}

	private function PopulateTables()
	{
		$date = date('m/d/Y h:i:s a', time());
		$auth_token = password_hash('088.136.004-02' . $date, PASSWORD_ARGON2I);
		$pwd = password_hash('adminad@min', PASSWORD_ARGON2I);
		$queries = [
			'users' => "INSERT INTO users
				 VALUES (
					'088.136.004-02',
					'adm',
					'administrator',
					'ad@min',
					:password,
					:authToken,
					'+55 (33)9111-2222',
					'superuser',
					'admin'
			);",
			'tables' => [
				"INSERT INTO tables VALUES (0,'plaza1',true,false,'aberta',0);",
				"INSERT INTO tables VALUES (1,'plaza1',true,false,'aberta',0);",
				"INSERT INTO tables VALUES (2,'plaza2',true,false,'aberta',0);",
				"INSERT INTO tables VALUES (3,'plaza3',false,true,'aberta',0);",
			],
		];

		foreach ($queries as $query_name => $query) {
			if (is_array($query)) {
				foreach ($query as $value) {
					$stmt = $this->connect()->prepare($value);
					$succeeded = $stmt->execute();

					if (!$succeeded) {
						printf("Prepare statement error: " . $stmt);
						$stmt = null;
						exit(1);
					}
				}

				printf("INSERTING VALUE INTO $query_name TABLE...\n");
			} else {
				$stmt = $this->connect()->prepare($query);

				if ($query_name == 'users') {
					$stmt->bindParam(':authToken', $auth_token, PDO::PARAM_STR);
					$stmt->bindParam(':password', $pwd, PDO::PARAM_STR);
				}

				$succeeded = $stmt->execute();

				if (!$succeeded) {
					printf("Prepare statement error: $stmt");
					$stmt = null;
					exit(1);
				}

				printf("INSERTING VALUE INTO $query_name TABLE...\n");
			}
		}
	}
}

$migration = new SQLiteMigrations();
$migration->InitDatabase();

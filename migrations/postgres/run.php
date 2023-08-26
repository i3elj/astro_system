<?php

require_once 'model/DatabaseModel.php';
require_once 'lib/extras.php';

class DefaultMigrations extends DatabaseModel
{
	public function InitDatabase()
	{
		$this->CreateTables();
		$this->PopulateTables();
	}

	private function CreateTables()
	{
		$tables = [
			"users" => "CREATE TABLE users (
				cpf             VARCHAR(14) PRIMARY KEY UNIQUE,
				nickname        TEXT NOT NULL,
				real_name       TEXT NOT NULL,
				email           VARCHAR NOT NULL,
				password        TEXT NOT NULL,
				auth_token      TEXT NOT NULL,
				phone_number    TEXT,
				permissions     TEXT,
				role            TEXT NOT NULL
			);",
			"dishes" => "CREATE TABLE dishes (
				id              SERIAL PRIMARY KEY UNIQUE,
				name            TEXT NOT NULL,
				cost            DECIMAL(10,2),
				ingredients     TEXT NOT NULL
			);",
			"ingredients" => "CREATE TABLE ingredients (
				id              SERIAL PRIMARY KEY UNIQUE,
				name            TEXT NOT NULL
			);",
			"tables" => "CREATE TABLE tables (
				id              INT PRIMARY KEY UNIQUE,
				location        TEXT,
				bill            DECIMAL(10,2),
				is_reserved     BOOLEAN NOT NULL,
				is_occupied     BOOLEAN NOT NULL
			);",
			"orders" => "CREATE TABLE orders (
				id              INT PRIMARY KEY UNIQUE,
				fk_table_id     INT NOT NULL,
				fk_ordered_item INT NOT NULL,
				observations    TEXT,
				created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				expiration_time TIMESTAMP DEFAULT (CURRENT_TIMESTAMP + INTERVAL '2 hours'),
				FOREIGN KEY (fk_table_id) REFERENCES tables(id),
				FOREIGN KEY (fk_ordered_item) REFERENCES dishes(id)
			);"
		];

		foreach ($tables as $table_name => $table) {
			$stmt = $this->connect()->postgres()->prepare($table);
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
		// password + cpf
		$date = date("m/d/Y h:i:s a", time());
		$auth_token = password_hash('088.136.004-02' . $date, PASSWORD_ARGON2I);
		$pwd = password_hash('adminad@min', PASSWORD_ARGON2I);
		$queries = [
			"users" => "INSERT INTO users
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
			"dishes" => "INSERT INTO dishes(name, cost, ingredients) VALUES (
				'Hot Chocolate',
				8.99,
				'milk,chocolate,cinnamon,maize starch,sugar,milk cream'
			);",
			"ingredients" => [
				"INSERT INTO ingredients(name) VALUES ('mayonnaise');",
				"INSERT INTO ingredients(name) VALUES ('pickles');",
				"INSERT INTO ingredients(name) VALUES ('onion');",
				"INSERT INTO ingredients(name) VALUES ('chicken breast');",
				"INSERT INTO ingredients(name) VALUES ('tomato');",
				"INSERT INTO ingredients(name) VALUES ('cheese');",
				"INSERT INTO ingredients(name) VALUES ('lettuce');",
				"INSERT INTO ingredients(name) VALUES ('milk');",
				"INSERT INTO ingredients(name) VALUES ('chocolate');",
				"INSERT INTO ingredients(name) VALUES ('cinnamon');",
				"INSERT INTO ingredients(name) VALUES ('sugar');",
				"INSERT INTO ingredients(name) VALUES ('milk cream');",
				"INSERT INTO ingredients(name) VALUES ('maize starch');",
			],
			"tables" => [
				"INSERT INTO tables VALUES (0,'plaza1',0,false,false);",
				"INSERT INTO tables VALUES (1,'plaza1',0,false,true);",
				"INSERT INTO tables VALUES (2,'plaza2',0,false,true);",
				"INSERT INTO tables VALUES (3,'plaza3',0,true,false);",
			],
		];

		foreach ($queries as $query_name => $query) {
			if (is_array($query)) {
				foreach ($query as $value) {
					$stmt = $this->connect()->postgres()->prepare($value);
					$succeeded = $stmt->execute();

					if (!$succeeded) {
						printf("Prepare statement error: " . $stmt);
						$stmt = null;
						exit(1);
					}
				}

				printf("INSERTING VALUE INTO $query_name TABLE...\n");
				exit(0);
			}

			$stmt = $this->connect()->postgres()->prepare($query);

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

$migration = new DefaultMigrations();
$migration->InitDatabase();

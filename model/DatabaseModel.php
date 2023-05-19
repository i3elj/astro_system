<?php

class DatabaseModel
{
  protected function connect()
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
}

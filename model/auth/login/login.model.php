<?php

class LoginModel extends DatabaseModel
{
  protected function checkEmail($email)
  {
    $stmt = $this->connect()->prepare(
      "SELECT * FROM users WHERE email = ?;"
    );

    $succeeded = $stmt->execute([$email]);

    if (!$succeeded) {
      printf("Prepare statement error: " . $stmt);
      $stmt = null;
      exit(1);
    }

    return $stmt->rowCount() == 1;
  }

  protected function checkPassword(string $pwd)
  {
    $stmt = $this->connect()->prepare(
      "SELECT * FROM users WHERE password = ?;"
    );

    $succeeded = $stmt->execute([$pwd]);

    if (!$succeeded) {
      printf("Prepare statement error: " . $stmt);
      $stmt = null;
      exit(1);
    }

    return $stmt->rowCount() == 1;
  }

  protected function logUser($email, $password)
  {
    /**
     * new function:
     * -> get email and password DONE
     * -> fix the database
     * -> encrypt
     * -> check if there's a token in the database
     * -> return the token to the user
     *
     * in the client:
     * -> store the token in cookies
     * -> stay logged in
    */
    $stmt = $this->connect()
      ->prepare("SELECT nickname, email FROM users
        WHERE email = ? AND password = ?;");

    $succeededed = $stmt->execute([$email, $password]);
    if (!$succeededed) {
      printf("Prepare statement not succeeded: " . $stmt);
      $stmt = null;
      exit(1);
    }

    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;

    session_start();
    $_SESSION['name'] = $user_data[0]["nickname"];
    $_SESSION['email'] = $user_data[0]["email"];
  }
}

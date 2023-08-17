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
    $stmt = $this->connect()->prepare(
      "SELECT email FROM users WHERE email = ?;"
    );

    $succeeded = $stmt->execute([$email]);

    if (!$succeeded) {
      printf("Prepare statement error: " . $stmt);
      $stmt = null;
      exit(1);
    }

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $stmt->rowCount() == 1;
  }

  /**
   * @param string $pwd User's password
   * @param string $email User's email
   *
   * @return bool True if the password is correct, false otherwise
   */
  protected function checkPassword(string $pwd, string $email): bool
  {
    $stmt = $this->connect()->prepare(
      "SELECT password FROM users WHERE email = ?;"
    );

    $succeeded = $stmt->execute([$email]);

    if (!$succeeded) {
      printf("Prepare statement error: " . $stmt);
      $stmt = null;
      exit(1);
    }

    $db_pwd = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['password'];
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
    $stmt = $this->connect()->prepare(
      "SELECT cpf, auth_token, password FROM users WHERE email = ?;"
    );

    $succeededed = $stmt->execute([$email]);

    if (!$succeededed) {
      printf("Prepare statement not succeeded: " . $stmt);
      $stmt = null;
      exit(1);
    }

    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    $new_auth_token = $this->updateAuthToken($user_data['cpf']);

    $db_password = $user_data['password'];

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

    $stmt = $this->connect()->prepare(
      "UPDATE users SET auth_token = ? WHERE cpf = ?;"
    );

    $succeededed = $stmt->execute([$new_auth_token, $cpf]);

    if (!$succeededed) {
      printf("Prepare statement not succeeded: " . $stmt);
      $stmt = null;
      exit(1);
    }

    return $new_auth_token;
  }
}

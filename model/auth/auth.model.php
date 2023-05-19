<?php

class AuthModel extends DatabaseModel
{
  protected function checkEmail($email)
  {
    $stmt = $this->connect()->prepare(
      "SELECT * FROM users WHERE uemail = ?;"
    );

    $succeed = $stmt->execute([$email]);

    if (!$succeed) {
      printf("Prepare statement error: " . $stmt);
      $stmt = null;
      exit(1);
    }

    return $stmt->rowCount() == 1;
  }

  protected function checkPassword(string $pwd)
  {
    $stmt = $this->connect()->prepare(
      "SELECT * FROM users WHERE upwd = ?;"
    );

    $succeed = $stmt->execute([$pwd]);

    if (!$succeed) {
      printf("Prepare statement error: " . $stmt);
      $stmt = null;
      exit(1);
    }

    return $stmt->rowCount() == 1;
  }

  protected function logUser($uemail, $upwd)
  {
    $stmt = $this->connect()
      ->prepare("SELECT uname, uemail FROM users
        WHERE uemail = ? AND upwd = ?;");

    $succeeded = $stmt->execute([$uemail, $upwd]);
    if (!$succeeded) {
      printf("Prepare statement not succeeded: " . $stmt);
      $stmt = null;
      exit(1);
    }

    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION['uname'] = $user_data[0]["uname"];
    $_SESSION['uemail'] = $user_data[0]["uemail"];

    $stmt = null;
  }
}

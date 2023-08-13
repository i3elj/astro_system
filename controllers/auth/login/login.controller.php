<?php

require_once "model/auth/login/login.model.php";

class LoginController extends LoginModel
{
  public const path = '/\/login/';

  public function Handler()
  {
    match ($_SERVER["REQUEST_METHOD"]) {
      'GET' => self::build_view(),
      'POST' => self::login(),
      default => badrequest()
    };
  }

  private function login()
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $json_response = [
      "validEmail" => true,
      "validPassword" => true
    ];

    if (!$this->checkEmail($email))
      $json_response["validEmail"] = false;

    if (!$this->checkPassword($password))
      $json_response["validPassword"] = false;

    if ($json_response["validEmail"] && $json_response["validPassword"])
      $this->logUser($email, $password);

    echo json_encode($json_response);
    exit(0);
  }

  private function build_view()
  {
    $auth_error = isset($_GET["auth_error"]) ? $_GET["auth_error"] : null;
    $field =  isset($_GET["field"]) ? $_GET["field"] : null;
    $email_recovery = isset($_GET["email_recovery"]) ? $_GET["email_recovery"] : null;

    $title = "Astro System - Login";
    require_once 'views/auth/login/login.view.php';
    exit(0);
  }
}

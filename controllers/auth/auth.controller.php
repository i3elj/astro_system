<?php

require_once "model/auth/auth.model.php";

class AuthController extends AuthModel
{
  public const path = '/\/login/';

  function Handler()
  {
    match ($_SERVER["REQUEST_METHOD"]) {
      'GET' => self::build_view(),
      'POST' => self::login(),
      default => badrequest()
    };
  }

  function login()
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email_success = $this->checkEmail($email);
    if (!$email_success) {
      header("location: /login?auth_error=email doesn't exist&field=email");
      exit(0);
    }

    $pwd_success = $this->checkPassword($password);
    if (!$pwd_success) {
      header("location: /login?auth_error=wrong password&field=pwd&email_recovery=$email");
      exit(0);
    }

    $this->logUser($email, $password);

    header("location: controllers/auth/auth.controller.php");
  }

  function build_view()
  {
    $auth_error = isset($_GET["auth_error"]) ? $_GET["auth_error"] : null;
    $field =  isset($_GET["field"]) ? $_GET["field"] : null;
    $email_recovery = isset($_GET["email_recovery"]) ? $_GET["email_recovery"] : null;

    $title = "Astro System - Login";
    require_once 'views/auth/auth.view.php';
    exit(0);
  }
}

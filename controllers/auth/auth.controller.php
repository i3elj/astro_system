<?php

require_once "model/auth/auth.model.php";

class AuthController extends AuthModel
{
  public const path = '/\/login/';

  static function Handler()
  {
    match ($_SERVER["REQUEST_METHOD"]) {
      'GET' => self::build_view(),
      'POST' => self::login(),
      default => badrequest()
    };
  }

  static function login()
  {
    exit(0);
  }

  static function build_view()
  {
    $title = "Astro System - Login";
    require_style('public/style.css');
    require_style('views/auth/auth.style.css');
    require_once 'views/auth/auth.view.php';
    exit(0);
  }
}

<?php

require_once "model/auth/login/login.model.php";

class Login extends LoginModel
{
	public function __construct(private string $path = '/\/login/')
	{
	}

	public function Handler()
	{
		match ($_SERVER["REQUEST_METHOD"]) {
			'GET' => self::build_view(),
			'POST' => self::login(),
			default => badrequest()
		};
	}

	private function login(): void
	{
		$email = $_POST['email'];
		$pwd = $_POST['password'];

		if (!$this->checkEmail($email)) {
			echo json_encode([
				"success" => false,
				"field" => 'email',
				"message" => "Email doesn't exist!"
			]);
			exit(0);
		}

		if (!$this->checkPassword($pwd, $email)) {
			echo json_encode([
				"success" => false,
				"field" => 'password',
				"message" => "Wrong password!"
			]);
			exit(0);
		}

		$auth_token = $this->logUser($pwd, $email);

		echo json_encode(["success" => true, "token" => $auth_token]);
		exit(0);
	}

	private function build_view(): void
	{
		$auth_error = isset($_GET["auth_error"]) ? $_GET["auth_error"] : null;
		$field =  isset($_GET["field"]) ? $_GET["field"] : null;
		$email_recovery = isset($_GET["email_recovery"]) ? $_GET["email_recovery"] : null;

		require_once 'views/auth/login/login.view.php';
		exit(0);
	}
}

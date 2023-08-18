<?php

require_once 'model/auth/signup/signup.model.php';

class SignUpController extends SignUpModel
{
	public const path = '/\/signup/';

	public function Handler()
	{
		match ($_SERVER['REQUEST_METHOD']) {
			'GET' => self::build_view(),
			'POST' => self::signup()
		};
	}

	private function signup()
	{
		$cpf = $_POST['cpf'];
		$nickname = $_POST['nickname'];
		$real_name = $_POST['realname'];
		$email = $_POST['email'];
		$phone_number = $_POST['phonenumber'];
		$pwd = $_POST['password'];

		if ($this->user_exist($cpf)) {
			echo json_encode([
				"success" => false,
				"field" => 'cpf',
				"message" => "cpf's already registered"
			]);
			exit(0);
		}

		$date = date("m/d/Y h:i:s a", time());
		$token = password_hash($cpf . $date, PASSWORD_ARGON2I);
		$pwd = password_hash($pwd . $email, PASSWORD_ARGON2I);
		$this->register([$cpf, $nickname, $real_name, $email, $pwd, $token, $phone_number]);

		echo json_encode(["success" => true, "field" => '', "message" => '']);
		exit(0);
	}

	private function build_view()
	{
		require_once 'views/auth/signup/signup.view.php';
		exit(0);
	}
}

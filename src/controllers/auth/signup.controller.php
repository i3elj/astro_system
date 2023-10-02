<?php

namespace Signup;

require_once 'src/model/auth/signup.model.php';

class Controller extends Model
{
	public function __construct(private string $path = '/\/signup/')
	{
	}

	/**
	 * The main method of each controller. This method takes care of what the
	 * controller will do depending on each http method used.
	 */
	public function Handler()
	{
		match ($_SERVER['REQUEST_METHOD']) {
			'GET' => $this->build_view(),
			'POST' => $this->signup()
		};
	}

	/**
	 * This method takes care of creating a new account for the user.
	 */
	private function signup()
	{
		$cpf = POST('cpf');
		$nickname = POST('nickname');
		$real_name = POST('realname');
		$email = POST('email');
		$phone_number = POST('phonenumber');
		$pwd = POST('password');

		if ($this->user_exist($cpf)) {
			$response = json_encode(['field' => 'cpf']);
			header('HX-Trigger: {"onerror": ' . $response . '}');
			echo 'O CPF informado já está cadastrado';
			exit(0);
		}

		$date = date('m/d/Y h:i:s a', time());
		$auth_token = password_hash($cpf . $date, PASSWORD_ARGON2I);
		$pwd = password_hash($pwd . $email, PASSWORD_ARGON2I);
		$this->register([$cpf, $nickname, $real_name, $email, $pwd, $auth_token, $phone_number]);

		$response = json_encode(['token' => $auth_token]);
		header('HX-Trigger: {"signup": ' . $response . '}');
		exit(0);
	}

	/**
	 * Each Controller will have a build_view function where it sends the
	 * desired webpage to the client.
	 */
	private function build_view()
	{
		require_once 'src/views/auth/signup/signup.view.php';
		exit(0);
	}
}

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
		$cpf = $_POST['cpf'];
		$nickname = $_POST['nickname'];
		$real_name = $_POST['realname'];
		$email = $_POST['email'];
		$phone_number = $_POST['phonenumber'];
		$pwd = $_POST['password'];

		if ($this->user_exist($cpf)) {
			echo json_encode([
				'success' => false,
				'field' => 'cpf',
				'message' => 'cpf is already registered'
			]);
			exit(0);
		}

		$date = date('m/d/Y h:i:s a', time());
		$token = password_hash($cpf . $date, PASSWORD_ARGON2I);
		$pwd = password_hash($pwd . $email, PASSWORD_ARGON2I);
		$this->register([$cpf, $nickname, $real_name, $email, $pwd, $token, $phone_number]);

		echo json_encode(['success' => true, 'token' => $token]);
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
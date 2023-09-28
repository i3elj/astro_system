<?php

namespace Login;

require_once 'src/services/Auth.service.php';

class Controller
{
	use \Services\Auth;

	public function __construct(private string $path = '/\/login/')
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
			'POST' => $this->login(),
			default => bad_request()
		};
	}

	/**
	 * This method takes care of authenticating the user.
	 */
	private function login()
	{
		$email = $_POST['email'];
		$pwd = $_POST['password'];

		if (!$this->check_email($email)) {
			echo json_encode([
				'success' => false,
				'field' => 'email',
				'message' => 'Email does not exist!'
			]);
			exit(0);
		}

		if (!$this->check_password($pwd, $email)) {
			echo json_encode([
				'success' => false,
				'field' => 'password',
				'message' => 'Wrong password!'
			]);
			exit(0);
		}

		$auth_token = $this->log_user($pwd, $email);

		echo json_encode(['success' => true, 'token' => $auth_token]);
		exit(0);
	}

	/**
	 * Each Controller will have a build_view function where it sends the
	 * desired webpage to the client.
	 */
	private function build_view()
	{
		$token = $_COOKIE['authToken'] ?? null;
		$is_logged = $this->is_authenticated($token);
		require_once 'src/views/auth/login/login.view.php';
		exit(0);
	}
}

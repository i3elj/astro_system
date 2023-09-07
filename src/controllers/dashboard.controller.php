<?php

namespace Dashboard;

require_once 'src/model/dashboard.model.php';
require_once 'src/services/Auth.service.php';

class Controller extends Model
{
	use \Services\Auth;

	public function __construct(private string $path = '/\/dashboard/')
	{
	}

	/**
	 * The main method of each controller. This method takes care of what the
	 * controller will do depending on each http method used.
	 */
	public function Handler(): void
	{
		match ($_SERVER['REQUEST_METHOD']) {
			'GET' => $this->build_view(),
			default => bad_request()
		};
	}

	/**
	 * Each Controller will have a build_view function where it sends the
	 * desired webpage to the client.
	 */
	private function build_view(): void
	{
		$token = $_COOKIE['authToken'];
		$is_logged = $this->is_authenticated($token);
		require_once 'src/views/dashboard/dashboard.view.php';
		exit(0);
	}
}

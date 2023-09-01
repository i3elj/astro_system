<?php

require_once 'model/dashboard.model.php';
require_once 'services/auth.service.php';

class Dashboard extends DashboardModel
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
		$auth_token = $_COOKIE['authToken'] ?? '';
		$is_logged = $this->is_authenticated($auth_token);
		require_once 'views/dashboard/dashboard.view.php';
		exit(0);
	}
}

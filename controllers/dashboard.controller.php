<?php

require_once "model/dashboard.model.php";

class Dashboard extends DashboardModel
{
	public function __construct(private string $path = '/\/dashboard/')
	{
	}

	public function Handler(): void
	{
		match ($_SERVER['REQUEST_METHOD']) {
			'GET' => self::build_view(),
			default => badrequest()
		};
	}

	private function build_view(): void
	{
		$auth_token = $_COOKIE['authToken'];
		require_once 'views/dashboard/dashboard.view.php';
		exit(0);
	}
}

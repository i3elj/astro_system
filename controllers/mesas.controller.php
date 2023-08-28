<?php

require_once 'model/mesas.model.php';
require_once "services/auth.service.php";

class Mesas extends MesasModel
{
    use Services\Auth;

    public function __construct(private string $path = '/\/mesas/')
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
            default => badrequest(),
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
        require_once 'views/mesas/mesas.view.php';
        exit(0);
    }
}

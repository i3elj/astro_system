<?php

namespace Home;

require_once 'src/model/home.model.php';
require_once 'src/services/Auth.service.php';

class Controller extends Model
{
    use \Services\Auth;

    public function __construct(private string $path = '/\/home/')
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
            default => bad_request(),
        };
    }

    /**
     * Each Controller will have a build_view function where it sends the
     * desired webpage to the client.
     */
    private function build_view(): void
    {
        $token = $_COOKIE['authToken'] ?? null;
        $is_logged = $this->isAuthenticated($token);
        require_once 'src/views/home/home.view.php';
        exit(0);
    }
}

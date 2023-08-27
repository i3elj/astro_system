<?php

require_once 'model/menu.model.php';

class Menu extends MenuModel
{
    public function __construct(private string $path = '/\/menu/')
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
        require_once 'views/menu/menu.view.php';
        exit(0);
    }
}

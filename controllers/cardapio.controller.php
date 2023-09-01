<?php

require_once 'model/cardapio.model.php';
require_once 'services/auth.service.php';

class Cardapio extends CardapioModel
{
    use \Services\Auth;

    public function __construct(private string $path = '/\/cardapio/')
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
        $auth_token = $_COOKIE['authToken'] ?? '';
        $is_logged = $this->is_authenticated($auth_token);

        if ($is_logged) {
            $user_info = $this->getUserInfo($auth_token);
            $menu_items = $this->getMenu($user_info['cpf']);
        }

        require_once 'views/cardapio/cardapio.view.php';
        exit(0);
    }
}

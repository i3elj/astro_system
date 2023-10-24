<?php

namespace Cardapio;

require_once 'src/model/cardapio/cardapio.model.php';
require_once 'src/services/Auth.service.php';

class Controller extends Model
{
    use \Services\Auth;

    public function __construct(private string $path = '/cardapio')
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
            default => _400(),
        };
    }

    /**
     * Each Controller will have a build_view function where it sends the
     * desired webpage to the client.
     */
    private function build_view(): void
    {
        $token = $_COOKIE['authToken'] ?? null;
        $is_logged = $this->is_authenticated($token);

        if ($is_logged) {
            $user_info = $this->get_user_info($token);
            $menu_items = $this->get_menu($user_info['cpf']);
            require_once 'src/views/cardapio/cardapio.view.php';
            exit(0);
        }

        header('location: /login');
    }
}

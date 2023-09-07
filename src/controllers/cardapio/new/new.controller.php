<?php

namespace Cardapio\New;


require_once 'src/model/cardapio/new/new.model.php';

class Controller extends Model
{
    use \Services\Auth;

    public function __construct(private string $path = '/cardapio/new')
    {
    }

    /**
     * The main method of each controller. This method takes care of what the
     * controller will do depending on each http method used.
     */
    public function Handler(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') bad_request();

        $this->build_view();
    }

    /**
     * Each Controller will have a build_view function where it sends the
     * desired webpage to the client.
     */
    private function build_view(): void
    {
        $token = $_COOKIE['authToken'];
        $is_logged = $this->is_authenticated($token);
        require_once 'src/views/cardapio/new/new.view.php';
        exit(0);
    }
}

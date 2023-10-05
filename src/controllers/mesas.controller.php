<?php

namespace Mesas;

require_once 'src/model/mesas.model.php';
require_once 'src/services/Auth.service.php';

class Controller extends Model
{
    use \Services\Auth;

    public function __construct(private string $path)
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

        if (!$is_logged) {
            header('location: /login');
            exit(0);
        }

        $keywords     = POST('keywords')     ?? '';
        $sortBy       = POST('sortBy')       ?? 'number';
        $orderType    = POST('orderType')    ?? 'ascending';
        $itemsPerPage = POST('itemsPerPage') ?? 10;

        $table_list = $this->get_table_list(
            $keywords,
            $sortBy,
            $orderType,
            (int)$itemsPerPage
        );

        require_once 'src/views/mesas/mesas.view.php';
        exit(0);
    }
}

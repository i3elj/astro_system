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
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            $this->build_view();

        bad_request();
    }

    /**
     * Each Controller will have a build_view function where it sends the
     * desired webpage to the client.
     */
    private function build_view(): void
    {
        $keywords = htmlspecialchars($_GET['keywords'] ?? '');
        $sortBy = htmlspecialchars($_GET['sortBy'] ?? 'number');
        $orderType = htmlspecialchars($_GET['orderType'] ?? 'ascending');
        $itemsPerPage = htmlspecialchars($_GET['itemsPerPage'] ?? 10);

        $table_list = $this->getTableList(
            $keywords,
            $sortBy,
            $orderType,
            (int)$itemsPerPage
        );

        $token = $_COOKIE['authToken'] ?? null;
        $is_logged = $this->is_authenticated($token);
        if (!$is_logged) header('location: /login');
        require_once 'src/views/mesas/mesas.view.php';
        exit(0);
    }
}

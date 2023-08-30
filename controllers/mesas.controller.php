<?php

require_once 'model/mesas.model.php';
require_once "services/auth.service.php";

class Mesas extends MesasModel
{
    use \Services\Auth;

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
        $keywords = htmlspecialchars($_GET['keywords'] ?? "");
        $sortBy = htmlspecialchars($_GET['sortBy'] ?? "number");
        $orderType = htmlspecialchars($_GET['orderType'] ?? "ascending");
        $itemsPerPage = htmlspecialchars($_GET['itemsPerPage'] ?? 10);

        $table_list = $this->getTableList(
            $keywords,
            $sortBy,
            $orderType,
            (int)$itemsPerPage
        );

        $validated_token = htmlspecialchars($_COOKIE['authToken']);
        $is_logged = $this->is_authenticated($validated_token);
        require_once 'views/mesas/mesas.view.php';
        exit(0);
    }
}

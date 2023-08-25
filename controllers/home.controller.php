<?php

require_once "model/home.model.php";

class Home extends HomeModel
{
    public function __construct(private string $path = '/\//')
    {
    }

    /**
     * The main method of each controller. This method takes care of what the
     * controller will do depending on each http method used.
     */
    public function Handler(): void
    {
        match ($_SERVER["REQUEST_METHOD"]) {
            "GET" => self::build_view(),
            "POST" => self::add_order(),
            default => badrequest(),
        };
    }

    private function add_order(): void
    {
        // $name = $_POST['dishName'];
        // $amount = (int) $_POST['amount'];
        // $params = get_route_params(self::path, ['/(\d(.+)?)/']);
        // $id = (int) $params[0];
        // $menu = [null]; // Database::get_price_list();

        // foreach ($menu as $dish_name => $dish_price)
        //   if ($dish_name == $name) $price = $dish_price;

        // date_default_timezone_get();
        // $order = [
        //   'id' => $id,
        //   'dishName' => $name,
        //   'quantity' => $amount,
        //   'price' => $price * $amount,
        //   'hour' => date('H:i'),
        //   'status' => "Na fila",
        // ];

        // Database::add_pedidos_to_db($order, $id);

        self::build_view();
    }

    /**
     * Each Controller will have a build_view function where it sends the
     * desired webpage to the client.
     */
    private function build_view(): void
    {
        require_once 'views/home/home.view.php';
        exit(0);
    }
}

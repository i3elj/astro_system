<?php

require_once "model/home/home.model.php";

class HomeController extends HomeModel
{
  public const path = 'Hello';

  static function Handler()
  {
    match ($_SERVER["REQUEST_METHOD"]) {
      "GET" => self::build_view(),
      "POST" => self::add_order(),
      default => badrequest(),
    };
  }

  function add_order()
  {
    $name = $_POST['dishName'];
    $amount = (int) $_POST['amount'];
    $params = get_route_params(self::path, ['/(\d(.+)?)/']);
    $id = (int) $params[0];
    $menu = [null]; // Database::get_price_list();
    $this->connect();

    foreach ($menu as $dish_name => $dish_price)
      if ($dish_name == $name) $price = $dish_price;

    date_default_timezone_get();
    $order = [
      'id' => $id,
      'dishName' => $name,
      'quantity' => $amount,
      'price' => $price * $amount,
      'hour' => date('H:i'),
      'status' => "Na fila",
    ];

    // Database::add_pedidos_to_db($order, $id);

    self::build_view();
  }

  static function build_view()
  {
    // ideal: $params = get_route_params(self::path, ['id', 'name']);
    $params = get_route_params(self::path, ['/(\d(.+)?)/']);
    $tables = [0, 1, 2]; // Database::load_db()["restaurants"][0]["tables"];

    foreach ($tables as $table) {
      if ((int)$table["id"] == (int)$params[0]) {
        $selected_table = $table;
      }
    }

    $title = "Astro System";
    require_style('public/style.css');
    require_style('views/home/home.style.css');
    require_script('views/home/home.js');
    require_once 'views/home/home.view.php';

    exit(0);
  }
}
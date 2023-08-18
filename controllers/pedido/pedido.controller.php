<?php

class PedidoController extends PedidoModel
{
	static function Route()
	{
	}

	static function build_view()
	{
	}
}

// function EditarPedidoController()
// {
//   $query_parameters_sent = strlen($_GET["id"]) > 0;
//
//   if ($query_parameters_sent) {
//     $pedido = query_by_id((int)$_GET["id"]);
//     $nome = $pedido["nome"];
//     $quantidade = $pedido["quantidade"];
//     require_once('pedido.view.php');
//   } else {
//     notfound();
//   }
// }

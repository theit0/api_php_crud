<?php
require_once "../controllers/ProductoController.php";

$productoController = new ProductoController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $productoController->obtenerProductos();
        break;
    case 'POST':
        $productoController->crearProducto();
        break;
    case 'PUT':
        $productoController->actualizarProducto();
        break;
    case 'DELETE':
        $productoController->eliminarProducto();
        break;
    default:
        echo json_encode(["error" => "Método no soportado"]);
        break;
}
?>

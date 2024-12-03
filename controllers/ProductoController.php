<?php
require_once "../services/ProductoService.php";

class ProductoController {
    private $productoService;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->productoService = new ProductoService($db);
    }

    public function obtenerProductos() {
        $productos = $this->productoService->obtenerProductos();
        echo json_encode($productos);
    }

    public function crearProducto() {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $this->productoService->crearProducto($data);
        echo json_encode($result);
    }

    public function actualizarProducto() {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $this->productoService->actualizarProducto($data);
        echo json_encode($result);
    }

    public function eliminarProducto() {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'] ?? null;
        $result = $this->productoService->eliminarProducto($id);
        echo json_encode($result);
    }
}
?>

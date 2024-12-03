<?php
require_once "../repositories/ProductoRepository.php";

class ProductoService {
    private $productoRepository;

    public function __construct($db) {
        $this->productoRepository = new ProductoRepository($db);
    }

    public function obtenerProductos() {
        return $this->productoRepository->obtenerTodos();
    }

    public function crearProducto($data) {
        if (!isset($data['nombre'], $data['precio'], $data['stock'])) {
            return ["error" => "Datos incompletos"];
        }

        $producto = new Producto(null, $data['nombre'], $data['precio'], $data['stock']);
        $result = $this->productoRepository->crear($producto);

        if ($result) {
            return ["mensaje" => "Producto creado exitosamente"];
        } else {
            return ["error" => "No se pudo crear el producto"];
        }
    }

    public function actualizarProducto($data) {
        if (!isset($data['id'], $data['nombre'], $data['precio'], $data['stock'])) {
            return ["error" => "Datos incompletos"];
        }

        $producto = new Producto($data['id'], $data['nombre'], $data['precio'], $data['stock']);
        $result = $this->productoRepository->actualizar($producto);

        if ($result) {
            return ["mensaje" => "Producto actualizado exitosamente"];
        } else {
            return ["error" => "No se pudo actualizar el producto"];
        }
    }

    public function eliminarProducto($id) {
        if (empty($id)) {
            return ["error" => "Falta el ID del producto"];
        }

        $result = $this->productoRepository->eliminar($id);

        if ($result) {
            return ["mensaje" => "Producto eliminado exitosamente"];
        } else {
            return ["error" => "No se pudo eliminar el producto"];
        }
    }
}
?>

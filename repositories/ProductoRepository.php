<?php
require_once "../config/conexion.php";
require_once "../models/Producto.php";

class ProductoRepository {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM producto";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear(Producto $producto) {
        $query = "INSERT INTO producto (nombre, precio, stock) VALUES (:nombre, :precio, :stock)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $producto->nombre);
        $stmt->bindParam(":precio", $producto->precio);
        $stmt->bindParam(":stock", $producto->stock);
        return $stmt->execute();
    }

    public function actualizar(Producto $producto) {
        $query = "UPDATE producto SET nombre = :nombre, precio = :precio, stock = :stock WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $producto->id);
        $stmt->bindParam(":nombre", $producto->nombre);
        $stmt->bindParam(":precio", $producto->precio);
        $stmt->bindParam(":stock", $producto->stock);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM producto WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>

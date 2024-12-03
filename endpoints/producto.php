<?php

require_once "../config/conexion.php";

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Obtener todos los productos
        $sql = "SELECT * FROM producto";
        $result = $conn->query($sql);

        if ($result) {
            $productos = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($productos);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'POST':
        // Crear un nuevo producto
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['nombre'], $data['precio'], $data['stock'])) {
            $nombre = $conn->real_escape_string($data['nombre']);
            $precio = $conn->real_escape_string($data['precio']);
            $stock = $conn->real_escape_string($data['stock']);

            $sql = "INSERT INTO producto (nombre, precio, stock) VALUES ('$nombre', $precio, $stock)";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["mensaje" => "Producto creado exitosamente", "id" => $conn->insert_id]);
            } else {
                echo json_encode(["error" => $conn->error]);
            }
        } else {
            echo json_encode(["error" => "Datos incompletos"]);
        }
        break;

    case 'PUT':
        // Actualizar un producto existente
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'], $data['nombre'], $data['precio'], $data['stock'])) {
            $id = $conn->real_escape_string($data['id']);
            $nombre = $conn->real_escape_string($data['nombre']);
            $precio = $conn->real_escape_string($data['precio']);
            $stock = $conn->real_escape_string($data['stock']);

            $sql = "UPDATE producto SET nombre='$nombre', precio=$precio, stock=$stock WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["mensaje" => "Producto actualizado exitosamente"]);
            } else {
                echo json_encode(["error" => $conn->error]);
            }
        } else {
            echo json_encode(["error" => "Datos incompletos"]);
        }
        break;

    case 'DELETE':
        // Eliminar un producto
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id'])) {
            $id = $conn->real_escape_string($data['id']);

            $sql = "DELETE FROM producto WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["mensaje" => "Producto eliminado exitosamente"]);
            } else {
                echo json_encode(["error" => $conn->error]);
            }
        } else {
            echo json_encode(["error" => "Falta el ID del producto"]);
        }
        break;

    default:
        // Método no soportado
        echo json_encode(["error" => "Método no soportado"]);
        break;
}

$conn->close();

?>

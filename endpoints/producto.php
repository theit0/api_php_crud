<?php

require_once "../config/conexion.php";

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method){
    case 'GET':
        $sql = "SELECT * FROM producto";
        $result = $conn->query($sql);

        $productos = $result->fetch_all(MYSQLI_ASSOC);
    
        echo json_encode($productos);
        break;
    break;
}

?>
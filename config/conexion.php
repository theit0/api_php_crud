<?php
    // Configuración para conectarse a la base de datos
    $host = "localhost";
    $user = "root";
    $password = ""; // Cambia si tienes contraseña
    $dbname = "sistema_de_ventas";
    $port = 3306; // Asegúrate de que sea el puerto correcto

    // Conexión
    $conn = new mysqli($host, $user, $password, $dbname, $port);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error al conectar a la base de datos: " . $conn->connect_error);
    }

    // Establecer el conjunto de caracteres
    $conn->set_charset("utf8");
?>
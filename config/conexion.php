<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "sistema_de_ventas";
    private $port = 3306;
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";port=" . $this->port;
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            die();
        }
        return $this->conn;
    }
}
?>
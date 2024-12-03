<?php
class DatabasePDO {
    private $dsn = 'mysql:host=localhost;dbname=tareas;charset=utf8';
    private $user = 'root';
    private $password = '';
    public $conn;

    public function __construct(){
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die('Error de Conexión: ' . $e->getMessage());
        }

    }
}
?>
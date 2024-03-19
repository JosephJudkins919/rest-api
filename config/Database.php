<?php

class Database {
    // Define database connection parameters
    private $host = 'localhost';
    private $db_name = 'quotesdb';
    private $username = 'your_username';
    private $password = 'fhsu653';
    private $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("pgsql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>

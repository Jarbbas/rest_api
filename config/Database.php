<?php 
  /** Classe para estabelecer a ligação à base de dados */
  class Database {
    // parametros de ligação
    private $host = 'localhost';
    private $db_name = 'rest_api';
    private $username = 'root';
    private $password = '';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      /** Try Catch para validar a ligação  */
      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        /** Em caso de insucesso  */
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
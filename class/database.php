<?php
/* Sergio San Martín */

class Database {
  private $connection;

  function __construct($base_datos, $host, $user, $pass) {
    $connectionString = "mysql:dbname=".$base_datos.";host=$host";
    $this->connection = new PDO($connectionString, $user, $pass);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (!$this->connection) {
      throw new Exception("No se ha podido realizar la conexión");
    }
  }
  
  public function getConnection() {
    return $this->connection;
  }

  public function insert($table, $data) {
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), '?'));
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $this->connection->prepare($sql);
    return $stmt->execute(array_values($data));
  }

  public function update($table, $data, $where) {
    $set = implode(", ", array_map(function($key) {
      return "$key = ?";
    }, array_keys($data)));
    $sql = "UPDATE $table SET $set WHERE $where";
    $stmt = $this->connection->prepare($sql);
    return $stmt->execute(array_values($data));
  }

  public function delete($table, $where) {
    $sql = "DELETE FROM $table WHERE $where";
    $stmt = $this->connection->prepare($sql);
    return $stmt->execute();
  }

  public function select($table, $columns = "*", $where = "") {
    $sql = "SELECT $columns FROM $table";
    if ($where) {
      $sql .= " WHERE $where";
    }
    $stmt = $this->connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>

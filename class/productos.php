<?php
/* Sergio San Martín */

require_once 'database.php';

class Producto {
  private $id;
  private $nombre;
  private $descripcion;
  private $precio;
  private $id_categoria;
  private $db;

  public function __construct($id = null, $nombre = null, $descripcion = null, $precio = null, $id_categoria = null) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
    $this->precio = $precio;
    $this->id_categoria = $id_categoria;
    $this->db = new Database('MIPROYECTO', 'localhost', 'root', ''); // Ajusta los parámetros según tu configuración
  }

  // Getters and Setters
  public function getId() {
    return $this->id;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }

  public function getPrecio() {
    return $this->precio;
  }

  public function setPrecio($precio) {
    $this->precio = $precio;
  }

  public function getIdCategoria() {
    return $this->id_categoria;
  }

  public function setIdCategoria($id_categoria) {
    $this->id_categoria = $id_categoria;
  }

  // Método para guardar el producto (insertar o actualizar)
  public function guardar() {
    if ($this->id === null) {
      // Insertar nuevo producto
      $data = [
        'nombre' => $this->nombre,
        'descripcion' => $this->descripcion,
        'precio' => $this->precio,
        'id_categoria' => $this->id_categoria
      ];
      return $this->db->insert('productos', $data);
    } else {
      // Actualizar producto existente
      $data = [
        'nombre' => $this->nombre,
        'descripcion' => $this->descripcion,
        'precio' => $this->precio,
        'id_categoria' => $this->id_categoria
      ];
      $where = "id_producto = {$this->id}";
      return $this->db->update('productos', $data, $where);
    }
  }

  // Método para eliminar el producto
  public function eliminar() {
    if ($this->id !== null) {
      $where = "id_producto = {$this->id}";
      return $this->db->delete('productos', $where);
    }
    return false;
  }

  // Método para cargar un producto desde la base de datos
  public static function cargar($id) {
    $db = new Database('MIPROYECTO', 'localhost', 'root', ''); // Ajusta los parámetros según tu configuración
    $result = $db->select('productos', '*', "id_producto = $id");
    if (!empty($result)) {
      $data = $result[0];
      return new self($data['id_producto'], $data['nombre'], $data['descripcion'], $data['precio'], $data['id_categoria']);
    }
    return null;
  }
}
?>

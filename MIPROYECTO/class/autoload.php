
<?php
/* Sergio San Martín */

$classMap = [
  'Database' => __DIR__ . '/database.php',
  'Categoria' => __DIR__ . '/categoria.php',
  'Producto' => __DIR__ . '/producto.php'
];

spl_autoload_register(function ($class_name) use ($classMap) {
  if (isset($classMap[$class_name])) {
    require_once $classMap[$class_name];
  }
});
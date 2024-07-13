<?php
include '../class/autoload.php';
$database = new Database("miproyecto", "127.0.0.1", "root", "");
$datos = new Categoria($database->getConnection());
$categorias = $datos->getAll();
include 'views/lista_categorias.php';
?>
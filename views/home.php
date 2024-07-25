<?php
require_once __DIR__ . '/../CLASS/database.php'; // Ruta absoluta al archivo database.php

try {
    $db = new Database('MIPROYECTO', 'localhost', 'root', '');
    $productos = $db->select('productos');

    if (empty($productos)) {
        $productosMensaje = '<p>No hay productos disponibles.</p>';
    } else {
        $productosMensaje = '<div class="productos-container">';
        
        foreach ($productos as $producto) {
            $nombre = htmlspecialchars($producto['nombre']);
            $precio = htmlspecialchars($producto['precio']);
            $categoria_id = htmlspecialchars($producto['categoria_id']);
            $imagen = htmlspecialchars($producto['imagen']);
            $descripcion = htmlspecialchars($producto['descripcion']);
            
            // Consultar el nombre de la categoría
            $categoria = $db->select('categorias', 'nombre', "id = $categoria_id");
            $categoria_nombre = $categoria ? htmlspecialchars($categoria[0]['nombre']) : 'Desconocida';

            // Ruta a la imagen
            $imagenRuta = $imagen ? "../assets/img/$imagen" : "../assets/img/default.png"; // Imagen por defecto si no hay imagen

            $productosMensaje .= '<div class="producto">';
            $productosMensaje .= "<img src=\"$imagenRuta\" alt=\"$nombre\" class=\"producto-imagen\" />";
            $productosMensaje .= "<h2>$nombre</h2>";
            $productosMensaje .= "<p class=\"producto-precio\">Precio: $precio</p>";
            $productosMensaje .= "<p class=\"producto-categoria\">Categoría: $categoria_nombre</p>";
            $productosMensaje .= "<p class=\"producto-descripcion\">Descripción: $descripcion</p>";
            $productosMensaje .= '</div>';
        }

        $productosMensaje .= '</div>';
    }
} catch (Exception $e) {
    $productosMensaje = 'Error: ' . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="../assets/css/estilos.css" rel="stylesheet"> <!-- Ruta relativa al CSS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            text-align: center;
            margin-bottom: 1em;
        }
        .logo {
            width: 150px; /* Ajustar el tamaño del logo */
            height: auto;
        }
        nav {
            background-color: #8BC34A; /* Verde más claro */
            padding: 0.5em;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            border-bottom: 2px solid #6DAB3F; /* Verde más oscuro para el borde inferior */
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        nav ul li {
            margin: 0 1em;
        }
        nav ul li a {
            text-decoration: none;
            color: #FFFFFF; /* Color blanco para el texto */
            font-weight: bold;
            padding: 0.5em 1em;
            display: block;
            font-size: 1.5em; /* Tamaño del texto más grande */
        }
        nav ul li a:hover {
            background-color: #6DAB3F; /* Cambiar a un verde más oscuro al pasar el ratón */
            border-radius: 5px;
        }
        .productos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .producto {
            flex: 1 1 calc(25% - 1em);
            box-sizing: border-box;
            margin: 0.5em;
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
        }
        .producto-imagen {
            max-width: 70%; /* Ajustar el tamaño de la imagen del producto */
            height: auto;
        }
        .producto h2 {
            font-size: 1.2em;
            margin: 0.5em 0;
        }
        .producto-precio,
        .producto-categoria,
        .producto-descripcion {
            margin: 0.5em 0;
        }
        .content {
            padding: 1em;
        }
    </style>
</head>
<body>
    <header>
        <img class="logo" src="../assets/img/logo1.png" alt="Logo"> <!-- Ruta relativa al logo -->
    </header>
    <nav>
        <ul>
            <li><a href="https://localhost/MIPROYECTO/index.php">Inicio</a></li> <!-- Enlace ajustado -->
            <li><a href="https://localhost/MIPROYECTO/backend/views/categorias.html">Categorías</a></li>
            <li><a href="https://localhost/MIPROYECTO/backend/views/productos.php">Productos</a></li>
        </ul>
    </nav>
    <main>
        <div class="content">
            <h1>Lista de Productos TecnoVentures S.A.</h1>
            <?php echo $productosMensaje; ?>
        </div>
    </main>
</body>
</html>

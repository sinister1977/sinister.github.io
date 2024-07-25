<?php
require_once 'CLASS/database.php';

try {
    $db = new Database('MIPROYECTO', 'localhost', 'root', '');
    $productos = $db->select('productos');

    if (empty($productos)) {
        $productosMensaje = '<p>No hay productos disponibles.</p>';
    } else {
        $productosMensaje = '<table>';
        $productosMensaje .= '<thead>';
        $productosMensaje .= '<tr><th>Nombre</th><th>Precio</th><th>Categoría</th><th>Imagen</th></tr>';
        $productosMensaje .= '</thead>';
        $productosMensaje .= '<tbody>';

        foreach ($productos as $producto) {
            $nombre = htmlspecialchars($producto['nombre']);
            $precio = htmlspecialchars($producto['precio']);
            $categoria_id = htmlspecialchars($producto['categoria_id']);
            $imagen = htmlspecialchars($producto['imagen']);
            
            // Consultar el nombre de la categoría
            $categoria = $db->select('categorias', 'nombre', "id = $categoria_id");
            $categoria_nombre = $categoria ? htmlspecialchars($categoria[0]['nombre']) : 'Desconocida';

            // Ruta a la imagen
            $imagenRuta = $imagen ? "assets/img/$imagen" : "assets/img/default.png"; // Imagen por defecto si no hay imagen

            $productosMensaje .= '<tr>';
            $productosMensaje .= "<td>$nombre</td>";
            $productosMensaje .= "<td>$precio</td>";
            $productosMensaje .= "<td>$categoria_nombre</td>";
            $productosMensaje .= "<td><img src=\"$imagenRuta\" alt=\"$nombre\" width=\"100\" /></td>";
            $productosMensaje .= '</tr>';
        }

        $productosMensaje .= '</tbody>';
        $productosMensaje .= '</table>';
    }
} catch (Exception $e) {
    $productosMensaje = 'Error: ' . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="assets/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <nav>
            <ul>
                <li>
                    <a href="index.php">
                        <img class="logo" src="assets/img/logo1.png" alt="Logo">
                    </a>
                </li>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="backend/views/categorias.php">Categorías</a></li>
                <li><a href="backend/views/productos.php">Productos</a></li>
            </ul>
        </nav>

        <div class="content">
            <h1>Lista de Productos TecnoVentures S.A.</h1>
            <?php echo $productosMensaje; ?>
        </div>
    </main>
</body>
</html>

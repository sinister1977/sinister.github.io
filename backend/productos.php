<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="../../assets/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <nav>
            <ul>
                <li><a href="../../index.php"><img class="logo" src="../../assets/img/logo1.png" /></a></li>
                <li><a href="../../index.php">Inicio</a></li>
                <li><a href="categorias.html">Categorias</a></li>
                <li><a href="../lista_categorias.php">Lista Categorias</a></li>
                <li><a href="productos.php">Productos</a></li>
            </ul>
        </nav>

        <div class="form_container">
            <h1>Crear producto</h1>

            <form id="formulario_productos" class="formulario" action="../create_product.php" method="post" enctype="multipart/form-data">
                <div class="form_input">
                    <label for="nombre">Nombre del producto</label>
                    <input name="nombre" type="text" required />
                </div>
                <div class="form_input">
                    <label for="precio">Precio del producto</label>
                    <input name="precio" type="number" step="0.01" required />
                </div>
                <div class="form_input">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id" required>
                        <?php
                        require_once '../../CLASS/database.php';
                        try {
                            $db = new Database('MIPROYECTO', 'localhost', 'root', '');
                            $categorias = $db->select('categorias');

                            if (empty($categorias)) {
                                echo '<option value="">No hay categorías disponibles</option>';
                            } else {
                                foreach ($categorias as $categoria) {
                                    $id = htmlspecialchars($categoria['id']);
                                    $nombre = htmlspecialchars($categoria['nombre']);
                                    echo "<option value=\"$id\">$nombre</option>";
                                }
                            }
                        } catch (Exception $e) {
                            echo "<option>Error: " . htmlspecialchars($e->getMessage()) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form_input">
                    <label for="imagen">Imagen del producto</label>
                    <input name="imagen" type="file" accept="image/*" />
                </div>

                <div class="form_footer">
                    <input class="btn" type="reset" value="Cancelar" />
                    <input class="btn" type="submit" value="Enviar" />
                </div>
            </form>
        </div>
    </main>

    <h2 style="text-align: center;">Sergio San Martín</h2>

    <script src="../../assets/js/productos.js"></script>
</body>
</html>

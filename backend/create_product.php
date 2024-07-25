<?php
/* Sergio San Martín */

require_once '../CLASS/database.php';

try {
    $db = new Database('MIPROYECTO', 'localhost', 'root', '');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $precio = isset($_POST['precio']) ? trim($_POST['precio']) : '';
        $categoria_id = isset($_POST['categoria_id']) ? trim($_POST['categoria_id']) : '';

        if (empty($nombre) || empty($precio) || empty($categoria_id)) {
            throw new Exception('Todos los campos son requeridos.');
        }

        if (!is_numeric($precio)) {
            throw new Exception('El precio debe ser un número válido.');
        }

        // Manejo de la imagen
        $imagen = '';
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagenTmp = $_FILES['imagen']['tmp_name'];
            $imagenNombre = basename($_FILES['imagen']['name']);
            $imagenDestino = '../uploads/' . $imagenNombre;

            // Verifica si el directorio de subida existe, si no, lo crea
            if (!is_dir('../uploads')) {
                mkdir('../uploads', 0755, true);
            }

            // Mueve el archivo subido al directorio de destino
            if (move_uploaded_file($imagenTmp, $imagenDestino)) {
                $imagen = $imagenNombre;
            } else {
                throw new Exception('No se pudo subir la imagen.');
            }
        }

        $data = [
            'nombre' => $nombre,
            'precio' => $precio,
            'categoria_id' => $categoria_id,
            'imagen' => $imagen
        ];

        $insertResult = $db->insert('productos', $data);

        if ($insertResult) {
            header('Location: ../success.php');
            exit();
        } else {
            throw new Exception('No se pudo agregar el producto.');
        }
    } else {
        throw new Exception('Método de solicitud no permitido.');
    }
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}
?>

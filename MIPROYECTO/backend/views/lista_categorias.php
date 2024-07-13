<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link href="../assets/css/estilos.css" rel="stylesheet" />
    <script
      src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <main>
      <nav>
        <ul>
          <li>
            <a href="../index.php">
              <img class="logo" src="../assets/img/logo1.png" />
            </a>
          </li>
          <li><a href="../index.php">Inicio</a></li>
          <li><a href="views/categorias.html">Categorias</a></li>
          <li>
            <a href="./backend/lista_categorias.php">Lista Categorias</a>
          </li>
        </ul>
      </nav>

      <div class="form_container">
        <h1>Listado de categorías</h1>
        <div class="lista_categorias">
          <table>
            <tr>
              <th>Id</th>
              <th>Nombre Categoria</th>
            </tr>
            <?php foreach ($categorias as $categoria): ?>
              <tr>
                <td>
                  <div class="celda">
                    <?= $categoria["id"] ?>
                  </div>
                </td>
                <td>
                  <div class="celda">
                    <?= $categoria["nombre"] ?>
                  </div>  
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </main>

  </body>
</html>
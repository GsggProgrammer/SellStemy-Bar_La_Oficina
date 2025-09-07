<?php
include "../vista/VProducto.php";

// Manejo de las acciones según el botón presionado
if ($_POST["boton"] == "Registrar") {
    $objeto = new producto(
        b: $_POST['d1'], 
        c: $_POST['d2'], 
        d: $_POST['d3'], 
        e: $_POST['d4'], 
        f: $_POST['d5'],
        g: null,
        h: $_SESSION['documento'],
        i: $_POST['proveedor']
    );

    $r = $objeto->Registrar();

    if (!empty($r)) {
        echo "<script>
                alert('Producto registrado con éxito');
                window.location.href = '../vista/VProducto.html';
              </script>";
    }

} else if ($_POST["boton"] == "consultaNombreProducto") {
    $objeto = new producto(b: $_POST['d1']);
    $r = $objeto->consultaNombreProducto();

    if (!empty($r)) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>Consulta específica</title>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="../estilos/Consultas.css">
            </head>
            <body>
                <section>
                    <table>
                        <?php
                        foreach ($r as $valor) {
                            echo "<tr>
                                    <th>CÓDIGO:</th>
                                    <td>{$valor['ID']}</td>
                                  </tr>
                                  <tr>
                                    <th>NOMBRE:</th>
                                    <td>{$valor['Nombre']}</td>
                                  </tr>
                                  <tr>
                                    <th>TIPO DE PRODUCTO:</th>
                                    <td>{$valor['Tipo_Producto']}</td>
                                  </tr>
                                  <tr>
                                    <th>CANTIDAD:</th>
                                    <td>{$valor['Cantidad']}</td>
                                  </tr>
                                  <tr>
                                    <th>DESCRIPCION:</th>
                                    <td>{$valor['Descripcion']}</td>
                                  </tr>
                                  <tr>
                                    <th>PRECIO:</th>
                                    <td>{$valor['Valor_Venta']}</td>
                                  </tr>
                                  <tr>
                                    <th>PROVEEDOR:</th>
                                    <td>{$valor['Nombre_Proveedor']}</td>
                                  </tr>
                                  <tr>
                                    <th>ACCIONES:</th>
                                    <td>
                                        <a class='btn btn-outline-warning' style='margin-bottom: 10px; padding: 10px;'
                                           href='CAProducto.php?boton=producto_modi&idProducto={$valor['ID']}'>
                                           Modificar
                                        </a>
                                        <br>";

                            if ($_SESSION['tipoUsuario'] == 'Administrador') {
                                echo "<a class='btn btn-outline-danger' style='padding: 10px;'href='CAProducto.php?boton=producto_eli&idProducto={$valor['ID']}' onclick='confirmarEliminacion()'>
                                           Eliminar
                                      </a>";
                            }

                            echo "      </td>
                                  </tr>";
                        }
                        ?>
                    </table>
                    <?php
                    if($_SESSION['tipoUsuario'] == 'Administrador'){
                        echo " 
                    <form method='post' style='background-color: transparent !important; border: none !important;' action='reactivarProductos.php'>
                        <center>
                        <button type='submit' class='btn btn-success' style='width: 30% !important; padding: 12px !important' name='boton' value='consultaEliminados'> Restaurar Productos </button>
                        </center>
                    </form>";
                    }
                    ?>
                </section>
            </body>
        </html>
        <?php
    }

} else if ($_POST["boton"] == "consultaTodos") {
    $objeto = new producto();
    $r = $objeto->consultaGeneral();

    if (!empty($r)) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>Consulta general</title>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="../estilos/Consultas.css">
            </head>
            <body>
                <section>
                    <table>
                        <tr>
                            <th style="width: 5% !important;">CÓDIGO</th>
                            <th>NOMBRE</th>
                            <th>TIPO DE PRODUCTO</th>
                            <th>CANTIDAD</th>
                            <th style="width: 13% !important;">DESCRIPCION</th>
                            <th style="width: 5% !important;">PRECIO</th>
                            <th>PROVEEDOR</th>
                            <th style="width: 13% !important;">ACCIONES</th>
                        </tr>
                        <?php
                        foreach ($r as $valor) {
                            echo "<tr>
                                    <td>{$valor['ID']}</td>
                                    <td>{$valor['Nombre']}</td>
                                    <td>{$valor['Tipo_Producto']}</td>
                                    <td>{$valor['Cantidad']}</td>
                                    <td>{$valor['Descripcion']}</td>
                                    <td>{$valor['Valor_Venta']}</td>
                                    <td>{$valor['Nombre_Proveedor']}</td>
                                    <td>
                                        <a class='btn btn-outline-warning' style='padding: 8px;' href='CAProducto.php?boton=producto_modi&idProducto={$valor['ID']}'>
                                           Modificar
                                        </a>";

                            // Verifica si el usuario es un Administrador para mostrar el botón de eliminar
                            if ($_SESSION['tipoUsuario'] == 'Administrador') {
                                echo "<a class='btn btn-outline-danger'style='padding: 8px; margin-left: 10px;' href='CAProducto.php?boton=producto_eli&idProducto={$valor['ID']}' onclick='confirmarEliminacion()'>
                                           Eliminar
                                      </a>
                                      </td>";
                            } 

                            echo "</tr>";
                        }
                        ?>
                    </table>
                    <?php
                    if($_SESSION['tipoUsuario'] == 'Administrador'){
                        echo " 
                    <form method='post' style='background-color: transparent !important; border: none !important;' action='reactivarProductos.php'>
                        <center>
                        <button type='submit' class='btn btn-success' style='width: 30% !important; padding: 12px !important' name='boton' value='consultaEliminados'> Restaurar Productos </button>
                        </center>
                    </form>";
                    }
                    ?>
                </section>
            </body>
        </html>
        <?php
    }

} else if ($_POST["boton"] == "actualizar") {
    $objeto = new producto(
        a: $_POST["d1"],
        b: $_POST['d2'], 
        c: $_POST['d3'], 
        d: $_POST['d4'], 
        e: $_POST['d5'], 
        f: $_POST['d6'],
        g: $_POST['d7'],
        i: $_POST['proveedor']
    );

    $r = $objeto->Actualizacion(); 

    if ($r == 1) {
        echo "<script>
                alert('Actualización exitosa');
              </script>";            
    } else {
        echo "Vuelva a intentarlo, los datos no se actualizaron";
    }
}

else if ($_GET["boton"] == "reactivarProducto") {
    $objeto = new producto(a: $_GET['doc']);
    $r = $objeto->Reactivacion();
    if (empty ($r)) {
      echo "<script>
          if (confirm('El producto ha sido Restaurado')) {
              window.location.href = '../vista/VProducto.php';
          }
      </script>";
  } else {
      echo "<script>
          if (confirm('El producto no ha sido Restaurado')) {
              window.location.href = '../vista/VProducto.php';
          }
      </script>";
  }
}
?>
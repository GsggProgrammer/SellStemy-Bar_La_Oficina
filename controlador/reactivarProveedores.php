<?php
include '../modelo/MProveedor.php';
if ($_POST['boton'] == 'consultaEliminados'){
    $objeto = new proveedor();
    $r = $objeto -> consultaEliminados();
    if (!empty ($r)){
        ?>
        <!DOCTYPE html>
            <html lang="es">
                <head>
                    <title>Consulta general</title>
                    <meta charset="UTF-8">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                    <link rel="stylesheet" href="../estilos/Vistas.css">
                    <link rel="stylesheet" href="../estilos/Consultas.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                    </head>
                    <header>
                    <div class="row">
                      <div class="col-2">
                       <a href="../vista/VUsuario.html" class="btn btn-outline-dark mr-auto volver">
                        <i class="fas fa-arrow-left"></i> <span>Volver</span>
                       </a>
                      </div>
                      <div class="col-8">
                       <h1> Restaurar Proveedores Bar-LaOficina </h1>
                      </div>
                      <div class="col-2">
                       <a href="#" class="btn btn-outline-dark cerrarSesion" onclick="cerrarSesion()">
                        <i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span>
                       </a>
                      </div>
                     </div>
                    </header>
                    <body>
                        <section>
                            <table>
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>NOMBRE</th>
                                    <th>DIRECCION</th>
                                    <th>TELÉFONO</th>
                                    <th>DIA DE ENTREGA</th>
                                    <th>ACCION</th>
                                </tr>
                                <?php
                                    foreach($r as $valor){
                                        echo "<tr>
                                            <td>$valor[ID]</td>
                                            <td>$valor[Nombre]</td>
                                            <td>$valor[Direccion]</td>
                                            <td>$valor[Telefono]</td>
                                            <td>$valor[Dia_Entrega]</td>
                                            <td><a class='btn btn-outline-success' style='border: 2px solid green;' href='CProveedor.php?boton=reactivarProveedor&doc=$valor[ID]'> Restaurar </a>";
                                    }
                                ?>
                            </table>
                        </section>
                    </body>
                    <script>
      function cerrarSesion() {
          if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
            window.location.href = "../cerrarSesion.php";
          }
      }
    </script>
                </html>

        <?php
    } else {
        echo "<script>
        alert('No hay proveedores eliminados');
        window.location.href='../vista/VProveedor.html';
        </script>";
    }
}
?>
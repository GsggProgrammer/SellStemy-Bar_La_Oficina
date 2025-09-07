<?php
include '../modelo/MVenta.php';
$objeto = new venta();
$r = $objeto->masVendidos();
if (!empty($r)) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <title>Productos Mas Vendidos</title>
            <meta charset="UTF-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <link rel="stylesheet" href="../estilos/ReporteProducto.css">
        </head>
        <header>
        <div class="container mt-4">
            <div class="row">
                <div class="col-2">
                    <a href="../vistaprincipal.php" class="btn btn-outline-dark mr-auto volver">
                        <i class="fas fa-arrow-left"></i> <span>Volver</span>
                    </a>
                </div>
                <div class="col-8">
                    <h1>
                        Productos Mas Vendidos Bar-LaOficina
                    </h1>
                </div>
                <div class="col-2">
                    <a href="#" class="btn btn-outline-dark cerrarSesion" onclick="cerrarSesion()">
                        <i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span>
                    </a>
                </div>
            </div>
        </div>
        </header>
        <body>
            <section>
                <center>
                <table>
                    <tr>
                        <th>CÓDIGO DEL PRODUCTO</th>
                        <th>NOMBRE DEL PRODUCTO</th>
                        <th>VENTAS RELACIONADAS</th>
                        <th>CANTIDAD VENDIDA</th>  <!-- Nueva columna para la cantidad vendida -->
                    </tr>
                    <?php
                    foreach ($r as $valor) {
                        echo "<tr>
                                <td>{$valor['ProductoID']}</td>
                                <td>{$valor['NombreProducto']}</td>
                                <td>{$valor['TotalVentas']}</td>
                                <td>{$valor['CantidadVendida']}</td> <!-- Agregar cantidad vendida -->
                              </tr>";
                    }
                    ?>
                </table>
                </center>
            </section>
        </body>
                    <!-- Scripts -->
    <script>
      function cerrarSesion() {
        if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
            window.location.href = "../cerrarSesion.php";
        }
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </html>
    <?php
} else {
    echo "<script>
        alert ('No existen ventas en el sistema');
        window.location.href = '../vistaprincipal.php';
    </script>";
}
?>
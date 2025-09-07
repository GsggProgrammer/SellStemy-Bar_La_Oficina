<?php
  //A partir de estas cabeceras, todo el documento se exporta como .xls
if (isset($_POST["reporte"])) {
    // Cabeceras para indicar que es un archivo de Excel .xls
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Confirmacion_Pedido.xls");  // Cambiado a .xls
    header("Pragma: no-cache");
    header("Expires: 0");                
}
    ?>
    <!DOCTYPE html>
        <html lang="es">
        <head>
            <title>Confirmación de pedido</title>
            <meta charset="UTF-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <link  rel="stylesheet" href="../estilos/Venta.css">
            <style>
                .sinborde{
                    border:0;
                    width:auto;
                }
            </style>

        </head>
        <header>
        <div class="container mt-4">
            <div class="row">
                <div class="col-2">
                    <a href="../vista/VVenta.php" class="btn btn-outline-dark mr-auto volver">
                        <i class="fas fa-arrow-left"></i> <span>Volver</span>
                    </a>
                </div>
                <div class="col-8">
                    <h1>
                        Registrar Ventas Bar-LaOficina
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
        <section style="margin:4% 4% 0% 4%">
    <fieldset>
        <legend>Confirmación de Venta</legend>    
        <br>
        <p style='color: white;'>Confirme su Pedido dando clic a Registrar Venta:</p>
<form method='POST' action='ConfirmarVenta.php'>
    <table class="table" id="TablaDetallesPedido">
        <tr>
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>DESCRIPCIÓN</th>
            <th>UNIDADES</th>
            <th>SUBTOTAL</th>
        </tr>
        <?php
$i = 1;
$total = 0;
$veces = count($_POST) / 5; // Calcula cuántos productos hay, dividiendo por 5

while ($i <= $veces) {
    // Verifica que la clave "cantidad$i" exista en $_POST
    if (isset($_POST["cantidad$i"]) && $_POST["cantidad$i"] != 0) {
        $precio = $_POST["valorVenta$i"] ?? 0; // Usar el valor de POST o 0 por defecto
        $cantidad = $_POST["cantidad$i"] ?? 0;
        $subtotal = $cantidad * $precio;

        echo "<tr>
                <td><input type='number' readonly name='id[]' value='".$_POST["id$i"]."'></td>
                <td>".$_POST["nombre$i"]."</td>
                <td><input type='number' readonly name='precio[]' value='$precio'></td>
                <td>".$_POST["descripcion$i"]."</td>
                <td><input type='number' readonly name='cantidad[]' value='$cantidad'></td>
                <td>$subtotal</td>
              </tr>";

        $total += $subtotal;
    }
    $i++;
}
?>
        <tr>
            <td colspan="6" style="text-align:center;">
                <br>
                <h5><u>El valor total de la venta es: $<?php echo number_format($total); ?></u></h5><br>
            </td>
        </tr>
    </table>
    <br>
    <div style="text-align:center;">
        <input type="hidden" name="total" value="<?php echo $total; ?>">    
        <!-- Campo para el método de pago -->
        <label for="metodoPago" class='metodoPago'>Método de Pago:</label>
        <select name="metodoPago" class='select' required>
            <option value="Efectivo">Efectivo</option>
            <option value="Tarjeta">Tarjeta</option>
            <option value="Transferencia">Transferencia</option>
        </select>
        <br>
        <input type="text" name="descripcion" placeholder="Descripción del pago" style='color: white;'>
        <br>
        <button type="submit" name='registroVenta' class="btn btn-success" style='width: 50%'>Registrar Venta</button>
    </div>
</form>
    </fieldset>
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
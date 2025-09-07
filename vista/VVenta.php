<?php
    session_start();
    if(!empty($_SESSION["documento"]))     //Si la variable de sesión no tiene valor
     {
        include "../modelo/MProducto.php";
        $objeto = new producto();
        $r = $objeto->consultaGeneral(); 
     }
     else{
        header("location:../vista/VLogin.html");
     }
?>

    <!DOCTYPE html>
        <html lang="es">
        <head>
            <title>Consulta de productos</title>
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
                    <a href="../vistaprincipal.php" class="btn btn-outline-dark mr-auto volver">
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
                    <legend>Productos disponibles - Venta</legend>    
                    <br>
                    <p style='color: white;'>Adicione a cada producto una cantidad a comprar y confirme su Venta dando clic al botón Confirmar e ir al pedido:</p>
                    <form method='post' onsubmit='return validarUnidades();' action='../controlador/CVenta.php'>
                        <table class='table'>
                            <tr><th>CÓDIGO</th><th>NOMBRE</th><th>CATEGORIA</th><th>DESCRIPCIÓN</th><th>PRECIO</th><th>UNIDADES</th></tr>
                            <?php
                                $i=1;
                                foreach($r as $valor){
                                    // var_dump ($valor);
                                    echo "<tr>
                                            <td><input type='text' readonly name='id$i' class='sinborde' value='$valor[ID]'></td>
                                            <td><input type='text' readonly name='nombre$i' class='sinborde' value='$valor[Nombre]'></td>
                                            <td><input type='text' readonly name='tipoProducto$i' class='sinborde' value='$valor[Tipo_Producto]'></td>
                                            <td><input type='text' readonly name='descripcion$i' class='sinborde' value='$valor[Descripcion]'></td>
                                            <td><input type='number' readonly name='valorVenta$i' class='sinborde' value='$valor[Valor_Venta]'></td>
                                            <td><input type='number' min='0' max='1000' value='0' name='cantidad$i' class='unidades'></td>
                                        </tr>";
                                    $i++;
                                }
                            ?>
                        </table>
                        <div class="row">
                        <div style="text-align:center;">
                            <div class="col-md-5">
                               <button type="submit" class="btn btn-success" name='boton'>Continuar</button>
                            </div>
                            <div class="col-md-5">
                               <button type="submit" class="btn btn-primary" value="SI" name="reporte">Generar Reporte Previo</button>
                            </div>
                        </div>
                        </div>
                </fieldset>
            </section>
            </form>
            <?php
            if ($_SESSION['tipoUsuario'] == 'Administrador'){
                ?>
            <form method="post" action="../controlador/CCVenta.php" id='formConsulta'>
          <div class="row">
           <div class="col-8">
            <label for="d1" id='labelConsultaEspecifica'> Ingresar Fecha De Venta: </label>
            <input type="date" id="consultaEspecifica" name="d1">
          </div>
          <div class="col-2">
            <button type="submit" name="botonConsulta" value="consultaFechaVenta" id='consulta1' class="btn btn-primary"> Buscar </button>
          </div>
          <div class="col-2">
            <button type="submit" name="botonConsulta" value="consultaTodos" id='consulta2' class="btn btn-primary"> Ver Todos </button>
          </div>
         </div>
        </form>
                <?php
            }
        ?>
        </body>
            <!-- Scripts -->
    <script>
        // Validar que al menos un producto tenga una cantidad mayor a 0
        function validarUnidades() {
            var unidades = document.querySelectorAll('.unidades');
            var algunaUnidadMayorACero = false;

            // Iterar por cada input de unidades
            unidades.forEach(function (input) {
                if (parseInt(input.value) > 0) { // verificar que alguno de los input sea entero y al mismo tiempo mayor que 0
                    algunaUnidadMayorACero = true; // establece la variable como verdadera si existe algun producto en la venta
                }
            });

            if (!algunaUnidadMayorACero) {
                alert('Debe agregar al menos un producto a la venta');
                return false;  // Evitar el envío del formulario
            }

            return true;  // Permitir el envío si hay unidades válidas
        }

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
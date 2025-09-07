<?php
session_start();
include "../modelo/MProveedor.php";
include "../vista/VProveedor.html";
if($_POST['boton'] == 'Registrar'){
$objeto = new proveedor(
    b: $_POST['d1'], 
    c: $_POST['d2'], 
    d: $_POST['d3'], 
    e: $_POST['d4'], 
    f: $_SESSION['documento']
);
$r=$objeto -> Registrar();
  if (!empty($r)){
?>
<script>
    alert("Proveedor registrado con exito");
    window.location.href = "../vista/VProveedor.html";
</script>
<?php
} 
} else if ($_POST["boton"] == "consultaNombreProveedor"){
    $objeto = new proveedor (
        b: $_POST ['d1']
    );
    $r = $objeto -> consultaNombreProveedor ();
    if (!empty ($r)){
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
                            foreach($r as $valor){
                                echo "  <tr>
                                            <th>CÓDIGO:</th>
                                            <td>$valor[ID]</td>
                                        </tr>
                                        <tr>
                                            <th>NOMBRE:</th>
                                            <td>$valor[Nombre]</td>
                                        </tr>
                                        <tr>
                                            <th>DIRECCION:</th>
                                            <td>$valor[Direccion]</td>
                                        </tr>
                                        <tr>
                                            <th>TELÉFONO:</th>
                                            <td>$valor[Telefono]</td>
                                        </tr>
                                        <tr>
                                            <th>ULTIMA ENTREGA:</th>
                                            <td>$valor[Dia_Entrega]</td>
                                        </tr>
                                        <tr>
                                            <th>ACCIONES:</th>
                                            <td>
                                            <a class='btn btn-outline-warning' style='margin-bottom: 10px; padding: 10px;' href='CAProveedor.php?boton=proveedor_modi&idProveedor=$valor[ID]'>Modificar</a>
                                            <br>";
                                            if ($_SESSION['tipoUsuario'] == 'Administrador') {
                                echo "<a class='btn btn-outline-danger' style='padding: 10px;'href='CAProveedor.php?boton=proveedor_eli&idProveedor={$valor['ID']}' onclick='confirmarEliminacion()'>
                                           Eliminar
                                      </a>";
                            }

                            echo "      </td>
                                  </tr>";
                        }
                        ?>
                    </table>
                    <?php
                            if ($_SESSION['tipoUsuario'] == 'Administrador'){
                                echo "
                            <form method='post' style='background-color: transparent !important; border: none !important;' action='reactivarProveedores.php'>
                                <center>
                                <button type='submit' class='btn btn-success' style='width: 30% !important; padding: 12px !important' name='boton' value='consultaEliminados'> Restaurar Proveedores </button>
                                </center>
                            </form>";
                            }
                            ?>
                </section>
            </body>
        </html>
    <?php
    }
} 

else if ($_POST["boton"] == "consultaTodos"){
    $objeto=new proveedor();
    $r = $objeto -> consultaGeneral();
    if(!empty($r)){
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
                                    <th>CÓDIGO</th>
                                    <th>NOMBRE</th>
                                    <th>DIRECCION</th>
                                    <th>TELÉFONO</th>
                                    <th>ULTIMA ENTREGA</th>
                                    <th colspan='2'>ACCIONES</th>
                                </tr>
                                <?php
                                    foreach($r as $valor){
                                        echo "<tr>
                                            <td>$valor[ID]</td>
                                            <td>$valor[Nombre]</td>
                                            <td>$valor[Direccion]</td>
                                            <td>$valor[Telefono]</td>
                                            <td>$valor[Dia_Entrega]</td>
                                            <td><a class='btn btn-outline-warning' style='padding: 8px;' href='CAProveedor.php?boton=proveedor_modi&idProveedor=$valor[ID]'>Modificar</a>
                                            ";

                            // Verifica si el usuario es un Administrador para mostrar el botón de eliminar
                            if ($_SESSION['tipoUsuario'] == 'Administrador') {
                                echo "<a class='btn btn-outline-danger' style='padding: 8px;' href='CAProveedor.php?boton=proveedor_eli&idProveedor={$valor['ID']}' onclick='confirmarEliminacion()'>
                                           Eliminar
                                      </a>
                                      </td>";
                            } 
                            echo "</tr>";
                        }
                        ?>
                            </table>
                            <?php
                            if ($_SESSION['tipoUsuario'] == 'Administrador'){
                                echo "
                            <form method='post' style='background-color: transparent !important; border: none !important;' action='reactivarProveedores.php'>
                                <center>
                                <button type='submit' class='btn btn-success' style='width: 30% !important; padding: 12px !important' name='boton' value='consultaEliminados'> Restaurar Proveedores </button>
                                </center>
                            </form>";
                            }
                            ?>
                        </section>
                    </body>
                </html>

        <?php
    }
}
else if($_POST["boton"]=="actualizar"){
    //var_dump($_POST);
    $objeto = new proveedor(
        a: $_POST['d1'],
        b: $_POST['d2'], 
        c: $_POST['d3'], 
        d: $_POST['d4'], 
        e: $_POST['d5']
    );
    $r = $objeto->Actualizacion(); 
    if($r==1){
        echo "<script>
        alert('Actualizacion extiosa');
        </script>";            
    }
    else{
        echo "Vuelva a intentarlo, los datos no se actualizaron";
    }
}
else if ($_GET["boton"] == "reactivarProveedor") {
    $objeto = new proveedor(a: $_GET['doc']);
    $r = $objeto->Reactivacion();
    if (empty ($r)) {
      echo "<script>
          if (confirm('El Proveedor ha sido Restaurado')) {
              window.location.href = '../vista/VProveedor.html';
          }
      </script>";
  } else {
      echo "<script>
          if (confirm('El Proveedor no ha sido Restaurado')) {
              window.location.href = '../vista/VProveedor.html';
          }
      </script>";
  }
}

        ?>

        ?>
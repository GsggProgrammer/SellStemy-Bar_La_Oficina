<?php
include '../vista/VVenta.php';
include '../modelo/MVenta.php';
if ($_POST["botonConsulta"] == "consultaFechaVenta") {
    $objeto = new venta(d: $_POST['d1']);
    $r = $objeto->consultaFechaVenta();
    if (!empty($r)) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>Consulta específica</title>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="../estilos/Venta.css">
            </head>
            <body>
                <section id='consultaFecha'>
                <?php
// Suponiendo que la fecha ha sido enviada a través de un formulario
$fechaVenta = isset($_POST['d1']) ? $_POST['d1'] : null;

// Mostrar subtítulo con la fecha de las ventas
if ($fechaVenta) {
    echo "<center><h2>Ventas del día: $fechaVenta</h2></center>";
} else {
    echo "<h2>Ventas del día: No se ha especificado una fecha</h2>";
}
?>

<table class='table'>
    <thead>
        <tr>
            <th>CÓDIGO</th>
            <th>MÉTODO DE PAGO</th>
            <th>FECHA DE REGISTRO</th>
            <th>DESCRIPCIÓN</th>
            <th>SUBTOTAL</th>
            <th>VALOR TOTAL</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($r as $valor) {
            // var_dump ($valor);
            echo "<tr>
                    <td>{$valor['ID']}</td>
                    <td>{$valor['Metodo_Pago']}</td>
                    <td>{$valor['Fecha_Venta']}</td>
                    <td>{$valor['Descripcion']}</td>
                    <td>{$valor['sub_total']}</td>
                    <td>{$valor['valor_total']}</td>
                    <td>
                    <a class='btn btn-outline-warning' href='CAVenta.php?boton=venta_modi&idVenta={$valor['ID']}'>
                        Modificar
                    </a> 
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
                </section>
            </body>
        </html>
        <?php
    }

} else if ($_POST["botonConsulta"] == "consultaTodos") {
    $objeto = new venta();
    $r = $objeto->consultaGeneral();
    if (!empty($r)) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>Consulta general</title>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="../estilos/Venta.css">
            </head>
            <body>
                <section id='consultaFecha'>
                <table class='table'>
    <thead>
        <tr>
            <th>CÓDIGO</th>
            <th>MÉTODO DE PAGO</th>
            <th>FECHA DE REGISTRO</th>
            <th>DESCRIPCIÓN</th>
            <th>SUBTOTAL</th>
            <th>VALOR TOTAL</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($r as $valor) {
            // var_dump ($valor);
            echo "<tr>
                    <td>{$valor['ID']}</td>
                    <td>{$valor['Metodo_Pago']}</td>
                    <td>{$valor['Fecha_Venta']}</td>
                    <td>{$valor['Descripcion']}</td>
                    <td>{$valor['sub_total']}</td>
                    <td>{$valor['valor_total']}</td>
                    <td>
                        <a class='btn btn-outline-warning' href='CAVenta.php?boton=venta_modi&idVenta={$valor['ID']}'>
                            Modificar
                        </a>
                    </td>
                  </tr>
                  ";
        } 
        ?>
    </tbody>
</table>
                </section>
            </body>
        </html>
        <?php
    }
} else if ($_POST["boton"] == "actualizar") {
    $objeto = new venta(
        a: $_POST["d1"],
        b: $_POST['d2'], 
        d: $_POST['d3'], 
        e: $_POST['d4'], 
        f: $_POST['d5'], 
        g: $_POST['d6']
    );

    $r = $objeto->Actualizacion(); 

    if ($r == 1) {
        echo "<script>
                alert('Actualización exitosa');
                window.location.href='../vista/VVenta.php';
              </script>";            
    } else {
        echo "Vuelva a intentarlo, los datos no se actualizaron";
    }
}
?>
<?php

include "../modelo/MVenta.php";
session_start();

$total = $_POST['total'];
$subTotal = $total / 1.19;
$iva = $total - $subTotal;

$detallesFactura = [];

if (isset($_POST['id'], $_POST['cantidad'], $_POST['precio'])) {
    for ($i = 0; $i < count($_POST['id']); $i++) {
        $detallesFactura[] = [
            'id' => $_POST['id'][$i],
            'precio' => $_POST['precio'][$i],
            'cantidad' => $_POST['cantidad'][$i]
        ];
    }
}

$objeto = new venta(
    b: $_POST['metodoPago'],
    c: $iva,
    e: $_POST['descripcion'],
    f: $subTotal,
    g: $total,
    h: $_SESSION["documento"],
    i: $detallesFactura
);

if (isset($_POST["registroVenta"])) {
    $r = $objeto->registrar();

    if ($r == 1) {
        echo "<script>
                alert('Registro exitoso');
                window.location.href = '../vista/VVenta.php';
              </script>";
    } else {
        echo "<script>
                alert('Error de registro, vuelva a intentarlo');
                window.location.href = '../vista/VVenta.php';
              </script>";
    }
}

?>
<?php
if ($_POST["boton"] == "Acceder") {
    include "../modelo/MUsuario.php";
    $objeto = new usuario(
        b: $_POST['d1'],  // Nombre_Usuario
        d: $_POST['d2']   // Contraseña ingresada por el usuario
    );
    $r = $objeto->LOGIN();  // Obtener los datos del usuario desde la base de datos

    if (!empty($r)) {
        // Verificar si la contraseña ingresada coincide exactamente con la de la base de datos usando '==='
        if ($r[0]['contrasena'] === $_POST['d2']) {
            session_start();
            $_SESSION["documento"] = $r[0]['Nombre_Usuario'];
            $_SESSION["contrasena"] = $r[0]['contrasena'];
            $_SESSION["tipoUsuario"] = $r[0]['Tipo_Usuario'];
            header("location: ../vistaprincipal.php");
        } else {
            echo "<script>
            alert('Credenciales Incorrectas');
            window.location.href = '../vista/VLogin.html';
            </script>";
        }
    } else {
        echo "<script>
        alert('Credenciales Incorrectas');
        window.location.href = '../vista/VLogin.html';
        </script>";
    }
} else {
    echo "Error: No se recibieron los datos de inicio de sesión";
}
?>
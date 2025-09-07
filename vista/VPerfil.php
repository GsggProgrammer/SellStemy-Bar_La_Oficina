<?php
include "../modelo/MUsuario.php";
// var_dump($_POST);
session_start();
$objeto = new usuario(
    b: $_SESSION['documento']
);
$r = $objeto->consultaNombreUsuario();
if (!empty($r)) {
?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <title>Perfil</title>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../estilos/Perfil.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
    <body>
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
                    <?php
                        if ($_SESSION['tipoUsuario'] == 'Administrador') {
                            echo 'Perfil de Administrador';
                        } elseif ($_SESSION['tipoUsuario'] == 'Cajero') {
                            echo 'Perfil de Cajero';
                        } elseif ($_SESSION['tipoUsuario'] == 'Almacenista') {
                            echo 'Perfil del Almacenista';
                        } else {
                            echo 'Perfil de Usuario';
                        }
                    ?>
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
    <main>
        <section>  
            <main>
                <div class='container mt-4'>
                    <div class='row justify-content-center'>
                        <div class='col-md-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>                             
                                <?php
                                foreach ($r as $valor) {
                                    echo "
                                      <h3 class='card-title'>Información Personal</h3>
                                      <p><strong>Nombre de Usuario:</strong> " . $valor['Nombre_Usuario'] . "</p>
                                      <p><strong>Nombre:</strong> " . $valor['Nombre'] . "</p>
                                      <p><strong>Correo Electrónico:</strong> " . $valor['Correo_Electronico'] . "</p>
                                      <p><strong>Teléfono:</strong> " . $valor['Telefono'] . "</p>
                                      <p><strong>Fecha de Nacimiento:</strong> " . $valor['Fecha_Nacimiento'] . "</p>
                                      <p><strong>Género:</strong> " . $valor['Genero'] . "</p>
                                      <p><strong>Tipo de Sangre:</strong> " . $valor['Tipo_Sangre'] . "</p>
                                      <p><strong>EPS:</strong> " . $valor['EPS'] . "</p>
                                      <p><strong>Estado Civil:</strong> " . $valor['Estado_Civil'] . "</p>
                                    ";

                                    // Verifica si el usuario es un Administrador para mostrar el botón de editar perfil
                                    if ($_SESSION['tipoUsuario'] == 'Administrador') {
                                        echo "
                                          <a href='../controlador/CPerfil.php?boton=perfil_modi&doc={$valor['Nombre_Usuario']}' class='btn btn-outline-dark FormButton'>
                                            <i class='fas fa-edit'></i> <span class='TextButton'>Editar Perfil</span>
                                          </a>
                                        ";
                                    } else {
                                        echo "<p class='text-danger'>No tienes permisos de edicion.</p>";
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
}
if (isset($_POST['boton']) && ($_POST["boton"]=="actualizar")) {
    $objeto = new usuario(
        b: $_POST['d1'], 
        c: $_POST['d2'], 
        e: $_POST['d5'], 
        f: $_POST['d7'], 
        g: $_POST['d4'],
        h: $_POST['d8'],
        i: $_POST['d6'],
        j: $_POST['d3'],
        k: $_POST['d9'],
        l: $_POST['d10'],
        m: $_POST['d11']
    );
    $r = $objeto->actualizacion(); 
    if ($r == 1) {
        echo "<script>
        alert('Actualización exitosa');
        </script>";            
    } else {
        echo "Vuelva a intentarlo, los datos no se actualizaron";
    }
}
?>
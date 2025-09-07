<?php
session_start();
// var_dump($_SESSION);
$tipoUsuario = $_SESSION['tipoUsuario'];
// var_dump($tipoUsuario);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas - Bar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card-link {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }

        .card-link:hover {
            text-decoration: none;
            color: inherit;
        }

        .card-body {
            text-align: center;
        }

        .card i {
            font-size: 2rem;
            display: block;
            margin-bottom: 0.5rem;
            color: black;
        }
    </style>
    <script>
        function cerrarSesion() {
            if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
                window.location.href = "cerrarSesion.php";
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-0">
                <?php
                    if ($tipoUsuario == 'Administrador') {
                        echo 'Panel de Administración';
                    } elseif ($tipoUsuario == 'Cajero') {
                        echo 'Panel de Cajero';
                    } elseif ($tipoUsuario == 'Almacenista') {
                        echo 'Panel del Almacenista';
                    } else {
                        echo 'Panel de Usuario';
                    }
                ?>
                </h1>
                <a href="#" class="btn btn-outline-dark cerrarSesionBtn" onclick="cerrarSesion()">
                    <i class="fas fa-sign-out-alt"></i> <span class="cerrarsesion">Cerrar sesión</span>
                </a>
            </div>
        </div>
    </header>
    <main>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <!-- Módulo Usuarios (Solo para Administradores) -->
                <?php if ($tipoUsuario == 'Administrador') : ?>
                <div class="col-md-3 mb-4">
                    <a href="vista/VUsuario.html" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-users"></i>
                                <h3>Usuarios</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Módulo Proveedores (No disponible para Cajeros) -->
                <?php if ($tipoUsuario !== 'Cajero') : ?>
                <div class="col-md-3 mb-4">
                    <a href="vista/VProveedor.html" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-truck"></i>
                                <h3>Proveedores</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Módulo Productos (No disponible para Cajeros) -->
                <?php if ($tipoUsuario !== 'Cajero') : ?>
                <div class="col-md-3 mb-4">
                    <a href="vista/VProducto.php" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-coins"></i>
                                <h3>Productos</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Módulo Ventas (No disponible para Almacenistas) -->
                <?php if ($tipoUsuario !== 'Almacenista') : ?>
                <div class="col-md-3 mb-4">
                    <a href="vista/VVenta.php" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-cart-plus"></i>
                                <h3>Ventas</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Módulo Reporte Productos (Solo Administrador y Almacenista) -->
                <?php if ($tipoUsuario == 'Administrador' || $tipoUsuario == 'Almacenista') : ?>
                <div class="col-md-3 mb-4">
                    <a href="controlador/CReporteProducto.php" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-signal"></i>
                                <h3>Reporte De Productos</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Módulo Reporte Ventas (Solo para Administrador) -->
                <?php if ($tipoUsuario == 'Administrador') : ?>
                <div class="col-md-3 mb-4">
                    <a href="controlador/CReporteVenta.php" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-signal"></i>
                                <h3>Reporte De Ventas</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Módulo Perfil (Disponible para todos los usuarios) -->
                <div class="col-md-3 mb-4">
                    <a href="vista/VPerfil.php" class="card-link">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-user-circle"></i>
                                <h3>Perfil Personal</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
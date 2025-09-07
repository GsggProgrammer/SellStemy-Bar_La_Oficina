<?php
session_start();
include "../modelo/MProducto.php";

if (isset($_GET["boton"])) {

  if ($_GET["boton"] == "producto_eli") {
      $objeto = new producto(a: $_GET['idProducto']);
      $r = $objeto->Eliminacion();
      if ($r == 1) {
          echo "<script>
              if (confirm('El producto ha sido eliminado')) {
                  window.location.href = '../vista/VProducto.php';
              }
          </script>";
      } else {
          echo "<script>
              if (confirm('El producto no ha sido eliminado')) {
                  window.location.href = '../vista/VProducto.php';
              }
          </script>";
      }
  } else {
    $objeto = new producto(
        a: $_GET['idProducto']
    );
    $r = $objeto->consultaID();
    $proveedores = $objeto->nombreProveedor();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Consulta general</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../estilos/Consultas.css">
    <?php

// Verificar si el tipo de usuario no es administrador
if ($_SESSION['tipoUsuario'] !== 'Administrador') {
    echo '<script>
    let cantidadActual;

    function obtenerCantidadActual() {
        cantidadActual = parseInt(document.getElementById("d5").value);
    }

    function validarForm() {
        var cantidadNueva = parseInt(document.getElementById("d5").value);

        if (cantidadNueva < cantidadActual) {
            alert("El valor no puede ser menor a : " + cantidadActual);
            return false;
        }
        return true;
    }

    document.addEventListener("DOMContentLoaded", obtenerCantidadActual);
    </script>';
} else {
    echo '<script>
    // Si el usuario es administrador, puedes optar por no ejecutar el script
    console.log("Acceso denegado para administradores.");
    </script>';
}
?>
</head>
<body>
<section>
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-modal">
                <div class="modal-header">
                    <h2 class="modal-title" id="editProfileModalLabel">Editar Producto</h2>
                </div>
                <form onsubmit="return validarForm()" method="post" action="CProducto.php">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <label>Codigo</label>
                                <input type="number" min="1" max="1000" id="d1" name="d1" readonly value="<?php echo $r[0]['ID']; ?>" required>
                            </div>
                            <div class="col-6">
                                <label>Nombre Producto</label>
                                <input type="text" maxlength="100" id="d2" name="d2" value="<?php echo $r[0]['Nombre']; ?>" required>
                            </div>
                            <div class="col-6">
                                <label>Valor de Compra</label>
                                <input type="text" id="d3" name="d3" value="<?php echo $r[0]['Valor_Compra']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Tipo de Producto</label>
                                <select name="d4">
                                    <option value="Alcoholica" <?php if($r[0]['Tipo_Producto'] == 'Alcoholica') echo 'selected'; ?>>Alcoholica</option>
                                    <option value="No Alcoholica" <?php if($r[0]['Tipo_Producto'] == 'No Alcoholica') echo 'selected'; ?>>No Alcoholica</option>
                                    <option value="Snacks" <?php if($r[0]['Tipo_Producto'] == 'Snacks') echo 'selected'; ?>>Snacks</option>
                                    <option value="Plato Elaborado" <?php if($r[0]['Tipo_Producto'] == 'Plato Elaborado') echo 'selected'; ?>>Plato Elaborado</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label>Cantidad</label>
                                <input type="number" min="1" step="1" id="d5" name="d5" value="<?php echo $r[0]['cantidad']; ?>" required>
                            </div>
                            <div class="col-5">
                                <label>Descripcion</label>
                                <input type="text" maxlength="150" id="d6" name="d6" value="<?php echo $r[0]['Descripcion']; ?>">
                            </div>
                            <div class="col-6">
                            <label> Proveedor </label>
                              <select id="proveedor" name="proveedor" required>
                              <?php
                                foreach ($proveedores as $proveedor): 
                                $selected = ($proveedor['ID'] == $idProveedorActual) ? 'selected' : '';
                              ?>
                                <option value="<?php echo $proveedor['ID']; ?>" <?php echo $selected; ?>>
                              <?php echo htmlspecialchars($proveedor['Nombre']); ?>
                                </option>
                              <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="col-6">
                                <!-- Campo readonly para mostrar el ValorVenta -->
                                <input type="hidden" id="d7" name="d7" value="<?php echo $r[0]['Valor_Venta']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="boton" value="actualizar" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php
}
}
?>
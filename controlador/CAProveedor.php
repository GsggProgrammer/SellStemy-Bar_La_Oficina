<?php
include "../modelo/MProveedor.php";

if (isset($_GET["boton"])) {

  if ($_GET["boton"] == "proveedor_eli") {
      $objeto = new proveedor(a: $_GET['idProveedor']);
      $r = $objeto->Eliminacion();
      if ($r == 1) {
          echo "<script>
              if (confirm('El proveedor ha sido eliminado')) {
                  window.location.href = '../vista/VProveedor.html';
              }
          </script>";
      } else {
          echo "<script>
              if (confirm('El proveedor no ha sido eliminado')) {
                  window.location.href = '../vista/VProveedor.html';
              }
          </script>";
      }
  } else{
    $objeto = new proveedor(
        a: $_GET['idProveedor']
    );
    $r = $objeto->consultaID();
    //var_dump($r);
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
            <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content rounded-modal">
                  <div class="modal-header">
                       <h2 class="modal-title" id="editProfileModalLabel">Editar Proveedor</h2>
                     </div>
                     <form method="post" action="CProveedor.php">
                       <div class="modal-body">
                         <div class="row">
                           <div class="col-4">
                             <label>Codigo</label>
                             <input type="number" min="1" max="1000" id="d1" name="d1" readonly value="<?php echo $r[0]['ID']; ?>" required>
                           </div>
                           <div class="col-6">
                             <label>Nombre Proveedor</label>
                             <input type="text" maxlength="100" id="d2" name="d2" value="<?php echo $r[0]['Nombre']; ?>" required>
                           </div>
                           <div class="col-6">
                              <label>Direccion</label>
                              <input type="text" id="d3" name="d3" value="<?php echo $r[0]['Direccion']; ?>" required>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-4">
                             <label>Telefono</label>
                             <input type="number" min="3000000000" max="9999999999" id="d4" name="d4" value="<?php echo $r[0]['Telefono']; ?>" required>
                           </div>
                           <div class="col-4">
                             <label>Ultima Entrega</label>
                             <input type="date" id="d5" name="d5" value="<?php echo $r[0]['Dia_Entrega']; ?>" required>
                           </div>
                    <div class="modal-footer">
                        <button type="submit" name="boton" value="actualizar" class="btn btn-primary">Guardar Cambios</button>
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
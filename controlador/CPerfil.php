<?php
include "../modelo/MUsuario.php";
if (isset($_GET["boton"])) {

  if ($_GET["boton"] == "perfil_modi") {
    $objeto = new usuario(
        b: $_GET['doc']
    );
    $r = $objeto->consultaNombreUsuario();
    // var_dump($r);
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
                       <h2 class="modal-title" id="editProfileModalLabel">Editar Perfil</h2>
                     </div>
                     <form method="post" action="../vista/VPerfil.php">
                       <div class="modal-body">
                         <div class="row">
                           <div class="col-4">
                             <label>Numero Documento</label>
                             <input type="number" min="1000000" max="999999999999" id="d1" name="d1" readonly value="<?php echo $r[0]['Nombre_Usuario']; ?>" required>
                           </div>
                           <div class="col-6">
                             <label>Nombre Completo</label>
                             <input type="text" maxlength="100" id="d2" name="d2" value="<?php echo $r[0]['Nombre']; ?>" required>
                           </div>
                           <div class="col-6">
                              <label>Correo Electronico</label>
                              <input type="email" id="d3" name="d3" value="<?php echo $r[0]['Correo_Electronico']; ?>" required>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-3">
                             <label>Telefono</label>
                             <input type="number" min="3000000000" max="9999999999" id="d4" name="d4" value="<?php echo $r[0]['Telefono']; ?>" required>
                           </div>
                           <div class="col-3">
                             <label>Direccion</label>
                             <input type="text" maxlength="100" id="d5" name="d5" value="<?php echo $r[0]['direccion']; ?>" required>
                           </div>
                           <div class="col-3">
                             <label>Genero</label>
                             <select name="d6">
                               <option value="Masculino"<?php if($r[0]['Genero'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
                               <option value="Femenino"<?php if($r[0]['Genero'] == 'Femenino') echo 'selected'; ?>>Femenino</option>
                               <option value="Otro"<?php if($r[0]['Genero'] == 'Otro') echo 'selected'; ?>>Otro</option>
                             </select>
                           </div>
                           <div class="col-3">
                             <label>Tipo_Usuario</label>
                             <select name="d7" required>
                               <option value="Administrador"<?php if($r[0]['Tipo_Usuario'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
                               <option value="Cajero" <?php if($r[0]['Tipo_Usuario'] == 'Cajero') echo 'selected'; ?>>Cajero</option>
                               <option value="Almacenista" <?php if($r[0]['Tipo_Usuario'] == 'Almacenista') echo 'selected'; ?>>Almacenista</option>
                             </select>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-4">
                    <label> Fecha Nacimiento </label>
                    <input type="date" id="d8" name="d8" value="<?php echo $r[0]['Fecha_Nacimiento']; ?>" required>
                </div>
                <div class="col-4">
                    <label> Tipo_Sangre </label>
                    <select name="d9" id="d9" required>
                        <option value="O+"<?php if($r[0]['Tipo_Sangre'] == 'O+') echo 'selected'; ?>>O+</option>
                        <option value="O-"<?php if($r[0]['Tipo_Sangre'] == 'O-') echo 'selected'; ?>>O-</option>
                        <option value="A-"<?php if($r[0]['Tipo_Sangre'] == 'A-') echo 'selected'; ?>>A-</option>
                        <option value="A+"<?php if($r[0]['Tipo_Sangre'] == 'A+') echo 'selected'; ?>>A+</option>
                        <option value="B-"<?php if($r[0]['Tipo_Sangre'] == 'B-') echo 'selected'; ?>>B-</option>
                        <option value="B+"<?php if($r[0]['Tipo_Sangre'] == 'B+') echo 'selected'; ?>>B+</option>
                        <option value="AB-"<?php if($r[0]['Tipo_Sangre'] == 'AB-') echo 'selected'; ?>>AB-</option>
                        <option value="AB+"<?php if($r[0]['Tipo_Sangre'] == 'AB+') echo 'selected'; ?>>AB+</option>
                      </select>
                </div>
                <div class="col-4">
                    <label> EPS </label>
                    <input type="text" id="d10" name="d10" value="<?php echo $r[0]['EPS']; ?>" required>
                </div>
            </div>
            <div class="row">
              <div class="col-4">
                <label>Estado Civil</label>
                <select name="d11" id="d11" required>
                    <option value="Soltero"<?php if($r[0]['Estado_Civil'] == 'Soltero') echo 'selected'; ?>>Soltero</option>
                    <option value="Casado"<?php if($r[0]['Estado_Civil'] == 'Casado') echo 'selected'; ?>>Casado</option>
                    <option value="Divorciado"<?php if($r[0]['Estado_Civil'] == 'Divorciado') echo 'selected'; ?>>Divorciado</option>
                    <option value="Viudo"<?php if($r[0]['Estado_Civil'] == 'Viudo') echo 'selected'; ?>>Viudo</option>
                    <option value="Separado"<?php if($r[0]['Estado_Civil'] == 'Separado') echo 'selected'; ?>>Separado</option>
                    <option value="Union Libre"<?php if($r[0]['Estado_Civil'] == 'Union Libre') echo 'selected'; ?>>Union Libre</option>
                    <option value="Union Civil"<?php if($r[0]['Estado_Civil'] == 'Union Civil') echo 'selected'; ?>>Union Civil</option>
                  </select>
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
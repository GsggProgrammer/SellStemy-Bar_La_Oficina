<?php
include "../modelo/MVenta.php";

if (isset($_GET["boton"])) {
$objeto = new venta(
        a: $_GET['idVenta']
    );
    $r = $objeto->consultaID();
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
                       <h2 class="modal-title" id="editProfileModalLabel">Editar Venta</h2>
                     </div>
                     <form method="post" action="CCVenta.php">
                       <div class="modal-body">
                         <div class="row">
                           <div class="col-4">
                             <label>Codigo</label>
                             <input type="number" min="1" max="1000" id="d1" name="d1" readonly value="<?php echo $r[0]['ID']; ?>" required>
                           </div>
                           <div class="col-6">
                             <label>Metodo de pago</label>
                             <select name="d2">
                               <option value="Efectivo"<?php if($r[0]['Metodo_Pago'] == 'Efectivo') echo 'selected'; ?>>Efectivo</option>
                               <option value="Tarjeta"<?php if($r[0]['Metodo_Pago'] == 'Tarjeta') echo 'selected'; ?>>Tarjeta</option>
                               <option value="Transferencia"<?php if($r[0]['Metodo_Pago'] == 'Transferencia') echo 'selected'; ?>>Transferencia</option>
                            </select>
                           </div>
                           <div class="col-6">
                              <label>Fecha de venta</label>
                              <input type="date" id="d3" name="d3" readonly value="<?php echo $r[0]['Fecha_Venta']; ?>" required>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-4">
                            <label> Descripcion </label>
                            <input type="text" id="d4" name="d4" value="<?php echo $r[0]['Descripcion']; ?>">
                           </div>
                           <div class="col-2">
                               <label>Sub Total</label>
                               <input type="number" id="d5" name="d5" readonly value="<?php echo $r[0]['sub_total']; ?>" required>
                           </div>
                           <div class="col-5">
                               <label>Valor Total</label>
                               <input type="number" id="d6" name="d6" readonly value="<?php echo $r[0]['valor_total']; ?>">
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
?>
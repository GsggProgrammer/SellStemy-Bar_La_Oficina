<?php
session_start();
include "../modelo/MUsuario.php";
include "../vista/VUsuario.html";
// var_dump($_POST);

if ($_POST["boton"] == "registrar") {

    // registrar perfilProfesional
    $perfilProfesional = [];

    // Solo recorrer los campos que existan
    if (!empty($_POST["PP1"])) {
        for ($i = 1; isset($_POST["PP".$i]); $i++) {
            $perfilProfesional[$i] = $_POST["PP".$i];
        }
    }

    // registrar Titulos
    $titulo = [];

    // Solo recorrer los campos que existan
    if (!empty($_POST["T1"])) {
        for ($i = 1; isset($_POST["T".$i]); $i++) {
            $titulo[$i] = $_POST["T".$i];
        }
    }

    $objeto = new usuario(
        b: $_POST['d1'], 
        c: $_POST['d2'], 
        d: $_POST['d12'], 
        e: $_POST['d5'], 
        f: $_POST['d7'], 
        g: $_POST['d4'],
        h: $_POST['d8'],
        i: $_POST['d6'],
        j: $_POST['d3'],
        k: $_POST['d9'],
        l: $_POST['d10'],
        m: $_POST['d11'],
        n: $perfilProfesional,
        o: $titulo
    );

    $r = $objeto->Registrar();
    
    if (!empty($r)) {
        ?>
        <script>
            alert("Usuario registrado con éxito");
            window.location.href = "../vista/VUsuario.html";
        </script>
        <?php
    }
}

else if ($_POST["boton"] == "consultaNombreUsuario"){
    $objeto = new usuario (
        b: $_POST ['d1']
    );
    $r = $objeto -> consultaNombreUsuario ();
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
           //  var_dump ($valor);
            echo "  <tr>
                        <th>CÓDIGO:</th>
                        <td>$valor[ID]</td>
                    </tr>
                    <tr>
                        <th>NOMBRE DE USUARIO:</th>
                        <td>$valor[Nombre_Usuario]</td>
                    </tr>
                    <tr>
                        <th>NOMBRE:</th>
                        <td>$valor[Nombre]</td>
                    </tr>
                    <tr>
                        <th>DIRECCION:</th>
                        <td>$valor[direccion]</td>
                    </tr>
                    <tr>
                        <th>TIPO DE USUARIO:</th>
                        <td>$valor[Tipo_Usuario]</td>
                    </tr>
                    <tr>
                        <th>CORREO ELECTRÓNICO:</th>
                        <td>$valor[Correo_Electronico]</td>
                    </tr>
                    <tr>
                        <th>TELÉFONO:</th>
                        <td>$valor[Telefono]</td>
                    </tr>
                    <tr>
                        <th>FECHA DE NACIMIENTO:</th>
                        <td>$valor[Fecha_Nacimiento]</td>
                    </tr>
                    <tr>
                        <th>GENERO:</th>
                        <td>$valor[Genero]</td>
                    </tr>
                    <tr>
                        <th>TIPO DE SANGRE:</th>
                        <td>$valor[Tipo_Sangre]</td>
                    </tr>
                    <tr>
                        <th>EPS:</th>
                        <td>$valor[EPS]</td>
                    </tr>
                    <tr>
                        <th>ESTADO CIVIL:</th>
                        <td>$valor[Estado_Civil]</td>
                    </tr>
                    <tr>
                        <th>TÍTULO(S):</th>
                        <td>
                            " . (is_null($valor['Nombre_Titulo']) ? 'No disponible' : 
                            "Entidad: $valor[Nombre_Entidad] <br>
                             Título: $valor[Nombre_Titulo] <br>
                             Descripción: $valor[Titulo_Descripcion] <br>
                             Año: $valor[Titulo_Ano]") . "
                        </td>
                    </tr>
                    <tr>
                        <th>EXPERIENCIA PROFESIONAL:</th>
                        <td>
                            " . (is_null($valor['Empresa']) ? 'No disponible' :
                            "Empresa: $valor[Empresa] <br>
                             Cargo: $valor[Cargo] <br>
                             Descripción: $valor[Perfil_Descripcion] <br>
                             Teléfono: $valor[Perfil_Telefono]") . "
                        </td>
                    </tr>
                    <tr>
                        <th>ACCIONES:</th>
                        <td>";
                        if ($valor['Nombre_Usuario'] == $_SESSION['documento']) {
                            echo "<a class='btn btn-warning' href='CAUsuario.php?boton=usuario_modi&doc=$valor[Nombre_Usuario]'>Modificar</a>
                                  <br><span class='text-danger'>No te puedes eliminar a ti mismo</span>";
                        } else {
                            echo "<a class='btn btn-warning' href='CAUsuario.php?boton=usuario_modi&doc=$valor[Nombre_Usuario]'>Modificar</a>
                                  <br><a class='btn btn-danger' href='CAUsuario.php?boton=usuario_eli&doc=$valor[Nombre_Usuario]' onclick='confirmarEliminacion()'>Eliminar</a>";
                        }
                        
                        echo "   </td>
                                </tr>";
                    }
                    ?>
                    </table>
                    <form method='post' style='background-color: transparent !important; border: none !important;' action='reactivarUsuarios.php'>
                        <center>
                        <button type='submit' class='btn btn-success' style='width: 30% !important; padding: 12px !important' name='boton' value='consultaEliminados'> Restaurar Usuarios </button>
                        </center>
                    </form>
                </section>
            </body>
        </html>
    <?php
    }
} 

else if ($_POST["boton"] == "consultaTodos"){
    $objeto=new usuario();
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
                                    <th>NOMBRE DE USUARIO</th>
                                    <th>NOMBRE</th>
                                    <th>TIPO DE USUARIO</th>
                                    <th>CORREO ELECTRÓNICO</th>
                                    <th>TELÉFONO</th>
                                    <th>FECHA DE NACIMIENTO</th>
                                    <th>GENERO</th>
                                    <th colspan='2'>ACCIONES</th>
                                </tr>
                                <?php
                                    foreach($r as $valor){
                                        echo "<tr>
                                            <td>$valor[ID]</td>
                                            <td>$valor[Nombre_Usuario]</td>
                                            <td>$valor[Nombre]</td>
                                            <td>$valor[Tipo_Usuario]</td>
                                            <td>$valor[Correo_Electronico]</td>
                                            <td>$valor[Telefono]</td>
                                            <td>$valor[Fecha_Nacimiento]</td>
                                            <td>$valor[Genero]</td>
                                            <td><a class='btn btn-warning' href='CAUsuario.php?boton=usuario_modi&doc=$valor[Nombre_Usuario]'>Modificar</a>";
                                            if ($valor['Nombre_Usuario'] == $_SESSION['documento']) {
                                                echo "<td><span class='text-danger'>No te puedes eliminar a ti mismo</span></td>";
                                            } else {
                                                echo "<td><a class='btn btn-danger' href='CAUsuario.php?boton=usuario_eli&doc=$valor[Nombre_Usuario]' onclick='confirmarEliminacion()'>Eliminar</a></td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                            </table>
                            </section>
                            <form method='post' style='background-color: transparent !important; border: none !important;' action='reactivarUsuarios.php'>
                                <center>
                                <button type='submit' class='btn btn-success' style='width: 30% !important; padding: 12px !important' name='boton' value='consultaEliminados'> Restaurar Usuarios </button>
                                </center>
                            </form>
                    </body>
                </html>

        <?php
    }
}   

else if($_POST["boton"]=="actualizar"){
    //var_dump($_POST);
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
    if($r==1){
        echo "<script>
        alert('Actualizacion extiosa');
        </script>";            
    }
    else{
        echo "Vuelva a intentarlo, los datos no se actualizaron";
    }
}

else if ($_GET["boton"] == "reactivarUsuario") {
    $objeto = new usuario(b: $_GET['doc']);
    $r = $objeto->Reactivacion();
    if (empty ($r)) {
      echo "<script>
          if (confirm('El usuario ha sido Restaurado')) {
              window.location.href = '../vista/VUsuario.html';
          }
      </script>";
  } else {
      echo "<script>
          if (confirm('El usuario no ha sido Restaurado')) {
              window.location.href = '../vista/VUsuario.html';
          }
      </script>";
  }
}

        ?>

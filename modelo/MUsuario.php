<?php

class usuario {
    private $nombreUsuario;
    private $nombre;
    private $contrasena;
    private $direccion;
    private $tipoUsuario;
    private $telefono;
    private $fechaNacimiento;
    private $genero;
    private $correoElectronico;
    private $tipoSangre;
    private $eps;
    private $estadoCivil;
    private $perfilProfesional;
    private $titulo;

    public function __construct($b=null, $c=null, $d=null, $e=null, $f=null, $g=null, $h=null, $i=null, $j=null, $k=null, $l=null, $m=null, $n=null, $o=null){
        $this->nombreUsuario = $b;
        $this->nombre = $c;
        $this->contrasena = $d;
        $this->direccion = $e;
        $this->tipoUsuario = $f;
        $this->telefono = $g;
        $this->fechaNacimiento = $h;
        $this->genero = $i;
        $this->correoElectronico = $j;
        $this->tipoSangre = $k;
        $this->eps = $l;
        $this->estadoCivil = $m;
        $this->perfilProfesional = $n;
        $this->titulo = $o;
    }
    
    public function LOGIN() {
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
        $sentencia = $conexion->prepare("CALL LOGIN (?, ?)");
        $sentencia->bindParam(1, $this->nombreUsuario);
        $sentencia->bindParam(2, $this->contrasena);
        $sentencia->execute();
        $r = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
    
    public function Registrar (){
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
            $sentencia = $conexion -> prepare("CALL RUsuarios (?,?,?,?,?,?,?,?,?,?,?,?)");
            $sentencia->bindParam (1, $this->nombreUsuario);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                // Este error sucede cuando la llave primaria de un usuario se repite al momento de registrar
                echo "<script>
                        alert ('El usuario ya estaba registrado, Por Favor, Verifique los datos');
                      </script>";
            } else {
                echo "<div class='alert alert-danger'>
                        <strong>Error:</strong> Ocurrió un problema al registrar el usuario. Intente más tarde.
                      </div>";
            }
        }
            $sentencia->bindParam (2, $this->nombre);
            $sentencia->bindParam (3, $this->contrasena);
            $sentencia->bindParam (4, $this->direccion);
            $sentencia->bindParam (5, $this->tipoUsuario);
            $sentencia->bindParam (6, $this->telefono);
            $sentencia->bindParam (7, $this->fechaNacimiento);
            $sentencia->bindParam (8, $this->genero);
            $sentencia->bindParam (9, $this->correoElectronico);
            $sentencia->bindParam (10, $this->tipoSangre);
            $sentencia->bindParam (11, $this->eps);
            $sentencia->bindParam (12, $this->estadoCivil);
            $r= $sentencia->execute();
            $r= $sentencia->fetchAll(PDO::FETCH_ASSOC);

            // Registro perfilProfesional
            if(!empty($this->perfilProfesional)){
                $registro_ref = $conexion->prepare("CALL RPerfilProfesional (?,?,?,?,?)");
                $veces = count($this->perfilProfesional)/4;
                // var_dump($veces);
                $i=1;
                $posicion=1;
                while($i<=$veces){
                    $registro_ref->bindParam(1,$this->perfilProfesional[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(2,$this->perfilProfesional[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(3,$this->perfilProfesional[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(4,$this->perfilProfesional[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(5,$this->nombreUsuario);
                    $registro_ref -> execute();
                    $i++;
                }
            }

            // Registro titulo
            if(!empty($this->titulo)){
                $registro_ref = $conexion->prepare("CALL RTitulo (?,?,?,?,?)");
                $veces = count($this->titulo)/4;
                // var_dump($veces);
                $i=1;
                $posicion=1;
                while($i<=$veces){
                    $registro_ref->bindParam(1,$this->titulo[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(2,$this->titulo[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(3,$this->titulo[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(4,$this->titulo[$posicion]);
                    $posicion++;
                    $registro_ref->bindParam(5,$this->nombreUsuario);
                    $registro_ref -> execute();
                    $i++;
                }
            }
        return $r;
    }
    public function consultaNombreUsuario (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL CUsuarios (?)");
        $sentencia->bindParam (1, $this->nombreUsuario);
        $sentencia->execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function consultaGeneral (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("SELECT * FROM generalUsuarios");
        $sentencia->execute();
        $r = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
        
        return $r;
    }

    public function consultaEliminados (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("SELECT * FROM usuariosEliminados");
        $sentencia->execute();
        $r = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function Reactivacion(){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL reactivarUsuarios (?)");
        $sentencia->bindParam (1, $this->nombreUsuario);
        $sentencia->execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function Actualizacion (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL MUsuarios (?,?,?,?,?,?,?,?,?,?,?)");
        $sentencia->bindParam (1, $this->nombreUsuario);
        $sentencia->bindParam (2, $this->nombre);
        $sentencia->bindParam (3, $this->direccion);
        $sentencia->bindParam (4, $this->tipoUsuario);
        $sentencia->bindParam (5, $this->telefono);
        $sentencia->bindParam (6, $this->fechaNacimiento);
        $sentencia->bindParam (7, $this->genero);
        $sentencia->bindParam (8, $this->correoElectronico);
        $sentencia->bindParam (9, $this->tipoSangre);
        $sentencia->bindParam (10, $this->eps);
        $sentencia->bindParam (11, $this->estadoCivil);
        $r=$sentencia->execute();
        return $r;

    }

    public function Eliminacion (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL EUsuarios (?)");
        $sentencia->bindParam (1, $this->nombreUsuario);
        $r=$sentencia->execute();
        return $r;
    }
}

?>
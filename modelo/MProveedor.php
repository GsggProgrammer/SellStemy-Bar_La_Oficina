<?php

class proveedor {
    private $id;
    private $nombre;
    private $direccion;
    private $telefono;
    private $diaEntrega;
    private $registradoPor;

    public function __construct($a=null, $b=null, $c=null, $d=null, $e=null, $f=null){
        $this->id = $a;
        $this->nombre = $b;
        $this->direccion = $c;
        $this->telefono = $d;
        $this->diaEntrega = $e;
        $this->registradoPor = $f;
}

    public function Registrar (){

        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL RProveedores (?,?,?,?,?)");
        $sentencia -> bindParam (1, $this -> nombre);
        $sentencia -> bindParam (2, $this -> direccion);
        $sentencia -> bindParam (3, $this -> telefono);
        $sentencia -> bindParam (4, $this -> diaEntrega);
        $sentencia -> bindParam (5, $this -> registradoPor);
        $r= $sentencia -> execute();
        return $r;
    }

    public function consultaNombreProveedor (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL CProveedores (?)");
        $sentencia -> bindParam (1, $this -> nombre);
        $sentencia -> execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function consultaGeneral (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("SELECT * FROM generalProveedores");
        $sentencia->execute();
        $r = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function consultaEliminados (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("SELECT * FROM proveedoresEliminados");
        $sentencia->execute();
        $r = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function Reactivacion(){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL reactivarProveedores (?)");
        $sentencia->bindParam (1, $this->id);
        $sentencia->execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function consultaID (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL CIDProveedores (?)");
        $sentencia -> bindParam (1, $this -> id);
        $sentencia->execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function Actualizacion (){

        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL MProveedores (?,?,?,?,?)");
        $sentencia -> bindParam (1, $this -> id );
        $sentencia -> bindParam (2, $this -> nombre);
        $sentencia -> bindParam (3, $this -> direccion);
        $sentencia -> bindParam (4, $this -> telefono);
        $sentencia -> bindParam (5, $this -> diaEntrega);
        $r= $sentencia -> execute();
        return $r;
    }

    public function Eliminacion (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL EProveedores(?)");
        $sentencia -> bindParam (1, $this -> id );
        $r= $sentencia -> execute();
        return $r;
    }
}

?>
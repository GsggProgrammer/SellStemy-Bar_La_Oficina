<?php

class producto {
    private $id;
    private $Nombre;
    private $Valor_Compra;
    private $Tipo_Producto;
    private $Cantidad;
    private $Descripcion;
    private $ValorVenta;
    private $Registrado_Por;
    private $id_proveedor;

    public function __construct($a=null,$b=null, $c=null, $d=null, $e=null, $f=null, $g=null, $h=null, $i=null) {

        $this->id = $a;
        $this->Nombre = $b;
        $this->Valor_Compra = $c;
        $this->Tipo_Producto = $d;
        $this->Cantidad = $e;
        $this->Descripcion = $f;
        $this->ValorVenta = $g;
        $this->Registrado_Por = $h;
        $this->id_proveedor = $i;
}

    public function nombreProveedor (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
        $sentencia = $conexion->prepare("SELECT * FROM CProveedorProducto");
        $sentencia->execute();
        $r = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function Registrar(){
        $this->ValorVenta = $this->Valor_Compra * 1.4;
    
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
        $sentencia = $conexion->prepare("CALL RProductos(?, ?, ?, ?, ?, ?, ?, ?)");
    
        // Asignar los parámetros con valores ya definidos
        $sentencia->bindParam(1, $this->Nombre);
        $sentencia->bindParam(2, $this->Valor_Compra);
        $sentencia->bindParam(3, $this->Tipo_Producto);
        $sentencia->bindParam(4, $this->Cantidad);
        $sentencia->bindParam(5, $this->Descripcion);
        $sentencia->bindParam(6, $this->ValorVenta);  // Pasar la variable calculada
        $sentencia->bindParam(7, $this->Registrado_Por);
        $sentencia->bindParam(8, $this->id_proveedor);

        $r = $sentencia->execute();
        $r = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function consultaNombreProducto (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL CProductos (?)");
        $sentencia -> bindParam (1, $this -> Nombre);
        $sentencia -> execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function consultaGeneral (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("SELECT * FROM generalProductos");
        $sentencia->execute();
        $r = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function consultaEliminados (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("SELECT * FROM productosEliminados");
        $sentencia->execute();
        $r = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function Reactivacion(){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL reactivarProductos (?)");
        $sentencia->bindParam (1, $this->id);
        $sentencia->execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    // Para tareas de actualizacion y eliminacion

    // al dar click en modificar o eliminar
    public function consultaID (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL CIDProductos (?)");
        $sentencia -> bindParam (1, $this -> id);
        $sentencia->execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function Actualizacion (){
        $this->ValorVenta = $this->Valor_Compra * 1.4;

        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL MProductos (?,?,?,?,?,?,?,?)");
        $sentencia->bindParam (1, $this->id);
        $sentencia->bindParam (2, $this->Nombre);
        $sentencia->bindParam (3, $this->Valor_Compra);
        $sentencia->bindParam (4, $this->Tipo_Producto);
        $sentencia->bindParam (5, $this->Cantidad);
        $sentencia->bindParam (6, $this->Descripcion);
        $sentencia->bindParam (7, $this->ValorVenta);  // Pasar la variable calculada
        $sentencia->bindParam (8, $this->id_proveedor);
        $r= $sentencia -> execute();
        return $r;
    }

    public function Eliminacion (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL EProductos (?)");
        $sentencia -> bindParam (1, $this -> id );
        $r= $sentencia -> execute();
        return $r;
    }
}


?>


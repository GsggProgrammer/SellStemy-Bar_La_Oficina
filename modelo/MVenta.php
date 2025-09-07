<?php

class venta{
    private $id;
    private $metodoPago;
    private $iva;
    private $fechaVenta;
    private $descripcion;
    private $subTotal;
    private $valorTotal;
    private $registradoPor;
    private $detallesFactura;

    public function __construct($a=null, $b=null, $c=null, $d=null, $e=null, $f=null, $g=null, $h=null, $i=null){

        $this->id = $a;
        $this->metodoPago = $b;
        $this->iva = $c;
        $this->fechaVenta = $d;
        $this->descripcion = $e;
        $this->subTotal = $f;
        $this->valorTotal = $g;
        $this->registradoPor = $h;  
        $this->detallesFactura = $i;

    }

    public function registrar() {
    // Conexión a la base de datos
    $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
    // Registro en la tabla 'venta'
    $sentencia = $conexion->prepare("call RVentas (?,?,?,?,?,?)");
    $sentencia->bindParam(1, $this->metodoPago);
    $sentencia->bindParam(2, $this->iva);
    $sentencia->bindParam(3, $this->descripcion);
    $sentencia->bindParam(4, $this->subTotal);
    $sentencia->bindParam(5, $this->valorTotal);
    $sentencia->bindParam(6, $this->registradoPor);
    $r = $sentencia->execute();    

    // Consulta de la última venta creada
    $consulta = $conexion->prepare("SELECT * FROM ultimaVenta");
    $consulta->execute();
    $idVenta = $consulta->fetch(PDO::FETCH_COLUMN);

    // Registro en la tabla detalles de factura
    foreach ($this->detallesFactura as $detalle) {
        $sentenciaDet = $conexion->prepare("call RDetalles (?, ?, ?, ?)");
        $sentenciaDet->bindParam(1, $detalle['id']); // ID del producto
        $sentenciaDet->bindParam(2, $idVenta);        // ID de la venta
        $sentenciaDet->bindParam(3, $detalle['precio']);  // Valor del producto
        $sentenciaDet->bindParam(4, $detalle['cantidad']); // Cantidad del producto
        $sentenciaDet->execute();
    }

    return $r;
}
    public function consultaFechaVenta(){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
        $consulta = $conexion->prepare("CALL CFechaVenta (?)");
        $consulta->bindParam(1, $this->fechaVenta);
        $consulta->execute();
        $r = $consulta->fetchAll();
        return $r;
    }

    public function consultaGeneral(){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
        $consulta = $conexion->prepare("SELECT * FROM generalVentas");
        $consulta->execute();
        $r = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
       
    public function masVendidos(){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
        $consulta = $conexion->prepare("SELECT * FROM ProductosMasVendidos");
        $consulta->execute();
        $r = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function masVentas(){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root");
        $consulta = $conexion->prepare("SELECT * FROM UsuariosMasVentas");
        $consulta->execute();
        $r = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }

    public function consultaID (){
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL CIDVentas (?)");
        $sentencia -> bindParam (1, $this -> id);
        $sentencia->execute();
        $r = $sentencia -> fetchAll();
        return $r;
    }

    public function Actualizacion (){

        $conexion = new PDO("mysql:host=localhost;dbname=proyecto","root");
        $sentencia = $conexion -> prepare("CALL MVentas (?,?,?,?,?,?)");
        $sentencia->bindParam (1, $this->id);
        $sentencia->bindParam (2, $this->metodoPago);
        $sentencia->bindParam (3, $this->fechaVenta);
        $sentencia->bindParam (4, $this->descripcion);
        $sentencia->bindParam (5, $this->subTotal);
        $sentencia->bindParam (6, $this->valorTotal);
        $r= $sentencia -> execute();
        return $r;
    }
}

?>
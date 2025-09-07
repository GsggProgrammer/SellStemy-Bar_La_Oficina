<?php

class LOGIN {
    private $nombreUsuario;
    private $contrasena;

    // Constructor con parámetros
    public function __construct($a= null, $b= null) {
        $this->nombreUsuario = $a;
        $this->contrasena = $b;
    }
    
    public function LOGIN() {
        // Conexión a la base de datos
        $conexion = new PDO("mysql:host=localhost;dbname=proyecto", "root", "");
        
        // Preparar y ejecutar el procedimiento almacenado
        $sentencia = $conexion->prepare("CALL LOGIN (?, ?)");
        $sentencia->bindParam(1, $this->nombreUsuario);
        $sentencia->bindParam(2, $this->contrasena);
        $sentencia->execute();

        // Obtener resultados
        $r = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
}

?>
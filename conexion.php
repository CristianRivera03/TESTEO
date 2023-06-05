<?php
class ConexionPDO
{
private $host;
private $dbname;
private $usuario;
private $contraseña;
private $conexion;

public function __construct($host, $dbname, $usuario, $contraseña)
{
    $this->host = $host;
    $this->dbname = $dbname;
    $this->usuario = $usuario;
    $this->contraseña = $contraseña;
}
public function conectar()
{
    try 
    {
        $opciones = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $this->conexion = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->usuario, $this->contraseña, $opciones);
        if($this->conexion != null){
            // echo "conectado"
        }else{
            // echo "desconectado"
        }
    }catch (PDOException $e) {
        echo "Error de conexion: " .$e-> getMessage();
        die();
    }
}
public function getConnection()
{
    return $this->conexion;
}
public function desconectar()
{
    $this->conexion = null;
    //echo "desconectado
}
}

?>
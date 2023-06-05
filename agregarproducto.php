<?php
session_start();

if($_SESSION['usuario']=== null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

$query = "SELECT * FROM cliente";
$statement = $conexion->getConnection()->query($query);
$cliente = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM producto";
$statement = $conexion->getConnection()->query($query);
$producto = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Agregar Albumes</title>
</head>
<body>
<form  action="procesos.php" method="POST">
    <input type="text" name="opcion" value="1" hidden >
    <label>Fecha de entrega</label>
<input class="form-control form-control-sm" style="width:800px;" type="date" name="fecha">
<br>
<select class="form-control form-control-sm" style="width:800px;" name="cliente">
<?php
     foreach($cliente as $clientes){
        echo "<option value='".$clientes['id']."' >".$clientes['nombre']."</option>";
     }
?>
</select>
<br>
<select class="form-control form-control-sm" style="width:800px;" name="pelicula">
<?php
     foreach($pelicula as $peliculas){
        echo "<option value='".$peliculas['id']."' >".$peliculas['nombre']."</option>";
     }
?>

</select>
<br>
<input class="form-control form-control-sm" style="width:800px;" type="text" name="costo">
<br>
<input type="submit" value="Agregar" class="btn btn-primary">
    </form>
</body>
</html>
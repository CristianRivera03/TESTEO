<?php
session_start();

if($_SESSION['usuario']=== null){
    header('Location:index.php');
}

include_once 'conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usuario, $contrasena);
$conexion->conectar();

$query = "select id_nombre as id,  as cliente, cliente.dui as dui ,peliculas.nombre as pelicula, costo 
FROM alquiler
inner join cliente on alquiler.id_cliente	= cliente.id
inner join peliculas on alquiler.id_pelicula	= peliculas.id";
$statement = $conexion->getConnection()->query($query);
$alquileres = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Alquileres</title>
</head>
<body>
<section style="width:800px; margin:0 auto;">
<a href='addmascota.php' class='btn btn-primary'>Nueva mascota</a>
    <table class="table" >
        <tr>
            <th >ID</th>
            <th>Fecha Entrega</th>
            <th>Cliente</th>
            <th>dui</th>
            <th>Pelicula</th>
            <th>Costo</th>
            <th >opciones</th>
            <th></th>
        </tr>
        <tbody>
            <?php
        foreach ($alquileres as $alquiler) {
                echo "<tr>";
                echo "<td>".$alquiler['id']."</td>";
                echo "<td>".$alquiler['fechaEntrega']."</td>";
                echo "<td>".$alquiler['cliente']."</td>";
                echo "<td>".$alquiler['dui']."</td>";
                echo "<td>".$alquiler['pelicula']."</td>";
                echo "<td>".$alquiler['costo']."</td>";
                echo "<td><a href='' class='btn btn-success'>Modificar</a></td>";

                echo "<td><form action='eliminaralquiler.php' method='POST'>
                        <input type='text' name='id' value='".$alquiler['id']."' hidden >
                       <input type='submit' class='btn btn-danger' value='Eliminar'>
                       </form></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</section>
</body>
</html>
<?php
include("conexion.php"); 
$con=Conectarse();
	
$codarancel = $_POST['codarancel'];

$sql = "select monto
from aranceles 
where codarancel = '$codarancel'";
	
$res=pg_query($con,$sql);

$row = pg_fetch_assoc($res);

$respuesta = new stdClass();

$respuesta->monto = $row['monto'];

echo json_encode($respuesta);
?>
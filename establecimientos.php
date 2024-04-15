<?php
// Se crea la conexión a la base de datos
    include("conexion.php"); 
	$con=Conectarse();
	
	$sql1 = "SELECT *  FROM establecimientos";
	
	$res1=pg_query($con, $sql1);

	$opcion = "";
	while($row = pg_fetch_array($res1)) 
	{
		 $opcion .=  '<option value="'.$row['codservicio'].'">'.$row['nomservicio'].'</option>';
	}
	echo $opcion;
?>
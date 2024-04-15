<?php
    include("conexion.php"); 
	$link=Conectarse();
    
	$sql1 = "select * from tiposturnos where codservicio = '".$_REQUEST["establecimiento"]."' and codarea = '".$_REQUEST["area"]."'";

	$result=pg_query($link,$sql1);

	echo '<option value=""></option>';
	while ($fila = pg_fetch_array($result)) 
	{
		echo '<option value="'.$fila["codturno"].'">'.$fila["nomturno"].'</option>';

	}
	
	// Liberar resultados
	pg_free_result($result);

?>
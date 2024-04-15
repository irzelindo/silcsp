<?php
    include("conexion.php"); 
	$link=Conectarse();
    
	$sql1 = "select * from cajas where codservicio = '".$_REQUEST["establecimiento"]."'";

	$result=pg_query($link,$sql1);
	
	echo '<option value=""></option>';

	while ($fila = pg_fetch_array($result)) 
	{
		echo '<option value="'.$fila["codcaja"].'">'.$fila["nomcaja"].'</option>';

	}
	
	// Liberar resultados
	pg_free_result($result);

?>
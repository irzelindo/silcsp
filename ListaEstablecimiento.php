<?php
    include("conexion.php"); 
	$link=Conectarse();
    
    $sql1 = "select * from establecimientos ";

	$result=pg_query($link,$sql1);
	
    echo '<option value=""></option>';

	while ($fila = pg_fetch_array($result)) 
	{
		
		echo '<option value="'.$fila["codservicio"].'">'.$fila["nomservicio"].'</option>';

	}
	
	// Liberar resultados
	pg_free_result($result);

?>
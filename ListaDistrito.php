<?php
    include("conexionsaa.php");
	$consaa=Conectarsesaa();
    
	$sql1 = "select * from distritos where coddpto = '".$_REQUEST["departamento"]."'";
	

	$result=pg_query($consaa,$sql1);

	while ($fila = pg_fetch_array($result)) 
	{
		if(trim($_REQUEST["distrito"]) == trim($fila["coddist"]))
		{
			echo '<option value="'.$fila["coddist"].'" selected>'.$fila["nomdist"].'</option>';
		}
		else
		{
			echo '<option value="'.$fila["coddist"].'">'.$fila["nomdist"].'</option>';
		}

	}
	
	// Liberar resultados
	pg_free_result($result);

?>
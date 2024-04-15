<?php
    include("conexionsaa.php");
	$consaa=Conectarsesaa();

	$sql1 = "select * from departamentos";
	
	$result=pg_query($consaa,$sql1);
	
	echo '<option value="">SELECIONAR</option>';

	while ($fila = pg_fetch_array($result)) 
	{
		if($fila["coddpto"] == $_REQUEST["departamento"])
		{
			echo '<option value="'.$fila["coddpto"].'" selected>'.$fila["nomdpto"].'</option>';
		}
		else
		{
			echo '<option value="'.$fila["coddpto"].'">'.$fila["nomdpto"].'</option>';
		}

	}

	
	// Liberar resultados
	pg_free_result($result);

?>
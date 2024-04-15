<?php
    include("conexionsaa.php");
	$consaa=Conectarsesaa();

	$codreg=substr($_REQUEST["region"],0,2);
   	$subcreg=substr($_REQUEST["region"],2,3);
    
	$sql1 = "select * from distritos where codreg = '$codreg' and subcreg = '$subcreg'";
	

	$result=pg_query($consaa,$sql1);

	echo '<option value=""></option>';

	while ($fila = pg_fetch_array($result)) 
	{
		echo '<option value="'.$fila["coddist"].'">'.$fila["nomdist"].'</option>';

	}
	
	// Liberar resultados
	pg_free_result($result);

?>
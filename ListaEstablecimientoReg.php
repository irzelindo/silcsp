<?php
    include("conexionsaa.php");
	$consaa=Conectarsesaa();

	$codreg=substr($_REQUEST["region"],0,2);
   	$subcreg=substr($_REQUEST["region"],2,3);
	$coddist=$_REQUEST["coddist"];
    
	$sql1 = "select * from establecimientos where codreg = '$codreg' and subcreg = '$subcreg' and coddist = '$coddist'";
	

	$result=pg_query($consaa,$sql1);

	echo '<option value=""></option>';
	while ($fila = pg_fetch_array($result)) 
	{
		echo '<option value="'.$fila["codserv"].'">'.$fila["nomserv"].'</option>';

	}
	
	// Liberar resultados
	pg_free_result($result);

?>
<?php
    include("conexion.php"); 
	$link=Conectarse();

	$codestudio  = $_POST["codestudio"];
	$nrordentra  = $_POST["nrordentra"];
	$codservicio = $_POST["codservicio"];

	$query = "select distinct e.codestudio,
							 e.nomestudio,
							 e.codsector
			from estudios e, estrealizar r
			where e.codestudio  = r.codestudio
			and   r.nordentra   = '$nordentra'
			and   r.codservicio = '$codservicio'";
	$result = pg_query($link,$query);

	$row = pg_fetch_assoc($result);

	$codsector 	 = $row["codsector"];
    
	$sql1 = "select * from sectores where codsector = '".$codsector."'";

	$result1=pg_query($link,$sql1);
	
	while ($fila = pg_fetch_array($result1)) 
	{
		$res = '<option value="'.$fila["codsector"].'">'.$fila["nomsector"].'</option>';

	}
	
	// Liberar resultados
	json_encode ($res);

?>
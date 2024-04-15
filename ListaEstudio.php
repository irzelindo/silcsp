<?php
  include("conexion.php");
	$link=Conectarse();

	$sql1 = "select * from estudios where codsector = '".$_REQUEST["codsector"]."'";

	$result=pg_query($link,$sql1);

	echo '<option value=""></option>';

	while ($fila = pg_fetch_array($result))
	{
		echo '<option value="'.$fila["codestudio"].'">'.$fila["nomestudio"].'</option>';

	}

	// Liberar resultados
	pg_free_result($result);

?>

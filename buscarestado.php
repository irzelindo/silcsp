<?php
// Se crea la conexi�n a la base de datos
	include("conexion.php");
	$con=Conectarse();

  $sql1 = "select codestado,
									nomestado
						from estadoresultado";

	$res1=pg_query($con, $sql1);
  $count=pg_num_rows($res1);

	echo '<select>';
	echo '<option value="0"></option>';
	while($row = pg_fetch_array($res1)) {

		 echo '<option value="'.$row['codestado'].'">'.$row['nomestado'].'</option>';
	}
	echo '</select>';

?>

<?php
// Se crea la conexi�n a la base de datos
	include("conexion.php");
	$con=Conectarse();

  $sql1 = "select codmetodo,
									nommetodo
						from metodos";

	$res1=pg_query($con, $sql1);
  $count=pg_num_rows($res1);

	echo '<select>';
	echo '<option value="0"></option>';
	while($row = pg_fetch_array($res1)) {

		 echo '<option value="'.$row['codmetodo'].'">'.$row['nommetodo'].'</option>';
	}
	echo '</select>';

?>

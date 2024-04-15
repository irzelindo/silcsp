<?php
// Se crea la conexi�n a la base de datos
	include("conexion.php");
	$con=Conectarse();

	$codestudio     = $_GET['codestudio'];
	$coddetermina   = $_GET['coddetermina'];

  $sql1 = "select rc.codresultado,
												 rc.nomresultado
										from resultadoposible rp, resultadocodificado rc
										where rp.codresultado = rc.codresultado
										and rp.codestudio = '$codestudio'
										and rp.coddetermina = '$coddetermina'";

	$res1=pg_query($con, $sql1);
  $count=pg_num_rows($res1);

	echo '<select>';
	echo '<option value="0"></option>';
	while($row = pg_fetch_array($res1)) {

		 echo '<option value="'.$row['codresultado'].'">'.$row['nomresultado'].'</option>';
	}
	echo '</select>';

?>

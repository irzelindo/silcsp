<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
ini_set("display_errors", false);
ini_set("memory_limit", "-1");
set_time_limit(0);
// ini_set('memory_limit', 1024*1024);
// set_time_limit(0);
// ini_set('memory_limit', '2G'); // or you could use 1G
// ini_set('max_execution_time', '180');
date_default_timezone_set('America/Asuncion');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();

include( "conexion.php" );
$link  	 	= Conectarse();
// $datosD	 	= explode("/", $_POST["FechaD"]);
// $datosH	 	= explode("/", $_POST["FechaH"]);
$LCSPRes 	= $_POST["LCSPRes"];
$enfermedad = $_POST["Enfermedad"];

if ( $enfermedad == "2" ) {
	$cargar = "'08005','08009','08010'";
}

// $finfoD = $datosD[2]."-".$datosD[1]."-".$datosD[0];
// $finfoH = $datosH[2]."-".$datosH[1]."-".$datosH[0];
$nomyape = $_SESSION["nomyape"];
$codusu  = $_SESSION['codusu'];

$query = "select * from usuarios u where u.codusu = '$codusu'";
$result = pg_query( $link, $query );
$usuario = pg_fetch_assoc( $result );

$respuesta = new stdClass();
for ($i=0; $i < count($LCSPRes) ; $i++) { 
	$sql = "UPDATE resultados SET envio_dgvs = 1, proceso_dgvs = '{$LCSPRes[$i]['id_proceso']}' WHERE nordentra ||'-'|| codservicio ||'-'|| nroestudio ||'-'|| idmuestra = '{$LCSPRes[$i]['cod_lcsp']}';";
	echo $sql;
	$result = pg_query( $link, $sql );
}

// $respuesta->arrResultado = pg_fetch_all( $result );
echo json_encode(array('respuesta2'=>'Actualizado'));
?>
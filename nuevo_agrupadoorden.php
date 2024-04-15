<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
$con=Conectarse();

$codsector  	=	$_POST['codsector'];
$codestudio 	=	$_POST['codestudio'];
$nordentra		=	$_POST['nordentra'];
$grupo			=	$_POST['grupo'];
$codestudio1	=	$_POST['codestudio1'];
$cantidad		=	count($nordentra);


if($grupo == '')
{
	$unro = pg_query( $con, "select max(CAST(coalesce(grupo, '0') AS integer)) as ultimo from ordenagrupado" );

	while ( $rowcod = pg_fetch_array( $unro ) ) {
		$grupo = $rowcod[ 'ultimo' ] + 1;
	}

}

$sqld = "select * from ordenagrupado where grupo = '$grupo'";

$resd = pg_query( $con, $sqld );
$countlc = pg_num_rows( $resd );

$fecha = date("Y-n-j", time());

$band = 0;

$respuesta = new stdClass();

if ( $countlc == 0 )
{
	for($i=0;$i<$cantidad;$i++)
	{
		
		pg_query( $con, "INSERT INTO ordenagrupado(
		grupo, fecha, nordentra, codusu, codestudio)
		VALUES ('$grupo', '$fecha', '$nordentra[$i]', '$codusu', '$codestudio[$i]')" );

		pg_query( $con, "UPDATE estrealizar
					SET estadoestu='5'
					WHERE nordentra = '$nordentra[$i]'");

	}
	
	

	$respuesta->grupo = $grupo;

	// Bitacora
	include( "bitacora.php" );
	$codopc = "V_211";
	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Agrupamiento Ordenes: Nro. Agrupamiento: " . $grupo;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
	// Fin grabacion de registro de auditoria
}
else
{
	for($i=0;$i<$cantidad;$i++)
	{
		pg_query( $con, "UPDATE datoagrupado
					SET fecha='$fecha', codusu='$codusu'
					WHERE grupo = '$grupo' and nordentra = '$nordentra[$i]' and codestudio = '$codestudio[$i]'" );

		pg_query( $con, "UPDATE estrealizar
				SET estadoestu='5'
				WHERE nordentra = '$nordentra[$i]'" );

	}

	$respuesta->grupo = 0;
}


echo json_encode($respuesta);
?>

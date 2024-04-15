<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
$con=Conectarse();

$codservicior	=	$_POST['codservicior'];
$nordentra		=	$_POST['nordentra'];
$codestudio	  =	$_POST['codestudio'];
$codrechazo   = $_POST['codrechazo'];
$grupo		  	=	$_POST['grupo'];
$cantidad		  =	$_POST['cantidad'];

$fecha = date("Y-n-j", time());

$respuesta = new stdClass();

	for($i=0;$i<$cantidad;$i++)
	{
				pg_query( $con, "UPDATE datoagrupado
			   						set estado='4'
					 					WHERE nordentra = '$nordentra[$i]' and grupo = '$grupo'");

				pg_query( $con, "UPDATE estrealizar
												SET estadoestu = '4'
												WHERE nordentra = '$nordentra[$i]'" );

			  pg_query( $con, "INSERT INTO rechazados(
							grupo, fecharechazo, codrechazo, codusu)
							VALUES ('$grupo', '$fecha', '$codrechazo', '$codusu')" );

	}

	$respuesta->grupo = $grupo;

	// Bitacora
	include( "bitacora.php" );
	$codopc = "V_213";
	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Agrupamiento para Rechazo: Nro. Agrupamiento: " . $grupo;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
	// Fin grabacion de registro de auditoria

echo json_encode($respuesta);
?>

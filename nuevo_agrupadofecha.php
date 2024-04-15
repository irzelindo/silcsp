<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
$con=Conectarse();

$codsector  	=	$_POST['codsector'];
$codestudio 	=	$_POST['codestudio'];
$nordentra		=	$_POST['nordentra'];
$grupo			  =	$_POST['grupo'];
$codestudio1	=	$_POST['codestudio1'];
$codresultado = $_POST['codresultado'];
$cantidad		  =	count($nordentra);
$microbiologia=	$_POST['microbiologia'];

$fecha = date("Y-n-j", time());

$band = 0;

$respuesta = new stdClass();

	for($i=0;$i<$cantidad;$i++)
	{
				if($microbiologia[$i] == 2)
				{
							pg_query( $con, "UPDATE estrealizar
										SET estadoestu='4'
										WHERE nordentra = '$nordentra[$i]'");

							pg_query( $con, "UPDATE resultados
													SET codestado = '002', codresultado = '$codresultado', fechares = '$fecha'
													WHERE nordentra = '$nordentra[$i]'");
				}
				else
				{
							pg_query( $con, "UPDATE estrealizar
										SET estadoestu='4'
										WHERE nordentra = '$nordentra[$i]'");

							pg_query( $con, "UPDATE resultadosmicro
													SET codestado = '002', codresultado = '$codresultado', fechares = '$fecha'
													WHERE nordentra = '$nordentra[$i]'");

				}
	}

	$respuesta->grupo = $grupo;

echo json_encode($respuesta);
?>

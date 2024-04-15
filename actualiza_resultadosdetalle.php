<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

$v_161  = $_SESSION['V_161']; //Carga, Validación Revalidación


include("conexion.php"); 
$con=Conectarse();

$fecha = date("Y-m-d", time());
$hora  = date("H:i");

$nordentra		=	$_POST['nordentra'];	
$codservicio	=	$_POST['codservicio'];
$nroestudio		=	$_POST['nroestudio'];
$nroorden		=	$_POST['nroorden'];
$validar		=	$_POST['validar'];
$conte          =	$_POST['conte'];

$respuesta = new stdClass();

if ( $conte == 'validar') 
{
	pg_query( $con, "UPDATE resultados
					SET validar='$validar', codusu1='$codusu', fechaval='$fecha', horaval='$hora'
					WHERE nordentra = '$nordentra' and codservicio = '$codservicio' and nroestudio = '$nroestudio' and nroorden = '$nroorden'" );

	$respuesta->grupo = 0;
} 
else 
{
	if ( $conte == 'revalidar') 
	{
		pg_query( $con, "UPDATE estrealizar
						SET revalidar='$validar', codusu2='$codusu', fechareval='$fecha', horareval='$hora'
						WHERE nordentra = '$nordentra' and codservicio = '$codservicio' and nroestudio = '$nroestudio'" );

		$respuesta->grupo = 0;
	} 
	else 
	{
		pg_query( $con, "UPDATE estrealizar
						SET anulado='$validar', codusu3='$codusu', fechaanul='$fecha', horaval='$hora'
						WHERE nordentra = '$nordentra' and codservicio = '$codservicio' and nroestudio = '$nroestudio'" );

		$respuesta->grupo = 0;
	}
}

echo json_encode($respuesta);
?>
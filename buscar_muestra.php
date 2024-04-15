<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php"); 
$con=Conectarse();

$nordentra		=	$_POST['nordentra'];	
$codservicio	=	$_POST['codservicio'];
$nroestudio		=	$_POST['nroestudio'];
$validar		=	$_POST['validar'];
$conte          =	$_POST['conte'];

$respuesta = new stdClass();

if ( $conte == 'validar') 
{
	$query = "select * from estrealizar WHERE nordentra = '$nordentra' and codservicio = '$codservicio' and nroestudio = '$nroestudio'";
	
	$result = pg_query($con,$query);

	$row = pg_fetch_assoc($result);

	$validar = $row["validar"];

	$respuesta->resul = $validar;
} 

echo json_encode($respuesta);
?>
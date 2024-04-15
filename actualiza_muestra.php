<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php"); 
$con=Conectarse();

$nordentra		=	$_POST['nordentra'];	
$codservicio	=	$_POST['codservicio'];
$codsector		=	$_POST['codsector'];
$validar		=	$_POST['validar'];
$conte          =	$_POST['conte'];

$respuesta = new stdClass();

if ( $conte == 'validar') 
{
	pg_query( $con, "UPDATE estrealizar r
					SET validar='$validar'
					WHERE r.nordentra = '$nordentra' and r.codservicio = '$codservicio' and exists(select * from estudios e where e.codestudio  = r.codestudio and  e.codsector = '$codsector')" );

	$respuesta->grupo = 0;
} 

// Bitacora
	include( "bitacora.php" );
	$codopc = "V_131";
	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Muestras Check in: Nro. Orden: " . $codservicio.$nordentra;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
// Fin grabacion de registro de auditoria

echo json_encode($respuesta);
?>
<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
$con=Conectarse();

$codservicioe	=	$_POST['codservicioe'];
$codservicior	=	$_POST['codservicior'];
$codcourier		=	$_POST['codcourier'];
$nromuestra		=	$_POST['nromuestra'];
$nropaciente	=	$_POST['nropaciente'];
$nordentra		=	$_POST['nordentra'];
$grupo			=	$_POST['grupo'];
$codservicio	=	$_POST['codservicio'];
$cantidad		=	count($nordentra);

if($grupo == '')
{
	$unro = pg_query( $con, "select max(CAST(coalesce(grupo, '0') AS integer)) as ultimo from datoagrupado" );

	while ( $rowcod = pg_fetch_array( $unro ) ) {
		$grupo = $rowcod[ 'ultimo' ] + 1;
	}

}

$sqld = "select * from datoagrupado where grupo = '$grupo'";

$resd = pg_query( $con, $sqld );
$countlc = pg_num_rows( $resd );

$fecha = date("Y-n-j", time());

$band = 0;

$respuesta = new stdClass();

if ( $countlc == 0 )
{
	for($i=0;$i<$cantidad;$i++)
	{
		pg_query( $con, "INSERT INTO datoagrupado(
		grupo, nromuestra, codservicioe, codservicior, fecha, nordentra, codusu, estado, codcourier, nropaciente, codservicio)
		VALUES ('$grupo', '$nromuestra[$i]', '$codservicioe', '$codservicior', '$fecha', '$nordentra[$i]', '$codusu', '2', '$codcourier', '$nropaciente[$i]', '$codservicio[$i]')" );

		pg_query( $con, "UPDATE estrealizar
					SET codservicior='$codservicioe', codserviciod='$codservicior', estadoestu = '2'
					WHERE nordentra = '$nordentra[$i]' and codservicio = '$codservicio[$i]' and nromuestra = '$nromuestra[$i]'" );

		pg_query( $con, "UPDATE ordtrabajo
					SET codservrem='$codservicioe', codservder='$codservicior'
					WHERE nordentra = '$nordentra[$i]' and codservicio = '$codservicio[$i]'" );

	}

	$respuesta->grupo = $grupo;

	// Bitacora
	include( "bitacora.php" );
	$codopc = "V_211";
	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Agrupamiento para Envio: Nro. Agrupamiento: " . $grupo;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
	// Fin grabacion de registro de auditoria
}
else
{
	for($i=0;$i<$cantidad;$i++)
	{
		pg_query( $con, "UPDATE datoagrupado
					SET codcourier='$codcourier', codservicioe='$codservicioe', codservicior='$codservicior'
					WHERE grupo = '$grupo' and nromuestra = '$nromuestra[$i]' and codservicio = '$codservicio[$i]'" );

		pg_query( $con, "UPDATE estrealizar
				SET codservicior='$codservicioe', codserviciod='$codservicior', estadoestu = '2'
				WHERE nordentra = '$nordentra[$i]'" );

		pg_query( $con, "UPDATE ordtrabajo
				SET codservrem='$codservicioe', codservder='$codservicior'
				WHERE nordentra = '$nordentra[$i]'" );

	}

	$respuesta->grupo = 0;
}


echo json_encode($respuesta);
?>

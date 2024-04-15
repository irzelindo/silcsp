<?php
	@header('Content-type: application/json; charset=utf-8');
	session_start();

	$codusu = $_SESSION[ 'codusu' ];

	include("conexion.php");
	$con=Conectarse();

	$codservicior	=	$_POST['codservicior'];
	$nordentra		=	$_POST['nordentra'];
	$codestudio	  =	$_POST['codestudio'];
	$grupo		  	=	$_POST['grupo'];
	$cantidad		  =	count($nordentra);

	$fecha = date("Y-n-j", time());

	$rep = 0;

	for($i=0;$i<$cantidad;$i++)
	{
				pg_query( $con, "UPDATE datoagrupado
			   						set estado='3'
					 					WHERE nordentra = '$nordentra[$i]' and grupo = '$grupo[$i]'");

			$query = "select * from ordtrabajo where nordentra = '$nordentra[$i]'";
			$result = pg_query($con,$query);

			$row = pg_fetch_assoc($result);

			$codservder = $row["codservder"];

			pg_query( $con, "UPDATE estrealizar
									   						set codservact='$codservder', estadoestu = '3'
											 					WHERE nordentra = '$nordentra[$i]'");


				$rep = $grupo[$i];
	}

	echo json_encode(array('message' => $rep));
?>

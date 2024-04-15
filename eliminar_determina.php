<?php 
@Header("Content-type: text/html; charset=utf-8");

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval']; 
   $codestudio	=	$_POST['codestudio'];
   $coddetermina=	$_POST['coddetermina'];

	$respuesta = new stdClass();

  	pg_query($con,"DELETE FROM evaluaciondeterminacion WHERE nroeval = '$nroeval' and codestudio = '$codestudio' and coddetermina = '$coddetermina'");

	$respuesta->nroeval = $nroeval;
	$respuesta->codestudio = $codestudio;

	echo json_encode($respuesta);
    
?>
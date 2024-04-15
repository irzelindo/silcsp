<?php 
@Header("Content-type: text/html; charset=utf-8");

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval	=	$_POST['nroeval']; 
   $item	=	$_POST['item'];
   $codusu	=	$_POST['codusu'];

	$respuesta = new stdClass();

  	pg_query($con,"DELETE FROM evalucionparticipante WHERE nroeval = '$nroeval' and item = '$item'");
	pg_query($con,"DELETE FROM respuestaparticipante WHERE nroeval = '$nroeval' and codusu = '$codusu'");
    pg_query($con,"DELETE FROM respuestaparti WHERE nroeval = '$nroeval' and codusu = '$codusu'");

	$respuesta->nroeval = $nroeval;

	echo json_encode($respuesta);
    
?>
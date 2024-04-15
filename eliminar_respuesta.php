<?php 
@Header("Content-type: text/html; charset=utf-8");

   include("conexion.php");
   $con=Conectarse();
   
   $idpregunta	=	$_POST['idpregunta']; 
   $item		=	$_POST['item'];

	$respuesta = new stdClass();

  	pg_query($con,"DELETE FROM respuesta WHERE idpregunta = '$idpregunta' and item = '$item'");

	$respuesta->idpregunta = $idpregunta;

	echo json_encode($respuesta);
    
?>
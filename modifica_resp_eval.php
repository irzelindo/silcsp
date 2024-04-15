<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval']; 
   $usuario		=	$_POST['usuario'];
   $obs  		=	$_POST['obs'];

	pg_query( $con, "UPDATE evalucionparticipante
		SET estado='3'
		WHERE nroeval='$nroeval'
		AND   codusu='$usuario'" );

	pg_query( $con, "UPDATE evaluacion
		SET obs='$obs'
		WHERE nroeval='$nroeval'" );


    echo json_encode(array('message' => 1));
  
?>
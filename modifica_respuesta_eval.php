<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval']; 
   $codestudio	=	$_POST['codestudio'];
   $coddetermina=	$_POST['coddetermina'];
   $usuario  	=	$_POST['usuario'];
   $obs  		=	$_POST['obs'];

	if($_POST['puntaje'] == '')
	{
		$puntaje = 0;
	}
	else
	{
		$puntaje = $_POST['puntaje'];
	}

   pg_query( $con, "UPDATE respuestaparti
		SET puntaje='$puntaje'
		WHERE nroeval='$nroeval' 
		AND   codestudio='$codestudio' 
		AND   coddetermina='$coddetermina' 
		AND   codusu='$usuario'" );

	pg_query( $con, "UPDATE evalucionparticipante
		SET estado='3'
		WHERE nroeval='$nroeval'
		AND   codusu='$usuario'" );

	pg_query( $con, "UPDATE evaluacion
		SET obs='$obs'
		WHERE nroeval='$nroeval'" );


    echo json_encode(array('message' => 1));
  
?>
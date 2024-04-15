<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval']; 
   $codnumero	=	$_POST['codnumero'];
   $codletra    =	$_POST['codletra'];
   $valor   	=	$_POST['valor'];
   $usuario  	=	$_POST['usuario'];
   $item  		=	$_POST['item'];

   if($codnumero != '')
   {
	   pg_query( $con, "INSERT INTO respuestaleishmania(
			nroeval, item, codusu, codnumero, codletra, valor, fechaenviado)
			VALUES ('$nroeval', '$item', '$usuario', '$codnumero', '$codletra', '$valor', cast(now() as date))" );
		
		pg_query( $con, "UPDATE evalucionparticipante
					   set estado = '2'
					   where nroeval    = '$nroeval'" );
   }
   

    echo json_encode(array('message' => 1));
  
?>
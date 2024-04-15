<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval']; 
   $codestudio	=	$_POST['codestudio'];
   $coddetermina=	$_POST['coddetermina'];
   $respuesta	=	$_POST['respuesta'];
   $metodo		=	$_POST['metodo'];
   $reactivo	=	$_POST['reactivo'];
   $marcalo  	=	$_POST['marcalo'];
   $lote    	=	$_POST['lote'];
   
   $equipo		=	$_POST['equipo'];
   $marcaeq		=	$_POST['marcaeq'];
   $usuario  	=	$_POST['usuario'];

	if($_POST['fechaven'] == null)
	{
		$fechaven	=	'null';
	}
	else
	{
		$fechaven	=	"'".$_POST['fechaven']."'";
	}

   $sql3="select *
		  from respuestaparti
		  where nroeval    = '$nroeval' 
		  and   codestudio = '$codestudio'
		  and   coddetermina = '$coddetermina'
		  and   codusu = '$codusu'"; 

	$res3=pg_query($con,$sql3);
	$count3=pg_num_rows($res3);

	if($count3 == 0)
    {

		   pg_query( $con, "INSERT INTO respuestaparti(
			nroeval, codestudio, coddetermina, codusu, respuesta, metodo, reactivo, equipo, marcaeq, lote, marcalo, fechaven, fechaenviado)
			VALUES ('$nroeval', '$codestudio', '$coddetermina', $usuario, '$respuesta', '$metodo', '$reactivo', '$equipo', '$marcaeq', '$lote', '$marcalo', $fechaven, cast(now() as date))" );
		
			pg_query( $con, "UPDATE evalucionparticipante
					   set estado = '2'
					   where nroeval    = '$nroeval'" );
		
	}
	else
	{
			pg_query( $con, "UPDATE respuestaparti
		SET respuesta='$respuesta', metodo='$metodo', reactivo='$reactivo', equipo='$equipo', marcaeq='$marcaeq', lote='$lote', marcalo='$marcalo', fechaven=$fechaven
		WHERE nroeval='$nroeval' 
		AND   codestudio='$codestudio' 
		AND   coddetermina='$coddetermina' 
		AND   codusu='$codusu'" );
	}


    echo json_encode(array('message' => 1));
  
?>
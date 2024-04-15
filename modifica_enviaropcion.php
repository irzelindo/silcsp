<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval'];
   $usuario		=	$_POST['usuario'];


   $sql="select *
		 from respuestaparticipante
		 where nroeval  = '$nroeval'
		 and   codusu   = '$usuario'"; 

	$res=pg_query($con,$sql);
	$count=pg_num_rows($res);

	if($count != 0)
	{
		pg_query( $con, "UPDATE respuestaparticipante
						 set enviado = 'S', fechaenviado = cast(now() as date)
						 where nroeval = '$nroeval'
						 and   codusu  = '$usuario'" );
		
		
	}

    echo json_encode(array('message' => 1));
  
?>
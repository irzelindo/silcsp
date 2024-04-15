<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval']; 
   $usuario		=	$_POST['usuario'];

   $sql="select *
		 from respuestafinal
		 where nroeval  = '$nroeval'
		 and   codusu   = '$usuario'
		 and   enviado  = 'N'"; 

	$res=pg_query($con,$sql);
	$count=pg_num_rows($res);

	if($count != 0)
	{
		pg_query( $con, "delete from respuestafinal where nroeval = '$nroeval' and codusu   = '$usuario'" );
		
		pg_query( $con, "UPDATE evalucionparticipante
  				   set estado = '1'
				   where nroeval    = '$nroeval' 
				   and   codusu = '$usuario'" );
	}

    echo json_encode(array('message' => 1));
  
?>
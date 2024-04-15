<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $idpregunta	=	$_POST['idpregunta']; 
   $nroeval		=	$_POST['nroeval']; 
   $item		=	$_POST['item'];
   $usuario		=	$_POST['usuario'];
   $tipo		=	$_POST['tipo'];
   $metodo		=	$_POST['metodo'];
   $reactivo	=	$_POST['reactivo'];
   $marca		=	$_POST['marca'];
   $loteev		=	$_POST['loteev'];
   $fechaven	=	$_POST['fechaven'];
   $equipo		=	$_POST['equipo'];
   $obsev		=	$_POST['obsev'];
   $rmuestra	=	$_POST['rmuestra'];
   $respuestar  =	$_POST['respuestar'];

   $sql="select *
		 from respuestafinal
		 where nroeval  = '$nroeval' 
		 and   idpregunta     = '$idpregunta'
		 and   codusu   = '$usuario'"; 

	$res=pg_query($con,$sql);
	$count=pg_num_rows($res);

	if($count == 0)
	{
		$sqlnro = "select nextval('seq_respuestar')";

		$resnro   = pg_query( $con, $sqlnro );
		$rownro   = pg_fetch_assoc($resnro);

		$codigo 	= $rownro["nextval"];


		if($tipo == 2)
		{
			pg_query( $con, "INSERT INTO respuestafinal(
					codigo, nroeval, idpregunta, codusu, respuesta)
			VALUES ('$codigo', '$nroeval', '$idpregunta', '$usuario', '$item')" );
		}
		else
		{
			pg_query( $con, "INSERT INTO respuestafinal(
					codigo, nroeval, idpregunta, codusu, respuestar)
			VALUES ('$codigo', '$nroeval', '$idpregunta', '$usuario', '$respuestar')" );
		}
	    
		
		 pg_query( $con, "UPDATE evalucionparticipante
  				   set estado = '2'
				   where nroeval    = '$nroeval' 
				   and   codusu = '$usuario'" );
	}
    else
	{
		$rowk   = pg_fetch_assoc($res);
		
		$codigo 	= $rowk["codigo"];
		
		if($tipo == 2)
		{
			pg_query( $con, "UPDATE respuestafinal
						 set respuesta = '$item'
						 where codigo = '$codigo'" );
		}
		else
		{
			pg_query( $con, "UPDATE respuestafinal
						 set respuestar = '$respuestar'
						 where codigo = '$codigo'" );
		}
		
		pg_query( $con, "UPDATE evalucionparticipante
  				   set estado = '2'
				   where nroeval    = '$nroeval' 
				   and   codusu = '$usuario'" );
	}

	if($rmuestra == 2)
	{
		pg_query( $con, "UPDATE respuestafinal
						 set metodo = '$metodo', reactivo = '$reactivo', marca = '$marca', lote = '$loteev', fechaven = '$fechaven', equipo = '$equipo', obs = '$obsev'
						 where nroeval    = '$nroeval' 
				   		 and   codusu = '$usuario'" );
	}

    echo json_encode(array('message' => 1));
  
?>
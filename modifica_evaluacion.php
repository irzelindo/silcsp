<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $codusu=$_SESSION['codusu'];

   include("conexion.php");
   $con=Conectarse();
   
   $nroeval		=	$_POST['nroeval']; 
   $item		=	$_POST['item'];
   $usuario		=	$_POST['usuario'];
   $opc			=	$_POST['opc'];
   $metodo		=	$_POST['metodo'];
   $reactivo	=	$_POST['reactivo'];
   $marca		=	$_POST['marca'];
   $loteev		=	$_POST['loteev'];
   $fechaven	=	$_POST['fechaven'];
   $equipo		=	$_POST['equipo'];
   $obsev		=	$_POST['obsev'];
   $rmuestra    =	$_POST['rmuestra'];

   $sql="select *
		 from respuestaparticipante
		 where nroeval  = '$nroeval' 
		 and   item     = '$item'
		 and   codusu   = '$usuario'"; 

	$res=pg_query($con,$sql);
	$count=pg_num_rows($res);

	if($count == 0)
	{
		$sqlnro = "select nextval('seq_respuesta')";

		$resnro   = pg_query( $con, $sqlnro );
		$rownro   = pg_fetch_assoc($resnro);

		$codigo 	= $rownro["nextval"];



	    pg_query( $con, "INSERT INTO respuestaparticipante(
					codigo, nroeval, item, codusu, respuesta)
			VALUES ('$codigo', '$nroeval', '$item', '$usuario', '$opc')" );
		
		 pg_query( $con, "UPDATE evalucionparticipante
  				   set estado = '2'
				   where nroeval    = '$nroeval' 
				   and   codusu = '$usuario'" );
	}
    else
	{
		$rowk   = pg_fetch_assoc($res);
		
		$codigo 	= $rowk["codigo"];
		
		pg_query( $con, "UPDATE respuestaparticipante
						 set respuesta = '$opc'
						 where codigo = '$codigo'" );
		
		pg_query( $con, "UPDATE evalucionparticipante
  				   set estado = '2'
				   where nroeval    = '$nroeval' 
				   and   codusu = '$usuario'" );
	}

	if($rmuestra == 2)
	{
		pg_query( $con, "UPDATE respuestaparticipante
						 set metodo = '$metodo', reactivo = '$reactivo', marca = '$marca', lote = '$loteev', fechaven = '$fechaven', equipo = '$equipo', obs = '$obsev'
						 where nroeval    = '$nroeval' 
				   		 and   codusu = '$usuario'" );
	}

    echo json_encode(array('message' => 1));
  
?>
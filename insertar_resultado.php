<?php
@Header("Content-type: text/html; charset=utf-8");

   include("conexion.php");
   $con=Conectarse();

   $nordentra		  =	$_POST['nordentra'];
   $codresultado      =	$_POST['codresultado'];
   $resultado		  =	$_POST['resultado'];
   $obs		          =	$_POST['obs'];
   $nroestudio	      =	$_POST['nroestudio'];
   $idmuestra		  =	$_POST['idmuestra'];
   $microbiologia	  =	$_POST['microbiologia'];

   $fecha = date("Y-n-j", time());

   $respuesta = new stdClass();

   if($microbiologia != 'underline')
   {
	   if($microbiologia == 2)
	   {
			pg_query( $con, "UPDATE estrealizar
							 SET estadoestu='4'
							 WHERE nordentra = '$nordentra'");
		   
		   if($resultado != 'underline')
		   {
			 	$result = pg_query($con,"UPDATE resultados
								  SET resultado='$resultado', obs='$obs', fechares = '$fecha', envio_dgvs = 0
								  WHERE nordentra ='$nordentra' and nroestudio ='$nroestudio' and idmuestra ='$idmuestra'");  
		   }
		   
		   if($codresultado != 'underline')
		   {
			   $result = pg_query($con,"UPDATE resultados
								  SET codresultado='$codresultado', obs='$obs', fechares = '$fecha', envio_dgvs = 0
								  WHERE nordentra ='$nordentra' and nroestudio ='$nroestudio' and idmuestra ='$idmuestra'");
		   }
			
	   }
	   else
	   {
			 pg_query( $con, "UPDATE estrealizar
							  SET estadoestu='4'
							  WHERE nordentra = '$nordentra'");
		   
		     if($resultado != 'underline')
             {
                  $result = pg_query($con,"UPDATE resultadosmicro
								  SET resultado='$resultado', obs='$obs', fechares = '$fecha', envio_dgvs = 0
								  WHERE nordentra ='$nordentra' and nroestudio ='$nroestudio' and idmuestra ='$idmuestra'"); 
             }
             else
             {
                 $result = pg_query($con,"UPDATE resultadosmicro
								  SET codresultado='$codresultado', obs='$obs', fechares = '$fecha', envio_dgvs = 0
								  WHERE nordentra ='$nordentra' and nroestudio ='$nroestudio' and idmuestra ='$idmuestra'");
             }
	   }
   }

   

  $respuesta->grupo = $codresultado;


  echo json_encode($respuesta);
?>
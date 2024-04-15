<?php
@Header("Content-type: text/html; charset=utf-8");
	session_start();

   include("conexion.php");
   $con=Conectarse();

	 $nordentra	 =	$_POST['nordentra'];
   $codestudio   =	$_POST['codestudio'];
   $codsector	 =	$_POST['codsector'];
   $operacion	 =	$_POST['operacion'];
   $coddetermina =	$_POST['coddetermina'];

   $codusu = $_SESSION[ 'codusu' ];

   $fechaanul = date("Y-m-d", time());
   $horaanul  = date("H:i");

	 $sql = "select * from resultados where nordentra = '$nordentra' and coddetermina = '$coddetermina' and fechaanul is not null";

   $res = pg_query( $con, $sql );
   $countlc = pg_num_rows( $res );

   $respuesta = new stdClass();

		if($countlc == 0)
    {
		 	   if($operacion == 'S')
		 	   {
		 		   pg_query( $con, "update resultados
		 						 set codusu3 = '$codusu', fechaanul = '$fechaanul', horaanul = '$horaanul', codestado = '005', fechaval = null, horaval = '', codusu1 = ''
		 						 where nordentra = '$nordentra'
		 						 and codsector = '$codsector'
		 						 and fechaval is not null" );
		 	   }

		 	   if($operacion == 'E')
		 	   {
		 		   pg_query( $con, "update resultados
		 						 set codusu3 = '$codusu', fechaanul = '$fechaanul', horaanul = '$horaanul', codestado = '005', fechaval = null, horaval = '', codusu1 = ''
		 						 where nordentra = '$nordentra'
		 						 and codestudio = '$codestudio'
		 						 and fechaval is not null" );
		 	   }

		 	   if($operacion == 'O')
		 	   {
		 		   pg_query( $con, "update resultados
		 						 set codusu3 = '$codusu', fechaanul = '$fechaanul', horaanul = '$horaanul', codestado = '005', fechaval = null, horaval = '', codusu1 = ''
		 						 where nordentra = '$nordentra'
		 						 and fechaval is not null" );
		 	   }


		 	  $respuesta->grupo = 1;

					// Bitacora
							 include( "bitacora.php" );
							 $codopc = "V_13";
							 $fecha1 = date( "Y-n-j", time() );
							 $hora = date( "G:i:s", time() );
							 $accion = "Anulacion Resultado: Nro. Orden: " . $nordentra;
							 $terminal = $_SERVER[ 'REMOTE_ADDR' ];
							 $a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
				 // Fin grabacion de registro de auditoria
    }
    else
    {
 	   			$respuesta->grupo = 0;
    }


  echo json_encode($respuesta);
?>

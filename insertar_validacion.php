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

   $fechaval = date("Y-m-d", time());
   $horaval  = date("H:i");

   $sql = "select * from resultados where nordentra = '$nordentra' and coddetermina = '$coddetermina' and fechaval is not null";

   $res = pg_query( $con, $sql );
   $countlc = pg_num_rows( $res );

   $respuesta = new stdClass();

   if($countlc == 0)
   {
	   if($operacion == 'S')
	   {
		   pg_query( $con, "update resultados
						 set fechaval = '$fechaval', horaval = '$horaval', codusu1 = '$codusu', codestado = '003', fechaanul = null, horaanul = '', codusu3 = ''
						 where nordentra = '$nordentra'
						 and codsector = '$codsector'
						 and (codresultado !='' or resultado !='' )" );
	   }

	   if($operacion == 'E')
	   {
		   pg_query( $con, "update resultados
						 set fechaval = '$fechaval', horaval = '$horaval', codusu1 = '$codusu', codestado = '003', fechaanul = null, horaanul = '', codusu3 = ''
						 where nordentra = '$nordentra'
						 and codestudio = '$codestudio'
						 and (codresultado !='' or resultado !='' )" );
	   }

	   if($operacion == 'O')
	   {
		   pg_query( $con, "update resultados
						 set fechaval = '$fechaval', horaval = '$horaval', codusu1 = '$codusu', codestado = '003', fechaanul = null, horaanul = '', codusu3 = ''
						 where nordentra = '$nordentra'
						 and (codresultado !='' or resultado !='' )" );
	   }


	  $respuesta->grupo = 1;

	   // Bitacora
			include( "bitacora.php" );
			$codopc = "V_13";
			$fecha1 = date( "Y-n-j", time() );
			$hora = date( "G:i:s", time() );
			$accion = "Validacion Resultado: Nro. Orden: " . $nordentra." Cod. Estudio: ".$codestudio;
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

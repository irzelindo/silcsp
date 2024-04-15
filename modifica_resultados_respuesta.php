<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_181   = $_SESSION['V_181'];	// Previsto Bioquímica Clínica
$v_182   = $_SESSION['V_182'];	// Previsto Dengue
$v_183   = $_SESSION['V_183'];	// Previsto Hematología
$v_184   = $_SESSION['V_184'];	// Previsto Influenza
$v_185   = $_SESSION['V_185'];	// Previsto Parasitología Intestinal
$v_186   = $_SESSION['V_186'];	// Previsto Rotavirus
$v_187   = $_SESSION['V_187'];	// Previsto Sífilis
$v_188   = $_SESSION['V_188'];	// Previsto Malaria

$nroeval 	= $_GET['nroeval'];
$codempresa = $_GET['codempresa'];
$texamen 	= $_GET['texamen'];
$mes	 	= $_GET['permes'];
$anio	 	= $_GET['peranio'];

switch ($texamen) 
{
	case '1':
	   
	    $query = "select * from evalanalitos where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);

		while ($row = pg_fetch_array($result))
		{
			$analito = $row["analito"];

			switch ($analito) 
			{
				case '1':
				   $resulprevisto1 = $row["resulprevisto"];

				   break;
				case '2':
					$resulprevisto2 = $row["resulprevisto"];

					break;
				case '3':
					$resulprevisto3 = $row["resulprevisto"];

					break;
				case '4':
					$resulprevisto4 = $row["resulprevisto"];

					break;
				case '5':
					$resulprevisto5 = $row["resulprevisto"];

					break;
				case '6':
					$resulprevisto6 = $row["resulprevisto"];

					break;
				case '7':
					$resulprevisto7 = $row["resulprevisto"];

					break;
				case '8':
					$resulprevisto8 = $row["resulprevisto"];

					break;
				case '9':
					$resulprevisto9 = $row["resulprevisto"];

					break;
			}
		}
		
	   break;
	case '2':
		
		$query = "select * from matdengue where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);

		while ($row = pg_fetch_array($result))
		{
			$nromuestra = $row["nromuestra"];

			switch ($nromuestra) 
			{
				case 'muestra1':
				   $muestra1 = $row["resulprevisto"];

				   break;
				case 'muestra2':
					$muestra2 = $row["resulprevisto"];

					break;
				case 'muestra3':
					$muestra3 = $row["resulprevisto"];

					break;
				case 'muestra4':
					$muestra4 = $row["resulprevisto"];

					break;
				case 'muestra5':
					$muestra5 = $row["resulprevisto"];

					break;
			}
		}
		
		break;
	case '3':
		
		
		break;
	case '4':
		
		
		break;
	case '5':
		
		
		break;
	case '6':
		
		
		break;
	case '7':
		
		
		break;
	case '8':
		
		
		break;
	case '9':
		
		
		break;
}
//incluímos la clase xajax
include( 'xajax/xajax_core/xajax.inc.php' );

//instanciamos el objeto de la clase xajax
$xajax = new xajax();

//registramos funciones 

$xajax->register( XAJAX_FUNCTION, 'ValidarFormulario' );

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

$xajax->configure( 'javascript URI', 'xajax/' );
//Funciones

function ValidarFormulario($form) 
{
	extract($form);

	$respuesta = new xajaxResponse();
	//$respuesta->setCharacterEncoding( 'utf-8' );
	
	$codusu = $_SESSION[ 'codusu' ];

	$con = Conectarse();

	$mensaje = '';

	switch ($texamen1 ) 
	{
		case '1':
		   $cadena1     = "select * from evalanalitos where nroeval = '$nroeval' and codempresa = '$codempresa1'";
		   $lista1      = pg_query($con, $cadena1);
		   $registro1   = pg_fetch_array($lista1);
		   $cantregis1  = pg_num_rows($lista1);

		   $codopc = "V_181";

		   if($cantregis1 == 0)
		   {
			   for ($i = 1; $i <= 9; $i++) 
			   {
				   $resultado = $form["resulprevisto$i"];
				   
				   pg_query( $con, "INSERT INTO evalanalitos(
				nroeval, codempresa, resulprevisto, analito)
				VALUES ('$nroeval', '$codempresa1', '$resultado', '$i')" );
			   }
		   }
		   else
		   {
			  for ($i = 1; $i <= 9; $i++) 
			   {
					$resultado = $form["resulprevisto$i"];
				  
				    pg_query( $con, "UPDATE evalanalitos
					SET resulprevisto='$resultado'
					WHERE nroeval = '$nroeval' and codempresa = '$codempresa1' and analito = '$i'" );
			   } 
		   }

		   break;
		case '2':
			
			$cadena1     = "select * from matdengue where nroeval = '$nroeval' and codempresa = '$codempresa1'";
		   $lista1      = pg_query($con, $cadena1);
		   $registro1   = pg_fetch_array($lista1);
		   $cantregis1  = pg_num_rows($lista1);

		   $codopc = "V_182";

		   if($cantregis1 == 0)
		   {
			   for ($i = 1; $i <= 5; $i++) 
			   {
				   $resultado = $form["muestra$i"];
				   
				   pg_query( $con, "INSERT INTO matdengue(
				nroeval, codempresa, resulprevisto, nromuestra)
				VALUES ('$nroeval', '$codempresa1', '$resultado', 'muestra$i')" );
			   }
		   }
		   else
		   {
			  for ($i = 1; $i <= 5; $i++) 
			   {
					$resultado = $form["muestra$i"];
				  
				    pg_query( $con, "UPDATE matdengue
					SET resulprevisto='$resultado'
					WHERE nroeval = '$nroeval' and codempresa = '$codempresa1' and nromuestra = 'muestra$i'" );
			   } 
		   }
			
			break;
		case '3':
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evalhematologia where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evalhematologia';
			break;
		case '4':
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evalinfluenza where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evalinfluenza';
			break;
		case '5':
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evalpintestinal where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evalpintestinal';
			break;
		case '6':
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evalrotavirus where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evalrotavirus';
			break;
		case '7':
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evalsifilis where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evalsifilis';
			break;
		case '8':
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evalmalaria where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evalmalaria';
			break;
		case '9':
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evaleducacioncontinua where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evaleducacioncontinua';
			break;
	}

	// Bitacora
	include( "bitacora.php" );

	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Resultados Previstos: Nro. Evaluacion: " . $nroeval;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
	// Fin grabacion de registro de auditoria

	$respuesta->redirect("resultados_previstos.php?mensage=2");


	return $respuesta;
}

if ( $_SESSION[ 'usuario' ] != "SI" ) {
	header( "Location: index.php" );
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
	<?php
	//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
	$xajax->printJavascript( "xajax/" );
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" href="favicon.ico"/>

	<!------------ CSS ----------->
	<link href="css/mibootstrap.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>

	<link href="css/animate.min.css" rel="stylesheet"/>

	<!----------- JAVASCRIPT ---------->
	<script src="js/jquery.js"></script>

	<!----------- PARA ALERTAS  ---------->
	<script src="js/sweetalert.min.js" type="text/javascript"></script>


	<link href="font-awesome.min.css" rel="stylesheet"/>

	<style>
		div#container {
			width: 970px;
			position: relative;
			margin: 0 auto 0 auto;
			text-align: left;
		}
		
		body {
			background-color: #FFFFFF;
			color: #337ab7;
			;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			line-height: 1.1875;
			margin: 0;
			text-align: center;
		}
		
		#wb_FontAwesomeIcon7 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon7:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon7 {
			height: 34px;
			width: 47px;
		}
		
		#FontAwesomeIcon7 i {
			color: #2E8B57;
			display: inline-block;
			font-size: 34px;
			line-height: 34px;
			vertical-align: middle;
			width: 28px;
		}
		
		#wb_FontAwesomeIcon7:hover i {
			color: #337AB7;
		}
		
		#wb_FontAwesomeIcon4 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon4:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon4 {
			height: 36px;
			width: 42px;
		}
		
		#FontAwesomeIcon4 i {
			color: #FF0000;
			display: inline-block;
			font-size: 36px;
			line-height: 36px;
			vertical-align: middle;
			width: 31px;
		}
		
		#wb_FontAwesomeIcon4:hover i {
			color: #337AB7;
		}
		
		#Button1 {
			width: 96px;
			height: 35px;
			visibility: visible;
			display: inline-block;
			color: #FFFFFF;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #3370B7;
			background-image: none;
			border-radius: 4px;
		}
		
		#Button1 {
			display: inline-block;
			width: 186px;
			height: 25px;
			z-index: 34;
		}
		
		#wb_pacientesLayoutGrid1 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: transparent;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#pacientesLayoutGrid1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#pacientesLayoutGrid1 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#pacientesLayoutGrid1 .col-1,
		#pacientesLayoutGrid1 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#pacientesLayoutGrid1 .col-1,
		#pacientesLayoutGrid1 .col-2 {
			float: left;
		}
		
		#pacientesLayoutGrid1 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientesLayoutGrid1 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		
		#pacientesLayoutGrid1:before,
		#pacientesLayoutGrid1:after,
		#pacientesLayoutGrid1 .row:before,
		#pacientesLayoutGrid1 .row:after {
			display: table;
			content: " ";
		}
		
		#pacientesLayoutGrid1:after,
		#pacientesLayoutGrid1 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#pacientesLayoutGrid1 .col-1,
			#pacientesLayoutGrid1 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_Text2 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_Text2 div {
			text-align: left;
		}
		
		#Line4 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#Line2 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#Line2 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 5;
		}
		
		#Line3 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#Line3 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 7;
		}
		
		#Line5 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#Line5 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 10;
		}
		
		#texamen {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			padding: 4px 4px 4px 4px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		
		#texamen:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#texamen {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 9;
		}
		
		#codempresa {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			padding: 4px 4px 4px 4px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		
		#codempresa:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#codempresa {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 9;
		}
		
		#Combobox2 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			padding: 4px 4px 4px 4px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		
		#Combobox2:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#Combobox2 {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 9;
		}
		
		#codservicior {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			padding: 4px 4px 4px 4px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		
		#codservicior:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#codservicior {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 9;
		}
	</style>

	<style>
		a {
			color: #337ab7;
			text-decoration: none;
		}
		
		a:visited {
			color: #800080;
		}
		
		a:active {
			color: #FF0000;
		}
		
		a:hover {
			color: #0000FF;
			text-decoration: none;
		}
		
		#wb_ResponsiveMenu1 {
			background-color: rgba(159, 182, 192, 1.00);
			display: block;
			text-align: center;
			width: 100%;
		}
		
		#ResponsiveMenu1 {
			background-color: #9FB6C0;
			display: inline-block;
			height: 45px;
		}
		
		#wb_ResponsiveMenu1 ul {
			list-style: none;
			margin: 0;
			padding: 0;
			position: relative;
		}
		
		#wb_ResponsiveMenu1 ul:after {
			clear: both;
			content: "";
			display: block;
		}
		
		#wb_ResponsiveMenu1 ul li {
			background-color: #9FB6C0;
			display: list-item;
			float: left;
			list-style: none;
			z-index: 9999;
		}
		
		#wb_ResponsiveMenu1 ul li i {
			font-size: 0px;
			width: 0px;
		}
		
		#wb_ResponsiveMenu1 ul li a {
			color: #FFFFFF;
			font-family: Arial;
			font-size: 13px;
			font-weight: normal;
			font-style: normal;
			padding: 15px 20px 15px 20px;
			text-align: center;
			text-decoration: none;
		}
		
		#wb_ResponsiveMenu1> ul> li> a {
			height: 15px;
		}
		
		.ResponsiveMenu1 a {
			display: block;
		}
		
		#wb_ResponsiveMenu1 li a:hover,
		#wb_ResponsiveMenu1 li .active {
			background-color: #5A7C8B;
			color: #F0F8FF;
		}
		
		#wb_ResponsiveMenu1 ul ul {
			display: none;
			position: absolute;
			top: 45px;
		}
		
		#wb_ResponsiveMenu1 ul li:hover> ul {
			display: list-item;
		}
		
		#wb_ResponsiveMenu1 ul ul li {
			background-color: #DCDCDC;
			color: #696969;
			float: none;
			position: relative;
			width: 209px;
		}
		
		#wb_ResponsiveMenu1 ul ul li a:hover,
		#wb_ResponsiveMenu1 ul ul li .active {
			background-color: #5A7C8B;
			color: #FFFFFF;
		}
		
		#wb_ResponsiveMenu1 ul ul li i {
			margin-right: 0px;
			vertical-align: middle;
		}
		
		#wb_ResponsiveMenu1 ul ul li a {
			color: #696969;
			padding: 5px 15px 5px 15px;
			text-align: left;
			vertical-align: middle;
		}
		
		#wb_ResponsiveMenu1 ul ul ul li {
			left: 209px;
			position: relative;
			top: -45px;
		}
		
		#wb_ResponsiveMenu1 .arrow-down {
			display: inline-block;
			width: 0;
			height: 0;
			margin-left: 2px;
			vertical-align: middle;
			border-top: 4px solid #FFFFFF;
			border-right: 4px solid transparent;
			border-left: 4px solid transparent;
			border-bottom: 0 dotted;
		}
		
		#wb_ResponsiveMenu1 .arrow-left {
			display: inline-block;
			width: 0;
			height: 0;
			margin-left: 4px;
			vertical-align: middle;
			border-left: 4px solid #696969;
			border-top: 4px solid transparent;
			border-bottom: 4px solid transparent;
			border-right: 0 dotted;
		}
		
		#wb_ResponsiveMenu1 li a:hover .arrow-down {
			border-top-color: #F0F8FF;
		}
		
		#wb_ResponsiveMenu1 ul ul li a:hover .arrow-left,
		#wb_ResponsiveMenu1 ul ul li .active .arrow-left {
			border-left-color: #FFFFFF;
		}
		
		#wb_ResponsiveMenu1 .toggle,
		[id^=ResponsiveMenu1-submenu] {
			display: none;
		}
		
		@media all and (max-width:768px) {
			#wb_ResponsiveMenu1 {
				margin: 0;
				text-align: left;
			}
			#wb_ResponsiveMenu1 ul li a,
			#wb_ResponsiveMenu1 .toggle {
				font-size: 13px;
				font-weight: normal;
				font-style: normal;
				padding: 5px 15px 5px 15px;
			}
			#wb_ResponsiveMenu1 .toggle+ a {
				display: none !important;
			}
			.ResponsiveMenu1 {
				display: none;
				z-index: 9999;
			}
			#ResponsiveMenu1 {
				background-color: transparent;
				display: none;
			}
			#wb_ResponsiveMenu1> ul> li> a {
				height: auto;
			}
			#wb_ResponsiveMenu1 .toggle {
				display: block;
				background-color: #9FB6C0;
				color: #FFFFFF;
				padding: 0px 15px 0px 15px;
				line-height: 26px;
				text-decoration: none;
				border: none;
			}
			#wb_ResponsiveMenu1 .toggle:hover {
				background-color: #5A7C8B;
				color: #F0F8FF;
			}
			[id^=ResponsiveMenu1-submenu]:checked+ ul {
				display: block !important;
			}
			#ResponsiveMenu1-title {
				height: 45px;
				line-height: 45px !important;
				text-align: center;
			}
			#wb_ResponsiveMenu1 ul li {
				display: block;
				width: 100%;
			}
			#wb_ResponsiveMenu1 ul ul .toggle,
			#wb_ResponsiveMenu1 ul ul a {
				padding: 0 30px;
			}
			#wb_ResponsiveMenu1 a:hover,
			#wb_ResponsiveMenu1 ul ul ul a {
				background-color: #DCDCDC;
				color: #696969;
			}
			#wb_ResponsiveMenu1 ul li ul li .toggle,
			#wb_ResponsiveMenu1 ul ul a {
				background-color: #DCDCDC;
				color: #696969;
			}
			#wb_ResponsiveMenu1 ul ul ul a {
				padding: 5px 15px 5px 45px;
			}
			#wb_ResponsiveMenu1 ul li a {
				text-align: left;
			}
			#wb_ResponsiveMenu1 ul li a br {
				display: none;
			}
			#wb_ResponsiveMenu1 ul li i {
				margin-right: 0px;
			}
			#wb_ResponsiveMenu1 ul ul {
				float: none;
				position: static;
			}
			#wb_ResponsiveMenu1 ul ul li:hover> ul,
			#wb_ResponsiveMenu1 ul li:hover> ul {
				display: none;
			}
			#wb_ResponsiveMenu1 ul ul li {
				display: block;
				width: 100%;
			}
			#wb_ResponsiveMenu1 ul ul ul li {
				position: static;
			}
			#ResponsiveMenu1-icon {
				display: block;
				position: absolute;
				left: 20px;
				top: 10px;
			}
			#ResponsiveMenu1-icon span {
				display: block;
				margin-top: 4px;
				height: 2px;
				background-color: #FFFFFF;
				color: #FFFFFF;
				width: 24px;
			}
			#wb_ResponsiveMenu1 ul li ul li .toggle:hover {
				background-color: #5A7C8B;
				color: #FFFFFF;
			}
			#wb_ResponsiveMenu1 .toggle .arrow-down {
				border-top-color: #FFFFFF;
			}
			#wb_ResponsiveMenu1 .toggle:hover .arrow-down,
			#wb_ResponsiveMenu1 li .active .arrow-down {
				border-top-color: #F0F8FF;
			}
			#wb_ResponsiveMenu1 ul li ul li .toggle .arrow-down {
				border-top-color: #696969;
			}
			#wb_ResponsiveMenu1 ul li ul li .toggle:hover .arrow-down,
			#wb_ResponsiveMenu1 ul li ul li .active .arrow-down {
				border-top-color: #FFFFFF;
			}
		}
		
		#wb_LayoutGrid1 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: transparent;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		
		#LayoutGrid1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 10px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#LayoutGrid1 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#LayoutGrid1 .col-1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#LayoutGrid1 .col-1 {
			float: left;
		}
		
		#LayoutGrid1 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: center;
		}
		
		#LayoutGrid1:before,
		#LayoutGrid1:after,
		#LayoutGrid1 .row:before,
		#LayoutGrid1 .row:after {
			display: table;
			content: " ";
		}
		
		#LayoutGrid1:after,
		#LayoutGrid1 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#LayoutGrid1 .col-1 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_LayoutGrid2 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: #9FB6C0;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#LayoutGrid2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#LayoutGrid2 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#LayoutGrid2 .col-1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#LayoutGrid2 .col-1 {
			float: left;
		}
		
		#LayoutGrid2 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: left;
		}
		
		#LayoutGrid2:before,
		#LayoutGrid2:after,
		#LayoutGrid2 .row:before,
		#LayoutGrid2 .row:after {
			display: table;
			content: " ";
		}
		
		#LayoutGrid2:after,
		#LayoutGrid2 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#LayoutGrid2 .col-1 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_Image3 {
			vertical-align: top;
		}
		
		#Image3 {
			border: 0px #000000 solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 0px 0px 0px;
			display: inline-block;
			width: 142px;
			height: 118px;
			vertical-align: top;
		}
		
		#wb_Image4 {
			vertical-align: top;
		}
		
		#Image4 {
			border: 0px #000000 solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 0px 0px 0px;
			display: inline-block;
			width: 743px;
			height: 147px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon2 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon2:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon2 {
			height: 32px;
			width: 66px;
		}
		
		#FontAwesomeIcon2 i {
			color: #265A88;
			display: inline-block;
			font-size: 32px;
			line-height: 32px;
			vertical-align: middle;
			width: 32px;
		}
		
		#wb_FontAwesomeIcon2:hover i {
			color: #337AB7;
		}
		
		#Layer2 {
			background-color: transparent;
			background-image: none;
		}
		
		#wb_FontAwesomeIcon3 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon3:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon3 {
			height: 39px;
			width: 43px;
		}
		
		#FontAwesomeIcon3 i {
			color: #FF0000;
			display: inline-block;
			font-size: 39px;
			line-height: 39px;
			vertical-align: middle;
			width: 39px;
		}
		
		#wb_FontAwesomeIcon3:hover i {
			color: #337AB7;
		}
		
		#wb_LayoutGrid3 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: transparent;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#LayoutGrid3 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#LayoutGrid3 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#LayoutGrid3 .col-1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#LayoutGrid3 .col-1 {
			float: left;
		}
		
		#LayoutGrid3 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: center;
		}
		
		#LayoutGrid3:before,
		#LayoutGrid3:after,
		#LayoutGrid3 .row:before,
		#LayoutGrid3 .row:after {
			display: table;
			content: " ";
		}
		
		#LayoutGrid3:after,
		#LayoutGrid3 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#LayoutGrid3 .col-1 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_Text1 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_Text1 div {
			text-align: left;
		}
		
		#Line9 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_menuLayoutGrid1 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: #F5F5F5;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#menuLayoutGrid1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#menuLayoutGrid1 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#menuLayoutGrid1 .col-1,
		#menuLayoutGrid1 .col-2,
		#menuLayoutGrid1 .col-3,
		#menuLayoutGrid1 .col-4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#menuLayoutGrid1 .col-1,
		#menuLayoutGrid1 .col-2,
		#menuLayoutGrid1 .col-3,
		#menuLayoutGrid1 .col-4 {
			float: left;
		}
		
		#menuLayoutGrid1 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: center;
		}
		
		#menuLayoutGrid1 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: center;
		}
		
		#menuLayoutGrid1 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: center;
		}
		
		#menuLayoutGrid1 .col-4 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: center;
		}
		
		#menuLayoutGrid1:before,
		#menuLayoutGrid1:after,
		#menuLayoutGrid1 .row:before,
		#menuLayoutGrid1 .row:after {
			display: table;
			content: " ";
		}
		
		#menuLayoutGrid1:after,
		#menuLayoutGrid1 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#menuLayoutGrid1 .col-1,
			#menuLayoutGrid1 .col-2,
			#menuLayoutGrid1 .col-3,
			#menuLayoutGrid1 .col-4 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_menuFontAwesomeIcon1 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_menuFontAwesomeIcon1:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#menuFontAwesomeIcon1 {
			height: 34px;
			width: 36px;
		}
		
		#menuFontAwesomeIcon1 i {
			color: #DC143C;
			display: inline-block;
			font-size: 34px;
			line-height: 34px;
			vertical-align: middle;
			width: 33px;
		}
		
		#wb_menuFontAwesomeIcon1:hover i {
			color: #337AB7;
		}
		
		#wb_menuFontAwesomeIcon2 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_menuFontAwesomeIcon2:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#menuFontAwesomeIcon2 {
			height: 34px;
			width: 36px;
		}
		
		#menuFontAwesomeIcon2 i {
			color: #DC143C;
			display: inline-block;
			font-size: 34px;
			line-height: 34px;
			vertical-align: middle;
			width: 33px;
		}
		
		#wb_menuFontAwesomeIcon2:hover i {
			color: #337AB7;
		}
		
		#wb_menuFontAwesomeIcon3 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_menuFontAwesomeIcon3:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#menuFontAwesomeIcon3 {
			height: 34px;
			width: 36px;
		}
		
		#menuFontAwesomeIcon3 i {
			color: #DC143C;
			display: inline-block;
			font-size: 34px;
			line-height: 34px;
			vertical-align: middle;
			width: 33px;
		}
		
		#wb_menuFontAwesomeIcon3:hover i {
			color: #337AB7;
		}
		
		#wb_menuText1 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_menuText1 div {
			text-align: left;
		}
		
		#wb_menuText2 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_menuText2 div {
			text-align: left;
		}
		
		#wb_menuText3 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_menuText3 div {
			text-align: left;
		}
		
		#page1Layer1 {
			background-color: #FFFFFF;
			background-image: none;
		}
		
		#page1Layer1 {
			display: inline-flex !important;
		}
		
		#wb_menuCarousel2 {
			background-color: #F2F5F7;
			background-image: none;
		}
		
		#menuCarousel2 .frame {
			width: 466px;
			display: inline-block;
			float: left;
			height: 262px;
		}
		
		#wb_menuCarousel2 .pagination {
			bottom: 0;
			left: 0;
			position: absolute;
			text-align: center;
			vertical-align: middle;
			width: 100%;
			z-index: 998;
		}
		
		#wb_menuCarousel2 .pagination img {
			border-style: none;
			padding: 12px 12px 12px 12px;
		}
		
		#menuImage5 {
			border: 0px #000000 solid;
			padding: 0px 0px 0px 0px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
		}
		
		#menuImage6 {
			border: 0px #000000 solid;
			padding: 0px 0px 0px 0px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
		}
		
		#menuImage7 {
			border: 0px #000000 solid;
			padding: 0px 0px 0px 0px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
		}
		
		#wb_menuText7 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_menuText7 div {
			text-align: left;
		}
		
		#wb_menuText8 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_menuText8 div {
			text-align: left;
		}
		
		#wb_menuText9 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_menuText9 div {
			text-align: left;
		}
		
		#wb_menuText10 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_menuText10 div {
			text-align: left;
		}
		
		#menuImage8 {
			border: 0px #000000 solid;
			padding: 0px 0px 0px 0px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
		}
		
		#page1Layer2 {
			background-color: #FFFFFF;
			background-image: none;
		}
		
		#wb_page1LayoutGrid1 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: #9FB6C0;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#page1LayoutGrid1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#page1LayoutGrid1 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#page1LayoutGrid1 .row .col-1,
		#page1LayoutGrid1 .row .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#page1LayoutGrid1 .row .col-1,
		#page1LayoutGrid1 .row .col-2 {
			float: left;
		}
		
		#page1LayoutGrid1 .row .col-1 {
			background-color: transparent;
			background-image: none;
			width: 75%;
			text-align: center;
		}
		
		#page1LayoutGrid1 .row .col-2 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: center;
		}
		
		#page1LayoutGrid1:before,
		#page1LayoutGrid1:after,
		#page1LayoutGrid1 .row:before,
		#page1LayoutGrid1 .row:after {
			display: table;
			content: " ";
		}
		
		#page1LayoutGrid1:after,
		#page1LayoutGrid1 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#page1LayoutGrid1 .row .col-1,
			#page1LayoutGrid1 .row .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_menuText4 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 20px 0px 20px 0px;
			margin: 0;
			text-align: center;
		}
		
		#wb_menuText4 div {
			text-align: center;
		}
		
		#wb_FontAwesomeIcon5 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			margin: 0px 10px 0px 0px;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon5:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon5 {
			height: 19px;
			width: 22px;
		}
		
		#FontAwesomeIcon5 i {
			color: #FFFFFF;
			display: inline-block;
			font-size: 19px;
			line-height: 19px;
			vertical-align: middle;
			width: 11px;
		}
		
		#wb_FontAwesomeIcon5:hover i {
			color: #FFFF00;
		}
		
		#wb_FontAwesomeIcon6 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			margin: 0px 10px 0px 0px;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon6:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon6 {
			height: 22px;
			width: 22px;
		}
		
		#FontAwesomeIcon6 i {
			color: #FFFFFF;
			display: inline-block;
			font-size: 22px;
			line-height: 22px;
			vertical-align: middle;
			width: 21px;
		}
		
		#wb_FontAwesomeIcon6:hover i {
			color: #FFFF00;
		}
		
		#wb_FontAwesomeIcon9 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			margin: 0px 10px 0px 0px;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon9:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon9 {
			height: 22px;
			width: 22px;
		}
		
		#FontAwesomeIcon9 i {
			color: #FFFFFF;
			display: inline-block;
			font-size: 22px;
			line-height: 22px;
			vertical-align: middle;
			width: 23px;
		}
		
		#wb_FontAwesomeIcon9:hover i {
			color: #FFFF00;
		}
		
		#page1Line1 {
			color: #9FB6C0;
			background-color: #9FB6C0;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#page1Line2 {
			color: #9FB6C0;
			background-color: #9FB6C0;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#page1Line2 {
			display: block;
			width: 100%;
			height: 27px;
			z-index: 34;
		}
		
		#wb_menuImage7 {
			position: absolute;
			left: 1507px;
			top: 15px;
			width: 265px;
			height: 185px;
			z-index: 18;
		}
		
		#wb_menuImage8 {
			position: absolute;
			left: 1041px;
			top: 15px;
			width: 265px;
			height: 185px;
			z-index: 17;
		}
		
		#wb_FontAwesomeIcon3 {
			position: absolute;
			left: 10px;
			top: 16px;
			width: 43px;
			height: 39px;
			text-align: center;
			z-index: 3;
		}
		
		#Line9 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 4;
		}
		
		#wb_FontAwesomeIcon5 {
			display: inline-block;
			width: 22px;
			height: 19px;
			text-align: center;
			z-index: 31;
		}
		
		#wb_FontAwesomeIcon6 {
			display: inline-block;
			width: 22px;
			height: 22px;
			text-align: center;
			z-index: 32;
		}
		
		#Layer2 {
			position: absolute;
			text-align: left;
			left: 28px;
			top: 859px;
			width: 62px;
			height: 71px;
			z-index: 42;
		}
		
		#wb_Image3 {
			display: inline-block;
			width: 142px;
			height: 118px;
			z-index: 0;
		}
		
		#wb_Image4 {
			display: inline-block;
			width: 743px;
			height: 147px;
			z-index: 1;
		}
		
		#wb_FontAwesomeIcon9 {
			display: inline-block;
			width: 22px;
			height: 22px;
			text-align: center;
			z-index: 33;
		}
		
		#menuCarousel2 {
			position: absolute;
		}
		
		#page1Layer1 {
			position: relative;
			text-align: center;
			width: 100%;
			height: 100%;
			float: left;
			display: block;
			z-index: 43;
		}
		
		#page1Layer2 {
			position: relative;
			text-align: center;
			width: 100%;
			height: 160px;
			float: left;
			clear: left;
			display: block;
			z-index: 44;
		}
		
		#wb_menuCarousel2 {
			position: absolute;
			left: 252px;
			top: 12px;
			width: 466px;
			height: 262px;
			z-index: 20;
			overflow: hidden;
		}
		
		#wb_menuText7 {
			position: absolute;
			left: 149px;
			top: 212px;
			width: 210px;
			height: 16px;
			z-index: 13;
		}
		
		#wb_menuFontAwesomeIcon1 {
			display: inline-block;
			width: 36px;
			height: 34px;
			text-align: center;
			z-index: 10;
		}
		
		#menuCarousel2_next {
			position: absolute;
			right: 4px;
			top: 44%;
			width: 30px;
			height: 30px;
			z-index: 999;
		}
		
		#wb_menuText8 {
			position: absolute;
			left: 615px;
			top: 212px;
			width: 202px;
			height: 16px;
			z-index: 15;
		}
		
		#wb_menuFontAwesomeIcon2 {
			display: inline-block;
			width: 36px;
			height: 34px;
			text-align: center;
			z-index: 6;
		}
		
		#wb_menuText9 {
			position: absolute;
			left: 1081px;
			top: 212px;
			width: 194px;
			height: 16px;
			z-index: 16;
		}
		
		#page1Layer1_Container {
			width: 970px;
			height: 620px;
			position: relative;
			margin-left: auto;
			margin-right: auto;
			margin-top: auto;
			margin-bottom: auto;
			text-align: left;
		}
		
		#wb_menuFontAwesomeIcon3 {
			display: inline-block;
			width: 36px;
			height: 34px;
			text-align: center;
			z-index: 8;
		}
		
		#wb_ResponsiveMenu1 {
			display: inline-block;
			width: 100%;
			z-index: 2;
		}
		
		#wb_menuImage5 {
			position: absolute;
			left: 101px;
			top: 15px;
			width: 265px;
			height: 185px;
			z-index: 12;
		}
		
		#page1Line1 {
			display: block;
			width: 100%;
			height: 24px;
			z-index: 30;
		}
		
		#menuCarousel2_back {
			position: absolute;
			left: 4px;
			top: 44%;
			width: 30px;
			height: 30px;
			z-index: 999;
		}
		
		#wb_menuText10 {
			position: absolute;
			left: 1547px;
			top: 212px;
			width: 210px;
			height: 16px;
			z-index: 19;
		}
		
		#wb_menuImage6 {
			position: absolute;
			left: 575px;
			top: 15px;
			width: 265px;
			height: 185px;
			z-index: 14;
		}
		
		@media only screen and (min-width: 1024px) {
			div#container {
				width: 1024px;
			}
			#wb_ResponsiveMenu1 {
				visibility: visible;
				display: block;
			}
			#wb_LayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid1 {
				padding: 10px 15px 0px 15px;
			}
			#LayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid1 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_LayoutGrid2 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Image3 {
				width: 171px;
				height: 142px;
				visibility: visible;
				display: inline-block;
			}
			#Image3 {
				width: 171px;
				height: 142px;
			}
			#wb_Image4 {
				width: 743px;
				height: 147px;
				visibility: visible;
				display: inline-block;
			}
			#Image4 {
				width: 743px;
				height: 147px;
			}
			#wb_FontAwesomeIcon2 {
				left: 283px;
				top: 96px;
				width: 66px;
				height: 32px;
				visibility: visible;
				display: inline;
				color: #265A88;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon2 {
				width: 66px;
				height: 32px;
			}
			#FontAwesomeIcon2 i {
				line-height: 32px;
				font-size: 32px;
			}
			#Layer2 {
				width: 54px;
				height: 52px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_FontAwesomeIcon3 {
				left: 3px;
				top: 6px;
				width: 49px;
				height: 36px;
				visibility: visible;
				display: inline;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon3 {
				width: 49px;
				height: 36px;
			}
			#FontAwesomeIcon3 i {
				line-height: 36px;
				font-size: 36px;
				width: 36px;
			}
			#wb_LayoutGrid3 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid3 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text1 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #F5F5F5;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#menuLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#menuLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#menuLayoutGrid1 .col-1,
			#menuLayoutGrid1 .col-2,
			#menuLayoutGrid1 .col-3,
			#menuLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#menuLayoutGrid1 .col-1 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#menuLayoutGrid1 .col-2 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#menuLayoutGrid1 .col-3 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#menuLayoutGrid1 .col-4 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#wb_menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon1 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon2 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon3 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuText1 {
				visibility: visible;
				display: block;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText2 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText3 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#page1Layer1 {
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#page1Layer1 {
				margin: 0px 0px 0px 0px;
			}
			#page1Layer1_Container {
				width: 1024px;
				height: 595px;
			}
			#wb_menuCarousel2 {
				left: 303px;
				top: 12px;
				width: 466px;
				height: 262px;
				visibility: visible;
				display: inline;
			}
			#menuCarousel2 .frame {
				width: 466px;
				height: 262px;
			}
			#wb_menuImage5 {
				left: 101px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage6 {
				left: 575px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage7 {
				left: 1507px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuText7 {
				left: 149px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText8 {
				left: 615px;
				top: 212px;
				width: 202px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText9 {
				left: 1081px;
				top: 212px;
				width: 194px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText10 {
				left: 1547px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuImage8 {
				left: 1041px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
		}
		
		@media only screen and (min-width: 980px) and (max-width: 1023px) {
			div#container {
				width: 980px;
			}
			#wb_ResponsiveMenu1 {
				visibility: visible;
				display: block;
			}
			#wb_LayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid1 {
				padding: 10px 15px 0px 15px;
			}
			#LayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid1 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_LayoutGrid2 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Image3 {
				width: 178px;
				height: 148px;
				visibility: visible;
				display: inline-block;
			}
			#Image3 {
				width: 178px;
				height: 148px;
			}
			#wb_Image4 {
				width: 743px;
				height: 147px;
				visibility: visible;
				display: inline-block;
			}
			#Image4 {
				width: 743px;
				height: 147px;
			}
			#wb_FontAwesomeIcon2 {
				left: 283px;
				top: 100px;
				width: 66px;
				height: 32px;
				visibility: visible;
				display: inline;
				color: #265A88;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon2 {
				width: 66px;
				height: 32px;
			}
			#FontAwesomeIcon2 i {
				line-height: 32px;
				font-size: 32px;
			}
			#Layer2 {
				width: 54px;
				height: 52px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_FontAwesomeIcon3 {
				left: 3px;
				top: 0px;
				width: 49px;
				height: 36px;
				visibility: visible;
				display: inline;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon3 {
				width: 49px;
				height: 36px;
			}
			#FontAwesomeIcon3 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_LayoutGrid3 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid3 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text1 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #F5F5F5;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#menuLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#menuLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#menuLayoutGrid1 .col-1,
			#menuLayoutGrid1 .col-2,
			#menuLayoutGrid1 .col-3,
			#menuLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#menuLayoutGrid1 .col-1 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#menuLayoutGrid1 .col-2 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#menuLayoutGrid1 .col-3 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#menuLayoutGrid1 .col-4 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#wb_menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon1 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon2 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon3 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuText1 {
				visibility: visible;
				display: block;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText2 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText3 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#page1Layer1 {
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#page1Layer1 {
				margin: 0px 0px 0px 0px;
			}
			#page1Layer1_Container {
				width: 980px;
				height: 597px;
			}
			#wb_menuCarousel2 {
				left: 303px;
				top: 16px;
				width: 466px;
				height: 262px;
				visibility: visible;
				display: inline;
			}
			#menuCarousel2 .frame {
				width: 466px;
				height: 262px;
			}
			#wb_menuImage5 {
				left: 101px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage6 {
				left: 575px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage7 {
				left: 1507px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuText7 {
				left: 149px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText8 {
				left: 615px;
				top: 212px;
				width: 202px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText9 {
				left: 1081px;
				top: 212px;
				width: 194px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText10 {
				left: 1547px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuImage8 {
				left: 1041px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
		}
		
		@media only screen and (min-width: 800px) and (max-width: 979px) {
			div#container {
				width: 800px;
			}
			#wb_ResponsiveMenu1 {
				visibility: visible;
				display: block;
			}
			#wb_LayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid1 {
				padding: 10px 15px 0px 15px;
			}
			#LayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid1 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_LayoutGrid2 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Image3 {
				width: 142px;
				height: 118px;
				visibility: visible;
				display: inline-block;
			}
			#Image3 {
				width: 142px;
				height: 118px;
			}
			#wb_Image4 {
				width: 590px;
				height: 116px;
				visibility: visible;
				display: inline-block;
			}
			#Image4 {
				width: 590px;
				height: 116px;
			}
			#wb_FontAwesomeIcon2 {
				left: 283px;
				top: 133px;
				width: 66px;
				height: 32px;
				visibility: visible;
				display: inline;
				color: #265A88;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon2 {
				width: 66px;
				height: 32px;
			}
			#FontAwesomeIcon2 i {
				line-height: 32px;
				font-size: 32px;
			}
			#Layer2 {
				width: 54px;
				height: 52px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_FontAwesomeIcon3 {
				left: 3px;
				top: 6px;
				width: 49px;
				height: 36px;
				visibility: visible;
				display: inline;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon3 {
				width: 49px;
				height: 36px;
			}
			#FontAwesomeIcon3 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_LayoutGrid3 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid3 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text1 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #F5F5F5;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#menuLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#menuLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#menuLayoutGrid1 .col-1,
			#menuLayoutGrid1 .col-2,
			#menuLayoutGrid1 .col-3,
			#menuLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#menuLayoutGrid1 .col-1 {
				display: block;
				width: 25%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-2 {
				display: block;
				width: 25%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-3 {
				display: block;
				width: 25%;
				text-align: center;
			}
			#menuLayoutGrid1 .col-4 {
				display: block;
				width: 25%;
				text-align: left;
			}
			#wb_menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon1 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon2 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon3 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuText1 {
				visibility: visible;
				display: block;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText2 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText3 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#page1Layer1 {
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#page1Layer1 {
				margin: 0px 0px 0px 0px;
			}
			#page1Layer1_Container {
				width: 800px;
				height: 591px;
			}
			#wb_menuCarousel2 {
				left: 185px;
				top: 12px;
				width: 466px;
				height: 262px;
				visibility: visible;
				display: inline;
			}
			#menuCarousel2 .frame {
				width: 466px;
				height: 262px;
			}
			#wb_menuImage5 {
				left: 101px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage6 {
				left: 575px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage7 {
				left: 1507px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuText7 {
				left: 149px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText8 {
				left: 615px;
				top: 212px;
				width: 202px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText9 {
				left: 1081px;
				top: 212px;
				width: 194px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText10 {
				left: 1547px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuImage8 {
				left: 1041px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
		}
		
		@media only screen and (min-width: 768px) and (max-width: 799px) {
			div#container {
				width: 768px;
			}
			#wb_ResponsiveMenu1 {
				visibility: visible;
				display: block;
			}
			#wb_LayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid1 {
				padding: 10px 15px 0px 15px;
			}
			#LayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid1 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_LayoutGrid2 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Image3 {
				width: 105px;
				height: 87px;
				visibility: visible;
				display: inline-block;
			}
			#Image3 {
				width: 105px;
				height: 87px;
			}
			#wb_Image4 {
				width: 561px;
				height: 110px;
				visibility: visible;
				display: inline-block;
			}
			#Image4 {
				width: 561px;
				height: 110px;
			}
			#wb_FontAwesomeIcon2 {
				left: 283px;
				top: 145px;
				width: 66px;
				height: 32px;
				visibility: visible;
				display: inline;
				color: #265A88;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon2 {
				width: 66px;
				height: 32px;
			}
			#FontAwesomeIcon2 i {
				line-height: 32px;
				font-size: 32px;
			}
			#Layer2 {
				width: 54px;
				height: 52px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_FontAwesomeIcon3 {
				left: 3px;
				top: 6px;
				width: 49px;
				height: 36px;
				visibility: visible;
				display: inline;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon3 {
				width: 49px;
				height: 36px;
			}
			#FontAwesomeIcon3 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_LayoutGrid3 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid3 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text1 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #F5F5F5;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#menuLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#menuLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#menuLayoutGrid1 .col-1,
			#menuLayoutGrid1 .col-2,
			#menuLayoutGrid1 .col-3,
			#menuLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#menuLayoutGrid1 .col-1 {
				display: block;
				width: 25%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-2 {
				display: block;
				width: 25%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-3 {
				display: block;
				width: 25%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-4 {
				display: block;
				width: 25%;
				text-align: left;
			}
			#wb_menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon1 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon2 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon3 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuText1 {
				visibility: visible;
				display: block;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText2 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText3 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#page1Layer1 {
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#page1Layer1 {
				margin: 0px 0px 0px 0px;
			}
			#page1Layer1_Container {
				width: 768px;
				height: 592px;
			}
			#wb_menuCarousel2 {
				left: 159px;
				top: 12px;
				width: 466px;
				height: 262px;
				visibility: visible;
				display: inline;
			}
			#menuCarousel2 .frame {
				width: 466px;
				height: 262px;
			}
			#wb_menuImage5 {
				left: 101px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage6 {
				left: 575px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage7 {
				left: 1507px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuText7 {
				left: 149px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText8 {
				left: 615px;
				top: 212px;
				width: 202px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText9 {
				left: 1081px;
				top: 212px;
				width: 194px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText10 {
				left: 1547px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuImage8 {
				left: 1041px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
		}
		
		@media only screen and (min-width: 480px) and (max-width: 767px) {
			div#container {
				width: 480px;
			}
			#wb_ResponsiveMenu1 {
				visibility: visible;
				display: block;
			}
			#wb_LayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid1 {
				padding: 10px 15px 0px 15px;
			}
			#LayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid1 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_LayoutGrid2 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Image3 {
				width: 76px;
				height: 63px;
				visibility: visible;
				display: inline-block;
			}
			#Image3 {
				width: 76px;
				height: 63px;
			}
			#wb_Image4 {
				width: 374px;
				height: 73px;
				visibility: visible;
				display: inline-block;
			}
			#Image4 {
				width: 374px;
				height: 73px;
			}
			#wb_FontAwesomeIcon2 {
				left: 283px;
				top: -105px;
				width: 66px;
				height: 32px;
				visibility: visible;
				display: inline;
				color: #265A88;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon2 {
				width: 66px;
				height: 32px;
			}
			#FontAwesomeIcon2 i {
				line-height: 32px;
				font-size: 32px;
			}
			#Layer2 {
				width: 54px;
				height: 52px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_FontAwesomeIcon3 {
				left: 3px;
				top: 6px;
				width: 49px;
				height: 36px;
				visibility: visible;
				display: inline;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon3 {
				width: 49px;
				height: 36px;
			}
			#FontAwesomeIcon3 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_LayoutGrid3 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid3 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text1 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #F5F5F5;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#menuLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#menuLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#menuLayoutGrid1 .col-1,
			#menuLayoutGrid1 .col-2,
			#menuLayoutGrid1 .col-3,
			#menuLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#menuLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon1 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon2 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon3 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuText1 {
				visibility: visible;
				display: block;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText2 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText3 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#page1Layer1 {
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#page1Layer1 {
				margin: 0px 0px 0px 0px;
			}
			#page1Layer1_Container {
				width: 480px;
				height: 592px;
			}
			#wb_menuCarousel2 {
				left: 7px;
				top: 12px;
				width: 466px;
				height: 262px;
				visibility: visible;
				display: inline;
			}
			#menuCarousel2 .frame {
				width: 466px;
				height: 262px;
			}
			#wb_menuImage5 {
				left: 101px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage6 {
				left: 575px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage7 {
				left: 1507px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuText7 {
				left: 149px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText8 {
				left: 615px;
				top: 212px;
				width: 202px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText9 {
				left: 1081px;
				top: 212px;
				width: 194px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText10 {
				left: 1547px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuImage8 {
				left: 1041px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
		}
		
		@media only screen and (max-width: 479px) {
			div#container {
				width: 320px;
			}
			#wb_ResponsiveMenu1 {
				visibility: visible;
				display: block;
			}
			#wb_LayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid1 {
				padding: 10px 15px 0px 15px;
			}
			#LayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid1 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_LayoutGrid2 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Image3 {
				width: 47px;
				height: 39px;
				visibility: visible;
				display: inline-block;
			}
			#Image3 {
				width: 47px;
				height: 39px;
			}
			#wb_Image4 {
				width: 222px;
				height: 43px;
				visibility: visible;
				display: inline-block;
			}
			#Image4 {
				width: 222px;
				height: 43px;
			}
			#wb_FontAwesomeIcon2 {
				left: 283px;
				top: -59px;
				width: 66px;
				height: 32px;
				visibility: visible;
				display: inline;
				color: #265A88;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon2 {
				width: 66px;
				height: 32px;
			}
			#FontAwesomeIcon2 i {
				line-height: 32px;
				font-size: 32px;
			}
			#Layer2 {
				width: 54px;
				height: 52px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_FontAwesomeIcon3 {
				left: 3px;
				top: 6px;
				width: 49px;
				height: 36px;
				visibility: visible;
				display: inline;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon3 {
				width: 49px;
				height: 36px;
			}
			#FontAwesomeIcon3 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_LayoutGrid3 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_LayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid3 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text1 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #F5F5F5;
				background-image: none;
			}
			#wb_menuLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#menuLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#menuLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#menuLayoutGrid1 .col-1,
			#menuLayoutGrid1 .col-2,
			#menuLayoutGrid1 .col-3,
			#menuLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#menuLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#menuLayoutGrid1 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon1 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon1 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon2 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon2 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #DC143C;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#menuFontAwesomeIcon3 {
				width: 36px;
				height: 34px;
			}
			#menuFontAwesomeIcon3 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_menuText1 {
				visibility: visible;
				display: block;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText2 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText3 {
				visibility: visible;
				display: block;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#page1Layer1 {
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#page1Layer1 {
				margin: 0px 0px 0px 0px;
			}
			#page1Layer1_Container {
				width: 320px;
				height: 597px;
			}
			#wb_menuCarousel2 {
				left: 6px;
				top: 22px;
				width: 295px;
				height: 254px;
				visibility: visible;
				display: inline;
			}
			#menuCarousel2 .frame {
				width: 295px;
				height: 254px;
			}
			#wb_menuImage5 {
				left: 101px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage6 {
				left: 404px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuImage7 {
				left: 900px;
				top: 17px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
			#wb_menuText7 {
				left: 149px;
				top: 212px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText8 {
				left: 444px;
				top: 212px;
				width: 202px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText9 {
				left: 739px;
				top: 212px;
				width: 194px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuText10 {
				left: 927px;
				top: 210px;
				width: 210px;
				height: 16px;
				visibility: visible;
				display: inline;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_menuImage8 {
				left: 699px;
				top: 15px;
				width: 265px;
				height: 185px;
				visibility: visible;
				display: inline;
			}
		}
		
		#wb_turnos_detallesLayoutGrid1 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: transparent;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#turnos_detallesLayoutGrid1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#turnos_detallesLayoutGrid1 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#turnos_detallesLayoutGrid1 .col-1,
		#turnos_detallesLayoutGrid1 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#turnos_detallesLayoutGrid1 .col-1,
		#turnos_detallesLayoutGrid1 .col-2 {
			float: right;
		}
		
		#turnos_detallesLayoutGrid1 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid1 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid1:before,
		#turnos_detallesLayoutGrid1:after,
		#turnos_detallesLayoutGrid1 .row:before,
		#turnos_detallesLayoutGrid1 .row:after {
			display: table;
			content: " ";
		}
		
		#turnos_detallesLayoutGrid1:after,
		#turnos_detallesLayoutGrid1 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#turnos_detallesLayoutGrid1 .col-1,
			#turnos_detallesLayoutGrid1 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_turnos_detallesLayoutGrid2 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: transparent;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#turnos_detallesLayoutGrid2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#turnos_detallesLayoutGrid2 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#turnos_detallesLayoutGrid2 .col-1,
		#turnos_detallesLayoutGrid2 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#turnos_detallesLayoutGrid2 .col-1 {
			float: right;
		}
		
		#turnos_detallesLayoutGrid2 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid2 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid2:before,
		#turnos_detallesLayoutGrid2:after,
		#turnos_detallesLayoutGrid2 .row:before,
		#turnos_detallesLayoutGrid2 .row:after {
			display: table;
			content: " ";
		}
		
		#turnos_detallesLayoutGrid2:after,
		#turnos_detallesLayoutGrid2 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#turnos_detallesLayoutGrid2 .col-1,
			#turnos_detallesLayoutGrid2 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_turnos_detallesText2 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_turnos_detallesText2 div {
			text-align: left;
		}
		
		#turnos_detallesLine4 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine5 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine5 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 25;
		}
		
		#turnos_detallesLine6 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesTable1 {
			border: 1px #C0C0C0 solid;
			background-color: transparent;
			background-image: none;
			border-collapse: separate;
			border-spacing: 0px;
		}
		
		#turnos_detallesTable1 td {
			padding: 0px 0px 0px 0px;
		}
		
		#turnos_detallesTable1 td div {
			white-space: nowrap;
		}
		
		#turnos_detallesTable1 .cell0 {
			background-color: #DCDCDC;
			background-image: none;
			border: 1px #C0C0C0 solid;
			text-align: center;
			vertical-align: top;
		}
		
		#turnos_detallesTable1 .cell1 {
			background-color: transparent;
			background-image: none;
			border: 1px #C0C0C0 solid;
			text-align: center;
			vertical-align: top;
		}
		
		#turnos_detallesTable1 .cell2 {
			background-color: transparent;
			background-image: none;
			border: 1px #C0C0C0 solid;
			text-align: center;
			vertical-align: middle;
		}
		
		#turnos_detallesTable1 .cell3 {
			background-color: #87CEEB;
			background-image: none;
			border: 1px #C0C0C0 solid;
			text-align: center;
			vertical-align: middle;
		}
		
		#turnos_detallesTable1 .cell4 {
			background-color: transparent;
			background-image: none;
			border: 1px #C0C0C0 solid;
			text-align: left;
			vertical-align: top;
		}
		
		#Table1 .cell0 {
			background-color: #4D4D4D;
			background-image: none;
			border: 1px #949494 solid;
			text-align: center;
			vertical-align: middle;
			font-family: Arial;
			font-size: 11px;
			line-height: 13px;
		}
		
		#Table1 .cell1 {
			background-color: #4D4D4D;
			background-image: none;
			border: 1px #949494 solid;
			text-align: center;
			vertical-align: top;
			font-family: Arial;
			font-size: 11px;
			line-height: 13px;
		}
		
		#Table1 .cell2 {
			background-color: #4D4D4D;
			background-image: none;
			border: 1px #949494 solid;
			text-align: center;
			vertical-align: top;
			font-family: Verdana;
			font-size: 11px;
			line-height: 12px;
		}
		
		#Table1 .cell3 {
			background-color: #4D4D4D;
			background-image: none;
			border: 1px #949494 solid;
			text-align: left;
			vertical-align: middle;
		}
		
		#Table1 .cell4 {
			background-color: #4D4D4D;
			background-image: none;
			border: 1px #949494 solid;
			text-align: left;
			vertical-align: top;
			font-size: 0;
		}
		
		#Table1 .cell5 {
			background-color: transparent;
			background-image: none;
			border: 1px #949494 solid;
			text-align: center;
			vertical-align: middle;
			font-size: 0;
		}
		
		#Table1 .cell6 {
			background-color: transparent;
			background-image: none;
			border: 1px #949494 solid;
			text-align: left;
			vertical-align: middle;
			font-family: Arial;
			font-size: 13px;
			line-height: 16px;
		}
		
		#wb_Text4 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_Text4 div {
			text-align: left;
		}
		
		#mes {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 4px 4px 4px 4px;
			text-align: left;
			vertical-align: middle;
		}
		
		#mes:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#mes {
			display: block;
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 35;
		}
		
		#mes {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FFFFFF;
			background-image: none;
			border-radius: 4px;
		}
		
		#wb_courier_detallesText2 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_courier_detallesText2 div {
			text-align: left;
		}
		
		#fecha {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 4px 4px 4px 4px;
			text-align: left;
			vertical-align: middle;
		}
		
		#fecha:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#fecha {
			display: block;
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}
		
		#fecha {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FFFFFF;
			background-image: none;
			border-radius: 4px;
		}
		
		#lote {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 4px 4px 4px 4px;
			text-align: left;
			vertical-align: middle;
		}
		
		#lote:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#lote {
			display: block;
			width: 40%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}
		
		#lote {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FFFFFF;
			background-image: none;
			border-radius: 4px;
		}
		
		#anio {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 4px 4px 4px 4px;
			text-align: left;
			vertical-align: middle;
		}
		
		#anio:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#anio {
			display: block;
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}
		
		#anio {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FFFFFF;
			background-image: none;
			border-radius: 4px;
		}
		
		#nroeval {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color: #000000;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 4px 4px 4px 4px;
			text-align: left;
			vertical-align: middle;
		}
		
		#nroeval:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#nroeval {
			display: block;
			width: 30%;
			height: 31px;
			line-height: 31px;
			z-index: 8;
		}
		
		#nroeval {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-image: none;
			border-radius: 4px;
		}
		
		#pacientes_detallesButton1 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #FF4500;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#pacientes_detallesButton1 {
			display: inline-block;
			width: 184px;
			height: 25px;
			z-index: 93;
		}
		
		#pacientes_detallesButton1 {
			width: 184px;
			height: 25px;
			visibility: visible;
			display: inline-block;
			color: #FFFFFF;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FF4500;
			background-image: none;
			border-radius: 4px;
		}
		
		#wb_turnos_detallesLayoutGrid4 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: transparent;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#turnos_detallesLayoutGrid4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#turnos_detallesLayoutGrid4 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#turnos_detallesLayoutGrid4 .col-1,
		#turnos_detallesLayoutGrid4 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#turnos_detallesLayoutGrid4 .col-1,
		#turnos_detallesLayoutGrid4 .col-2 {
			float: left;
		}
		
		#turnos_detallesLayoutGrid4 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid4 .col-2 {
			background-color: transparent;
			background-image: none;
			display: none;
			width: 0;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid4:before,
		#turnos_detallesLayoutGrid4:after,
		#turnos_detallesLayoutGrid4 .row:before,
		#turnos_detallesLayoutGrid4 .row:after {
			display: table;
			content: " ";
		}
		
		#turnos_detallesLayoutGrid4:after,
		#turnos_detallesLayoutGrid4 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#turnos_detallesLayoutGrid4 .col-1,
			#turnos_detallesLayoutGrid4 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_turnos_detallesLayoutGrid4 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_turnos_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid4 .col-1,
			#turnos_detallesLayoutGrid4 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
		
		#wb_turnos_detallesLayoutGrid4 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_turnos_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid4 .col-1,
			#turnos_detallesLayoutGrid4 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid4 .col-2 {
				display: none;
				text-align: left;
			}
		
		#wb_turnos_detallesLayoutGrid4 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_turnos_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid4 .col-1,
			#turnos_detallesLayoutGrid4 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid4 .col-2 {
				display: none;
				text-align: left;
			}
		
		#wb_turnos_detallesLayoutGrid4 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_turnos_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid4 .col-1,
			#turnos_detallesLayoutGrid4 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid4 .col-2 {
				display: none;
				text-align: left;
			}
		
		#wb_turnos_detallesLayoutGrid4 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_turnos_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid4 .col-1,
			#turnos_detallesLayoutGrid4 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
		
		#wb_turnos_detallesLayoutGrid4 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_turnos_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid4 .col-1,
			#turnos_detallesLayoutGrid4 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
		
		#turnos_detallesLine11 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine11 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 108;
		}
		
		#turnos_detallesLine11 {
				height: 11px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
		
		#turnos_detallesLine12 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine12 {
			display: block;
			width: 100%;
			height: 61px;
			z-index: 110;
		}
		
		#turnos_detallesLine12 {
				height: 61px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
		
		#wb_sintomas_detallesLayoutGrid1 {
			clear: both;
			position: relative;
			table-layout: fixed;
			display: table;
			text-align: center;
			width: 100%;
			background-color: transparent;
			background-image: none;
			border: 0px #CCCCCC solid;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			margin-right: auto;
			margin-left: auto;
			max-width: 1024px;
		}
		
		#sintomas_detallesLayoutGrid1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#sintomas_detallesLayoutGrid1 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#sintomas_detallesLayoutGrid1 .col-1,
		#sintomas_detallesLayoutGrid1 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#sintomas_detallesLayoutGrid1 .col-1,
		#sintomas_detallesLayoutGrid1 .col-2 {
			float: left;
		}
		
		#sintomas_detallesLayoutGrid1 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: left;
		}
		
		#sintomas_detallesLayoutGrid1 .col-2 {
			background-color: transparent;
			background-image: none;
			display: none;
			width: 0;
			text-align: left;
		}
		
		#sintomas_detallesLayoutGrid1:before,
		#sintomas_detallesLayoutGrid1:after,
		#sintomas_detallesLayoutGrid1 .row:before,
		#sintomas_detallesLayoutGrid1 .row:after {
			display: table;
			content: " ";
		}
		
		#sintomas_detallesLayoutGrid1:after,
		#sintomas_detallesLayoutGrid1 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#sintomas_detallesLayoutGrid1 .col-1,
			#sintomas_detallesLayoutGrid1 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_sintomas_detallesLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_sintomas_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#sintomas_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#sintomas_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1,
			#sintomas_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#sintomas_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
		
		#wb_sintomas_detallesLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_sintomas_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#sintomas_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#sintomas_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1,
			#sintomas_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#sintomas_detallesLayoutGrid1 .col-2 {
				display: none;
				text-align: left;
			}
		
		#wb_sintomas_detallesLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_sintomas_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#sintomas_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#sintomas_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1,
			#sintomas_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#sintomas_detallesLayoutGrid1 .col-2 {
				display: none;
				text-align: left;
			}
		
		#wb_sintomas_detallesLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_sintomas_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#sintomas_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#sintomas_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1,
			#sintomas_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#sintomas_detallesLayoutGrid1 .col-2 {
				display: none;
				text-align: left;
			}
		
		#wb_sintomas_detallesLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_sintomas_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#sintomas_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#sintomas_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1,
			#sintomas_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#sintomas_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
		
		#wb_sintomas_detallesLayoutGrid1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#wb_sintomas_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#sintomas_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#sintomas_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1,
			#sintomas_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#sintomas_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#sintomas_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
		
			#sintomas_detallesLine1 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#sintomas_detallesLine1 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 111;
		}
		
		#sintomas_detallesLine1 {
				height: 11px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
		
		#sintomas_detallesLine2 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#sintomas_detallesLine2 {
			display: block;
			width: 100%;
			height: 16px;
			z-index: 113;
		}
		
		#sintomas_detallesLine2 {
				height: 16px;
				visibility: visible;
				display: block;
				color: #A0A0A0;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
		
		#wb_respuesta_clinica_detallesLayoutGrid1
		{
		   clear: both;
		   position: relative;
		   table-layout: fixed;
		   display: table;
		   text-align: center;
		   width: 100%;
		   background-color: transparent;
		   background-image: none;
		   border: 0px #CCCCCC solid;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   margin-right: auto;
		   margin-left: auto;
		   max-width: 1024px;
		}
		#respuesta_clinica_detallesLayoutGrid1
		{
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 0px 15px 0px 15px;
		   margin-right: auto;
		   margin-left: auto;
		}
		#respuesta_clinica_detallesLayoutGrid1 .row
		{
		   margin-right: -15px;
		   margin-left: -15px;
		}
		#respuesta_clinica_detallesLayoutGrid1 .col-1
		{
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   font-size: 0px;
		   min-height: 1px;
		   padding-right: 15px;
		   padding-left: 15px;
		   position: relative;
		}
		#respuesta_clinica_detallesLayoutGrid1 .col-1
		{
		   float: left;
		}
		#respuesta_clinica_detallesLayoutGrid1 .col-1
		{
		   background-color: transparent;
		   background-image: none;
		   width: 100%;
		   text-align: center;
		}
		#respuesta_clinica_detallesLayoutGrid1:before,
		#respuesta_clinica_detallesLayoutGrid1:after,
		#respuesta_clinica_detallesLayoutGrid1 .row:before,
		#respuesta_clinica_detallesLayoutGrid1 .row:after
		{
		   display: table;
		   content: " ";
		}
		#respuesta_clinica_detallesLayoutGrid1:after,
		#respuesta_clinica_detallesLayoutGrid1 .row:after
		{
		   clear: both;
		}
		@media (max-width: 480px)
		{
		#respuesta_clinica_detallesLayoutGrid1 .col-1
		{
		   float: none;
		   width: 100%;
		}
		}
		
		#respuesta_clinica_detallesTable1
		{
		   border: 1px #C0C0C0 solid;
		   background-color: transparent;
		   background-image: none;
		   border-collapse: separate;
		   border-spacing: 0px;
		}
		#respuesta_clinica_detallesTable1 td
		{
		   padding: 0px 0px 0px 0px;
		}
		#respuesta_clinica_detallesTable1 .cell0
		{
		   background-color: #DCDCDC;
		   background-image: none;
		   border: 1px #C0C0C0 solid;
		   text-align: center;
		   vertical-align: middle;
		   font-family: Arial;
		   font-size: 9.3px;
		   line-height: 12px;
		}
		#respuesta_clinica_detallesTable1 .cell1
		{
		   background-color: transparent;
		   background-image: none;
		   border: 1px #C0C0C0 solid;
		   text-align: left;
		   vertical-align: top;
		   font-family: Arial;
		   font-size: 9.3px;
		   line-height: 12px;
		}
		#respuesta_clinica_detallesTable1 .cell2
		{
		   background-color: transparent;
		   background-image: none;
		   border: 1px #C0C0C0 solid;
		   text-align: left;
		   vertical-align: top;
		   font-size: 0;
		}
		#respuesta_clinica_detallesTable1 .cell3
		{
		   background-color: transparent;
		   background-image: none;
		   border: 1px #C0C0C0 solid;
		   text-align: left;
		   vertical-align: top;
		   font-family: Arial;
		   font-size: 13px;
		   line-height: 16px;
		}
		#respuesta_clinica_detallesTable1 .cell4
		{
		   background-color: transparent;
		   background-image: none;
		   border: 1px #C0C0C0 solid;
		   text-align: left;
		   vertical-align: top;
		}
		
		#resulprevisto1
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto1:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto1
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto2
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto2:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto2
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto3
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto3:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto3
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto4
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto4:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto4
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto5
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto5:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto5
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto6
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto6:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto6
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto7
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto7:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto7
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto8
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto8:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto8
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#resulprevisto9
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#resulprevisto9:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#resulprevisto9
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		
		#muestra1
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#muestra1:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#muestra1
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#muestra2
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#muestra2:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#muestra2
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#muestra3
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#muestra3:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#muestra3
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#muestra4
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#muestra4:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#muestra4
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#muestra5
		{
		   border: 1px #CCCCCC solid;
		   border-radius: 4px;
		   background-color: #FFFFFF;
		   background-image: none;
		   color :#000000;
		   font-family: Arial;
		   font-weight: normal;
		   font-size: 9.3px;
		   -webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
		   box-sizing: border-box;
		   padding: 4px 4px 4px 4px;
		   text-align: left;
		   vertical-align: middle;
		}
		#muestra5:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		#muestra5
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
	</style>
	
	<script src="wb.stickylayer.min.js"></script>
	<script src="wb.carousel.min.js"></script>

	<script>
		$( document ).ready( function () {
			$( "#Layer2" ).stickylayer( {
				orientation: 2,
				position: [ 45, 50 ],
				delay: 500
			} );
			var menuCarousel2Opts = {
				delay: 3000,
				duration: 500,
				easing: 'linear',
				mode: 'forward',
				direction: '',
				scalemode: 2,
				pagination: true,
				pagination_img_default: 'images/page_default.png',
				pagination_img_active: 'images/page_active.png',
				start: 1
			};
			$( "#menuCarousel2" ).carousel( menuCarousel2Opts );
			$( "#menuCarousel2_back a" ).click( function () {
				$( '#menuCarousel2' ).carousel( 'prev' );
			} );
			$( "#menuCarousel2_next a" ).click( function () {
				$( '#menuCarousel2' ).carousel( 'next' );
			} );
		} );
	</script>

	<style type="text/css">
		.glyphicon.glyphicon-edit,
		.glyphicon.glyphicon-trash {
			font-size: 20px;
		}
	</style>
</head>

<body onLoad="gridReload();">
	<div id="container">
	</div>
	<div id="wb_LayoutGrid1">
		<div id="LayoutGrid1">
			<div class="row">
				<div class="col-1">
					<div id="wb_Image3">
						<img src="images/logolcsp2.png" id="Image3" alt=""/>
					</div>
					<div id="wb_Image4">
						<img src="images/banner1lcsp.png" id="Image4" alt=""/>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="wb_LayoutGrid2">
		<div id="LayoutGrid2">
			<div class="row">
				<div class="col-1">

					<?php 
                
                require('menuprincipal.php');
                
                ?>

				</div>
			</div>
		</div>
	</div>

	<div id="Layer2">
		<div id="wb_FontAwesomeIcon3">
			<div id="FontAwesomeIcon3">
				<a href="menu.php">
					<div id="FontAwesomeIcon3"><i class="fa fa-commenting-o">&nbsp;</i>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div id="wb_LayoutGrid3">
		<div id="LayoutGrid3">
			<div class="row">
				<div class="col-1">
					<hr id="Line9"/>
					<div id="wb_Text1">
						<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br><br></strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>CONTROL DE CALIDAD - RESULTADOS PREVISTOS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong><br />
					</strong></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form name="formu" id="formu" method="post">
		<div id="wb_pacientesLayoutGrid1">
			<div id="pacientesLayoutGrid1">
				<div class="row">
					<div class="col-1">
					  <div id="wb_Text2">
						  <span style="color:#808080;font-family:Verdana;font-size:30px;"><strong>Nro. Evaluaci&oacute;n:  </strong></span>
						</div>
						<hr id="Line3">
					</div>

					<div class="col-2">
						<hr id="Line4">
						<input type="text" id="nroeval" name="nroeval" value="<?php echo $nroeval; ?>" spellcheck="false" readonly style="font-size: 30px; text-align: center;">
						<hr id="Line5">
					</div>

				</div>

				<div class="row">
					<div class="col-1">
						<hr id="Line2">
						<div id="wb_Text2">
							<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Tipo examen: </strong></span>
						</div>
						<hr id="Line3">
					</div>

					<div class="col-2">
						<hr id="Line4">
						<div class="selector-establecimiento">
							<select name="texamen" size="1" id="texamen" <?php if($texamen != ''){echo "disabled";}?> style="<?php if($texamen != ''){echo "background-color: #DCDCDC";}?>">
								<option value=""></option>
								<option value="1" <?php if($texamen == 1){ echo 'selected';}  ?> >BIOQUIMICA CLINICA</option>
								<option value="2" <?php if($texamen == 2){ echo 'selected';}  ?>>DENGUE</option>
								<option value="3" <?php if($texamen == 3){ echo 'selected';}  ?>>HEMATOLOGIA</option>
								<option value="4" <?php if($texamen == 4){ echo 'selected';}  ?>>INFLUENZA</option>
								<option value="5" <?php if($texamen == 5){ echo 'selected';}  ?>>PARASITOLOGIA INTESTINAL</option>
								<option value="6" <?php if($texamen == 6){ echo 'selected';}  ?>>ROTAVIRUS</option>
								<option value="7" <?php if($texamen == 7){ echo 'selected';}  ?>>SIFILIS</option>
								<option value="8" <?php if($texamen == 8){ echo 'selected';}  ?>>MALARIA</option>
								<option value="9" <?php if($texamen == 9){ echo 'selected';}  ?>>EDUCACION CONTINUA</option>
							</select>
							<input type="hidden" name="texamen1" id="texamen1" value="<?php echo $texamen; ?>">
						</div>
						<hr id="Line5">
					</div>

				</div>
				<div id="wb_LayoutGrid6">
					<div id="LayoutGrid6">
						<div class="row">
							<div class="col-1">
								<div id="wb_Text4"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Mes: </strong></span> </div>
							</div>
							<div class="col-2">
								<input type="number" id="mes" name="mes" value="<?php echo $mes; ?>" spellcheck="false" maxlength="2" style="background-color: #DCDCDC;" readonly>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div id="wb_LayoutGrid7">
					<div id="LayoutGrid7">
						<div class="row">
							<div class="col-1">
								<div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>A&ntilde;o: </strong></span> </div>
							</div>
							<div class="col-2">
								<input type="number" id="anio" name="anio" value="<?php echo $anio; ?>" spellcheck="false" maxlength="4" style="background-color: #DCDCDC;" readonly>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div id="wb_LayoutGrid7">
					<div id="LayoutGrid7">
						<div class="row">
							<div class="col-1">
								<div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Fecha: </strong></span> </div>
							</div>
							<div class="col-2">
								<input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" spellcheck="false" autofocus>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div id="wb_LayoutGrid7">
					<div id="LayoutGrid7">
						<div class="row">
							<div class="col-1">
								<div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Lote: </strong></span> </div>
							</div>
							<div class="col-2">
								<input type="text" id="lote" name="lote" value="<?php echo $lote; ?>" spellcheck="false" maxlength="20">
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-1">
						<hr id="Line2">
						<div id="wb_Text2">
							<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Empresa: </strong></span>
						</div>
						<hr id="Line3">
					</div>

					<div class="col-2">
						<hr id="Line4">
						<div class="selector-establecimiento">
							<select name="codempresa" size="1" id="codempresa" <?php if($codempresa != ''){echo "disabled";}?> style="<?php if($codempresa != ''){echo "background-color: #DCDCDC";}?>">
								<option value=""></option>
								<?php
									$tabla_dpto = pg_query($link, "WITH RECURSIVE 					establecimiento_empresa(codempresa, razonsocial) AS (
										SELECT codservicio, 
											   nomservicio
										FROM establecimientos
										UNION ALL
										SELECT codempresa, 
											   razonsocial
										FROM empresas
									  )
									SELECT codempresa, razonsocial
									FROM establecimiento_empresa
									ORDER BY codempresa");
									while($depto = pg_fetch_array($tabla_dpto)) 
									{
									   if(trim($codempresa) == trim($depto["codempresa"]))
										{
											echo '<option value="'.$depto["codempresa"].'" selected>'.$depto["razonsocial"].'</option>';
										}
										else
										{
											echo '<option value="'.$depto["codempresa"].'">'.$depto["razonsocial"].'</option>';
										}
									}
								?>
							</select>
							
							<input type="hidden" name="codempresa1" id="codempresa1" value="<?php echo $codempresa; ?>">
						</div>
						<hr id="Line5">
					</div>

				</div>
			</div>
		</div>
		<div id="wb_LayoutGrid6">
			<div id="LayoutGrid6">
				<div class="row">
					<div class="col-1">

					</div>
				</div>
			</div>
		</div>

		<div id="wb_turnos_detallesLayoutGrid4">
		<div id="turnos_detallesLayoutGrid4">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine11">
					<input type="button" id="Button1" name="agregar" value="Guardar Datos" onclick="xajax_ValidarFormulario(xajax.getFormValues(formu));" >
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
		
	<?php	
		switch ($texamen) 
		{
			case '1':
			   echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
				<div id="respuesta_clinica_detallesLayoutGrid1">
					<div class="row">
						<div class="col-1">
							<table width="748" id="respuesta_clinica_detallesTable1" align="center">
								<tr>
									<th width="186" class="cell0"><span style="color:#000000;"> Analitos</span>
									</th>
									<th width="550" class="cell0"><span style="color:#000000;"> Resultado Previsto</span>
									</th>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Glicemia</span>
									</td>
									<td class="cell2"><input type="text" id="resulprevisto1" name="resulprevisto1" value="'.$resulprevisto1.'" spellcheck="false" maxlength="100" autofocus>
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Urea</span>
									</td>
									<td class="cell2"><input type="text" id="resulprevisto2" name="resulprevisto2" value="'.$resulprevisto2.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Creatinina</span>
									</td>
									<td class="cell2"><input type="text" id="resulprevisto3" name="resulprevisto3" value="'.$resulprevisto3.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Colesterol</span>
									</td>
									<td class="cell1"><span style="color:#000000;"> </span>
									<input type="text" id="resulprevisto4" name="resulprevisto4" value="'.$resulprevisto4.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Trigliceridos</span>
									</td>
									<td class="cell1"><span style="color:#000000;"> </span>
									<input type="text" id="resulprevisto5" name="resulprevisto5" value="'.$resulprevisto5.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;">GOT (AST)</span>
									</td>
									<td class="cell1"><input type="text" id="resulprevisto6" name="resulprevisto6" value="'.$resulprevisto6.'" spellcheck="false" maxlength="100"></td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;">GPT (ALT)</span>
									</td>
									<td class="cell1"><input type="text" id="resulprevisto7" name="resulprevisto7" value="'.$resulprevisto7.'" spellcheck="false" maxlength="100"></td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;">Proteinas totales</span>
									</td>
									<td class="cell1"><input type="text" id="resulprevisto8" name="resulprevisto8" value="'.$resulprevisto8.'" spellcheck="false" maxlength="100"></td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Albumina</span>
									</td>
									<td class="cell1"><span style="color:#000000;"> </span>
									<input type="text" id="resulprevisto9" name="resulprevisto9" value="'.$resulprevisto9.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>';
				
			   break;
			case '2':
				echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
				<div id="respuesta_clinica_detallesLayoutGrid1">
					<div class="row">
						<div class="col-1">
							<table width="748" id="respuesta_clinica_detallesTable1" align="center">
								<tr>
									<th width="186" class="cell0"><span style="color:#000000;"> Material de Control</span>
									</th>
									<th width="550" class="cell0"><span style="color:#000000;"> Resultado Previsto</span>
									</th>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Muestra 1</span>
									</td>
									<td class="cell2"><input type="text" id="muestra1" name="muestra1" value="'.$muestra1.'" spellcheck="false" maxlength="100" autofocus>
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Muestra 2</span>
									</td>
									<td class="cell2"><input type="text" id="muestra2" name="muestra2" value="'.$muestra2.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Muestra 3</span>
									</td>
									<td class="cell2"><input type="text" id="muestra3" name="muestra3" value="'.$muestra3.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Muestra 4</span>
									</td>
									<td class="cell1"><span style="color:#000000;"> </span>
									<input type="text" id="muestra4" name="muestra4" value="'.$muestra4.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000;"> Muestra 5</span>
									</td>
									<td class="cell1"><span style="color:#000000;"> </span>
									<input type="text" id="muestra5" name="muestra5" value="'.$muestra5.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>';

				break;
			case '3':


				break;
			case '4':


				break;
			case '5':


				break;
			case '6':


				break;
			case '7':


				break;
			case '8':


				break;
			case '9':


				break;
		}
	?>
	
	<div id="wb_sintomas_detallesLayoutGrid1">
		<div id="sintomas_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="sintomas_detallesLine1"/>
					<div id="wb_sintomas_detallesText1">
						<span style="color:#FF0000;font-family:Arial;font-size:13px;">[&nbsp;<a href="#" onclick="window.location.href='resultados_previstos.php'"> VOLVER </a>&nbsp;]</span>
						
	

					</div>
					<hr id="sintomas_detallesLine2"/>
				</div>
			</div>
		</div>
	</div>
	</form>

	<div id="page1Layer2">
		<div id="wb_page1LayoutGrid1">
			<div id="page1LayoutGrid1">
				<div class="row">
					<div class="col-1">
						<div id="wb_menuText4">
							<span style="color:#FFFFFF;font-family:Arial;font-size:13px;">&#169; 2018 Laboratorio Central de Salud P&uacute;blica. <br />
        				Todos los derechos reservados.<br />
        				Asunci&oacute;n, Paraguay</span>
						</div>
					</div>
					<div class="col-2">
						<hr id="page1Line1"/>
						<div id="wb_FontAwesomeIcon5">
							<div id="FontAwesomeIcon5">
								<i class="fa fa-facebook-f">&nbsp;</i>
							</div>
						</div>
						<div id="wb_FontAwesomeIcon6">
							<div id="FontAwesomeIcon6">
								<i class="fa fa-envelope-o">&nbsp;</i>
							</div>
						</div>
						<div id="wb_FontAwesomeIcon9">
							<div id="FontAwesomeIcon9">
								<i class="fa fa-cloud">&nbsp;</i>
							</div>
						</div>
						<hr id="page1Line2"/>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
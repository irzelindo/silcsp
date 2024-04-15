<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_161  = $_SESSION['V_161']; //Carga, Validación Revalidación
$v_162 = $_SESSION['V_162']; //Impresión Resultados
$v_163 = $_SESSION['V_163 ']; //Carga, Validación Microbiología
$v_164 = $_SESSION['V_164']; //Email Resultados
$v_168 = $_SESSION['V_168']; //Histórico de Resultados
$v_169 = $_SESSION['V_169']; //Interfaces con Analizadores
$v_1691  = $_SESSION['V_1691']; //Preparar Muestras
$v_1692  = $_SESSION['V_1692']; //Confirmar Resultados

$nordentra 	 = $_GET['nordentra'];
$codservicio = $_GET['codservicio'];
$codestudio  = $_GET['codestudio'];
$nroorden    = $_GET['nroorden'];

$query = "select * from ordtrabajo where nordentra = '$nordentra' and codservicio = '$codservicio'";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$fecharec 	 = $row["fecharec"];
$horarec 	 = $row["horarec"];
$codservicio = $row["codservicio"];
$codorigen 	 = $row["codorigen"];
$codservder  = $row["codservder"];
$codmedico   = $row["codmedico"];
$recitacion  = $row["recitacion"];
$retira  	 = $row["retira"];
$obs  		 = $row["obs"];
$urgente     = $row["urgente"];
$fechasal    = $row["fechasal"];
$horasal     = $row["horasal"];
$nropaciente = $row["nropaciente"];

$query1 = "select * from paciente where nropaciente = '$nropaciente'";
$result1 = pg_query($link,$query1);

$row1 = pg_fetch_assoc($result1);

$tdocumento = $row1["tdocumento"];
$cedula 	= $row1["cedula"];
$pnombre 	= $row1["pnombre"];
$snombre 	= $row1["snombre"];
$papellido 	= $row1["papellido"];
$sapellido 	= $row1["sapellido"];

switch ($tdocumento) {
    case '1':
        $nomdocumento = "1. Cedula";
        break;
    case '2':
        $nomdocumento = "2. Pasaporte";
        break;
    case '3':
        $nomdocumento = "3. Carnet Indigena";
        break;
	case '4':
        $nomdocumento = "4. Otros";
        break;
	case '5':
        $nomdocumento = "5. No Tiene";
        break;
}

$query2 = "select * from resultadosmicro where nordentra = '$nordentra' and codservicio = '$codservicio' and codestudio = '$codestudio' and norden = '$nroorden'";
$result2 = pg_query($link,$query2);

$row2 = pg_fetch_assoc($result2);

$coddetermina 	= $row2["coddetermina"];
$codsector      = $row2["codsector"];
$codmetodo      = $row2["codmetodo"];
$codumedida     = $row2["codumedida"];
$resultado      = $row2["resultado"];
$codresultado   = $row2["codresultado"];
$obs	        = $row2["obs"];
$nroestudio 	= $row2["nroestudio"];
$codestado	 	= $row2["codestado"];
$codusu1	 	= $row2["codusu1"];
$horaval	 	= $row2["horaval"];
$codusu2	 	= $row2["codusu2"];

$horareval	 	= $row2["horareval"];
$codusu3	 	= $row2["codusu3"];

$horaanul	 	= $row2["horaanul"];

if($row2["fechaval"] != '')
{
	$fechaval = date("d/m/Y", strtotime($row2["fechaval"]));
}
else
{
	$fechaval = "";
}

if($row2["fechareval"] != '')
{
	$fechareval	 = date("d/m/Y", strtotime($row2["fechareval"]));
}
else
{
	$fechareval = "";
}

if($row2["fechaanul"] != '')
{
	$fechaanul	 = date("d/m/Y", strtotime($row2["fechaanul"]));
}
else
{
	$fechaanul = "";
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

function ValidarFormulario($form) {
	extract($form);

	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding( 'utf-8' );
	
	$codusu = $_SESSION[ 'codusu' ];
	
	$fecharec = date("Y-m-d", time());

	$con = Conectarse();

	$mensaje = '';
	
	if ( $codumedida == "" ) {
		$mensaje .= '- Rellene el campo Unidad de Medida!\n';

		$respuesta->Assign( "codumedida", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "codumedida", "style.backgroundColor", "white" );
	}
	
	if ( $codestado == "") {
		$mensaje .= '- Rellene el campo Estados!\n';

		$respuesta->Assign( "codestado", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "codestado", "style.backgroundColor", "white" );
	}

	if ($resultados == "") {
		$mensaje .= '- Rellene el campo Resultado!\n';

		$respuesta->Assign( "resultados", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "resultados", "style.backgroundColor", "white" );
	}

	if ( $mensaje == "" ) {
		

		pg_query( $con, "UPDATE public.resultadosmicro
								SET fechares='$fecharec', codmetodo='$codmetodo1', codumedida='$codumedida', resultado='$resultados', codresultado='$codresultado', codequipo='$codequipo', codestado='002'
								WHERE nordentra = '$nrordentra' and codservicio = '$codservicio1' and norden = '$nroorden' and codestudio = '$codestudio1' and coddetermina = '$coddetermina1'" );


		$respuesta->redirect("navegador_resultadosm.php?nordentra=$nrordentra&codservicio=$codservicio1&codestudio=$codestudio1");
		
		// Bitacora
		include( "bitacora.php" );
		$codopc = "V_163";
		$fecha1 = date( "Y-n-j", time() );
		$hora = date( "G:i:s", time() );
		$accion = "Carga y Validacion Resultado: Nro. Orden: " . $codservicio1.$nrordentra;
		$terminal = $_SERVER[ 'REMOTE_ADDR' ];
		$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
		// Fin grabacion de registro de auditoria


	} else {

		$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
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
	<script src="js/jquery.min.js"></script>
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
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
			width: 96px;
			height: 25px;
			z-index: 90;
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
		
		#Combobox1 {
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
		
		#Combobox1:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#Combobox1 {
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
		
		#Combobox3 {
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
		
		#Combobox3:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#Combobox3 {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 9;
		}
	</style>

	<style>
		a {
			color: #0000FF;
			text-decoration: underline;
		}
		
		a:visited {
			color: #800080;
		}
		
		a:active {
			color: #FF0000;
		}
		
		a:hover {
			color: #0000FF;
			text-decoration: underline;
		}
		
		#turnos_detallesLine8 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesButton5 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
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
		
		#wb_turnos_detallesLayoutGrid5 {
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
		
		#turnos_detallesLayoutGrid5 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#turnos_detallesLayoutGrid5 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#turnos_detallesLayoutGrid5 .col-1,
		#turnos_detallesLayoutGrid5 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#turnos_detallesLayoutGrid5 .col-1,
		#turnos_detallesLayoutGrid5 .col-2 {
			float: left;
		}
		
		#turnos_detallesLayoutGrid5 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid5 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		
		#turnos_detallesLayoutGrid5:before,
		#turnos_detallesLayoutGrid5:after,
		#turnos_detallesLayoutGrid5 .row:before,
		#turnos_detallesLayoutGrid5 .row:after {
			display: table;
			content: " ";
		}
		
		#turnos_detallesLayoutGrid5:after,
		#turnos_detallesLayoutGrid5 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#turnos_detallesLayoutGrid5 .col-1,
			#turnos_detallesLayoutGrid5 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#turnos_detallesLine14 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#fecharec {
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
		
		#fecharec:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#horarec {
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
		
		#horarec:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#courier_detallesLine7 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#codestudio {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
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
		
		#codestudio:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#tdocumento {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
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
		
		#tdocumento:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#Line9 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
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
		
		#wb_FontAwesomeIcon1 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon1:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon1 {
			height: 26px;
			width: 37px;
		}
		
		#FontAwesomeIcon1 i {
			color: #2E8B57;
			display: inline-block;
			font-size: 26px;
			line-height: 26px;
			vertical-align: middle;
			width: 25px;
		}
		
		#wb_FontAwesomeIcon1:hover i {
			color: #FF8C00;
		}
		
		#Layer1 {
			background-color: transparent;
			background-image: none;
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
			height: 36px;
			width: 49px;
		}
		
		#FontAwesomeIcon3 i {
			color: #FF0000;
			display: inline-block;
			font-size: 36px;
			line-height: 36px;
			vertical-align: middle;
			width: 36px;
		}
		
		#wb_FontAwesomeIcon3:hover i {
			color: #337AB7;
		}
		
		#npaciente {
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
		
		#npaciente:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#wb_pacientes_detallesText1 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText1 div {
			text-align: left;
		}
		
		#pacientes_detallesLine2 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine4 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_pacientes_detallesText2 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText2 div {
			text-align: left;
		}
		
		#pacientes_detallesLine5 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#nrordentra {
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
		
		#nrordentra:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#pacientes_detallesLine8 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_pacientes_detallesText3 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText3 div {
			text-align: left;
		}
		
		#pacientes_detallesLine10 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine12 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_pacientes_detallesText4 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText4 div {
			text-align: left;
		}
		
		#pacientes_detallesLine14 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#cedula {
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
		
		#cedula:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#pacientes_detallesLine16 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pnombre {
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
		
		#pnombre:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#wb_pacientes_detallesText5 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText5 div {
			text-align: left;
		}
		
		#pacientes_detallesLine18 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine20 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_pacientes_detallesText6 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText6 div {
			text-align: left;
		}
		
		#pacientes_detallesLine22 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#snombre {
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
		
		#snombre:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#pacientes_detallesLine24 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#papellido {
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
		
		#papellido:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#wb_pacientes_detallesText7 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText7 div {
			text-align: left;
		}
		
		#pacientes_detallesLine26 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine28 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_pacientes_detallesText8 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_pacientes_detallesText8 div {
			text-align: left;
		}
		
		#pacientes_detallesLine30 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#sapellido {
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
		
		#sapellido:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#pacientes_detallesLine32 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_usuarios_detallesLayoutGrid7 {
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
		
		#usuarios_detallesLayoutGrid7 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#usuarios_detallesLayoutGrid7 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#usuarios_detallesLayoutGrid7 .col-1,
		#usuarios_detallesLayoutGrid7 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#usuarios_detallesLayoutGrid7 .col-1,
		#usuarios_detallesLayoutGrid7 .col-2 {
			float: left;
		}
		
		#usuarios_detallesLayoutGrid7 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#usuarios_detallesLayoutGrid7 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		
		#usuarios_detallesLayoutGrid7:before,
		#usuarios_detallesLayoutGrid7:after,
		#usuarios_detallesLayoutGrid7 .row:before,
		#usuarios_detallesLayoutGrid7 .row:after {
			display: table;
			content: " ";
		}
		
		#usuarios_detallesLayoutGrid7:after,
		#usuarios_detallesLayoutGrid7 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#usuarios_detallesLayoutGrid7 .col-1,
			#usuarios_detallesLayoutGrid7 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_usuarios_detallesText7 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_usuarios_detallesText7 div {
			text-align: left;
		}
		
		#usuarios_detallesLine23 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#usuarios_detallesLine24 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#usuarios_detallesLine25 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#codservicio {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
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
		
		#codservicio:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
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
			float: left;
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
		
		#wb_turnos_detallesText1 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_turnos_detallesText1 div {
			text-align: left;
		}
		
		#turnos_detallesLine1 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine3 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_courier_detallesLayoutGrid2 {
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
		
		#courier_detallesLayoutGrid2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#courier_detallesLayoutGrid2 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#courier_detallesLayoutGrid2 .col-1,
		#courier_detallesLayoutGrid2 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#courier_detallesLayoutGrid2 .col-1,
		#courier_detallesLayoutGrid2 .col-2 {
			float: left;
		}
		
		#courier_detallesLayoutGrid2 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#courier_detallesLayoutGrid2 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		
		#courier_detallesLayoutGrid2:before,
		#courier_detallesLayoutGrid2:after,
		#courier_detallesLayoutGrid2 .row:before,
		#courier_detallesLayoutGrid2 .row:after {
			display: table;
			content: " ";
		}
		
		#courier_detallesLayoutGrid2:after,
		#courier_detallesLayoutGrid2 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#courier_detallesLayoutGrid2 .col-1,
			#courier_detallesLayoutGrid2 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#courier_detallesLine5 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#courier_detallesLine6 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#courier_detallesLine8 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_turnos_detallesText3 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_turnos_detallesText3 div {
			text-align: left;
		}
		
		#wb_pacientes_detallesLayoutGrid1 {
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
		
		#pacientes_detallesLayoutGrid1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#pacientes_detallesLayoutGrid1 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#pacientes_detallesLayoutGrid1 .col-1,
		#pacientes_detallesLayoutGrid1 .col-2,
		#pacientes_detallesLayoutGrid1 .col-3,
		#pacientes_detallesLayoutGrid1 .col-4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#pacientes_detallesLayoutGrid1 .col-1,
		#pacientes_detallesLayoutGrid1 .col-2,
		#pacientes_detallesLayoutGrid1 .col-3,
		#pacientes_detallesLayoutGrid1 .col-4 {
			float: left;
		}
		
		#pacientes_detallesLayoutGrid1 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid1 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid1 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid1 .col-4 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid1:before,
		#pacientes_detallesLayoutGrid1:after,
		#pacientes_detallesLayoutGrid1 .row:before,
		#pacientes_detallesLayoutGrid1 .row:after {
			display: table;
			content: " ";
		}
		
		#pacientes_detallesLayoutGrid1:after,
		#pacientes_detallesLayoutGrid1 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#pacientes_detallesLayoutGrid1 .col-1,
			#pacientes_detallesLayoutGrid1 .col-2,
			#pacientes_detallesLayoutGrid1 .col-3,
			#pacientes_detallesLayoutGrid1 .col-4 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_pacientes_detallesLayoutGrid2 {
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
		
		#pacientes_detallesLayoutGrid2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#pacientes_detallesLayoutGrid2 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#pacientes_detallesLayoutGrid2 .col-1,
		#pacientes_detallesLayoutGrid2 .col-2,
		#pacientes_detallesLayoutGrid2 .col-3,
		#pacientes_detallesLayoutGrid2 .col-4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#pacientes_detallesLayoutGrid2 .col-1,
		#pacientes_detallesLayoutGrid2 .col-2,
		#pacientes_detallesLayoutGrid2 .col-3,
		#pacientes_detallesLayoutGrid2 .col-4 {
			float: left;
		}
		
		#pacientes_detallesLayoutGrid2 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid2 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid2 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid2 .col-4 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid2:before,
		#pacientes_detallesLayoutGrid2:after,
		#pacientes_detallesLayoutGrid2 .row:before,
		#pacientes_detallesLayoutGrid2 .row:after {
			display: table;
			content: " ";
		}
		
		#pacientes_detallesLayoutGrid2:after,
		#pacientes_detallesLayoutGrid2 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#pacientes_detallesLayoutGrid2 .col-1,
			#pacientes_detallesLayoutGrid2 .col-2,
			#pacientes_detallesLayoutGrid2 .col-3,
			#pacientes_detallesLayoutGrid2 .col-4 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_pacientes_detallesLayoutGrid3 {
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
		
		#pacientes_detallesLayoutGrid3 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#pacientes_detallesLayoutGrid3 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#pacientes_detallesLayoutGrid3 .col-1,
		#pacientes_detallesLayoutGrid3 .col-2,
		#pacientes_detallesLayoutGrid3 .col-3,
		#pacientes_detallesLayoutGrid3 .col-4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#pacientes_detallesLayoutGrid3 .col-1,
		#pacientes_detallesLayoutGrid3 .col-2,
		#pacientes_detallesLayoutGrid3 .col-3,
		#pacientes_detallesLayoutGrid3 .col-4 {
			float: left;
		}
		
		#pacientes_detallesLayoutGrid3 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid3 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid3 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid3 .col-4 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid3:before,
		#pacientes_detallesLayoutGrid3:after,
		#pacientes_detallesLayoutGrid3 .row:before,
		#pacientes_detallesLayoutGrid3 .row:after {
			display: table;
			content: " ";
		}
		
		#pacientes_detallesLayoutGrid3:after,
		#pacientes_detallesLayoutGrid3 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#pacientes_detallesLayoutGrid3 .col-1,
			#pacientes_detallesLayoutGrid3 .col-2,
			#pacientes_detallesLayoutGrid3 .col-3,
			#pacientes_detallesLayoutGrid3 .col-4 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_pacientes_detallesLayoutGrid4 {
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
		
		#pacientes_detallesLayoutGrid4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#pacientes_detallesLayoutGrid4 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#pacientes_detallesLayoutGrid4 .col-1,
		#pacientes_detallesLayoutGrid4 .col-2,
		#pacientes_detallesLayoutGrid4 .col-3,
		#pacientes_detallesLayoutGrid4 .col-4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#pacientes_detallesLayoutGrid4 .col-1,
		#pacientes_detallesLayoutGrid4 .col-2,
		#pacientes_detallesLayoutGrid4 .col-3,
		#pacientes_detallesLayoutGrid4 .col-4 {
			float: left;
		}
		
		#pacientes_detallesLayoutGrid4 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid4 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid4 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid4 .col-4 {
			background-color: transparent;
			background-image: none;
			width: 16.66666667%;
			text-align: left;
		}
		
		#pacientes_detallesLayoutGrid4:before,
		#pacientes_detallesLayoutGrid4:after,
		#pacientes_detallesLayoutGrid4 .row:before,
		#pacientes_detallesLayoutGrid4 .row:after {
			display: table;
			content: " ";
		}
		
		#pacientes_detallesLayoutGrid4:after,
		#pacientes_detallesLayoutGrid4 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#pacientes_detallesLayoutGrid4 .col-1,
			#pacientes_detallesLayoutGrid4 .col-2,
			#pacientes_detallesLayoutGrid4 .col-3,
			#pacientes_detallesLayoutGrid4 .col-4 {
				float: none;
				width: 100%;
			}
		}
		
		#codorigen {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
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
		
		#codorigen:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#codsector {
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
		
		#codsector:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#coddetermina {
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
		
		#coddetermina:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#codmetodo {
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
		
		#codmetodo:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#codumedida {
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
		
		#codumedida:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#codestado {
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
		
		#codestado:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#codresultado {
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
		
		#codresultado:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#resultados {
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
		
		#resultados:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#obs {
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
		
		#obs:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#turnos_detallesLine2 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#codequipo {
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
		
		#codequipo:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
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
		
		#turnos_detallesLayoutGrid2 .col-1 {
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
			float: left;
		}
		
		#turnos_detallesLayoutGrid2 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: center;
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
			#turnos_detallesLayoutGrid2 .col-1 {
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
		
		#wb_LayoutGrid4 {
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
		
		#LayoutGrid4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#LayoutGrid4 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#LayoutGrid4 .col-1 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#LayoutGrid4 .col-1 {
			float: left;
		}
		
		#LayoutGrid4 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: center;
		}
		
		#LayoutGrid4:before,
		#LayoutGrid4:after,
		#LayoutGrid4 .row:before,
		#LayoutGrid4 .row:after {
			display: table;
			content: " ";
		}
		
		#LayoutGrid4:after,
		#LayoutGrid4 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#LayoutGrid4 .col-1 {
				float: none;
				width: 100%;
			}
		}
		
		#Table1 {
			border: 1px #4D4D4D solid;
			background-color: #DBDBDB;
			background-image: none;
			border-collapse: collapse;
			border-spacing: 0px;
		}
		
		#Table1 td {
			padding: 0px 0px 0px 0px;
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
			text-align: center;
			vertical-align: middle;
			font-family: Arial;
			font-size: 13px;
			line-height: 16px;
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
		
		#Table1 tr:nth-child(odd) {
			background-color: #FFFFFF;
		}
		
		#wb_FontAwesomeIcon5 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon5:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon5 {
			height: 34px;
			width: 41px;
		}
		
		#FontAwesomeIcon5 i {
			color: #2E8B57;
			display: inline-block;
			font-size: 34px;
			line-height: 34px;
			vertical-align: middle;
			width: 28px;
		}
		
		#wb_FontAwesomeIcon5:hover i {
			color: #337AB7;
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
			width: 41px;
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
		
		#wb_FontAwesomeIcon6 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon6:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon6 {
			height: 36px;
			width: 41px;
		}
		
		#FontAwesomeIcon6 i {
			color: #FF0000;
			display: inline-block;
			font-size: 36px;
			line-height: 36px;
			vertical-align: middle;
			width: 31px;
		}
		
		#wb_FontAwesomeIcon6:hover i {
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
			width: 41px;
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
		
		#empresasEditbox2 {
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
		
		#empresasEditbox2:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#empresasEditbox3 {
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
		
		#empresasEditbox3:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#empresasEditbox1 {
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
		
		#empresasEditbox1:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#Editbox4 {
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
		
		#Editbox4:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}
		
		#wb_LayoutGrid7 {
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
		
		#LayoutGrid7 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#LayoutGrid7 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#LayoutGrid7 .col-1,
		#LayoutGrid7 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#LayoutGrid7 .col-1,
		#LayoutGrid7 .col-2 {
			float: left;
		}
		
		#LayoutGrid7 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: left;
		}
		
		#LayoutGrid7 .col-2 {
			background-color: transparent;
			background-image: none;
			display: none;
			width: 0;
			text-align: left;
		}
		
		#LayoutGrid7:before,
		#LayoutGrid7:after,
		#LayoutGrid7 .row:before,
		#LayoutGrid7 .row:after {
			display: table;
			content: " ";
		}
		
		#LayoutGrid7:after,
		#LayoutGrid7 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#LayoutGrid7 .col-1,
			#LayoutGrid7 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#Button1 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#Line16 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#Line11 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesButton1 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #FF0000;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#turnos_detallesLine5 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_pacientes_detallesLayoutGrid11 {
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
		
		#pacientes_detallesLayoutGrid11 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#pacientes_detallesLayoutGrid11 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#pacientes_detallesLayoutGrid11 .col-1,
		#pacientes_detallesLayoutGrid11 .col-2,
		#pacientes_detallesLayoutGrid11 .col-3 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#pacientes_detallesLayoutGrid11 .col-1,
		#pacientes_detallesLayoutGrid11 .col-2,
		#pacientes_detallesLayoutGrid11 .col-3 {
			float: left;
		}
		
		#pacientes_detallesLayoutGrid11 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: center;
		}
		
		#pacientes_detallesLayoutGrid11 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: center;
		}
		
		#pacientes_detallesLayoutGrid11 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: center;
		}
		
		#pacientes_detallesLayoutGrid11:before,
		#pacientes_detallesLayoutGrid11:after,
		#pacientes_detallesLayoutGrid11 .row:before,
		#pacientes_detallesLayoutGrid11 .row:after {
			display: table;
			content: " ";
		}
		
		#pacientes_detallesLayoutGrid11:after,
		#pacientes_detallesLayoutGrid11 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#pacientes_detallesLayoutGrid11 .col-1,
			#pacientes_detallesLayoutGrid11 .col-2,
			#pacientes_detallesLayoutGrid11 .col-3 {
				float: none;
				width: 100%;
			}
		}
		
		#pacientes_detallesLine50 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine51 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine52 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine53 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#pacientes_detallesLine54 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
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
		
		#pacientes_detallesButton2 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #FF4500;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#pacientes_detallesButton3 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #FF4500;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#wb_turnos_detallesLayoutGrid3 {
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
		
		#turnos_detallesLayoutGrid3 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#turnos_detallesLayoutGrid3 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#turnos_detallesLayoutGrid3 .col-1,
		#turnos_detallesLayoutGrid3 .col-2,
		#turnos_detallesLayoutGrid3 .col-3 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#turnos_detallesLayoutGrid3 .col-1,
		#turnos_detallesLayoutGrid3 .col-2,
		#turnos_detallesLayoutGrid3 .col-3 {
			float: left;
		}
		
		#turnos_detallesLayoutGrid3 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: center;
		}
		
		#turnos_detallesLayoutGrid3 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: center;
		}
		
		#turnos_detallesLayoutGrid3 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: center;
		}
		
		#turnos_detallesLayoutGrid3:before,
		#turnos_detallesLayoutGrid3:after,
		#turnos_detallesLayoutGrid3 .row:before,
		#turnos_detallesLayoutGrid3 .row:after {
			display: table;
			content: " ";
		}
		
		#turnos_detallesLayoutGrid3:after,
		#turnos_detallesLayoutGrid3 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#turnos_detallesLayoutGrid3 .col-1,
			#turnos_detallesLayoutGrid3 .col-2,
			#turnos_detallesLayoutGrid3 .col-3 {
				float: none;
				width: 100%;
			}
		}
		
		#turnos_detallesLine6 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine7 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine9 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine10 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesButton2 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#turnos_detallesButton3 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
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
		
		#turnos_detallesButton4 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#turnos_detallesLine11 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine12 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
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
		
		#sintomas_detallesLine1 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_sintomas_detallesText1 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_sintomas_detallesText1 div {
			text-align: left;
		}
		
		#sintomas_detallesLine2 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#wb_LayoutGrid9 {
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
		
		#LayoutGrid9 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 15px 15px 15px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#LayoutGrid9 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		
		#LayoutGrid9 .col-1,
		#LayoutGrid9 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#LayoutGrid9 .col-1,
		#LayoutGrid9 .col-2 {
			float: left;
		}
		
		#LayoutGrid9 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 50%;
			text-align: center;
		}
		
		#LayoutGrid9 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 50%;
			text-align: center;
		}
		
		#LayoutGrid9:before,
		#LayoutGrid9:after,
		#LayoutGrid9 .row:before,
		#LayoutGrid9 .row:after {
			display: table;
			content: " ";
		}
		
		#LayoutGrid9:after,
		#LayoutGrid9 .row:after {
			clear: both;
		}
		
		@media (max-width: 768px) {
			#LayoutGrid9 .col-1,
			#LayoutGrid9 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_Text8 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 20px 0px 20px 0px;
			margin: 0;
			text-align: center;
		}
		
		#wb_Text8 div {
			text-align: center;
		}
		
		#wb_FontAwesomeIcon8 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			margin: 0px 10px 0px 0px;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon8:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon8 {
			height: 22px;
			width: 22px;
		}
		
		#FontAwesomeIcon8 i {
			color: #FFFFFF;
			display: inline-block;
			font-size: 22px;
			line-height: 22px;
			vertical-align: middle;
			width: 12px;
		}
		
		#wb_FontAwesomeIcon8:hover i {
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
			width: 20px;
		}
		
		#wb_FontAwesomeIcon9:hover i {
			color: #FFFF00;
		}
		
		#wb_FontAwesomeIcon10 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon10:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon10 {
			height: 22px;
			width: 32px;
		}
		
		#FontAwesomeIcon10 i {
			color: #FFFFFF;
			display: inline-block;
			font-size: 22px;
			line-height: 22px;
			vertical-align: middle;
			width: 18px;
		}
		
		#wb_FontAwesomeIcon10:hover i {
			color: #FFFF00;
		}
		
		#wb_FontAwesomeIcon11 {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
			text-align: center;
			margin: 0px 10px 0px 0px;
			padding: 0px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon11:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
		}
		
		#FontAwesomeIcon11 {
			height: 22px;
			width: 22px;
		}
		
		#FontAwesomeIcon11 i {
			color: #FFFFFF;
			display: inline-block;
			font-size: 22px;
			line-height: 22px;
			vertical-align: middle;
			width: 18px;
		}
		
		#wb_FontAwesomeIcon11:hover i {
			color: #FFFF00;
		}
		
		#wb_turnos_detallesText4 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		
		#wb_turnos_detallesText4 div {
			text-align: left;
		}
		
		#turnos_detallesLine13 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#turnos_detallesLine15 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
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
		
		#wb_ResponsiveMenu1.affix {
			top: 0 !important;
			position: fixed !important;
			left: 50% !important;
			margin-left: -470px;
		}
		
		#pacientes_detallesLine53 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 94;
		}
		
		#pacientes_detallesLine20 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 49;
		}
		
		#usuarios_detallesLine24 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 16;
		}
		
		#wb_FontAwesomeIcon1 {
			position: absolute;
			left: 13px;
			top: 13px;
			width: 37px;
			height: 26px;
			text-align: center;
			z-index: 10;
		}
		
		#pacientes_detallesLine54 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 97;
		}
		
		#pacientes_detallesLine32 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 61;
		}
		
		#pacientes_detallesLine10 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 39;
		}
		
		#npaciente {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 32;
		}
		
		#pacientes_detallesLine2 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 29;
		}
		
		#courier_detallesLine5 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 22;
		}
		
		#usuarios_detallesLine25 {
			display: block;
			width: 100%;
			height: 12px;
			z-index: 14;
		}
		
		#wb_FontAwesomeIcon10 {
			display: inline-block;
			width: 32px;
			height: 22px;
			text-align: center;
			z-index: 118;
		}
		
		#pacientes_detallesLine22 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 51;
		}
		
		#nrordentra {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 36;
		}
		
		#codestudio {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 26;
		}
		
		#courier_detallesLine6 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 24;
		}
		
		#wb_FontAwesomeIcon3 {
			position: absolute;
			left: 3px;
			top: 6px;
			width: 49px;
			height: 36px;
			text-align: center;
			z-index: 11;
		}
		
		#wb_FontAwesomeIcon11 {
			display: inline-block;
			width: 22px;
			height: 22px;
			text-align: center;
			z-index: 117;
		}
		
		#Line11 {
			display: block;
			width: 100%;
			height: 90px;
			z-index: 91;
		}
		
		#wb_FontAwesomeIcon4 {
			display: inline-block;
			width: 41px;
			height: 36px;
			text-align: center;
			z-index: 71;
		}
		
		#Editbox4 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 65;
		}
		
		#pnombre {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 48;
		}
		
		#pacientes_detallesLine12 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 41;
		}
		
		#pacientes_detallesLine4 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 33;
		}
		
		#courier_detallesLine7 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 25;
		}
		
		#codorigen {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#codsector {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#coddetermina {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#codmetodo {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#codumedida {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#codestado {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#codequipo {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#codresultado {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#resultados {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#obs {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 20;
		}
		
		#codservicio {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 15;
		}
		
		#Line9 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 3;
		}
		
		#turnos_detallesLine10 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 105;
		}
		
		#wb_FontAwesomeIcon5 {
			display: inline-block;
			width: 41px;
			height: 34px;
			text-align: center;
			z-index: 70;
		}
		
		#pacientes_detallesLine24 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 53;
		}
		
		#cedula {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 44;
		}
		
		#pacientes_detallesLine5 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 35;
		}
		
		#courier_detallesLine8 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 27;
		}
		
		#Layer1 {
			position: absolute;
			text-align: left;
			left: 73px;
			top: 1286px;
			width: 63px;
			height: 52px;
			z-index: 167;
		}
		
		#turnos_detallesLine11 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 108;
		}
		
		#wb_FontAwesomeIcon6 {
			display: inline-block;
			width: 41px;
			height: 36px;
			text-align: center;
			z-index: 69;
		}
		
		#Table1 {
			display: table;
			width: 100%;
			height: 143px;
			z-index: 72;
		}
		
		#snombre {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 52;
		}
		
		#pacientes_detallesLine14 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 43;
		}
		
		#turnos_detallesButton1 {
			display: inline-block;
			width: 185px;
			height: 25px;
			z-index: 30;
		}
		
		#Layer2 {
			position: absolute;
			text-align: left;
			left: 9px;
			top: 1286px;
			width: 54px;
			height: 52px;
			z-index: 168;
		}
		
		#wb_Image3 {
			display: inline-block;
			width: 142px;
			height: 118px;
			z-index: 0;
		}
		
		#turnos_detallesLine12 {
			display: block;
			width: 100%;
			height: 61px;
			z-index: 110;
		}
		
		#turnos_detallesButton2 {
			display: inline-block;
			width: 184px;
			height: 25px;
			z-index: 101;
		}
		
		#pacientes_detallesButton1 {
			display: inline-block;
			width: 184px;
			height: 25px;
			z-index: 93;
		}
		
		#wb_FontAwesomeIcon7 {
			display: inline-block;
			width: 41px;
			height: 34px;
			text-align: center;
			z-index: 68;
		}
		
		#papellido {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 56;
		}
		
		#pacientes_detallesLine26 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 55;
		}
		
		#wb_Image4 {
			display: inline-block;
			width: 743px;
			height: 147px;
			z-index: 1;
		}
		
		#wb_FontAwesomeIcon8 {
			display: inline-block;
			width: 22px;
			height: 22px;
			text-align: center;
			z-index: 115;
		}
		
		#turnos_detallesButton3 {
			display: inline-block;
			width: 184px;
			height: 25px;
			z-index: 107;
		}
		
		#pacientes_detallesButton2 {
			display: inline-block;
			width: 184px;
			height: 25px;
			z-index: 96;
		}
		
		#sapellido {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 60;
		}
		
		#pacientes_detallesLine16 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 45;
		}
		
		#tdocumento {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 40;
		}
		
		#pacientes_detallesLine8 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 37;
		}
		
		#turnos_detallesLine1 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 17;
		}
		
		#turnos_detallesLine13 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 5;
		}
		
		#wb_FontAwesomeIcon9 {
			display: inline-block;
			width: 22px;
			height: 22px;
			text-align: center;
			z-index: 116;
		}
		
		#turnos_detallesButton4 {
			display: inline-block;
			width: 96px;
			height: 25px;
			z-index: 109;
		}
		
		#pacientes_detallesButton3 {
			display: inline-block;
			width: 184px;
			height: 25px;
			z-index: 99;
		}
		
		#Line16 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 89;
		}
		
		#pacientes_detallesLine28 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 57;
		}
		
		#turnos_detallesLine2 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 21;
		}
		
		#turnos_detallesLine14 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 7;
		}
		
		#turnos_detallesButton5 {
			display: inline-block;
			width: 184px;
			height: 25px;
			z-index: 104;
		}
		
		#pacientes_detallesLine18 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 47;
		}
		
		#turnos_detallesLine3 {
			display: block;
			width: 100%;
			height: 12px;
			z-index: 19;
		}
		
		#turnos_detallesLine15 {
			display: block;
			width: 100%;
			height: 12px;
			z-index: 9;
		}
		
		#empresasEditbox1 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 64;
		}
		
		#turnos_detallesLine4 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 62;
		}
		
		#empresasEditbox2 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 66;
		}
		
		#turnos_detallesLine5 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 31;
		}
		
		#turnos_detallesLine6 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 100;
		}
		
		#empresasEditbox3 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 67;
		}
		
		#fecharec {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 8;
		}
		
		#horarec {
			display: block;
			width: 20%;
			height: 31px;
			line-height: 31px;
			z-index: 8;
		}
		
		#sintomas_detallesLine1 {
			display: block;
			width: 100%;
			height: 11px;
			z-index: 111;
		}
		
		#turnos_detallesLine7 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 106;
		}
		
		#sintomas_detallesLine2 {
			display: block;
			width: 100%;
			height: 16px;
			z-index: 113;
		}
		
		#turnos_detallesLine8 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 103;
		}
		
		#pacientes_detallesLine50 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 92;
		}
		
		#wb_ResponsiveMenu1 {
			display: inline-block;
			width: 100%;
			z-index: 2;
		}
		
		#turnos_detallesLine9 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 102;
		}
		
		#pacientes_detallesLine51 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 98;
		}
		
		#pacientes_detallesLine52 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 95;
		}
		
		#pacientes_detallesLine30 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 59;
		}
		
		#usuarios_detallesLine23 {
			display: block;
			width: 100%;
			height: 10px;
			z-index: 12;
		}
		
		@media only screen and (min-width: 1024px) {
			div#container {
				width: 1024px;
			}
			#turnos_detallesLine8 {
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
			#turnos_detallesButton5 {
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
				background-color: #3370B7;
				background-image: none;
				border-radius: 4px;
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
			#wb_LayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid5 {
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
			#wb_turnos_detallesLayoutGrid5 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid5 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid5 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid5 .col-1,
			#turnos_detallesLayoutGrid5 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid5 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid5 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: center;
			}
			#turnos_detallesLine14 {
				height: 10px;
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
			#fecharec {
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
			#horarec {
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
			#courier_detallesLine7 {
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
			#codestudio {
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
			#tdocumento {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
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
			#wb_Text1 {
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
			#wb_FontAwesomeIcon2 {
				left: 255px;
				top: -93px;
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
			#wb_FontAwesomeIcon1 {
				left: 0px;
				top: 3px;
				width: 37px;
				height: 26px;
				visibility: visible;
				display: inline;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon1 {
				width: 37px;
				height: 26px;
			}
			#FontAwesomeIcon1 i {
				line-height: 26px;
				font-size: 26px;
			}
			#Layer1 {
				width: 42px;
				height: 32px;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Layer2 {
				width: 60px;
				height: 43px;
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
				left: 0px;
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
			#npaciente {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText1 {
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
			#pacientes_detallesLine2 {
				height: 10px;
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
			#pacientes_detallesLine4 {
				height: 10px;
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
			#wb_pacientes_detallesText2 {
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
			#pacientes_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#nrordentra {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine8 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesText3 {
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
			#pacientes_detallesLine10 {
				height: 10px;
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
			#pacientes_detallesLine12 {
				height: 10px;
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
			#wb_pacientes_detallesText4 {
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
			#pacientes_detallesLine14 {
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
			#cedula {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine16 {
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
			#pnombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText5 {
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
			#pacientes_detallesLine18 {
				height: 10px;
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
			#pacientes_detallesLine20 {
				height: 10px;
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
			#wb_pacientes_detallesText6 {
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
			#pacientes_detallesLine22 {
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
			#snombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine24 {
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
			#papellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText7 {
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
			#pacientes_detallesLine26 {
				height: 10px;
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
			#pacientes_detallesLine28 {
				height: 10px;
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
			#wb_pacientes_detallesText8 {
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
			#pacientes_detallesLine30 {
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
			#sapellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine32 {
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
			#wb_usuarios_detallesLayoutGrid7 {
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
			#wb_usuarios_detallesLayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#usuarios_detallesLayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#usuarios_detallesLayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1,
			#usuarios_detallesLayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#usuarios_detallesLayoutGrid7 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: center;
			}
			#wb_usuarios_detallesText7 {
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
			#usuarios_detallesLine23 {
				height: 10px;
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
			#usuarios_detallesLine24 {
				height: 10px;
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
			#usuarios_detallesLine25 {
				height: 12px;
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
			#codservicio {
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
			#wb_turnos_detallesLayoutGrid1 {
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
			#wb_turnos_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid1 .col-1,
			#turnos_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: center;
			}
			#wb_turnos_detallesText1 {
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
			#turnos_detallesLine1 {
				height: 10px;
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
			#turnos_detallesLine3 {
				height: 12px;
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
			#wb_courier_detallesLayoutGrid2 {
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
			#wb_courier_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#courier_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#courier_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#courier_detallesLayoutGrid2 .col-1,
			#courier_detallesLayoutGrid2 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#courier_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#courier_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: center;
			}
			#courier_detallesLine5 {
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
			#courier_detallesLine6 {
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
			#courier_detallesLine8 {
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
			#wb_turnos_detallesText3 {
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
			#wb_pacientes_detallesLayoutGrid1 {
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
			#wb_pacientes_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1,
			#pacientes_detallesLayoutGrid1 .col-2,
			#pacientes_detallesLayoutGrid1 .col-3,
			#pacientes_detallesLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid1 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid2 {
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
			#wb_pacientes_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1,
			#pacientes_detallesLayoutGrid2 .col-2,
			#pacientes_detallesLayoutGrid2 .col-3,
			#pacientes_detallesLayoutGrid2 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid2 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid3 {
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
			#wb_pacientes_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1,
			#pacientes_detallesLayoutGrid3 .col-2,
			#pacientes_detallesLayoutGrid3 .col-3,
			#pacientes_detallesLayoutGrid3 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid4 {
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
			#wb_pacientes_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1,
			#pacientes_detallesLayoutGrid4 .col-2,
			#pacientes_detallesLayoutGrid4 .col-3,
			#pacientes_detallesLayoutGrid4 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid4 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#codorigen {
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
			#codsector {
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
			
			#coddetermina {
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
			
			#codmetodo {
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
			
			#codumedida {
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
			
			#codestado {
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
			
			#codresultado {
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
			
			#resultados {
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
				margin-top: 10px;
			}
			
			#obs {
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
				margin-top: 10px;
			}
			
			#codequipo {
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
			
			#turnos_detallesLine2 {
				height: 10px;
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
			#wb_turnos_detallesLayoutGrid2 {
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
			#wb_turnos_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_turnos_detallesText2 {
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
			#turnos_detallesLine4 {
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
			#wb_LayoutGrid4 {
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
			#wb_LayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid4 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#Table1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DBDBDB;
				background-image: none;
			}
			#Table1 .cell0 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell1 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell2 {
				font-family: Verdana;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 12px;
			}
			#Table1 .cell3 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell4 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#Table1 .cell5 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell6 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#wb_FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon5 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon7 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon6 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon4 i {
				line-height: 36px;
				font-size: 36px;
			}
			#empresasEditbox2 {
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
			#empresasEditbox3 {
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
			#empresasEditbox1 {
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
			#Editbox4 {
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
			#wb_LayoutGrid7 {
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
			#wb_LayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid7 .col-1,
			#LayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid7 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#LayoutGrid7 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
		
			#Line16 {
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
			#Line11 {
				height: 35px;
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
			#turnos_detallesButton1 {
				width: 185px;
				height: 25px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FF0000;
				background-image: none;
				border-radius: 4px;
			}
			#turnos_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesLayoutGrid11 {
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
			#wb_pacientes_detallesLayoutGrid11 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid11 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid11 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1,
			#pacientes_detallesLayoutGrid11 .col-2,
			#pacientes_detallesLayoutGrid11 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLine50 {
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
			#pacientes_detallesLine51 {
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
			#pacientes_detallesLine52 {
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
			#pacientes_detallesLine53 {
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
			#pacientes_detallesLine54 {
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
			#pacientes_detallesButton2 {
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
			#pacientes_detallesButton3 {
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
			#wb_turnos_detallesLayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid3 .col-1,
			#turnos_detallesLayoutGrid3 .col-2,
			#turnos_detallesLayoutGrid3 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLine6 {
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
			#turnos_detallesLine7 {
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
			#turnos_detallesLine9 {
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
			#turnos_detallesLine10 {
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
			#turnos_detallesButton2 {
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
				background-color: #3370B7;
				background-image: none;
				border-radius: 4px;
			}
			#turnos_detallesButton3 {
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
				background-color: #3370B7;
				background-image: none;
				border-radius: 4px;
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
			#turnos_detallesButton4 {
				width: 96px;
				height: 25px;
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
			#wb_sintomas_detallesText1 {
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
			#wb_LayoutGrid9 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid9 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid9 {
				padding: 15px 15px 15px 15px;
			}
			#LayoutGrid9 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid9 .col-1,
			#LayoutGrid9 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid9 .col-1 {
				display: block;
				width: 50%;
				text-align: center;
			}
			#LayoutGrid9 .col-2 {
				display: block;
				width: 50%;
				text-align: center;
			}
			#wb_Text8 {
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
			#wb_FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon8 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon9 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
			}
			#FontAwesomeIcon10 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon11 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_turnos_detallesText4 {
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
			#turnos_detallesLine13 {
				height: 10px;
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
			#turnos_detallesLine15 {
				height: 12px;
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
		}
		
		@media only screen and (min-width: 980px) and (max-width: 1023px) {
			div#container {
				width: 980px;
			}
			#turnos_detallesLine8 {
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
			#wb_LayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid5 {
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
			#wb_turnos_detallesLayoutGrid5 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid5 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid5 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid5 .col-1,
			#turnos_detallesLayoutGrid5 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid5 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid5 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#turnos_detallesLine14 {
				height: 10px;
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
			#fecharec {
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
			#courier_detallesLine7 {
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
			
			#tdocumento {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
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
			#wb_Text1 {
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
			#wb_FontAwesomeIcon2 {
				left: 273px;
				top: 0px;
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
			#wb_FontAwesomeIcon1 {
				left: 0px;
				top: 0px;
				width: 37px;
				height: 26px;
				visibility: visible;
				display: inline;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon1 {
				width: 37px;
				height: 26px;
			}
			#FontAwesomeIcon1 i {
				line-height: 26px;
				font-size: 26px;
			}
			#Layer1 {
				width: 43px;
				height: 32px;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Layer2 {
				width: 60px;
				height: 39px;
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
				left: 0px;
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
			
			#wb_pacientes_detallesText1 {
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
			#pacientes_detallesLine2 {
				height: 10px;
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
			#pacientes_detallesLine4 {
				height: 10px;
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
			#wb_pacientes_detallesText2 {
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
			#pacientes_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			
			#pacientes_detallesLine8 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesText3 {
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
			#pacientes_detallesLine10 {
				height: 10px;
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
			#pacientes_detallesLine12 {
				height: 10px;
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
			#wb_pacientes_detallesText4 {
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
			#pacientes_detallesLine14 {
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
			#cedula {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine16 {
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
			#pnombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText5 {
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
			#pacientes_detallesLine18 {
				height: 10px;
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
			#pacientes_detallesLine20 {
				height: 10px;
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
			#wb_pacientes_detallesText6 {
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
			#pacientes_detallesLine22 {
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
			#snombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine24 {
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
			#papellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText7 {
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
			#pacientes_detallesLine26 {
				height: 10px;
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
			#pacientes_detallesLine28 {
				height: 10px;
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
			#wb_pacientes_detallesText8 {
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
			#pacientes_detallesLine30 {
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
			#sapellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine32 {
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
			#wb_usuarios_detallesLayoutGrid7 {
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
			#wb_usuarios_detallesLayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#usuarios_detallesLayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#usuarios_detallesLayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1,
			#usuarios_detallesLayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#usuarios_detallesLayoutGrid7 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#wb_usuarios_detallesText7 {
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
			#usuarios_detallesLine23 {
				height: 10px;
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
			#usuarios_detallesLine24 {
				height: 10px;
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
			#usuarios_detallesLine25 {
				height: 12px;
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
			
			#wb_turnos_detallesLayoutGrid1 {
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
			#wb_turnos_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid1 .col-1,
			#turnos_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#wb_turnos_detallesText1 {
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
			#turnos_detallesLine1 {
				height: 10px;
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
			#turnos_detallesLine3 {
				height: 12px;
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
			#wb_courier_detallesLayoutGrid2 {
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
			#wb_courier_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#courier_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#courier_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#courier_detallesLayoutGrid2 .col-1,
			#courier_detallesLayoutGrid2 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#courier_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#courier_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#courier_detallesLine5 {
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
			#courier_detallesLine6 {
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
			#courier_detallesLine8 {
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
			#wb_turnos_detallesText3 {
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
			#wb_pacientes_detallesLayoutGrid1 {
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
			#wb_pacientes_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1,
			#pacientes_detallesLayoutGrid1 .col-2,
			#pacientes_detallesLayoutGrid1 .col-3,
			#pacientes_detallesLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid2 {
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
			#wb_pacientes_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1,
			#pacientes_detallesLayoutGrid2 .col-2,
			#pacientes_detallesLayoutGrid2 .col-3,
			#pacientes_detallesLayoutGrid2 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid3 {
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
			#wb_pacientes_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1,
			#pacientes_detallesLayoutGrid3 .col-2,
			#pacientes_detallesLayoutGrid3 .col-3,
			#pacientes_detallesLayoutGrid3 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid4 {
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
			#wb_pacientes_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1,
			#pacientes_detallesLayoutGrid4 .col-2,
			#pacientes_detallesLayoutGrid4 .col-3,
			#pacientes_detallesLayoutGrid4 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			
			#turnos_detallesLine2 {
				height: 10px;
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
			#wb_turnos_detallesLayoutGrid2 {
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
			#wb_turnos_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_turnos_detallesText2 {
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
			#turnos_detallesLine4 {
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
			#wb_LayoutGrid4 {
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
			#wb_LayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid4 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#Table1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DBDBDB;
				background-image: none;
			}
			#Table1 .cell0 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell1 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell2 {
				font-family: Verdana;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 12px;
			}
			#Table1 .cell3 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell4 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#Table1 .cell5 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell6 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#wb_FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon5 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon7 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon6 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon4 i {
				line-height: 36px;
				font-size: 36px;
			}
			#empresasEditbox2 {
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
			#empresasEditbox3 {
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
			#empresasEditbox1 {
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
			#Editbox4 {
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
			#wb_LayoutGrid7 {
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
			#wb_LayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid7 .col-1,
			#LayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid7 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#LayoutGrid7 .col-2 {
				display: none;
				text-align: left;
			}
			
			#Line16 {
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
			#Line11 {
				height: 90px;
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
			#turnos_detallesButton1 {
				width: 185px;
				height: 25px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FF0000;
				background-image: none;
				border-radius: 4px;
			}
			#turnos_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesLayoutGrid11 {
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
			#wb_pacientes_detallesLayoutGrid11 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid11 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid11 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1,
			#pacientes_detallesLayoutGrid11 .col-2,
			#pacientes_detallesLayoutGrid11 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLine50 {
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
			#pacientes_detallesLine51 {
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
			#pacientes_detallesLine52 {
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
			#pacientes_detallesLine53 {
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
			#pacientes_detallesLine54 {
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
			
			
			#wb_turnos_detallesLayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid3 .col-1,
			#turnos_detallesLayoutGrid3 .col-2,
			#turnos_detallesLayoutGrid3 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLine6 {
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
			#turnos_detallesLine7 {
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
			#turnos_detallesLine9 {
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
			#turnos_detallesLine10 {
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
			#turnos_detallesButton4 {
				width: 96px;
				height: 25px;
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
			#wb_sintomas_detallesText1 {
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
			#wb_LayoutGrid9 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid9 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid9 {
				padding: 15px 15px 15px 15px;
			}
			#LayoutGrid9 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid9 .col-1,
			#LayoutGrid9 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid9 .col-1 {
				display: block;
				width: 50%;
				text-align: center;
			}
			#LayoutGrid9 .col-2 {
				display: block;
				width: 50%;
				text-align: center;
			}
			#wb_Text8 {
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
			#wb_FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon8 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon9 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
			}
			#FontAwesomeIcon10 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon11 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_turnos_detallesText4 {
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
			#turnos_detallesLine13 {
				height: 10px;
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
			#turnos_detallesLine15 {
				height: 12px;
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
		}
		
		@media only screen and (min-width: 800px) and (max-width: 979px) {
			div#container {
				width: 800px;
			}
			#turnos_detallesLine8 {
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
			#wb_LayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid5 {
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
			#wb_turnos_detallesLayoutGrid5 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid5 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid5 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid5 .col-1,
			#turnos_detallesLayoutGrid5 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid5 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid5 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#turnos_detallesLine14 {
				height: 10px;
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
			
			#courier_detallesLine7 {
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
			
			#tdocumento {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
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
			#wb_Text1 {
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
			#wb_FontAwesomeIcon2 {
				left: 276px;
				top: 48px;
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
			#wb_FontAwesomeIcon1 {
				left: 0px;
				top: 8px;
				width: 37px;
				height: 26px;
				visibility: visible;
				display: inline;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon1 {
				width: 37px;
				height: 26px;
			}
			#FontAwesomeIcon1 i {
				line-height: 26px;
				font-size: 26px;
			}
			#Layer1 {
				width: 37px;
				height: 38px;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Layer2 {
				width: 60px;
				height: 45px;
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
				left: 0px;
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
			
			#wb_pacientes_detallesText1 {
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
			#pacientes_detallesLine2 {
				height: 10px;
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
			#pacientes_detallesLine4 {
				height: 10px;
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
			#wb_pacientes_detallesText2 {
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
			#pacientes_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			
			#pacientes_detallesLine8 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesText3 {
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
			#pacientes_detallesLine10 {
				height: 10px;
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
			#pacientes_detallesLine12 {
				height: 10px;
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
			#wb_pacientes_detallesText4 {
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
			#pacientes_detallesLine14 {
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
			#cedula {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine16 {
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
			#pnombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText5 {
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
			#pacientes_detallesLine18 {
				height: 10px;
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
			#pacientes_detallesLine20 {
				height: 10px;
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
			#wb_pacientes_detallesText6 {
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
			#pacientes_detallesLine22 {
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
			#snombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine24 {
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
			#papellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText7 {
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
			#pacientes_detallesLine26 {
				height: 10px;
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
			#pacientes_detallesLine28 {
				height: 10px;
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
			#wb_pacientes_detallesText8 {
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
			#pacientes_detallesLine30 {
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
			#sapellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine32 {
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
			#wb_usuarios_detallesLayoutGrid7 {
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
			#wb_usuarios_detallesLayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#usuarios_detallesLayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#usuarios_detallesLayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1,
			#usuarios_detallesLayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#usuarios_detallesLayoutGrid7 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#wb_usuarios_detallesText7 {
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
			#usuarios_detallesLine23 {
				height: 10px;
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
			#usuarios_detallesLine24 {
				height: 10px;
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
			#usuarios_detallesLine25 {
				height: 12px;
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
			
			#wb_turnos_detallesLayoutGrid1 {
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
			#wb_turnos_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid1 .col-1,
			#turnos_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#wb_turnos_detallesText1 {
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
			#turnos_detallesLine1 {
				height: 10px;
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
			#turnos_detallesLine3 {
				height: 12px;
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
			#wb_courier_detallesLayoutGrid2 {
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
			#wb_courier_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#courier_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#courier_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#courier_detallesLayoutGrid2 .col-1,
			#courier_detallesLayoutGrid2 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#courier_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#courier_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#courier_detallesLine5 {
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
			#courier_detallesLine6 {
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
			#courier_detallesLine8 {
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
			#wb_turnos_detallesText3 {
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
			#wb_pacientes_detallesLayoutGrid1 {
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
			#wb_pacientes_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1,
			#pacientes_detallesLayoutGrid1 .col-2,
			#pacientes_detallesLayoutGrid1 .col-3,
			#pacientes_detallesLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid2 {
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
			#wb_pacientes_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1,
			#pacientes_detallesLayoutGrid2 .col-2,
			#pacientes_detallesLayoutGrid2 .col-3,
			#pacientes_detallesLayoutGrid2 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid3 {
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
			#wb_pacientes_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1,
			#pacientes_detallesLayoutGrid3 .col-2,
			#pacientes_detallesLayoutGrid3 .col-3,
			#pacientes_detallesLayoutGrid3 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid4 {
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
			#wb_pacientes_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1,
			#pacientes_detallesLayoutGrid4 .col-2,
			#pacientes_detallesLayoutGrid4 .col-3,
			#pacientes_detallesLayoutGrid4 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			
			#turnos_detallesLine2 {
				height: 10px;
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
			#wb_turnos_detallesLayoutGrid2 {
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
			#wb_turnos_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_turnos_detallesText2 {
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
			#turnos_detallesLine4 {
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
			#wb_LayoutGrid4 {
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
			#wb_LayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid4 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#Table1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DBDBDB;
				background-image: none;
			}
			#Table1 .cell0 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell1 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell2 {
				font-family: Verdana;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 12px;
			}
			#Table1 .cell3 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell4 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#Table1 .cell5 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell6 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#wb_FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon5 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon7 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon6 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon4 i {
				line-height: 36px;
				font-size: 36px;
			}
			#empresasEditbox2 {
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
			#empresasEditbox3 {
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
			#empresasEditbox1 {
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
			#Editbox4 {
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
			#wb_LayoutGrid7 {
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
			#wb_LayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid7 .col-1,
			#LayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid7 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#LayoutGrid7 .col-2 {
				display: none;
				text-align: left;
			}
			
			#Line16 {
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
			#Line11 {
				height: 90px;
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
			#turnos_detallesButton1 {
				width: 185px;
				height: 25px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FF0000;
				background-image: none;
				border-radius: 4px;
			}
			#turnos_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesLayoutGrid11 {
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
			#wb_pacientes_detallesLayoutGrid11 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid11 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid11 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1,
			#pacientes_detallesLayoutGrid11 .col-2,
			#pacientes_detallesLayoutGrid11 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLine50 {
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
			#pacientes_detallesLine51 {
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
			#pacientes_detallesLine52 {
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
			#pacientes_detallesLine53 {
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
			#pacientes_detallesLine54 {
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
			
			
			#wb_turnos_detallesLayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid3 .col-1,
			#turnos_detallesLayoutGrid3 .col-2,
			#turnos_detallesLayoutGrid3 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLine6 {
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
			#turnos_detallesLine7 {
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
			#turnos_detallesLine9 {
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
			#turnos_detallesLine10 {
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
			#turnos_detallesButton4 {
				width: 96px;
				height: 25px;
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
			#wb_sintomas_detallesText1 {
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
			#wb_LayoutGrid9 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid9 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid9 {
				padding: 15px 15px 15px 15px;
			}
			#LayoutGrid9 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid9 .col-1,
			#LayoutGrid9 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid9 .col-1 {
				display: block;
				width: 50%;
				text-align: center;
			}
			#LayoutGrid9 .col-2 {
				display: block;
				width: 50%;
				text-align: center;
			}
			#wb_Text8 {
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
			#wb_FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon8 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon9 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
			}
			#FontAwesomeIcon10 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon11 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_turnos_detallesText4 {
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
			#turnos_detallesLine13 {
				height: 10px;
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
			#turnos_detallesLine15 {
				height: 12px;
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
		}
		
		@media only screen and (min-width: 768px) and (max-width: 799px) {
			div#container {
				width: 768px;
			}
			#turnos_detallesLine8 {
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
			#wb_LayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid5 {
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
			#wb_turnos_detallesLayoutGrid5 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid5 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid5 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid5 .col-1,
			#turnos_detallesLayoutGrid5 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid5 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid5 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#turnos_detallesLine14 {
				height: 10px;
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
			
			#courier_detallesLine7 {
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
			
			#tdocumento {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
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
			#wb_Text1 {
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
			#wb_FontAwesomeIcon2 {
				left: 104px;
				top: 20px;
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
			#wb_FontAwesomeIcon1 {
				left: 174px;
				top: 22px;
				width: 37px;
				height: 26px;
				visibility: hidden;
				display: none;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon1 {
				width: 37px;
				height: 26px;
			}
			#FontAwesomeIcon1 i {
				line-height: 26px;
				font-size: 26px;
			}
			#Layer1 {
				width: 211px;
				height: 52px;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Layer2 {
				width: 60px;
				height: 46px;
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
				left: 0px;
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
			
			#wb_pacientes_detallesText1 {
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
			#pacientes_detallesLine2 {
				height: 10px;
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
			#pacientes_detallesLine4 {
				height: 10px;
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
			#wb_pacientes_detallesText2 {
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
			#pacientes_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			
			#pacientes_detallesLine8 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesText3 {
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
			#pacientes_detallesLine10 {
				height: 10px;
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
			#pacientes_detallesLine12 {
				height: 10px;
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
			#wb_pacientes_detallesText4 {
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
			#pacientes_detallesLine14 {
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
			#cedula {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine16 {
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
			#pnombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText5 {
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
			#pacientes_detallesLine18 {
				height: 10px;
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
			#pacientes_detallesLine20 {
				height: 10px;
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
			#wb_pacientes_detallesText6 {
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
			#pacientes_detallesLine22 {
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
			#snombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine24 {
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
			#papellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText7 {
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
			#pacientes_detallesLine26 {
				height: 10px;
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
			#pacientes_detallesLine28 {
				height: 10px;
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
			#wb_pacientes_detallesText8 {
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
			#pacientes_detallesLine30 {
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
			#sapellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine32 {
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
			#wb_usuarios_detallesLayoutGrid7 {
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
			#wb_usuarios_detallesLayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#usuarios_detallesLayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#usuarios_detallesLayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1,
			#usuarios_detallesLayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#usuarios_detallesLayoutGrid7 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#wb_usuarios_detallesText7 {
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
			#usuarios_detallesLine23 {
				height: 10px;
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
			#usuarios_detallesLine24 {
				height: 10px;
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
			#usuarios_detallesLine25 {
				height: 12px;
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
			
			#wb_turnos_detallesLayoutGrid1 {
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
			#wb_turnos_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid1 .col-1,
			#turnos_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#wb_turnos_detallesText1 {
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
			#turnos_detallesLine1 {
				height: 10px;
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
			#turnos_detallesLine3 {
				height: 12px;
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
			#wb_courier_detallesLayoutGrid2 {
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
			#wb_courier_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#courier_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#courier_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#courier_detallesLayoutGrid2 .col-1,
			#courier_detallesLayoutGrid2 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#courier_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#courier_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
			}
			#courier_detallesLine5 {
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
			#courier_detallesLine6 {
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
			#courier_detallesLine8 {
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
			#wb_turnos_detallesText3 {
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
			#wb_pacientes_detallesLayoutGrid1 {
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
			#wb_pacientes_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1,
			#pacientes_detallesLayoutGrid1 .col-2,
			#pacientes_detallesLayoutGrid1 .col-3,
			#pacientes_detallesLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid2 {
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
			#wb_pacientes_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1,
			#pacientes_detallesLayoutGrid2 .col-2,
			#pacientes_detallesLayoutGrid2 .col-3,
			#pacientes_detallesLayoutGrid2 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid3 {
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
			#wb_pacientes_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1,
			#pacientes_detallesLayoutGrid3 .col-2,
			#pacientes_detallesLayoutGrid3 .col-3,
			#pacientes_detallesLayoutGrid3 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid4 {
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
			#wb_pacientes_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1,
			#pacientes_detallesLayoutGrid4 .col-2,
			#pacientes_detallesLayoutGrid4 .col-3,
			#pacientes_detallesLayoutGrid4 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-4 {
				display: block;
				width: 16.66666667%;
				text-align: left;
			}
			
			#turnos_detallesLine2 {
				height: 10px;
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
			#wb_turnos_detallesLayoutGrid2 {
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
			#wb_turnos_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_turnos_detallesText2 {
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
			#turnos_detallesLine4 {
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
			#wb_LayoutGrid4 {
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
			#wb_LayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid4 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#Table1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DBDBDB;
				background-image: none;
			}
			#Table1 .cell0 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell1 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell2 {
				font-family: Verdana;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 12px;
			}
			#Table1 .cell3 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell4 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#Table1 .cell5 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell6 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#wb_FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon5 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon7 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon6 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon4 i {
				line-height: 36px;
				font-size: 36px;
			}
			#empresasEditbox2 {
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
			#empresasEditbox3 {
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
			#empresasEditbox1 {
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
			#Editbox4 {
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
			#wb_LayoutGrid7 {
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
			#wb_LayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid7 .col-1,
			#LayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid7 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#LayoutGrid7 .col-2 {
				display: none;
				text-align: left;
			}
			
			#Line16 {
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
			#Line11 {
				height: 90px;
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
			#turnos_detallesButton1 {
				width: 185px;
				height: 25px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FF0000;
				background-image: none;
				border-radius: 4px;
			}
			#turnos_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesLayoutGrid11 {
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
			#wb_pacientes_detallesLayoutGrid11 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid11 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid11 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1,
			#pacientes_detallesLayoutGrid11 .col-2,
			#pacientes_detallesLayoutGrid11 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#pacientes_detallesLine50 {
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
			#pacientes_detallesLine51 {
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
			#pacientes_detallesLine52 {
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
			#pacientes_detallesLine53 {
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
			#pacientes_detallesLine54 {
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
			
			
			#wb_turnos_detallesLayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid3 .col-1,
			#turnos_detallesLayoutGrid3 .col-2,
			#turnos_detallesLayoutGrid3 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 33.33333333%;
				text-align: center;
			}
			#turnos_detallesLine6 {
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
			#turnos_detallesLine7 {
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
			#turnos_detallesLine9 {
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
			#turnos_detallesLine10 {
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
			#turnos_detallesButton4 {
				width: 96px;
				height: 25px;
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
			#wb_sintomas_detallesText1 {
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
			#wb_LayoutGrid9 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid9 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid9 {
				padding: 15px 15px 15px 15px;
			}
			#LayoutGrid9 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid9 .col-1,
			#LayoutGrid9 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid9 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#LayoutGrid9 .col-2 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text8 {
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
			#wb_FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon8 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon9 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
			}
			#FontAwesomeIcon10 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon11 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_turnos_detallesText4 {
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
			#turnos_detallesLine13 {
				height: 10px;
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
			#turnos_detallesLine15 {
				height: 12px;
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
		}
		
		@media only screen and (min-width: 480px) and (max-width: 767px) {
			div#container {
				width: 480px;
			}
			#turnos_detallesLine8 {
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
			#wb_LayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid5 {
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
			#wb_turnos_detallesLayoutGrid5 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid5 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid5 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid5 .col-1,
			#turnos_detallesLayoutGrid5 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid5 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid5 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLine14 {
				height: 10px;
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
			
			#courier_detallesLine7 {
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
			
			#tdocumento {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
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
			#wb_Text1 {
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
			#wb_FontAwesomeIcon2 {
				left: 104px;
				top: -12px;
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
			#wb_FontAwesomeIcon1 {
				left: 174px;
				top: 22px;
				width: 37px;
				height: 26px;
				visibility: hidden;
				display: none;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon1 {
				width: 37px;
				height: 26px;
			}
			#FontAwesomeIcon1 i {
				line-height: 26px;
				font-size: 26px;
			}
			#Layer1 {
				width: 211px;
				height: 52px;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#Layer2 {
				width: 60px;
				height: 46px;
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
				left: 0px;
				top: 5px;
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
			
			#wb_pacientes_detallesText1 {
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
			#pacientes_detallesLine2 {
				height: 10px;
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
			#pacientes_detallesLine4 {
				height: 10px;
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
			#wb_pacientes_detallesText2 {
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
			#pacientes_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			
			#pacientes_detallesLine8 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesText3 {
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
			#pacientes_detallesLine10 {
				height: 10px;
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
			#pacientes_detallesLine12 {
				height: 10px;
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
			#wb_pacientes_detallesText4 {
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
			#pacientes_detallesLine14 {
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
			#cedula {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine16 {
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
			#pnombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText5 {
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
			#pacientes_detallesLine18 {
				height: 10px;
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
			#pacientes_detallesLine20 {
				height: 10px;
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
			#wb_pacientes_detallesText6 {
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
			#pacientes_detallesLine22 {
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
			#snombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine24 {
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
			#papellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText7 {
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
			#pacientes_detallesLine26 {
				height: 10px;
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
			#pacientes_detallesLine28 {
				height: 10px;
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
			#wb_pacientes_detallesText8 {
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
			#pacientes_detallesLine30 {
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
			#sapellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine32 {
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
			#wb_usuarios_detallesLayoutGrid7 {
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
			#wb_usuarios_detallesLayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#usuarios_detallesLayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#usuarios_detallesLayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1,
			#usuarios_detallesLayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#usuarios_detallesLayoutGrid7 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_usuarios_detallesText7 {
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
			#usuarios_detallesLine23 {
				height: 10px;
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
			#usuarios_detallesLine24 {
				height: 10px;
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
			#usuarios_detallesLine25 {
				height: 12px;
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
			
			#wb_turnos_detallesLayoutGrid1 {
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
			#wb_turnos_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid1 .col-1,
			#turnos_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_turnos_detallesText1 {
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
			#turnos_detallesLine1 {
				height: 10px;
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
			#turnos_detallesLine3 {
				height: 12px;
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
			#wb_courier_detallesLayoutGrid2 {
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
			#wb_courier_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#courier_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#courier_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#courier_detallesLayoutGrid2 .col-1,
			#courier_detallesLayoutGrid2 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#courier_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#courier_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#courier_detallesLine5 {
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
			#courier_detallesLine6 {
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
			#courier_detallesLine8 {
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
			#wb_turnos_detallesText3 {
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
			#wb_pacientes_detallesLayoutGrid1 {
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
			#wb_pacientes_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1,
			#pacientes_detallesLayoutGrid1 .col-2,
			#pacientes_detallesLayoutGrid1 .col-3,
			#pacientes_detallesLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid2 {
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
			#wb_pacientes_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1,
			#pacientes_detallesLayoutGrid2 .col-2,
			#pacientes_detallesLayoutGrid2 .col-3,
			#pacientes_detallesLayoutGrid2 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid3 {
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
			#wb_pacientes_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1,
			#pacientes_detallesLayoutGrid3 .col-2,
			#pacientes_detallesLayoutGrid3 .col-3,
			#pacientes_detallesLayoutGrid3 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid4 {
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
			#wb_pacientes_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1,
			#pacientes_detallesLayoutGrid4 .col-2,
			#pacientes_detallesLayoutGrid4 .col-3,
			#pacientes_detallesLayoutGrid4 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			
			#turnos_detallesLine2 {
				height: 10px;
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
			#wb_turnos_detallesLayoutGrid2 {
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
			#wb_turnos_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_turnos_detallesText2 {
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
			#turnos_detallesLine4 {
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
			#wb_LayoutGrid4 {
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
			#wb_LayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid4 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#Table1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DBDBDB;
				background-image: none;
			}
			#Table1 .cell0 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell1 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell2 {
				font-family: Verdana;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 12px;
			}
			#Table1 .cell3 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell4 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#Table1 .cell5 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell6 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#wb_FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon5 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon7 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon6 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon4 i {
				line-height: 36px;
				font-size: 36px;
			}
			#empresasEditbox2 {
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
			#empresasEditbox3 {
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
			#empresasEditbox1 {
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
			#Editbox4 {
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
			#wb_LayoutGrid7 {
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
			#wb_LayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid7 .col-1,
			#LayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid7 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#LayoutGrid7 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			
			#Line16 {
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
			#Line11 {
				height: 90px;
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
			#turnos_detallesButton1 {
				width: 185px;
				height: 25px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FF0000;
				background-image: none;
				border-radius: 4px;
			}
			#turnos_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesLayoutGrid11 {
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
			#wb_pacientes_detallesLayoutGrid11 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid11 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid11 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1,
			#pacientes_detallesLayoutGrid11 .col-2,
			#pacientes_detallesLayoutGrid11 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-2 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-3 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#pacientes_detallesLine50 {
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
			#pacientes_detallesLine51 {
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
			#pacientes_detallesLine52 {
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
			#pacientes_detallesLine53 {
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
			#pacientes_detallesLine54 {
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
			
			
			
			#wb_turnos_detallesLayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid3 .col-1,
			#turnos_detallesLayoutGrid3 .col-2,
			#turnos_detallesLayoutGrid3 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#turnos_detallesLine6 {
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
			#turnos_detallesLine7 {
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
			#turnos_detallesLine9 {
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
			#turnos_detallesLine10 {
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
			#turnos_detallesButton4 {
				width: 96px;
				height: 25px;
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
			#wb_sintomas_detallesText1 {
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
			#wb_LayoutGrid9 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid9 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid9 {
				padding: 15px 15px 15px 15px;
			}
			#LayoutGrid9 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid9 .col-1,
			#LayoutGrid9 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid9 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#LayoutGrid9 .col-2 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text8 {
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
			#wb_FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon8 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon9 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
			}
			#FontAwesomeIcon10 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon11 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_turnos_detallesText4 {
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
			#turnos_detallesLine13 {
				height: 10px;
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
			#turnos_detallesLine15 {
				height: 12px;
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
		}
		
		@media only screen and (max-width: 479px) {
			div#container {
				width: 320px;
			}
			#turnos_detallesLine8 {
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
			#wb_LayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid5 {
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
			#wb_turnos_detallesLayoutGrid5 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid5 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid5 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid5 .col-1,
			#turnos_detallesLayoutGrid5 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid5 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid5 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLine14 {
				height: 10px;
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
			
			#courier_detallesLine7 {
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
			
			#tdocumento {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#Line9 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
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
			#wb_Text1 {
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
			#wb_FontAwesomeIcon2 {
				left: 107px;
				top: -31px;
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
			#wb_FontAwesomeIcon1 {
				left: 174px;
				top: 22px;
				width: 37px;
				height: 26px;
				visibility: hidden;
				display: none;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon1 {
				width: 37px;
				height: 26px;
			}
			#FontAwesomeIcon1 i {
				line-height: 26px;
				font-size: 26px;
			}
			#Layer1 {
				width: 211px;
				height: 52px;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
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
			
			#wb_pacientes_detallesText1 {
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
			#pacientes_detallesLine2 {
				height: 10px;
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
			#pacientes_detallesLine4 {
				height: 10px;
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
			#wb_pacientes_detallesText2 {
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
			#pacientes_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			
			#pacientes_detallesLine8 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesText3 {
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
			#pacientes_detallesLine10 {
				height: 10px;
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
			#pacientes_detallesLine12 {
				height: 10px;
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
			#wb_pacientes_detallesText4 {
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
			#pacientes_detallesLine14 {
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
			#cedula {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine16 {
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
			#pnombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText5 {
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
			#pacientes_detallesLine18 {
				height: 10px;
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
			#pacientes_detallesLine20 {
				height: 10px;
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
			#wb_pacientes_detallesText6 {
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
			#pacientes_detallesLine22 {
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
			#snombre {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine24 {
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
			#papellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#wb_pacientes_detallesText7 {
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
			#pacientes_detallesLine26 {
				height: 10px;
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
			#pacientes_detallesLine28 {
				height: 10px;
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
			#wb_pacientes_detallesText8 {
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
			#pacientes_detallesLine30 {
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
			#sapellido {
				visibility: visible;
				display: block;
				color: #000000;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DCDCDC;
				background-image: none;
				border-radius: 4px;
			}
			#pacientes_detallesLine32 {
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
			#wb_usuarios_detallesLayoutGrid7 {
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
			#wb_usuarios_detallesLayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#usuarios_detallesLayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#usuarios_detallesLayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1,
			#usuarios_detallesLayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#usuarios_detallesLayoutGrid7 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#usuarios_detallesLayoutGrid7 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_usuarios_detallesText7 {
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
			#usuarios_detallesLine23 {
				height: 10px;
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
			#usuarios_detallesLine24 {
				height: 10px;
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
			#usuarios_detallesLine25 {
				height: 12px;
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
			
			#wb_turnos_detallesLayoutGrid1 {
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
			#wb_turnos_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid1 .col-1,
			#turnos_detallesLayoutGrid1 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#turnos_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_turnos_detallesText1 {
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
			#turnos_detallesLine1 {
				height: 10px;
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
			#turnos_detallesLine3 {
				height: 12px;
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
			#wb_courier_detallesLayoutGrid2 {
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
			#wb_courier_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#courier_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#courier_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#courier_detallesLayoutGrid2 .col-1,
			#courier_detallesLayoutGrid2 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#courier_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#courier_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#courier_detallesLine5 {
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
			#courier_detallesLine6 {
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
			#courier_detallesLine8 {
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
			#wb_turnos_detallesText3 {
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
			#wb_pacientes_detallesLayoutGrid1 {
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
			#wb_pacientes_detallesLayoutGrid1 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid1 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid1 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1,
			#pacientes_detallesLayoutGrid1 .col-2,
			#pacientes_detallesLayoutGrid1 .col-3,
			#pacientes_detallesLayoutGrid1 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid1 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid1 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid2 {
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
			#wb_pacientes_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1,
			#pacientes_detallesLayoutGrid2 .col-2,
			#pacientes_detallesLayoutGrid2 .col-3,
			#pacientes_detallesLayoutGrid2 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid2 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid3 {
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
			#wb_pacientes_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1,
			#pacientes_detallesLayoutGrid3 .col-2,
			#pacientes_detallesLayoutGrid3 .col-3,
			#pacientes_detallesLayoutGrid3 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid3 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#wb_pacientes_detallesLayoutGrid4 {
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
			#wb_pacientes_detallesLayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1,
			#pacientes_detallesLayoutGrid4 .col-2,
			#pacientes_detallesLayoutGrid4 .col-3,
			#pacientes_detallesLayoutGrid4 .col-4 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-3 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#pacientes_detallesLayoutGrid4 .col-4 {
				display: block;
				width: 100%;
				text-align: left;
			}
			
			#turnos_detallesLine2 {
				height: 10px;
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
			#wb_turnos_detallesLayoutGrid2 {
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
			#wb_turnos_detallesLayoutGrid2 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid2 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid2 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid2 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_turnos_detallesText2 {
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
			#turnos_detallesLine4 {
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
			#wb_LayoutGrid4 {
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
			#wb_LayoutGrid4 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid4 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid4 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid4 .col-1 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid4 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#Table1 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #DBDBDB;
				background-image: none;
			}
			#Table1 .cell0 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell1 {
				font-family: Arial;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 13px;
			}
			#Table1 .cell2 {
				font-family: Verdana;
				font-weight: normal;
				font-size: 11px;
				text-align: center;
				line-height: 12px;
			}
			#Table1 .cell3 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell4 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#Table1 .cell5 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: center;
				line-height: 16px;
			}
			#Table1 .cell6 {
				font-family: Arial;
				font-weight: normal;
				font-size: 13px;
				text-align: left;
				line-height: 16px;
			}
			#wb_FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon5 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon5 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
				visibility: visible;
				display: inline-block;
				color: #2E8B57;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon7 {
				width: 41px;
				height: 34px;
			}
			#FontAwesomeIcon7 i {
				line-height: 34px;
				font-size: 34px;
			}
			#wb_FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon6 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon6 i {
				line-height: 36px;
				font-size: 36px;
			}
			#wb_FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
				visibility: visible;
				display: inline-block;
				color: #FF0000;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon4 {
				width: 41px;
				height: 36px;
			}
			#FontAwesomeIcon4 i {
				line-height: 36px;
				font-size: 36px;
			}
			#empresasEditbox2 {
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
			#empresasEditbox3 {
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
			#empresasEditbox1 {
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
			#Editbox4 {
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
			#wb_LayoutGrid7 {
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
			#wb_LayoutGrid7 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid7 {
				padding: 0px 15px 0px 15px;
			}
			#LayoutGrid7 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid7 .col-1,
			#LayoutGrid7 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid7 .col-1 {
				display: block;
				width: 100%;
				text-align: left;
			}
			#LayoutGrid7 .col-2 {
				display: block;
				width: 100%;
				text-align: left;
			}
			
			#Line16 {
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
			#Line11 {
				height: 90px;
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
			#turnos_detallesButton1 {
				width: 185px;
				height: 25px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FF0000;
				background-image: none;
				border-radius: 4px;
			}
			#turnos_detallesLine5 {
				height: 13px;
				visibility: visible;
				display: block;
				color: #FFFFFF;
				font-size: 13px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #FFFFFF;
				background-image: none;
			}
			#wb_pacientes_detallesLayoutGrid11 {
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
			#wb_pacientes_detallesLayoutGrid11 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#pacientes_detallesLayoutGrid11 {
				padding: 0px 15px 0px 15px;
			}
			#pacientes_detallesLayoutGrid11 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1,
			#pacientes_detallesLayoutGrid11 .col-2,
			#pacientes_detallesLayoutGrid11 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#pacientes_detallesLayoutGrid11 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-2 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#pacientes_detallesLayoutGrid11 .col-3 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#pacientes_detallesLine50 {
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
			#pacientes_detallesLine51 {
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
			#pacientes_detallesLine52 {
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
			#pacientes_detallesLine53 {
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
			#pacientes_detallesLine54 {
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
			
			
			
			#wb_turnos_detallesLayoutGrid3 {
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
			#wb_turnos_detallesLayoutGrid3 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#turnos_detallesLayoutGrid3 {
				padding: 0px 15px 0px 15px;
			}
			#turnos_detallesLayoutGrid3 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#turnos_detallesLayoutGrid3 .col-1,
			#turnos_detallesLayoutGrid3 .col-2,
			#turnos_detallesLayoutGrid3 .col-3 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#turnos_detallesLayoutGrid3 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-2 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#turnos_detallesLayoutGrid3 .col-3 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#turnos_detallesLine6 {
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
			#turnos_detallesLine7 {
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
			#turnos_detallesLine9 {
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
			#turnos_detallesLine10 {
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
			#turnos_detallesButton4 {
				width: 96px;
				height: 25px;
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
			#wb_sintomas_detallesText1 {
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
			#wb_LayoutGrid9 {
				visibility: visible;
				display: table;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: #9FB6C0;
				background-image: none;
			}
			#wb_LayoutGrid9 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
			#LayoutGrid9 {
				padding: 15px 15px 15px 15px;
			}
			#LayoutGrid9 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
			#LayoutGrid9 .col-1,
			#LayoutGrid9 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
			#LayoutGrid9 .col-1 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#LayoutGrid9 .col-2 {
				display: block;
				width: 100%;
				text-align: center;
			}
			#wb_Text8 {
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
			#wb_FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon8 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon8 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon9 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon9 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon10 {
				width: 32px;
				height: 22px;
			}
			#FontAwesomeIcon10 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
				visibility: visible;
				display: inline-block;
				color: #FFFFFF;
				font-size: 8px;
				font-family: Arial;
				font-weight: normal;
				font-style: normal;
				text-decoration: none;
				background-color: transparent;
				background-image: none;
			}
			#FontAwesomeIcon11 {
				width: 22px;
				height: 22px;
			}
			#FontAwesomeIcon11 i {
				line-height: 22px;
				font-size: 22px;
			}
			#wb_turnos_detallesText4 {
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
			#turnos_detallesLine13 {
				height: 10px;
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
			#turnos_detallesLine15 {
				height: 12px;
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
		}
		
		#wb_ordenes_detallesLayoutGrid2 {
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
		#ordenes_detallesLayoutGrid2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#ordenes_detallesLayoutGrid2 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#ordenes_detallesLayoutGrid2 .col-1, #ordenes_detallesLayoutGrid2 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#ordenes_detallesLayoutGrid2 .col-1, #ordenes_detallesLayoutGrid2 .col-2 {
			float: left;
		}
		#ordenes_detallesLayoutGrid2 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		#ordenes_detallesLayoutGrid2 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		#ordenes_detallesLayoutGrid2:before, #ordenes_detallesLayoutGrid2:after, #ordenes_detallesLayoutGrid2 .row:before, #ordenes_detallesLayoutGrid2 .row:after {
			display: table;
			content: " ";
		}
		#ordenes_detallesLayoutGrid2:after, #ordenes_detallesLayoutGrid2 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#ordenes_detallesLayoutGrid2 .col-1, #ordenes_detallesLayoutGrid2 .col-2 {
			float: none;
			width: 100%;
		}
		}
		#wb_ordenes_detallesText2 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		#wb_ordenes_detallesText2 div {
			text-align: left;
		}
		#ordenes_detallesLine4 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine5 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine6 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#fechasal {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-image: none;
			color : #000000;
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
		#fechasal:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#fechasal {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 70;
		}
		#fechasal {
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
		#wb_ordenes_detallesLayoutGrid3 {
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
		#ordenes_detallesLayoutGrid3 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#ordenes_detallesLayoutGrid3 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#ordenes_detallesLayoutGrid3 .col-1, #ordenes_detallesLayoutGrid3 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#ordenes_detallesLayoutGrid3 .col-1, #ordenes_detallesLayoutGrid3 .col-2 {
			float: left;
		}
		#ordenes_detallesLayoutGrid3 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		#ordenes_detallesLayoutGrid3 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		#ordenes_detallesLayoutGrid3:before, #ordenes_detallesLayoutGrid3:after, #ordenes_detallesLayoutGrid3 .row:before, #ordenes_detallesLayoutGrid3 .row:after {
			display: table;
			content: " ";
		}
		#ordenes_detallesLayoutGrid3:after, #ordenes_detallesLayoutGrid3 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#ordenes_detallesLayoutGrid3 .col-1, #ordenes_detallesLayoutGrid3 .col-2 {
			float: none;
			width: 100%;
		}
		}
		#wb_ordenes_detallesText3 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		#wb_ordenes_detallesText3 div {
			text-align: left;
		}
		#ordenes_detallesLine7 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine8 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine9 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#horasal {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-image: none;
			color : #000000;
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
		#horasal:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#horasal {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 75;
		}
		#horasal {
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
		#wb_listas_ordenesLayoutGrid5 {
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
		#listas_ordenesLayoutGrid5 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#listas_ordenesLayoutGrid5 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#listas_ordenesLayoutGrid5 .col-1, #listas_ordenesLayoutGrid5 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#listas_ordenesLayoutGrid5 .col-1, #listas_ordenesLayoutGrid5 .col-2 {
			float: left;
		}
		#listas_ordenesLayoutGrid5 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		#listas_ordenesLayoutGrid5 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		#listas_ordenesLayoutGrid5:before, #listas_ordenesLayoutGrid5:after, #listas_ordenesLayoutGrid5 .row:before, #listas_ordenesLayoutGrid5 .row:after {
			display: table;
			content: " ";
		}
		#listas_ordenesLayoutGrid5:after, #listas_ordenesLayoutGrid5 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#listas_ordenesLayoutGrid5 .col-1, #listas_ordenesLayoutGrid5 .col-2 {
			float: none;
			width: 100%;
		}
		}
		#wb_listas_ordenesText5 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		#wb_listas_ordenesText5 div {
			text-align: left;
		}
		#listas_ordenesLine15 {
			color: #FFFFFF;

			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#listas_ordenesLine16 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#listas_ordenesLine17 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#listas_ordenesTable2 {
			border: 0px #C0C0C0 solid;
			background-color: transparent;
			background-image: none;
			border-collapse: separate;
			border-spacing: 2px;
		}
		#listas_ordenesTable2 td {
			padding: 2px 2px 2px 2px;
		}
		#listas_ordenesTable2 .cell0 {
			background-color: transparent;
			background-image: none;
			text-align: left;
			vertical-align: middle;
			font-size: 0;
		}
		#listas_ordenesTable2 .cell1 {
			background-color: transparent;
			background-image: none;
			text-align: left;
			vertical-align: middle;
			font-family: Arial;
			font-size: 13px;
			line-height: 16px;
		}
		#wb_listas_ordenesCheckbox3 {
			position: relative;
		}
		#wb_listas_ordenesCheckbox3, #wb_listas_ordenesCheckbox3 *, #wb_listas_ordenesCheckbox3 *::before, #wb_listas_ordenesCheckbox3 *::after {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		#wb_listas_ordenesCheckbox3 input[type='checkbox'] {
			position: absolute;
			padding: 0;
			margin: 0;
			opacity: 0;
			z-index: 1;
			width: 18px;
			height: 18px;
			left: 0;
			top: 0;
		}
		#wb_listas_ordenesCheckbox3 label {
			display: inline-block;
			vertical-align: middle;
			position: absolute;
			left: 0;
			top: 0;
			width: 0;
			height: 0;
			padding: 0;
		}
		#wb_listas_ordenesCheckbox3 label::before {
			content: "";
			display: inline-block;
			position: absolute;
			width: 18px;
			height: 18px;
			left: 0;
			top: 0;
			background-color: #FFFFFF;
			border: 1px #CCCCCC solid;
			border-radius: 4px;
		}
		#wb_listas_ordenesCheckbox3 label::after {
			display: inline-block;
			position: absolute;
			width: 18px;
			height: 18px;
			left: 0;
			top: 0;
			padding: 0;
			text-align: center;
			line-height: 18px;
		}
		#wb_listas_ordenesCheckbox3 input[type='checkbox']:checked + label::after {
			content: " ";
			background: url('data:image/svg+xml,%3Csvg%20height%3D%2218%22%20width%3D%2218%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20style%3D%22fill%3A%23FFFFFF%22%20transform%3D%22scale%280.01%29%22%3E%0D%0A%3Cpath%20transform%3D%22rotate%28180%29%20scale%28-1%2C1%29%20translate%280%2C-1536%29%22%20d%3D%22M1671%20970q0%20-40%20-28%20-68l-724%20-724l-136%20-136q-28%20-28%20-68%20-28t-68%2028l-136%20136l-362%20362q-28%2028%20-28%2068t28%2068l136%20136q28%2028%2068%2028t68%20-28l294%20-295l656%20657q28%2028%2068%2028t68%20-28l136%20-136q28%20-28%2028%20-68z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E') no-repeat center center;
			background-size: 80% 80%
		}
		#wb_listas_ordenesCheckbox3 input[type='checkbox']:checked + label::before {
			background-color: #3370B7;
			background-image: none;
			border-color: #3370B7;
		}
		#wb_listas_ordenesCheckbox3 input[type='checkbox']:focus + label::before {
			outline: thin dotted;
		}
		#wb_ordenes_detallesLayoutGrid4 {
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
		#ordenes_detallesLayoutGrid4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#ordenes_detallesLayoutGrid4 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#ordenes_detallesLayoutGrid4 .col-1, #ordenes_detallesLayoutGrid4 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#ordenes_detallesLayoutGrid4 .col-1, #ordenes_detallesLayoutGrid4 .col-2 {
			float: left;
		}
		#ordenes_detallesLayoutGrid4 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		#ordenes_detallesLayoutGrid4 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: center;
		}
		#ordenes_detallesLayoutGrid4:before, #ordenes_detallesLayoutGrid4:after, #ordenes_detallesLayoutGrid4 .row:before, #ordenes_detallesLayoutGrid4 .row:after {
			display: table;
			content: " ";
		}
		#ordenes_detallesLayoutGrid4:after, #ordenes_detallesLayoutGrid4 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#ordenes_detallesLayoutGrid4 .col-1, #ordenes_detallesLayoutGrid4 .col-2 {
			float: none;
			width: 100%;
		}
		}
		#wb_ordenes_detallesText4 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		#wb_ordenes_detallesText4 div {
			text-align: left;
		}
		#ordenes_detallesLine10 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine11 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine12 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#nomedico {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
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
		#nomedico:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#nomedico {
			display: block;
			width: 100%;
			height: 28px;
			z-index: 90;
		}
		#nomedico {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		#ordenes_detallesButton1 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #FF0000;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		#ordenes_detallesButton1 {
			width: 114px;
			height: 25px;
			visibility: visible;
			display: inline-block;
			color: #FFFFFF;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FF0000;
			background-image: none;
			border-radius: 4px;
		}
		#ordenes_detallesButton1 {
	display: inline-block;
	width: 244px;
	height: 25px;
	z-index: 87;
}
		#ordenes_detallesLine13 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#wb_ordenes_detallesLayoutGrid5 {
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
		#ordenes_detallesLayoutGrid5 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#ordenes_detallesLayoutGrid5 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#ordenes_detallesLayoutGrid5 .col-1, #ordenes_detallesLayoutGrid5 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#ordenes_detallesLayoutGrid5 .col-1, #ordenes_detallesLayoutGrid5 .col-2 {
			float: left;
		}
		#ordenes_detallesLayoutGrid5 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		#ordenes_detallesLayoutGrid5 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		#ordenes_detallesLayoutGrid5:before, #ordenes_detallesLayoutGrid5:after, #ordenes_detallesLayoutGrid5 .row:before, #ordenes_detallesLayoutGrid5 .row:after {
			display: table;
			content: " ";
		}
		#ordenes_detallesLayoutGrid5:after, #ordenes_detallesLayoutGrid5 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#ordenes_detallesLayoutGrid5 .col-1, #ordenes_detallesLayoutGrid5 .col-2 {
			float: none;
			width: 100%;
		}
		}
		#wb_ordenes_detallesText5 {
			background-color: transparent;
			background-image: none;
			visibility: visible;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		#wb_ordenes_detallesText5 div {
			text-align: left;
		}
		#ordenes_detallesLine14 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine15 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesLine16 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#ordenes_detallesButton2 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #FF0000;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		#ordenes_detallesButton2 {
			display: inline-block;
			width: 244px;
			height: 25px;
			z-index: 101;
		}
		#ordenes_detallesButton2 {
			width: 244px;
			height: 25px;
			visibility: visible;
			display: inline-block;
			color: #FFFFFF;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FF0000;
			background-image: none;
			border-radius: 4px;
		}
		
		#archivo {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color: #555555;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		#archivo {
			display: block;
			width: 100%;
			height: 16px;
			line-height: 16px;
			z-index: 98;
		}
		#archivo {
			width: 284px;
			height: 16px;
			visibility: visible;
			display: inline-block;
			color: #555555;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FFFFFF;
			background-image: none;
			border-radius: 4px;
		}
		#wb_listas_ordenesLayoutGrid6 {
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
		#listas_ordenesLayoutGrid6 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#listas_ordenesLayoutGrid6 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#listas_ordenesLayoutGrid6 .col-1, #listas_ordenesLayoutGrid6 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#listas_ordenesLayoutGrid6 .col-1, #listas_ordenesLayoutGrid6 .col-2 {
			float: left;
		}
		#listas_ordenesLayoutGrid6 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		#listas_ordenesLayoutGrid6 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		#listas_ordenesLayoutGrid6:before, #listas_ordenesLayoutGrid6:after, #listas_ordenesLayoutGrid6 .row:before, #listas_ordenesLayoutGrid6 .row:after {
			display: table;
			content: " ";
		}
		#listas_ordenesLayoutGrid6:after, #listas_ordenesLayoutGrid6 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#listas_ordenesLayoutGrid6 .col-1, #listas_ordenesLayoutGrid6 .col-2 {
			float: none;
			width: 100%;
		}
		}
		#listas_ordenesLine18 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#listas_ordenesLine19 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#listas_ordenesLine20 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		
		#ordenes_detallesEditbox1 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color : #000000;
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
		#ordenes_detallesEditbox1:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		
		#ordenes_detallesEditbox1 {
			display: block;
			width: 100%;
			height: 31px;
			line-height: 31px;
			z-index: 15;
		}
		
		#ordenes_detallesEditbox1 {
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
		
		#ordenes_detallesButton3 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #FF0000;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#ordenes_detallesButton3 {
			display: inline-block;
			width: 236px;
			height: 25px;
			z-index: 95;
		}
		
		#ordenes_detallesButton3 {
			width: 236px;
			height: 25px;
			visibility: visible;
			display: inline-block;
			color: #FFFFFF;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FF0000;
			background-image: none;
			border-radius: 4px;
		}
		
		#wb_empresas_detallesLayoutGrid8 {
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
		#empresas_detallesLayoutGrid8 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#empresas_detallesLayoutGrid8 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2 {
			float: left;
		}
		#empresas_detallesLayoutGrid8 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 33.33333333%;
			text-align: left;
		}
		#empresas_detallesLayoutGrid8 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 66.66666667%;
			text-align: left;
		}
		#empresas_detallesLayoutGrid8:before, #empresas_detallesLayoutGrid8:after, #empresas_detallesLayoutGrid8 .row:before, #empresas_detallesLayoutGrid8 .row:after {
			display: table;
			content: " ";
		}
		#empresas_detallesLayoutGrid8:after, #empresas_detallesLayoutGrid8 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2 {
			float: none;
			width: 100%;
		}
		}
		
		#obs {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #FFFFFF;
			background-image: none;
			color : #000000;
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
		#obs:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#obs {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 150;
		}
		#obs {
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
		
		#Button2 {
			width: 120px;
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
		
		#Button2 {
			display: inline-block;
			width: 120px;
			height: 25px;
			z-index: 90;
		}
		
		#Button2 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		#wb_resultados_detallesLayoutGrid5 {
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
		#resultados_detallesLayoutGrid5 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#resultados_detallesLayoutGrid5 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#resultados_detallesLayoutGrid5 .col-1, #resultados_detallesLayoutGrid5 .col-2, #resultados_detallesLayoutGrid5 .col-3, #resultados_detallesLayoutGrid5 .col-4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#resultados_detallesLayoutGrid5 .col-1, #resultados_detallesLayoutGrid5 .col-2, #resultados_detallesLayoutGrid5 .col-3, #resultados_detallesLayoutGrid5 .col-4 {
			float: left;
		}
		#resultados_detallesLayoutGrid5 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid5 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid5 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid5 .col-4 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid5:before, #resultados_detallesLayoutGrid5:after, #resultados_detallesLayoutGrid5 .row:before, #resultados_detallesLayoutGrid5 .row:after {
			display: table;
			content: " ";
		}
		#resultados_detallesLayoutGrid5:after, #resultados_detallesLayoutGrid5 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#resultados_detallesLayoutGrid5 .col-1, #resultados_detallesLayoutGrid5 .col-2, #resultados_detallesLayoutGrid5 .col-3, #resultados_detallesLayoutGrid5 .col-4 {
			float: none;
			width: 100%;
		}
		}
		#resultados_detallesButton1 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		
		#resultados_detallesButton1 {
			display: inline-block;
			width: 96px;
			height: 25px;
			z-index: 112;
		}
		
		#resultados_detallesButton1 {
			width: 96px;
			height: 25px;
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
		
		#wb_resultados_detallesText4 {
			background-color: transparent;
			background-image: none;
			border: 0px #000000 solid;
			padding: 0;
			margin: 0;
			text-align: left;
		}
		#wb_resultados_detallesText4 div {
			text-align: left;
		}
		#wb_resultados_detallesText4 {
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
		
		#codusu1 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#codusu1:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#codusu1 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 114;
		}
		#codusu1 {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		
		#fechaval {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#fechaval:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#fechaval {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 116;
		}
		#fechaval {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		
		#horaval {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#horaval:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#horaval {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		#horaval {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 118;
		}
		
		#codusu2 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#codusu2:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#codusu2 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 114;
		}
		#codusu2 {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		
		#fechareval {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#fechareval:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#fechareval {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 116;
		}
		#fechareval {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		
		#horareval {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#horareval:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#horareval {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		#horareval {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 118;
		}
		
		#codusu3 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#codusu3:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#codusu3 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 114;
		}
		#codusu3 {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		
		#fechaanul {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#fechaanul:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#fechaanul {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 116;
		}
		#fechaanul {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		
		#horaanul {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#horaanul:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#horaanul {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		#horaanul {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 118;
		}
		
		#resultados_detallesButton2 {
			border: 1px #2E6DA4 solid;
			border-radius: 4px;
			background-color: #3370B7;
			background-image: none;
			color: #FFFFFF;
			font-family: Arial;
			font-weight: normal;
			font-size: 13px;
		}
		#resultados_detallesButton2 {
			display: inline-block;
			width: 96px;
			height: 25px;
			z-index: 120;
		}
		#resultados_detallesButton2 {
			width: 96px;
			height: 25px;
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
		#resultados_detallesEditbox5 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#resultados_detallesEditbox5:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#resultados_detallesEditbox6 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#resultados_detallesEditbox6:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#resultados_detallesEditbox7 {
			border: 1px #CCCCCC solid;
			border-radius: 4px;
			background-color: #DCDCDC;
			background-image: none;
			color : #000000;
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
		#resultados_detallesEditbox7:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
			outline: 0;
		}
		#resultados_detallesEditbox5 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 122;
		}
		#resultados_detallesEditbox6 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 124;
		}
		#resultados_detallesEditbox7 {
			display: block;
			width: 100%;
			height: 26px;
			line-height: 26px;
			z-index: 126;
		}
		#resultados_detallesEditbox5 {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		#resultados_detallesEditbox6 {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		#resultados_detallesEditbox7 {
			visibility: visible;
			display: block;
			color: #000000;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #DCDCDC;
			background-image: none;
			border-radius: 4px;
		}
		#resultados_detallesLine18 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#resultados_detallesLine18 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 111;
		}
		#resultados_detallesLine18 {
			height: 13px;
			visibility: visible;
			display: block;
			color: #FFFFFF;
			font-size: 13px;
			font-family: Arial;
			font-weight: normal;
			font-style: normal;
			text-decoration: none;
			background-color: #FFFFFF;
			background-image: none;
		}
		#wb_resultados_detallesLayoutGrid8 {
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
		#resultados_detallesLayoutGrid8 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#resultados_detallesLayoutGrid8 .row {
			margin-right: -15px;
			margin-left: -15px;
		}
		#resultados_detallesLayoutGrid8 .col-1, #resultados_detallesLayoutGrid8 .col-2, #resultados_detallesLayoutGrid8 .col-3, #resultados_detallesLayoutGrid8 .col-4 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		#resultados_detallesLayoutGrid8 .col-1, #resultados_detallesLayoutGrid8 .col-2, #resultados_detallesLayoutGrid8 .col-3, #resultados_detallesLayoutGrid8 .col-4 {
			float: left;
		}
		#resultados_detallesLayoutGrid8 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid8 .col-2 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid8 .col-3 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid8 .col-4 {
			background-color: transparent;
			background-image: none;
			width: 25%;
			text-align: left;
		}
		#resultados_detallesLayoutGrid8:before, #resultados_detallesLayoutGrid8:after, #resultados_detallesLayoutGrid8 .row:before, #resultados_detallesLayoutGrid8 .row:after {
			display: table;
			content: " ";
		}
		#resultados_detallesLayoutGrid8:after, #resultados_detallesLayoutGrid8 .row:after {
			clear: both;
		}

		@media (max-width: 480px) {
		#resultados_detallesLayoutGrid8 .col-1, #resultados_detallesLayoutGrid8 .col-2, #resultados_detallesLayoutGrid8 .col-3, #resultados_detallesLayoutGrid8 .col-4 {
			float: none;
			width: 100%;
		}
		}
		
		#resultados_detallesLine21 {
			color: #FFFFFF;
			background-color: #FFFFFF;
			border-width: 0;
			margin: 0;
			padding: 0;
		}
		#resultados_detallesLine21 {
			display: block;
			width: 100%;
			height: 13px;
			z-index: 135;
		}
		#resultados_detallesLine21 {
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
	</style>

	<script src="jquery-1.12.4.min.js"></script>
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
	<script>
		$( function () {
			var lastsel2;

			jQuery( "#listamicroorganismo" ).jqGrid( {
				url: 'datosmicroorganismo.php?nordentra=<?php echo $nordentra; ?>&codservicio=<?php echo $codservicio; ?>&nroestudio=<?php echo $nroestudio; ?>&nroorden=<?php echo $nroorden; ?>',
				datatype: 'json',
				mtype: 'GET',
				loadonce: true,
				height: 200,
				recordpos: 'left',
				pagerpos: 'right',

				gridview: true,

				colNames: ['Revisar', 'Borrar', 'Estudio Micro', 'Estudio', 'Resultado', 'Microorganismo', 'Antibiograma', 'Observaci&oacute;n'],
				colModel: [ {
					name: 'modificar',
					width: 60,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "50"
					},
					search: false
				}, {
					name: 'borrar',
					width: 60,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "50"
					},
					search: false
				}, {
					name: 'nomestudiobio',
					index: 'nomestudiobio',
					width: 200,
		
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 80,
							size: 80,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'nomestudio',
					index: 'nomestudio',
					width: 250,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 80,
							size: 100,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'resultado',
					index: "resultado",
					width: 300,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 100,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'nommicroorg',
					index: 'nommicroorg',
					width: 200,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 80,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				},
				{
					name: 'nomantibiogr',
					index: 'nomantibiogr',
					width: 200,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 80,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				},
				{
					name: 'obs',
					index: 'obs',
					width: 200,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 80,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}
				],

				caption: "Microorganismo",
				ignoreCase: true,
				pager: '#perpage',
				rowNum: 7,
				rowList: [ 7, 15, 30 ],

				sortname: 'nomestudiobio',
				sortorder: 'asc',
				viewrecords: true,
				editable: true,
			
				loadComplete: function () {
					$( "tr.jqgrow:odd" ).css( "background", "#FAFAFA" ).css( "margin-bottom", "0 solid" );
				},

				shrinkToFit: true, // well, it's 'true' by default

				beforeRequest: function () {
					responsive_jqgrid( $( ".jqGrid" ) );
				}

			} );

			grid = $( "#listamicroorganismo" );

			jQuery( "#listamicroorganismo" ).jqGrid( 'setFrozenColumns' );

			jQuery( "#listamicroorganismo" ).jqGrid( 'filterToolbar', {
				stringResult: true,
				searchOnEnter: false,
				defaultSearch: "cn"
			} );

			
			function responsive_jqgrid( jqgrid ) {
				jqgrid.find( '.ui-jqgrid' ).addClass( 'clear-margin span12' ).css( 'width', '' );
				jqgrid.find( '.ui-jqgrid-view' ).addClass( 'clear-margin span12' ).css( 'width', '' );
				jqgrid.find( '.ui-jqgrid-view > div' ).eq( 1 ).addClass( 'clear-margin span12' ).css( 'width', '' ).css( 'min-height', '0' );
				jqgrid.find( '.ui-jqgrid-view > div' ).eq( 2 ).addClass( 'clear-margin span12' ).css( 'width', '' ).css( 'min-height', '0' );
				jqgrid.find( '.ui-jqgrid-sdiv' ).addClass( 'clear-margin span12' ).css( 'width', '' );
				jqgrid.find( '.ui-jqgrid-pager' ).addClass( 'clear-margin span12' ).css( 'width', '' );
			}

		} );
		
		$( function () {
			var lastsel2;

			jQuery( "#listaantibioticos" ).jqGrid( {
				url: 'datosantibiotico.php?nordentra=<?php echo $nordentra; ?>&codservicio=<?php echo $codservicio; ?>&nroestudio=<?php echo $nroestudio; ?>&nroorden=<?php echo $nroorden; ?>',
				datatype: 'json',
				mtype: 'GET',
				loadonce: true,
				height: 200,
				recordpos: 'left',
				pagerpos: 'right',

				gridview: true,

				colNames: ['Revisar', 'Borrar', 'Antibiotico', 'Resultado', 'Diametro', 'CMI', 'Observaci&oacute;n'],
				colModel: [ {
					name: 'modificar',
					width: 60,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "50"
					},
					search: false
				}, {
					name: 'borrar',
					width: 60,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "50"
					},
					search: false
				}, {
					name: 'nomantibiot',
					index: 'nomantibiot',
					width: 300,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 100,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'resultado',
					index: 'resultado',
					width: 300,
				
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 100,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'diametro',
					index: "diametro",
					width: 80,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 80,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				},
				{
					name: 'cmi',
					index: "cmi",
					width: 200,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 100,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				},
				{
					name: 'obs',
					index: 'obs',
					width: 200,
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 80,
							size: 100,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}],

				caption: "Antibioticos",
				ignoreCase: true,
				pager: '#perpage1',
				rowNum: 7,
				rowList: [ 7, 15, 30 ],

				sortname: 'nomantibiot',
				sortorder: 'asc',
				viewrecords: true,
				editable: true,
			
				loadComplete: function () {
					$( "tr.jqgrow:odd" ).css( "background", "#FAFAFA" ).css( "margin-bottom", "0 solid" );
				},
				autowidth: true,
				shrinkToFit: false, // well, it's 'true' by default
				forceFit:true,
				beforeRequest: function () {
					responsive_jqgrid( $( ".jqGrid" ) );
				}

			} );

			grid = $( "#listaantibioticos" );

			jQuery( "#listaantibioticos" ).jqGrid( 'setFrozenColumns' );

			jQuery( "#listaantibioticos" ).jqGrid( 'filterToolbar', {
				stringResult: true,
				searchOnEnter: false,
				defaultSearch: "cn"
			} );


			function responsive_jqgrid( jqgrid ) {
				jqgrid.find( '.ui-jqgrid' ).addClass( 'clear-margin span12' ).css( 'width', '' );
				jqgrid.find( '.ui-jqgrid-view' ).addClass( 'clear-margin span12' ).css( 'width', '' );
				jqgrid.find( '.ui-jqgrid-view > div' ).eq( 1 ).addClass( 'clear-margin span12' ).css( 'width', '' ).css( 'min-height', '0' );
				jqgrid.find( '.ui-jqgrid-view > div' ).eq( 2 ).addClass( 'clear-margin span12' ).css( 'width', '' ).css( 'min-height', '0' );
				jqgrid.find( '.ui-jqgrid-sdiv' ).addClass( 'clear-margin span12' ).css( 'width', '' );
				jqgrid.find( '.ui-jqgrid-pager' ).addClass( 'clear-margin span12' ).css( 'width', '' );
			}

		} );
	
	</script>

	<script language="JavaScript">
		
		function conMayusculas(field) 
		{  
		   field.value = field.value.toUpperCase()  
		}

		function validarnum(event)
		{
			var  enterCodigo= event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
			if ((enterCodigo>47 && enterCodigo<58) || enterCodigo==8 || enterCodigo==9)
			{
				return true;
			}
			else
			{
				return false;	
			}   
		}

		function validarcar(e) { // 1
			tecla = (document.all) ? e.keyCode : e.which; // 2
			if (tecla==8) return true; // 3
			patron =/[<>!=*&%$#'"{}?]/; // 4
			te = String.fromCharCode(tecla); // 5
			return !patron.test(te); // 6
		}

		function esNumero(strNumber) 
		{
			if (strNumber == null) return false;
			if (strNumber == undefined) return false;
			if (typeof strNumber === "number" && !isNaN(strNumber)) return true;
			if (strNumber == "") return false;
			if (strNumber === "") return false;
			var psInt, psFloat;
			psInt = parseInt(strNumber);
			psFloat = parseFloat(strNumber);
			return !isNaN(strNumber) && !isNaN(psFloat);
		}

		function confirmacion(nordentra, codestudio, nroresul, codservicio, nroorden) 
		{ 
			swal({
					  title: "Borrar Registro",
					  text: "Est\u00e1 seguro que desea borrar?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if (willDelete) 
					  {
						window.location = "eliminar_resultado_micro.php?nordentra=" + nordentra+"&codestudio=" + codestudio+"&nroresul=" + nroresul+"&codservicio=" + codservicio+"&nroorden=" + nroorden;
					  } 
					  else 
					  {
						swal("El registro salvado!");
					  }
				});
		}
		
		function confirmacion1(nordentra, codestudio, nroresul, codservicio, nroorden) 
		{ 
			swal({
					  title: "Borrar Registro",
					  text: "Est\u00e1 seguro que desea borrar?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if (willDelete) 
					  {
						window.location = "eliminar_resultado_anti.php?nordentra=" + nordentra+"&codestudio=" + codestudio+"&nroresul=" + nroresul+"&codservicio=" + codservicio+"&nroorden=" + nroorden;
					  } 
					  else 
					  {
						swal("El registro salvado!");
					  }
				});
		}
	</script>
	
	
	
	<style type="text/css">
		.glyphicon.glyphicon-edit,
		.glyphicon.glyphicon-trash {
			font-size: 20px;
		}
	</style>
</head>

<body>
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
						<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br><br></strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>CARGA Y VALIDACION DE RESULTADOS MICROBIOLOGIA 
</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong><br />
					</strong></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<form name="formu" id="formu" method="post">

<div id="wb_usuarios_detallesLayoutGrid7">
	<div id="usuarios_detallesLayoutGrid7">
			<div class="row">
				<div class="col-1">
					<hr id="usuarios_detallesLine23">
					<div id="wb_usuarios_detallesText7">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Establecimiento de Salud: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="usuarios_detallesLine25">
					<select name="codservicio" size="1" id="codservicio" <?php if($codservicio != ''){echo "disabled";}?> style="<?php if($codservicio != ''){echo "background-color: #DCDCDC";}?>">
                       <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from establecimientos");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($codservicio) == trim($depto["codservicio"]))
								{
									echo '<option value="'.$depto["codservicio"].'" selected>'.$depto["nomservicio"].'</option>';
								}
								else
								{
									echo '<option value="'.$depto["codservicio"].'">'.$depto["nomservicio"].'</option>';
								}
							}
            			?>
    				</select>
    				<input type="hidden" name="nroorden" id="nroorden" value="<?php echo $nroorden; ?>">
					<input type="hidden" name="codservicio1" id="codservicio1" value="<?php echo $codservicio; ?>">
					<hr id="usuarios_detallesLine24">
				</div>
			</div>
  </div>
</div>

	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Origen del Paciente: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="codorigen" size="1" id="codorigen" <?php if($codorigen != ''){echo "disabled";}?> style="<?php if($codorigen != ''){echo "background-color: #DCDCDC";}?>">
                        <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from origenpaciente order by codorigen");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codorigen']) == trim($codorigen))
							   {
								  echo "<option value = ".$depto['codorigen']." selected>".$depto['nomorigen']."</option>"; 


							   }
							   else
							   {
								   echo "<option value = ".$depto['codorigen'].">".$depto['nomorigen']."</option>";
							   }
							}


					?>
    				</select>
    				<input type="hidden" name="codorigen1" id="codorigen1" value="<?php echo $codorigen; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>

	

  <div id="wb_pacientes_detallesLayoutGrid1">
		<div id="pacientes_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<div id="wb_pacientes_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>N&uacute;mero de Paciente: </strong></span>
					</div>
					<hr id="pacientes_detallesLine2">
					<hr id="turnos_detallesLine5">
				</div>
				<div class="col-2">
				  <input type="text" name="npaciente" id="npaciente" value="<?php echo $nropaciente; ?>">
					<hr id="pacientes_detallesLine4">
				</div>
				<div class="col-3">
					<div id="wb_pacientes_detallesText2">
						<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Nro. de Orden:</strong></span>
					</div>
					<hr id="pacientes_detallesLine5">
				</div>
				<div class="col-4">
					<input type="text" id="nrordentra" name="nrordentra" value="<?php echo $nordentra; ?>" readonly>
					<hr id="pacientes_detallesLine8">
				</div>
			</div>
		</div>
	</div>

	<div id="wb_pacientes_detallesLayoutGrid2">
		<div id="pacientes_detallesLayoutGrid2">
			<div class="row">
				<div class="col-1">
					<div id="wb_pacientes_detallesText3">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Tipo de Documento: </strong></span>
					</div>
					<hr id="pacientes_detallesLine10">
				</div>
				<div class="col-2">
					<input type="text" name="tdocumento" id="tdocumento" value="<?php echo $nomdocumento; ?>" readonly spellcheck="false">
					<hr id="pacientes_detallesLine12">
				</div>
				<div class="col-3">
					<div id="wb_pacientes_detallesText4">
						<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Nro. Documento:</strong></span>
					</div>
					<hr id="pacientes_detallesLine14">
				</div>
				<div class="col-4">
					<input type="text" id="cedula" name="cedula" value="<?php echo $cedula; ?>" readonly spellcheck="false">
					<hr id="pacientes_detallesLine16">
				</div>
			</div>
		</div>
	</div>

	<div id="wb_pacientes_detallesLayoutGrid3">
		<div id="pacientes_detallesLayoutGrid3">
			<div class="row">
				<div class="col-1">
					<div id="wb_pacientes_detallesText5">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Primer Nombre:</strong></span>
					</div>
					<hr id="pacientes_detallesLine18">
				</div>
				<div class="col-2">
					<input type="text" id="pnombre" name="pnombre" value="<?php echo $pnombre; ?>" maxlength="20" readonly spellcheck="false">
					<hr id="pacientes_detallesLine20">
				</div>
				<div class="col-3">
					<div id="wb_pacientes_detallesText6">
						<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Segundo Nombre:</strong></span>
					</div>
					<hr id="pacientes_detallesLine22">
				</div>
				<div class="col-4">
					<input type="text" id="snombre" name="snombre" value="<?php echo $snombre; ?>" readonly spellcheck="false">
					<hr id="pacientes_detallesLine24">
				</div>
			</div>
		</div>
	</div>

	<div id="wb_pacientes_detallesLayoutGrid4">
		<div id="pacientes_detallesLayoutGrid4">
			<div class="row">
				<div class="col-1">
					<div id="wb_pacientes_detallesText7">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Primer Apellido:</strong></span>
					</div>
					<hr id="pacientes_detallesLine26">
				</div>
				<div class="col-2">
					<input type="text" id="papellido" name="papellido" value="<?php echo $papellido; ?>" maxlength="20" readonly spellcheck="false">
					<hr id="pacientes_detallesLine28">
				</div>
				<div class="col-3">
					<div id="wb_pacientes_detallesText8">
						<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Segundo Apellido:</strong></span>
					</div>
					<hr id="pacientes_detallesLine30">
				</div>
				<div class="col-4">
					<input type="text" id="sapellido" name="sapellido" value="<?php echo $sapellido; ?>" readonly spellcheck="false">
					<hr id="pacientes_detallesLine32">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_courier_detallesLayoutGrid2">
		<div id="courier_detallesLayoutGrid2">
			<div class="row">
				<div class="col-1">
					<hr id="courier_detallesLine5">
					<div id="wb_turnos_detallesText3">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Estudio: </strong></span>
					</div>
					<hr id="courier_detallesLine6">
				</div>
				<div class="col-2">
					<hr id="courier_detallesLine7">
				  <div class="selector-estudio">
				  <select name="codestudio" size="1" id="codestudio" <?php if($codestudio != ''){echo "disabled";}?> style="<?php if($codestudio != ''){echo "background-color: #DCDCDC";}?>">
                        <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select distinct e.codestudio,
																		 e.nomestudio
														from estudios e, estrealizar r
														where e.codestudio  = r.codestudio
														and   r.nordentra   = '$nordentra'
														and   r.codservicio = '$codservicio'");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codestudio']) == trim($codestudio))
							   { 
								   echo "<option value = ".$depto['codestudio']." selected>".$depto['nomestudio']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['codestudio'].">".$depto['nomestudio']."</option>";
							   }
								
							}


						?>
    				</select>
					<input type="hidden" name="codestudio1" id="codestudio1" value="<?php echo $codestudio; ?>">
					</div>
					<hr id="courier_detallesLine8">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Sector: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="codsector" size="1" id="codsector" <?php if($codsector != ''){echo "disabled";}?> style="<?php if($codsector != ''){echo "background-color: #DCDCDC";}?>">
                      <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from sectores");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codsector']) == trim($codsector))
							   { 
								   echo "<option value = ".$depto['codsector']." selected>".$depto['nomsector']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['codsector'].">".$depto['nomsector']."</option>";
							   }
								
							}


						?>
    				</select>
    				<input type="hidden" name="codsector1" id="codsector1" value="<?php echo $codsector; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Determinaci&oacute;n: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="coddetermina" size="1" id="coddetermina" <?php if($coddetermina != ''){echo "disabled";}?> style="<?php if($coddetermina != ''){echo "background-color: #DCDCDC";}?>">
                      <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from determinaciones where codestudio = '$codestudio'");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['coddetermina']) == trim($coddetermina))
							   { 
								   echo "<option value = ".$depto['coddetermina']." selected>".$depto['nomdetermina']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['coddetermina'].">".$depto['nomdetermina']."</option>";
							   }
								
							}


						?>
    				</select>
    				<input type="hidden" name="coddetermina1" id="coddetermina1" value="<?php echo $coddetermina; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>M&eacute;todo: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="codmetodo" size="1" id="codmetodo" <?php if($codmetodo != ''){echo "disabled";}?> style="<?php if($codmetodo != ''){echo "background-color: #DCDCDC";}?>">
                      <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from metodos");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codmetodo']) == trim($codmetodo))
							   { 
								   echo "<option value = ".$depto['codmetodo']." selected>".$depto['nommetodo']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['codmetodo'].">".$depto['nommetodo']."</option>";
							   }
								
							}


						?>
    				</select>
    				<input type="hidden" name="codmetodo1" id="codmetodo1" value="<?php echo $codmetodo; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Unidad de medida: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="codumedida" size="1" id="codumedida">
                      <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from unidadmedida");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codumedida']) == trim($codumedida))
							   { 
								   echo "<option value = ".$depto['codumedida']." selected>".$depto['nomumedida']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['codumedida'].">".$depto['nomumedida']."</option>";
							   }
								
							}


						?>
    				</select>
    				<input type="hidden" name="codumedida1" id="codumedida1" value="<?php echo $codumedida; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Estados: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="codestado" size="1" id="codestado" >
                      <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from estadoresultado");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codestado']) == trim($codestado))
							   { 
								   echo "<option value = ".$depto['codestado']." selected>".$depto['nomestado']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['codestado'].">".$depto['nomestado']."</option>";
							   }
								
							}


						?>
    				</select>
    				<input type="hidden" name="codestado1" id="codestado1" value="<?php echo $codestado; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Resultado Microbiologia: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="codresultado" size="1" id="codresultado" >
                      <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select rc.codresultado,
																   rc.nomresultado
															from resultadoposible rp, resultadocodificadobio rc
															where rp.codresultado = rc.codresultado 
															and rp.codestudio = '$codestudio'
															and rp.coddetermina = '$coddetermina'");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codresultado']) == trim($codresultado))
							   { 
								   echo "<option value = ".$depto['codresultado']." selected>".$depto['nomresultado']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['codresultado'].">".$depto['nomresultado']."</option>";
							   }
								
							}


						?>
    				</select>
					<br>
					<br>
					<input type="text" name="resultados" id="resultados" value="<?php echo $resultado; ?>" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
    				<input type="hidden" name="codresultado1" id="codresultado1" value="<?php echo $codresultado; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Equipo que proces&oacute;: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<select name="codequipo" size="1" id="codequipo">
                      <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from equipos");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($depto['codequipo']) == trim($codequipo))
							   { 
								   echo "<option value = ".$depto['codequipo']." selected>".$depto['decripcion']."</option>";
							   }
							   else
							   {
								   echo "<option value = ".$depto['codequipo'].">".$depto['decripcion']."</option>";
							   }
								
							}


						?>
    				</select>
    				<input type="hidden" name="codequipo1" id="codequipo1" value="<?php echo $codequipo; ?>">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	<div id="wb_turnos_detallesLayoutGrid1">
		<div id="turnos_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine1">
					<div id="wb_turnos_detallesText1">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Observaciones: <br></strong></span>
					</div>
				</div>
				<div class="col-2">
					<hr id="turnos_detallesLine3">
					<input type="text" name="obs" id="obs" value="<?php echo $obs; ?>" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
					<hr id="turnos_detallesLine2">
				</div>
			</div>
		</div>
	</div>
	<br>
	  <div id="wb_turnos_detallesLayoutGrid2">
			<div id="turnos_detallesLayoutGrid2">
				<div class="row">
					<div class="col-1">
						<div id="wb_turnos_detallesText2">
							<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Microorganismos</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="wb_LayoutGrid4">
			<div id="LayoutGrid4">
				<div class="row">
					<div class="col-1">
						<div class="jqGrid">
							<br/>
							<table id="listamicroorganismo"></table>
							<div id="perpage"></div>
					  </div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="wb_LayoutGrid7">
			<div id="LayoutGrid7">
				<div class="row">
					<div class="col-1">
						<hr id="Line16">
						<input type="button" id="Button1" onclick="window.location.href='nuevo_resultado_micro.php?nordentra=<?php echo $nordentra;?>&codservicio=<?php echo $codservicio;?>&codestudio=<?php echo $codestudio;?>&nroorden=<?php echo $nroorden;?>';" name="agregar" value="Agregar">
						<hr id="Line11">
					</div>
					<div class="col-2">
					</div>
				</div>
			</div>
		</div>
	<br>
	  <div id="wb_turnos_detallesLayoutGrid2">
			<div id="turnos_detallesLayoutGrid2">
				<div class="row">
					<div class="col-1">
						<div id="wb_turnos_detallesText2">
							<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Antibi&oacute;ticos</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div id="wb_LayoutGrid4">
			<div id="LayoutGrid4">
				<div class="row">
					<div class="col-1">
						<div class="jqGrid">
							<br/>
							<table id="listaantibioticos"></table>
							<div id="perpage1"></div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	
	<div id="wb_LayoutGrid7">
		<div id="LayoutGrid7">
			<div class="row">
				<div class="col-1">
					<hr id="Line16">
					<input type="button" id="Button1" onclick="window.location.href='nuevo_resultado_anti.php?nordentra=<?php echo $nordentra;?>&codservicio=<?php echo $codservicio;?>&codestudio=<?php echo $codestudio;?>&nroorden=<?php echo $nroorden;?>';" name="agregar" value="Agregar">
					<hr id="Line11">
				</div>
				<div class="col-2">
				</div>
			</div>
		</div>
	</div>
	<br>

	<div id="wb_turnos_detallesLayoutGrid4">
		<div id="turnos_detallesLayoutGrid4">
			<div class="row">
				<div class="col-1">
					<hr id="turnos_detallesLine11">
					<?php
						if ($v_161==2 || $v_161==3) 
						{
						 echo '<input type="button" id="turnos_detallesButton4" onclick="xajax_ValidarFormulario(xajax.getFormValues(formu));" name="guardar" value="Guardar Datos">';
						}
					?>
				</div>
				<hr id="turnos_detallesLine12">
				<div class="col-2">
			    </div>
			</div>
		</div>
	</div>
</form>
	<div id="wb_sintomas_detallesLayoutGrid1">
		<div id="sintomas_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="sintomas_detallesLine1"/>
					<div id="wb_sintomas_detallesText1">
						<span style="color:#FF0000;font-family:Arial;font-size:13px;">[&nbsp;<a href="#" onclick="window.location.href='navegador_resultadosm.php?nordentra=<?php echo $nordentra;?>&codservicio=<?php echo $codservicio;?>&codestudio=<?php echo $codestudio;?>';"> VOLVER </a>&nbsp;]</span>

					</div>
					<hr id="sintomas_detallesLine2"/>
				</div>
				<div class="col-2">
				</div>
			</div>
		</div>
	</div>
	<div id="wb_LayoutGrid9">
		<div id="LayoutGrid9">
			<div class="row">
				<div class="col-1">
					<div id="wb_Text8">
						<span style="color:#FFFFFF;font-family:Arial;font-size:13px;">&#169; 2018 Laboratorio Central de Salud P&uacute;blica. <br />
        				Todos los derechos reservados.<br />
        				Asunci&oacute;n, Paraguay</span>
					</div>
				</div>
				<div class="col-2">
					<div id="wb_FontAwesomeIcon8">
						<div id="FontAwesomeIcon8">
							<i class="fa fa-facebook-f">&nbsp;</i>
						</div>
					</div>
					<div id="wb_FontAwesomeIcon9">
						<div id="FontAwesomeIcon9">
							<i class="fa fa-envelope-o">&nbsp;</i>
						</div>
					</div>
					<div id="wb_FontAwesomeIcon11">
						<div id="FontAwesomeIcon11">
							<i class="fa fa-cloud">&nbsp;</i>
						</div>
					</div>
					<br/>
				</div>

			</div>
		</div>
	</div>

<!-- jqGrid Lib(js, css) -->
	<link rel="stylesheet" href="jqgrid/jquery-ui.css"/>
	<link rel="stylesheet" href="jqgrid/ui.jqgrid.css"/>

	<script src="jqgrid/grid.locale-es.js"></script>
	<script src="jqgrid/jquery.jqGrid.min.js"></script>
<!-- end -->
<link rel="stylesheet" href="jqgrid/style.css"/>

</body>
<?php
if ($_GET["mensage"]==4)
{
	echo "<script type=''>
     swal('','NO se puede borrar, pues otros datos dependen de este registro !!!','error'); 
     </script>"; 
}
if ($_GET["mensage"]==1)
{
	echo "<script type=''>
     swal('','El registro ha sido eliminado!','success'); 
     </script>"; 
}

?>
</html>
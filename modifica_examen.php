<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_171   = $_SESSION['V_171'];	// Selección para Examinar
$v_1711   = $_SESSION['V_1711'];	// Envio de Examen

$nroeval 	= $_GET['nroeval'];

$query = "SELECT *
FROM evaluacion 
WHERE nroeval = '$nroeval'";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$mes 	 	= $row["permes"];
$anio 	 	= $row["peranio"];
$codsector 	= $row["codsector"];
$lote	 	= $row["lote"];
$puntaje	= $row["puntaje"];
$escala	 	= $row["escala"];
$tipo		= $row["tipo"];
$subprograma= $row["subprograma"];
$rmuestra   = $row["rmuestra"];
$cantfila   = $row["cantfila"];
$enunciado  = $row["enunciado"];

$date = date_create($row["fecharcierre"]);
$fechacierre= date_format($date,"Y-m-d");

$date1 = date_create($row["fechainicio"]);
$fechainicio= date_format($date1,"Y-m-d");

//incluímos la clase xajax
include( 'xajax/xajax_core/xajax.inc.php' );

//instanciamos el objeto de la clase xajax
$xajax = new xajax();

//registramos funciones 

$xajax->register( XAJAX_FUNCTION, 'ValidarFormulario');
$xajax->register( XAJAX_FUNCTION, 'AgregarPregunta' );
$xajax->register( XAJAX_FUNCTION, 'AgregarPregunta1' );
$xajax->register( XAJAX_FUNCTION, 'AgregarEstudios' );
$xajax->register( XAJAX_FUNCTION, 'AgregarDeterminacion' );
$xajax->register( XAJAX_FUNCTION, 'AgregarRespuesta' );
$xajax->register( XAJAX_FUNCTION, 'AgregarRespuesta1' );

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

$xajax->configure( 'javascript URI', 'xajax/' );
//Funciones

function ValidarFormulario($form) 
{
	extract($form);

	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding( 'utf-8' );
	
	$codusu = $_SESSION[ 'codusu' ];

	$con = Conectarse();

	$mensaje = '';
	
	if ( $mes == "" ) {
		$mensaje = '- Rellene el campo Mes!\n';

		$respuesta->Assign( "mes", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "mes", "style.backgroundColor", "white" );
	}
	
	if ( $anio == "" ) {
		$mensaje .= '- Rellene el campo Año!\n';

		$respuesta->Assign( "anio", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "anio", "style.backgroundColor", "white" );
	}

	if ( $mensaje == "" ) {
		   
			pg_query( $con, "UPDATE evaluacion
			SET permes='$mes', peranio='$anio', lote='$lote', puntaje='$punto', escala='$escala', fecharcierre='$fechacierre', codsector='$codsector', fechainicio='$fechainicio', subprograma='$subprograma', rmuestra='$rmuestra', cantfila='$cantfila', enunciado='$enunciado'
			WHERE nroeval = '$nroeval'" );

			// Bitacora
			include( "bitacora.php" );
			$codopc = "V_171";
			$fecha1 = date( "Y-n-j", time() );
			$hora = date( "G:i:s", time() );
			$accion = "Control Calidad: Modifica-Reg.: Nro. Evaluacion: " . $nroeval;
			$terminal = $_SERVER[ 'REMOTE_ADDR' ];
			$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
			// Fin grabacion de registro de auditoria
			
			$respuesta->redirect("modifica_examen.php?nroeval=$nroeval&mensage=2");


	} else {

		$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
	return $respuesta;
}

function AgregarPregunta($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding( 'utf-8' );

	$codusu = $_SESSION[ 'codusu' ];

	$con = Conectarse();

	$mensaje = '';

	if ($pregunta == "") {
		$mensaje .= '- Rellene el campo Pregunta!
';

		$respuesta->Assign( "pregunta", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "pregunta", "style.backgroundColor", "" );
	}

	if ($opc1 == "") {
		$mensaje .= '- Rellene el campo Respuesta 1!
';

		$respuesta->Assign( "opc1", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "opc1", "style.backgroundColor", "" );
	}
	
	if ($opc2 == "") {
		$mensaje .= '- Rellene el campo Respuesta 2!
';

		$respuesta->Assign( "opc2", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "opc2", "style.backgroundColor", "" );
	}
	
	if ($opc3 == "") {
		$mensaje .= '- Rellene el campo Respuesta 3!
';

		$respuesta->Assign( "opc3", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "opc3", "style.backgroundColor", "" );
	}
	
	if ($opc4 == "") {
		$mensaje .= '- Rellene el campo Respuesta 4!
';

		$respuesta->Assign( "opc4", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "opc4", "style.backgroundColor", "" );
	}
	
	if ($opc5 == "") {
		$mensaje .= '- Rellene el campo Respuesta 5!
';

		$respuesta->Assign( "opc5", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "opc5", "style.backgroundColor", "" );
	}
	
	if ($opc6 == "") {
		$mensaje .= '- Rellene el campo Respuesta 6!
';

		$respuesta->Assign( "opc6", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "opc6", "style.backgroundColor", "" );
	}
	
	if ($opc7 == "") {
		$mensaje .= '- Rellene el campo Respuesta 7!
';

		$respuesta->Assign( "opc7", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "opc7", "style.backgroundColor", "" );
	}
	
	if ($res == "") {
		$mensaje .= '- Elegir Alguna Opcion!
';

		$respuesta->Assign( "res", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "res", "style.backgroundColor", "" );
	}
	
	if ($puntaje1 == "") {
		$mensaje .= '- Rellene el campo Puntaje!';

		$respuesta->Assign( "puntaje1", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "puntaje1", "style.backgroundColor", "" );
	}
	
	if ($mensaje == "")
	{
			$unro = pg_query( $con, "select max(item) as ultimo from evaluaciondet where nroeval = '$nroeval'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$item = $rowcod[ 'ultimo' ] + 1;
			}
		
			$fecharegistro = date( "Y-n-j", time() );
		
			
			pg_query( $con, "INSERT INTO evaluaciondet(
	nroeval, item, fecharegistro, pregunta, opc1, opc2, opc3, opc4, opc5, respuesta, puntaje, opc6, opc7)
	VALUES ('$nroeval', '$item', '$fecharegistro', '$pregunta', '$opc1', '$opc2', '$opc3', '$opc4', '$opc5', '$res', '$puntaje1', '$opc6', '$opc7')" );
		
			$respuesta->script("Ocultar()");

			// Bitacora
			include( "bitacora.php" );
			$codopc = "V_13";
			$fecha1 = date( "Y-n-j", time() );
			$hora = date( "G:i:s", time() );
			$accion = "Educacion: Insertar-Reg.: Evaluacion: " . $nroeval;
			$terminal = $_SERVER[ 'REMOTE_ADDR' ];
			$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
			// Fin grabacion de registro de auditoria
	}
	else
	{

		$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
	return $respuesta;
}

function AgregarPregunta1($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding( 'utf-8' );

	$codusu = $_SESSION[ 'codusu' ];

	$con = Conectarse();

	$mensaje = '';

	if ($descripcio == "") {
		$mensaje .= '- Rellene el campo Pregunta!
';

		$respuesta->Assign( "descripcio", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "descripcio", "style.backgroundColor", "" );
	}

	if ($tipo == "") {
		$mensaje .= '- Rellene el campo Tipo!
';

		$respuesta->Assign( "tipo", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "tipo", "style.backgroundColor", "" );
	}
	
	if ($puntaje2 == "") {
		$mensaje .= '- Rellene el campo Puntaje!';

		$respuesta->Assign( "puntaje2", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "puntaje2", "style.backgroundColor", "" );
	}
	
	if ($mensaje == "")
	{
			$unro = pg_query( $con, "select max(idpregunta) as ultimo from pregunta where nroeval = '$nroeval'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$idpregunta = $rowcod[ 'ultimo' ] + 1;
			}
		
			$fecharegistro = date( "Y-n-j", time() );
		
			
			pg_query( $con, "INSERT INTO pregunta(
	nroeval, idpregunta, fecharegistro, descripcio, tipo, puntaje)
	VALUES ('$nroeval', '$idpregunta', '$fecharegistro', '$descripcio', '$tipo', '$puntaje2')" );
		
			$respuesta->script("Ocultar()");

			// Bitacora
			include( "bitacora.php" );
			$codopc = "V_13";
			$fecha1 = date( "Y-n-j", time() );
			$hora = date( "G:i:s", time() );
			$accion = "Educacion: Insertar-Reg.: Evaluacion: " . $nroeval;
			$terminal = $_SERVER[ 'REMOTE_ADDR' ];
			$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
			// Fin grabacion de registro de auditoria
	}
	else
	{

		$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
	return $respuesta;
}

function AgregarEstudios($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	//$respuesta->setCharacterEncoding( 'utf-8' );

	$codusu = $_SESSION[ 'codusu' ];

	$con = Conectarse();
	
	$fecharegistro = date( "Y-n-j", time() );

	$mensaje = '';

	if ($codestudio == "") {
		$mensaje .= '- Rellene el campo Estudio!';

		$respuesta->Assign( "codestudio", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "codestudio", "style.backgroundColor", "" );
	}

	if ($mensaje == "")
	{
		pg_query( $con, "INSERT INTO evaluaciondetestu(
				nroeval, codestudio, fecharegistro)
		VALUES ('$nroeval', '$codestudio1', '$fecharegistro')" );

			
		$respuesta->script("Ocultar()");
	}
	else
	{

		$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
	return $respuesta;
}

function AgregarDeterminacion($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	//$respuesta->setCharacterEncoding( 'utf-8' );

	$con = Conectarse();

	$mensaje = '';
	
	$query9 = "select * from evaluaciondeterminacion where nroeval = '$nroeval1' and codestudio = '$codestudio2' and coddetermina = '$coddetermina1'";
	$result9 = pg_query( $con, $query9 );
	
	$numeroRegistros = pg_num_rows($result9);

	if ($coddete == "") {
		$mensaje .= '- Rellene el campo Determinacion!';

		$respuesta->Assign( "coddete", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "coddete", "style.backgroundColor", "" );
	}
	
	if ($correcta == "") {
		$mensaje .= '- Rellene el campo Respuesta Correcta!';

		$respuesta->Assign( "correcta", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "correcta", "style.backgroundColor", "" );
	}
	
	if ($drp == "") {
		$mensaje .= '- Rellene el campo Respuesta D.R.P.!';

		$respuesta->Assign( "drp", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "drp", "style.backgroundColor", "" );
	}
	
	if ($numeroRegistros == 0) 
	{

		if ($mensaje == "")
		{
			pg_query( $con, "INSERT INTO evaluaciondeterminacion(
					nroeval, codestudio, coddetermina, correcta, drp)
			VALUES ('$nroeval', '$codestudio2', '$coddetermina1', '$correcta', '$drp')" );
			
			$respuesta->script("TraerLista('$nroeval1', '$codestudio2')");


			//$respuesta->script("Ocultar()");
		}
		else
		{

			$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
		}
	} 
	else
	{
		$respuesta->script('swal("La determinacion ya fue agregado !", "", "warning")');
	}
	
	return $respuesta;
}

function AgregarRespuesta($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	//$respuesta->setCharacterEncoding( 'utf-8' );

	$con = Conectarse();

	$mensaje = '';
	

	if ($descripcio1 == "") {
		$mensaje .= '- Rellene el campo Respuesta!';

		$respuesta->Assign( "descripcio1", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "descripcio1", "style.backgroundColor", "" );
	}
	
	if ($mensaje == "")
	{
			if($correcta == '')
			{
				$correcta = 2;
			}
		
			$unro = pg_query( $con, "select max(item) as ultimo from respuesta where idpregunta = '$idpregunta1'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$item = $rowcod[ 'ultimo' ] + 1;
			}
		
			if($item == '')
			{
				$item = 1;
			}
		
			pg_query( $con, "INSERT INTO respuesta(
					idpregunta, item, descripcio, correcta)
			VALUES ('$idpregunta1', '$item', '$descripcio1', '$correcta')" );
			
			$respuesta->script("TraerLista1('$idpregunta1')");


			//$respuesta->script("Ocultar()");
	}
	else
	{

			$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
	
	return $respuesta;
}


function AgregarRespuesta1($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	//$respuesta->setCharacterEncoding( 'utf-8' );

	$con = Conectarse();

	$mensaje = '';
	
	
	if ($correctar == "") {
		$mensaje .= '- Rellene el campo Respuesta!';

		$respuesta->Assign( "correctar", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "correctar", "style.backgroundColor", "" );
	}
	
	$query9 = "select * from respuesta where idpregunta = '$idpregunta2'";
	$result9 = pg_query( $con, $query9 );
	
	$numeroRegistros = pg_num_rows($result9);
	
	if ($mensaje == "")
	{
			if($numeroRegistros == 0)
			{
				pg_query( $con, "INSERT INTO respuesta(
					idpregunta, item, descripcio, correctar)
			VALUES ('$idpregunta2', '1', '$descripcio2', '$correctar')" );
			}
			else
			{
				pg_query( $con, "update respuesta
								set descripcio = '$descripcio2', correctar = '$correctar'
								where idpregunta = '$idpregunta2' and item = '1'" );
			}

			$respuesta->script("Ocultar()");
	}
	else
	{

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
	<!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!----------- PARA ALERTAS  ---------->
	<script src="js/sweetalert.min.js" type="text/javascript"></script>

	<link href="font-awesome.min.css" rel="stylesheet"/>

	<!----------- PARA MODAL  ---------->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">

  	<script src="js/popper.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function(){
			  $("#button").click(function(){
        		$("#myModal").modal("hide");
			  });

			  $("#myModal").on('hide.bs.modal', function(){
					$('#pregunta').val('');
				    $('#opc1').val('');
				    $('#opc2').val('');
				    $('#opc3').val('');
				    $('#opc4').val('');
				    $('#opc5').val('');
				    $('#puntaje1').val('');
				    $("#res").prop("checked", false);
				    
				    gridReload1();
			  });

			  $('#myModal').on('shown.bs.modal', function () {
					$('#pregunta').focus();
			  });
			
			  $("#button1").click(function(){
        		$("#myModal1").modal("hide");
			  });

			  $("#myModal1").on('hide.bs.modal', function(){
					$('#codestudio').val('');
				    $('#codestudio1').val('');
				    
				    gridReload();
			  });

			  $('#myModal1').on('shown.bs.modal', function () {
					$('#codestudio').focus();
			  });
			
			  $("#button2").click(function(){
        		$("#myModal2").modal("hide");
			  });

			  $("#myModal2").on('hide.bs.modal', function(){
					$('#coddete').val('');
				    $('#coddetermina1').val('');
				    $('#correcta').val('');
				  	$('#drp').val('');
			  });

			  $('#myModal2').on('shown.bs.modal', function () {
					$('#coddete').focus();
			  });
			
			  $("#myModal3").on('hide.bs.modal', function(){
					$('#descripcio').val('');
				    $('#puntaje2').val('');
				    
				    gridReload2();
			  });

			  $('#myModal3').on('shown.bs.modal', function () {
					$('#descripcio').focus();
			  });
			
			  $("#myModal4").on('hide.bs.modal', function(){
					$('#descripcio1').val('');
			  });

			  $('#myModal4').on('shown.bs.modal', function () {
					$('#descripcio1').focus();

			  });
			
			  $("#myModal5").on('hide.bs.modal', function(){
					$('#correctar').val('');
			  });

			  $('#myModal5').on('shown.bs.modal', function () {
					$('#correctar').focus();

			  });
			
		});
	</script>

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
		
		#Combobox1
		{
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
		#Combobox1:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}

		#Combobox1
		{
		   display: block;
		   width: 100%;
		   height: 28px;
		   z-index: 9;
		}
		
		#codsector
		{
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

		#codsector:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}

		#codsector
		{
		   display: block;
		   width: 100%;
		   height: 28px;
		   z-index: 9;
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
		
		#subprograma {
			display: block;
			width: 40%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}

		#subprograma {
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
		
		#punto {
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

		#punto:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}

		#punto {
			display: block;
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}

		#punto {
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
		
		#escala {
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

		#escala:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}

		#escala {
			display: block;
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}

		#escala {
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
		
		#fechacierre {
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

		#fechacierre:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}

		#fechacierre {
			display: block;
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}

		#fechacierre {
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
		
		#fechainicio {
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

		#fechainicio:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}

		#fechainicio {
			display: block;
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}

		#fechainicio {
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
		
		#tipo
		{
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

		#tipo:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}

		#tipo
		{
		   display: block;
		   width: 100%;
		   height: 28px;
		   z-index: 9;
		}
		
		#archivo {
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

		#archivo:focus {
			border-color: #66AFE9;
			-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.075), 0px 0px 8px rgba(102, 175, 233, 0.60);
			outline: 0;
		}

		#archivo {
			display: block;
			width: 52%;
			height: 31px;
			line-height: 26px;
			z-index: 41;
		}

		#archivo {
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
		
		#rmuestra
		{
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

		#rmuestra:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}

		#rmuestra
		{
		   display: block;
		   width: 41%;
		   height: 28px;
		   z-index: 9;
		}
		
		#cantfila {
			display: block;
			width: 40%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}

		#cantfila {
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
		
		#enunciado {
			display: block;
			width: 120%;
			height: 26px;
			line-height: 26px;
			z-index: 41;
		}

		#enunciado {
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
	</style>

	<script src="wb.stickylayer.min.js"></script>
	<script src="wb.carousel.min.js"></script>

	<script>
		
		function ListaEstudios()
		{
			$(document).ready(function() {

			var data = {};
			$("#listaestudios option").each(function(i,el) {
			   data[$(el).data("value")] = $(el).val();
			});
			console.log(data, $("#listaestudios option").val());

				var value = $('#codestudio').val();

				$('#codestudio1').val($('#listaestudios [value="' + value + '"]').data('value'));
			});

		}
		
		function elegir(nroeval, codestudio) 
		{ 
			$("#myModal2").modal("show");
			
			jQuery("#nroeval1").val(nroeval);
			jQuery("#codestudio2").val(codestudio);
			
			$.ajax({
			   type: 'POST',
			   url: 'buscardeter.php',
			   data:{ codestudio: codestudio},
			   success: function(data){
				
				 $('#listadeterminacion').html(data);
				   
			   }
				
				
			});
			
			TraerLista(nroeval, codestudio);
		}
		
		function elegir1(idpregunta, tipo) 
		{ 
			jQuery("#tipo1").val(tipo);
			
			if(tipo == 1)
			{
			   $("#myModal5").modal("show");
				
			   jQuery("#idpregunta2").val(idpregunta);
			}
			else
			{
			   $("#myModal4").modal("show");
				
			   jQuery("#idpregunta1").val(idpregunta);
				
			   TraerLista1(idpregunta);
			}
			
			
		}
		
		function ListaDeterminacion()
		{
			
			$(document).ready(function() {

			var data = {};
			$("#listadeterminacion option").each(function(i,el) {
			   data[$(el).data("value")] = $(el).val();
			});
			console.log(data, $("#listadeterminacion option").val());

				var value = $('#coddete').val();

				$('#coddetermina1').val($('#listadeterminacion [value="' + value + '"]').data('value'));
			});

		}
		
		function TraerLista(nroeval, codestudio)
		{
			$.ajax({
			   type: 'POST',
			   url: 'buscardeterminaciones.php',
			   data:{ nroeval: nroeval, codestudio: codestudio},
			   success: function(data){
				   
				 $('#coddete').val('');
				 $('#coddetermina1').val('');
				 $('#correcta').val('');
				 $('#drp').val('');
				
				 $('#tusers').html(data);
				   
			   }
				
				
			});

		}
		
		function TraerLista1(idpregunta)
		{
			$.ajax({
			   type: 'POST',
			   url: 'buscarrespuesta.php',
			   data:{ idpregunta: idpregunta},
			   success: function(data){
				   
				 $('#correcta').val('');
				 $('#descripcio1').val('');
				
				 $('#trespuesta').html(data);

			   }
				
				
			});

		}
		
		function Ocultar()
		{
			$("[data-dismiss=modal]").trigger({ type: "click" });
			//location.reload();
		}
		
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

		function validarcar(e)
		{ // 1
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
		
		function gridReload1()
		{
			var nroeval 	= jQuery("#nroeval").val();

			jQuery("#listapacientes").jqGrid('setGridParam',{url:"datosevaluacion.php?nroeval="+nroeval,datatype:'json'}).trigger("reloadGrid");

		}
		
		function gridReload()
		{
			var nroeval 	= jQuery("#nroeval").val();

			jQuery("#listapacientes1").jqGrid('setGridParam',{url:"datosevaluacion1.php?nroeval="+nroeval,datatype:'json'}).trigger("reloadGrid");

		}
		
		function gridReload2()
		{
			var nroeval 	= jQuery("#nroeval").val();

			jQuery("#listapacientes2").jqGrid('setGridParam',{url:"datospregunta.php?nroeval="+nroeval,datatype:'json'}).trigger("reloadGrid");

		}
		
		function confirmacion(nroeval, item)
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
					window.location = "eliminar_pregunta.php?nroeval=" + nroeval + "&item="+ item ;
				  }
				  else
				  {
					swal("El registro salvado!");
				  }
			});
		}
		
		function confirmacion1(nroeval, codestudio)
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
					window.location = "eliminar_pregunta1.php?nroeval=" + nroeval + "&codestudio="+ codestudio ;
				  }
				  else
				  {
					swal("El registro salvado!");
				  }
			});
		}
		
		function confirmacion2(nroeval, idpregunta)
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
					window.location = "eliminar_pregunta2.php?nroeval=" + nroeval + "&idpregunta="+ idpregunta ;
				  }
				  else
				  {
					swal("El registro salvado!");
				  }
			});
		}
		
		$( function () {
			var lastsel2;

			jQuery( "#listapacientes" ).jqGrid( {
				url: 'datosevaluacion.php?nroeval=<?php echo $nroeval; ?>',
				datatype: 'json',
				mtype: 'GET',
				loadonce: true,
				height: 200,
				recordpos: 'left',
				pagerpos: 'right',

				gridview: true,

				colNames: ['Borrar', 'Orden', 'Pregunta', 'Puntaje'],
				colModel: [ {
					name: 'borrar',
					width: 20,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "20"
					},
					search: false
				}, {
					name: 'item',
					index: 'item',
					width: 40,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 10,
							size: 7,
							style: "width:90px;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'pregunta',
					index: 'pregunta',
					width: 200,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 10,
							size: 7,
							style: "width:630px;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, 
				
				{
					name: 'puntaje',
					index: 'puntaje',
					width: 50,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 80,
							size: 80,
							style: "width:120px;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}],

				caption: "PREGUNTAS",
				ignoreCase: true,
				pager: '#perpage',
				rowNum: 7,
				rowList: [ 7, 15, 30 ],

				sortname: 'item',
				sortorder: 'asc',
				viewrecords: true,
				editable: true,
				autowidth: true,
				loadComplete: function () {
					$( "tr.jqgrow:odd" ).css( "background", "#FAFAFA" ).css( "margin-bottom", "0 solid" );
				},

				shrinkToFit: true, // well, it's 'true' by default

				beforeRequest: function () {
					responsive_jqgrid( $( ".jqGrid" ) );
				}

			} );

			grid = $( "#listapacientes" );

			jQuery( "#listapacientes" ).jqGrid( 'setFrozenColumns' );

			jQuery( "#listapacientes" ).jqGrid( 'filterToolbar', {
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
			var lastsel3;

			jQuery( "#listapacientes1" ).jqGrid( {
				url: 'datosevaluacion1.php?nroeval=<?php echo $nroeval; ?>',
				datatype: 'json',
				mtype: 'GET',
				loadonce: true,
				height: 200,
				recordpos: 'left',
				pagerpos: 'right',

				gridview: true,

				colNames: ['Borrar', 'Determinacion', 'Codigo', 'Estudio'],
				colModel: [ {
					name: 'borrar',
					width: 20,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "20"
					},
					search: false
				}, 
				
				{
					name: 'determinacion',
					width: 40,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "40"
					},
					search: false
				},
						   
				{
					name: 'codestudio',
					index: 'codestudio',
					width: 40,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 10,
							size: 7,
							style: "width:90px;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'nomestudio',
					index: 'nomestudio',
					width: 200,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 10,
							size: 7,
							style: "width:630px;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}],

				caption: "ESTUDIOS",
				ignoreCase: true,
				pager: '#perpage1',
				rowNum: 7,
				rowList: [ 7, 15, 30 ],

				sortname: 'item',
				sortorder: 'asc',
				viewrecords: true,
				editable: true,
				autowidth: true,
				loadComplete: function () {
					$( "tr.jqgrow:odd" ).css( "background", "#FAFAFA" ).css( "margin-bottom", "0 solid" );
				},

				shrinkToFit: true, // well, it's 'true' by default

				beforeRequest: function () {
					responsive_jqgrid( $( ".jqGrid" ) );
				}

			} );

			grid = $( "#listapacientes1" );

			jQuery( "#listapacientes1" ).jqGrid( 'setFrozenColumns' );

			jQuery( "#listapacientes1" ).jqGrid( 'filterToolbar', {
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
			var lastsel4;

			jQuery( "#listapacientes2" ).jqGrid( {
				url: 'datospregunta.php?nroeval=<?php echo $nroeval; ?>',
				datatype: 'json',
				mtype: 'GET',
				loadonce: true,
				height: 200,
				recordpos: 'left',
				pagerpos: 'right',

				gridview: true,

				colNames: ['Borrar', 'Respuesta', 'Pregunta', 'Puntaje'],
				colModel: [ {
					name: 'borrar',
					width: 20,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "20"
					},
					search: false
				}, {
					name: 'respuesta',
					width: 30,
					resizable: false,
					align: "center",
					sorttype: "int",
					editable: false,
					editoptions: {
						maxlength: "30"
					},
					search: false
				}, {
					name: 'pregunta',
					index: 'pregunta',
					width: 200,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 10,
							size: 7,
							style: "width:630px;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, 
				
				{
					name: 'puntaje',
					index: 'puntaje',
					width: 50,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 80,
							size: 80,
							style: "width:120px;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}],

				caption: "PREGUNTAS",
				ignoreCase: true,
				pager: '#perpage2',
				rowNum: 7,
				rowList: [ 7, 15, 30 ],

				sortname: 'item',
				sortorder: 'asc',
				viewrecords: true,
				editable: true,
				autowidth: true,
				loadComplete: function () {
					$( "tr.jqgrow:odd" ).css( "background", "#FAFAFA" ).css( "margin-bottom", "0 solid" );
				},

				shrinkToFit: true, // well, it's 'true' by default

				beforeRequest: function () {
					responsive_jqgrid( $( ".jqGrid" ) );
				}

			} );

			grid = $( "#listapacientes2" );

			jQuery( "#listapacientes2" ).jqGrid( 'setFrozenColumns' );

			jQuery( "#listapacientes2" ).jqGrid( 'filterToolbar', {
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
		
		function eliminar(nroeval, codestudio, coddetermina) 
		{
			
			jQuery.ajax({
					type: "POST",
					url: "eliminar_determina.php",
					dataType:'json',
					data:{nroeval:nroeval, codestudio:codestudio, coddetermina:coddetermina},
					success: function(data){
					
						TraerLista(data.nroeval, data.codestudio);
					}

			});
		}
		
		function eliminar1(idpregunta, item) 
		{
			
			jQuery.ajax({
					type: "POST",
					url: "eliminar_respuesta.php",
					dataType:'json',
					data:{idpregunta:idpregunta, item:item},
					success: function(data){
					
						TraerLista1(data.idpregunta);
					}

			});
		}
		
		function verificadoc()
		{
			 archivo   = window.document.formu.archivo.value;


			 extensiones_permitidas = new Array(".pdf");
			 mierror = "";
			 if (!archivo)
			 {
				//Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario
				 mierror = "No has seleccionado ning\u00FAn archivo";
			 }
			 else
			 {
				//recupero la extensión de este nombre de archivo
				extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
				//alert (extension);
				//compruebo si la extensión está entre las permitidas
				permitida = false;
				for (var i = 0; i < extensiones_permitidas.length; i++)
				{
				   if (extensiones_permitidas[i] == extension)
				   {
					  permitida = true;
					  break;
				   }
				}
				if (!permitida)
				{
				   mierror = "Comprueba la extensi\u00F3n de los archivos a subir. \nS\u00F3lo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
				 }
				 else
				 {
					swal("Se Adjunto correctamente!", "", "success");
					window.document.formu.submit();
					return 1;
				 }
			 }
			 //si estoy aqui es que no se ha podido submitir
			 swal(mierror, "", "warning");
			 return 0;
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
						<img src="images/logolcsp2.png" id="Image3" alt=""/><img src="images/banner1lcsp.png" id="Image" alt=""/>
					</div>
					<div id="wb_Image4"></div>
				</div>
			</div><img src="images/banner1lcsp.png" id="Image4" alt=""/>
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

	<div id="wb_LayoutGrid3">
		<div id="LayoutGrid3">
			<div class="row">
				<div class="col-1">
					<hr id="Line9"/>
					<div id="wb_Text1">
						<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br><br></strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong><br />
					</strong></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form name="formu" id="formu" enctype="multipart/form-data" action="upload.php" method="post">
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
					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Sector: </strong></span>
					</div>
					<hr id="Line3">
						</div>

					<div class="col-2">
					<hr id="Line4">
					<div class="selector-sector">
					<select name="codsector" size="1" id="codsector">
						<option value=""></option>
						<?php

							$tabla_dpto = pg_query($link, "select * from sectores order by codsector");
							while($depto = pg_fetch_array($tabla_dpto))
							{
							   if($depto['codsector'] == $codsector)
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
					</div>
					<hr id="Line5">
					</div>
				</div>
				
				<div class="row">
			
                      <div class="col-1">
                          <div id="wb_Text4"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Mes: </strong></span> </div>
						  
                      </div>
                      <div class="col-2">
                          <input type="number" id="mes" name="mes" value="<?php echo $mes; ?>" spellcheck="false" maxlength="2" autofocus>
						  <hr id="Line5">
                      </div>

				</div>
				
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>A&ntilde;o: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="number" id="anio" name="anio" value="<?php echo $anio; ?>" spellcheck="false" maxlength="4">
						<hr id="Line5">
                    </div>
			  </div>
				
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Lote: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="text" id="lote" name="lote" value="<?php echo $lote; ?>" spellcheck="false" maxlength="20">
						<hr id="Line5">
                    </div>
			  </div>
				
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Puntaje: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="number" id="punto" name="punto" value="<?php echo $puntaje; ?>" spellcheck="false" maxlength="10">
						<hr id="Line5">
                    </div>
			  </div>
				
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Escala: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="number" id="escala" name="escala" value="<?php echo $escala; ?>" spellcheck="false" maxlength="2">
						<hr id="Line5">
                    </div>
			  </div>
				
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Fecha Inicio: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="date" id="fechainicio" name="fechainicio" value="<?php echo $fechainicio; ?>" spellcheck="false">
						<hr id="Line5">
                    </div>
			  </div>
				
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Fecha Cierre: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="date" id="fechacierre" name="fechacierre" value="<?php echo $fechacierre; ?>" spellcheck="false">
						<hr id="Line5">
                    </div>
			  </div>
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Subir archivo: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="file"  id="archivo" name="archivo"  onChange="verificadoc()">
						<hr id="Line5">
                    </div>
			  </div>
				
			  <div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Sub-Programa: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="text" id="subprograma" name="subprograma" value="<?php echo $subprograma; ?>" spellcheck="false" maxlength="20">
						<hr id="Line5">
                    </div>
			    </div>
				
				<div class="row">
					<div class="col-1">
					<div id="wb_Text2">
					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Realiza Muestra: </strong></span>
					</div>
					
					</div>

					<div class="col-2">
					<hr id="Line4">
					<div class="selector-sector">
					<select name="rmuestra" size="1" id="rmuestra">
						<option value=""></option>
						<option value = "1" <?php if($rmuestra == 1){echo 'selected'; } ?>>No</option>
						<option value = "2" <?php if($rmuestra == 2){echo 'selected'; } ?>>Si</option>
						
					</select>
					</div>
	
					</div>
				</div>
				
				<?php if($tipo == 3){?>
				<br>
				<div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Filas a Mostrar: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="number" id="cantfila" name="cantfila" value="<?php echo $cantfila; ?>" spellcheck="false" maxlength="2">
						<hr id="Line5">
                    </div>
			    </div>
				
				<div class="row">
                    <div class="col-1">
                        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Enunciado: </strong></span> </div>
                    </div>
                    <div class="col-2">
                        <input type="text" id="enunciado" name="enunciado" value="<?php echo $enunciado; ?>" spellcheck="false" maxlength="200">
						<hr id="Line5">
                    </div>
			    </div>
				<?php } ?>
				
				
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
					
					<button type="button" class="btn btn-primary btn-lg" onclick="xajax_ValidarFormulario(xajax.getFormValues(formu));">
					  			Guardar Datos</button>
					<hr id="turnos_detallesLine12">
				</div>
			</div>
		</div>
			
		<?php if($tipo == '2')
			  { 
		?>
			
		<div class="row">
				<div class="col-1" style="text-align: left; padding-left: 35px">
					<hr id="Line16">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1" id="button1" autofocus>
					  Agregar
					</button>
					<hr id="Line11">
				</div>
		</div>
			
		<div class="row">
				<div class="col-1" style="text-align: left; padding-left: 35px">
					<div id="wb_turnos_detallesText2">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>ESTUDIOS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong></span>
					</div>
				</div>
		</div>
			
		<div class="row">
				<div class="col-1">
					<div class="jqGrid">
						<br/>
						<table id="listapacientes1"></table>
						<div id="perpage1"></div>
				  </div>
				</div>
		</div>
			
		<?php }
			
			  if($tipo == '1')
			  { 
		?>
	
		<div class="row">
					<div class="col-1" style="text-align: left; padding-left: 35px">
						<hr id="Line16">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="button" autofocus>
						  Agregar
						</button>
						<hr id="Line11">
					</div>
		</div>
		
		<div class="row">
				<div class="col-1" style="text-align: left; padding-left: 35px">
					<div id="wb_turnos_detallesText2">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>PREGUNTAS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong></span>
					</div>
				</div>
		</div>
			
		<div class="row">
				<div class="col-1">
					<div class="jqGrid">
						<br/>
						<table id="listapacientes"></table>
						<div id="perpage"></div>
				  </div>
				</div>
		</div>
		<?php } 
			
			  if($tipo == '4')
			  { 
		?>
	
		<div class="row">
					<div class="col-1" style="text-align: left; padding-left: 35px">
						<hr id="Line16">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal3" id="button" autofocus>
						  Agregar
						</button>
						<hr id="Line11">
					</div>
		</div>
		
		<div class="row">
				<div class="col-1" style="text-align: left; padding-left: 35px">
					<div id="wb_turnos_detallesText2">
						<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>PREGUNTAS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong></span>
					</div>
				</div>
		</div>
			
		<div class="row">
				<div class="col-1">
					<div class="jqGrid">
						<br/>
						<table id="listapacientes2"></table>
						<div id="perpage2"></div>
				  </div>
				</div>
		</div>
		<?php } ?>	
		
			
	</div>

	<div id="wb_sintomas_detallesLayoutGrid1">
		<div id="sintomas_detallesLayoutGrid1">
			<div class="row">
				<div class="col-1">
					<hr id="sintomas_detallesLine1"/>
					<div id="wb_sintomas_detallesText1">
						<span style="color:#FF0000;font-family:Arial;font-size:13px;">[&nbsp;<a href="#" onclick="window.location.href='elegir_examen.php'"> VOLVER </a>&nbsp;]</span>



					</div>
					<hr id="sintomas_detallesLine2"/>
				</div>
			</div>
		</div>
	</div>
		
	<!-- Modal -->

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <br><br>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			<div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Pregunta</div>
			<div class="row"><input type="text" name="pregunta" id="pregunta" style="width: 80%"  onkeypress="return validarcar(event)" autofocus></div> 
			<div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;padding-top: 10px;">Multiple</div>
			 
			<div class="row" style="padding-bottom: 10px;">
				
					<input type="radio" name="res" id="res" value="1">
					<input type="text" name="opc1" id="opc1" style="width: 50%"  onkeypress="return validarcar(event)">
				
			 </div>
			  
			<div class="row" style="padding-bottom: 10px;">
				
				<input type="radio" name="res" id="res" value="2">
				<input type="text" name="opc2" id="opc2" style="width: 50%"  onkeypress="return validarcar(event)" autofocus>
				
			</div>
			  
			<div class="row" style="padding-bottom: 10px;">
				
				<input type="radio" name="res" id="res" value="3">
				<input type="text" name="opc3" id="opc3" style="width: 50%"  onkeypress="return validarcar(event)">
			  
			</div>
			  
			<div class="row" style="padding-bottom: 10px;">
				
				<input type="radio" name="res" id="res" value="4">
				<input type="text" name="opc4" id="opc4" style="width: 50%"  onkeypress="return validarcar(event)">
			  
			</div>
			  
			<div class="row" style="padding-bottom: 10px;">
				
				<input type="radio" name="res" id="res" value="5">
				<input type="text" name="opc5" id="opc5" style="width: 50%"  onkeypress="return validarcar(event)">
			  
			</div>
			  
			<div class="row" style="padding-bottom: 10px;">
				
				<input type="radio" name="res" id="res" value="5">
				<input type="text" name="opc6" id="opc6" style="width: 50%"  onkeypress="return validarcar(event)">
			  
			</div>
			  
			 <div class="row" style="padding-bottom: 10px;">
				
				<input type="radio" name="res" id="res" value="5">
				<input type="text" name="opc7" id="opc7" style="width: 50%"  onkeypress="return validarcar(event)">
			  
			</div> 
			 
			  
			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Puntaje</div>
			 <div class="row" style="padding-left: 45px;text-align: left;"><input type="number" name="puntaje1" id="puntaje1" style="width: 30%"></div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="xajax_AgregarPregunta(xajax.getFormValues('formu'));">Guardar Datos</button>
		  </div>
		</div>
	  </div>
	</div>
		
	<!-- Modal Estudios-->
		
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <br><br>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			<div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Estudio</div>
			 
			<input type="text" name="codestudio" id="codestudio" list="listaestudios" style="width: 80%"  onkeypress="return validarcar(event)" onChange="ListaEstudios()" autofocus>

			 <input type="hidden" name="codestudio1" id="codestudio1" value="<?php echo $codestudio; ?>" >


		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="xajax_AgregarEstudios(xajax.getFormValues('formu'));">Guardar Datos</button>
		  </div>
		</div>
	  </div>
	</div>
		
	<!-- Modal Determinacion -->
		
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <br><br>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			<div class="row"><input type="hidden" name="codestudio2" id="codestudio2"></div>
			<div class="row"><input type="hidden" name="nroeval1" id="nroeval1"></div> 
			  
			<div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Determinacion
			 
			<input name="coddete" id="coddete" list="listadeterminacion" style="width: 80%"  onkeypress="return validarcar(event)" onChange="ListaDeterminacion()" autofocus></div>
			  
			  
			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Resultado Correcto
			  
			 <input type="text" name="correcta" id="correcta" style="width: 80%"  onkeypress="return validarcar(event)" maxlength="100"></div>
			  
			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">D.R.P.
			 <br>
			 <input type="text" name="drp" id="drp" style="width: 80%"  onkeypress="return validarnum(event)" maxlength="10"></div>

			 <input type="hidden" name="coddetermina1" id="coddetermina1" value="<?php echo $coddetermina; ?>" >
			  
			 <div id="tusers" class="table-hover table-responsive" style="padding-top: 30px;">


		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="xajax_AgregarDeterminacion(xajax.getFormValues('formu'));">Guardar Datos</button>
			  
			<button type="button" class="btn btn-primary" onclick="Ocultar();">Salir</button>
		  </div>
		</div>
	  </div>
	</div>
	</div>
		
	<!-- Modal Preguntas-->

	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <br><br>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			<div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Pregunta</div>
			<div class="row"><input type="text" name="descripcio" id="descripcio" style="width: 80%"  onkeypress="return validarcar(event)" autofocus maxlength="200"></div> 
			<div class="row" style="text-align: left;padding-left: 47px;padding-top: 10px;">Tipo</div>
			  
			<div class="row" style="padding-left: 47px;padding-bottom: 10px;padding-top: 10px;width: 30%;">
			 
				<select name="tipo" size="1" id="tipo">
					<option value = "1">Simple</option>
					<option value = "2">Multiple</option>

				 </select>
			
			</div>

			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Puntaje</div>
			 <div class="row" style="padding-left: 45px;text-align: left;"><input type="number" name="puntaje2" id="puntaje2" style="width: 30%"></div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="xajax_AgregarPregunta1(xajax.getFormValues('formu'));">Guardar Datos</button>
		  </div>
		</div>
	  </div>
	</div>
		
	<!-- Modal Respuestas Multiple-->
		
	<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <br><br>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			<div class="row"><input type="hidden" name="idpregunta1" id="idpregunta1"></div>
			  
			<div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Respuesta </div>
			  
			<div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">
				
				 	<input type="text" name="descripcio1" id="descripcio1" style="width: 80%"  onkeypress="return validarcar(event)" maxlength="200">
			  
			 </div>
			  
			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Respuesta Correcto </div>
	
			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">
				
				 	<input type="checkbox" name="correcta" id="correcta" value="1">
			  
			 </div>

			  
			 <div id="trespuesta" class="table-hover table-responsive" style="padding-top: 30px;">


		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="xajax_AgregarRespuesta(xajax.getFormValues('formu'));">Guardar Datos</button>
			  
			<button type="button" class="btn btn-primary" onclick="Ocultar();">Salir</button>
		  </div>
		</div>
	  </div>
	</div>
	</div>
		
	<!-- Modal Respuestas Simple-->
		
	<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <br><br>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			<div class="row"><input type="hidden" name="idpregunta2" id="idpregunta2"></div>
			<div class="row"><input type="hidden" name="tipo1" id="tipo1"></div>
			  
			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">Respuesta Correcta</div>
			  
			 <div class="row" style="text-align: left;padding-left: 47px;padding-bottom: 10px;">
				
				 	<input type="text" name="correctar" id="correctar" style="width: 80%"  onkeypress="return validarcar(event)" maxlength="100">
			  
			 </div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="xajax_AgregarRespuesta1(xajax.getFormValues('formu'));">Guardar Datos</button>
			  
			<button type="button" class="btn btn-primary" onclick="Ocultar();">Salir</button>
		  </div>
		</div>
	  </div>
	</div>
	</div>
	
	</form>
	
	<datalist id="listaestudios">
	  <?php
			$tabla_dpto = pg_query($link, "select * from estudios");
			echo '<option data-value = "" value = ""></option>';
			while($depto = pg_fetch_array($tabla_dpto))
			{
				echo '<option data-value = "'.$depto['codestudio'].'" value = "'.$depto['codestudio']."- ".$depto['nomestudio'].'"></option>';
			}
		?>
	</datalist>
		
	<datalist id="listadeterminacion">

	</datalist>

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
	
<!-- jqGrid Lib(js, css) -->
	<link rel="stylesheet" href="jqgrid/jquery-ui.css"/>
	<link rel="stylesheet" href="jqgrid/ui.jqgrid.css"/>

	<script src="jqgrid/grid.locale-es.js"></script>
	<script src="jqgrid/jquery.jqGrid.min.js"></script>
<!-- end -->
<link rel="stylesheet" href="jqgrid/style.css"/>

</body>
</html>
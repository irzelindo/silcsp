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
	   
	    $tabla = 'evalbioquimica';
		
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
		
		$tabla = 'evaldengue';
		
		$query = "select * from matdengue where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result   = pg_query($link,$query);
		$cantidad = pg_num_rows($result);
		
		break;
	case '3':
		
		$tabla = 'evalhematologia';
		
		$query = "select * from evalhematologia where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);
		
		$row = pg_fetch_assoc($result);

		$flneutrobandr 	 = $row["flneutrobandr"];
		$flneutrosegmr 	 = $row["flneutrosegmr"];
		$fllinfor 	 	 = $row["fllinfor"];
		$fllinforeactr 	 = $row["fllinforeactr"];
		$flmonocitor 	 = $row["flmonocitor"];
		$fleosinofilor 	 = $row["fleosinofilor"];
		$flbasofilor 	 = $row["flbasofilor"];
		$flblastosr 	 = $row["flblastosr"];
		$flmielocitosr 	 = $row["flmielocitosr"];
		$flmetamielor 	 = $row["flmetamielor"];
		
		$sbsinaltr 	 	 = $row["sbsinaltr"];
		$sbgranur 	 	 = $row["sbgranur"];
		$sbnucleor 	 	 = $row["sbnucleor"];
		$sbvacuolar 	 = $row["sbvacuolar"];
		$srsinaltr 	 	 = $row["srsinaltr"];
		$sranisocitr 	 = $row["sranisocitr"];
		$srmicrocitor 	 = $row["srmicrocitor"];
		$srmacrocitor 	 = $row["srmacrocitor"];
		$srnormocitr 	 = $row["srnormocitr"];
		$srpoiquilocitr	 = $row["srpoiquilocitr"];
		$srnormocromr 	 = $row["srnormocromr"];
		$srhipocromiar 	 = $row["srhipocromiar"];
		$srpolicromar 	 = $row["srpolicromar"];
		$srnormoblar 	 = $row["srnormoblar"];
		$spmacroplaqsar  = $row["spmacroplaqsar"];
		$spmacropaqr 	 = $row["spmacropaqr"];
		$parleishmaniar  = $row["parleishmaniar"];
		$parplasmodr 	 = $row["parplasmodr"];
		
		
		if($sbsinaltr == 1)
		{
			$chk1 = "checked";
		}
		
		if($sbgranur == 1)
		{
			$chk2 = "checked";
		}
		
		if($sbnucleor == 1)
		{
			$chk3 = "checked";
		}
		
		if($sbvacuolar == 1)
		{
			$chk4 = "checked";
		}
		
		if($srsinaltr == 1)
		{
			$chk5 = "checked";
		}
		
		if($sranisocitr == 1)
		{
			$chk6 = "checked";
		}
		
		if($srmicrocitor == 1)
		{
			$chk7 = "checked";
		}
		
		if($srmacrocitor == 1)
		{
			$chk8 = "checked";
		}
		
		if($srnormocitr == 1)
		{
			$chk9 = "checked";
		}
		
		if($srpoiquilocitr == 1)
		{
			$chk10 = "checked";
		}
		
		if($srnormocromr == 1)
		{
			$chk11 = "checked";
		}
		
		if($srhipocromiar == 1)
		{
			$chk12 = "checked";
		}
		
		if($srpolicromar == 1)
		{
			$chk13 = "checked";
		}
		
		if($srnormoblar == 1)
		{
			$chk14 = "checked";
		}
		
		if($spmacroplaqsar == 1)
		{
			$chk15 = "checked";
		}
		
		if($spmacropaqr == 1)
		{
			$chk16 = "checked";
		}
		
		if($parleishmaniar == 1)
		{
			$chk17 = "checked";
		}
		
		if($parplasmodr == 1)
		{
			$chk18 = "checked";
		}
		
		break;
	case '4':
		
		$tabla = 'evalinfluenza';
		
		$query = "select * from matinfluenza where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);
		$cantidad = pg_num_rows($result);
		
		break;
	case '5':
		
		$tabla = 'evalpintestinal';
		
		$query = "select * from evalpintestinal where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);
		
		$row = pg_fetch_assoc($result);

		$quisteencor 	 = $row["quisteencor"];
		$ooquister 	 	 = $row["ooquister"];
		$formasvacur 	 = $row["formasvacur"];
		$quistecolir 	 = $row["quistecolir"];
		$huevoascar 	 = $row["huevoascar"];
		$huevohymer 	 = $row["huevohymer"];
		$quistehistr 	 = $row["quistehistr"];
		$huevouncir 	 = $row["huevouncir"];
		$huevohymenar 	 = $row["huevohymenar"];
		$quistegiarr 	 = $row["quistegiarr"];
		$huevotricr 	 = $row["huevotricr"];
		$huevovermr 	 = $row["huevovermr"];
		$quisteiodar 	 = $row["quisteiodar"];
		$huevotaenr 	 = $row["huevotaenr"];
		$huevoschir 	 = $row["huevoschir"];
		$quistechilr 	 = $row["quistechilr"];
		$larvastronr 	 = $row["larvastronr"];
		$larvafilar 	 = $row["larvafilar"];
		$ooisteisor 	 = $row["ooisteisor"];
		$larvauncir		 = $row["larvauncir"];
		$larvaancyr 	 = $row["larvaancyr"];
		$noseobsr	 	 = $row["noseobsr"];
		$otrosespr	 	 = $row["otrosespr"];
		
		
		if($quisteencor == 1)
		{
			$chk1 = "checked";
		}
		
		if($ooquister == 1)
		{
			$chk2 = "checked";
		}
		
		if($formasvacur == 1)
		{
			$chk3 = "checked";
		}
		
		if($quistecolir == 1)
		{
			$chk4 = "checked";
		}
		
		if($huevoascar == 1)
		{
			$chk5 = "checked";
		}
		
		if($huevohymer == 1)
		{
			$chk6 = "checked";
		}
		
		if($quistehistr == 1)
		{
			$chk7 = "checked";
		}
		
		if($huevouncir == 1)
		{
			$chk8 = "checked";
		}
		
		if($huevohymenar == 1)
		{
			$chk9 = "checked";
		}
		
		if($quistegiarr == 1)
		{
			$chk10 = "checked";
		}
		
		if($huevotricr == 1)
		{
			$chk11 = "checked";
		}
		
		if($huevovermr == 1)
		{
			$chk12 = "checked";
		}
		
		if($quisteiodar == 1)
		{
			$chk13 = "checked";
		}
		
		if($huevotaenr == 1)
		{
			$chk14 = "checked";
		}
		
		if($huevoschir == 1)
		{
			$chk15 = "checked";
		}
		
		if($quistechilr == 1)
		{
			$chk16 = "checked";
		}
		
		if($larvastronr == 1)
		{
			$chk17 = "checked";
		}
		
		if($larvafilar == 1)
		{
			$chk18 = "checked";
		}
		
		if($ooisteisor == 1)
		{
			$chk19 = "checked";
		}
		
		if($larvauncir == 1)
		{
			$chk20 = "checked";
		}
		
		if($larvaancyr == 1)
		{
			$chk21 = "checked";
		}
		
		if($noseobsr == 1)
		{
			$chk22 = "checked";
		}
		
		break;
	case '6':
		
		$tabla = 'evalrotavirus';
		
		$query = "select * from matrotavirus where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);
		$cantidad = pg_num_rows($result);

		break;
	case '7':
		
		$tabla = 'evalsifilis';
		
		$query = "select * from resulsifilis where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);
		$cantidad = pg_num_rows($result);
		
		break;
	case '8':
		
		$tabla = 'evalmalaria';
		
		$query = "select * from lamimalaria where nroeval = '$nroeval' and codempresa = '$codempresa'";
		
		$result = pg_query($link,$query);
		$cantidad = pg_num_rows($result);
		
		break;
		
	case '9':
				
		$tabla = 'evaleducacioncontinua';
		break;

}

$query1 = "select * from ".$tabla." where nroeval = '$nroeval' and codempresa = '$codempresa'";
$result1 = pg_query($link,$query1);

$row1  = pg_fetch_assoc($result1);

$lote = $row1["lote"];

//incluímos la clase xajax
include( 'xajax/xajax_core/xajax.inc.php' );

//instanciamos el objeto de la clase xajax
$xajax = new xajax();

//registramos funciones 

$xajax->register( XAJAX_FUNCTION, 'ValidarFormulario' );
$xajax->register( XAJAX_FUNCTION, 'AgregarResultado' );

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

$xajax->configure( 'javascript URI', 'xajax/' );
//Funciones

function AgregarResultado($form) 
{
	extract($form);

	$respuesta = new xajaxResponse();
	//$respuesta->setCharacterEncoding( 'utf-8' );
	
	$codusu = $_SESSION[ 'codusu' ];

	$con = Conectarse();
	
	$sql1 = "select * from respeducacioncontinua where nroeval = '$nroeval' and codempresa = '$codempresa1' and nropregunta = '$nropregunta'";
    $res1=pg_query($con,$sql1);
    $numeroRegistros1=pg_num_rows($res1);

	$mensaje = '';

	if ($lote == "") {
		$mensaje .= '- Rellene el campo Lote!';

		$respuesta->Assign( "lote", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "lote", "style.backgroundColor", "" );
	}
	
	if ($nropregunta == "") {
		$mensaje .= '- Rellene el campo Respuesta!';

		$respuesta->Assign( "nropregunta", "style.backgroundColor", "yellow" );

	} else {
		$respuesta->Assign( "nropregunta", "style.backgroundColor", "" );
	}

	if ($mensaje == "") 
	{
		if($numeroRegistros1 == 0)
		{	
			pg_query( $con, "INSERT INTO respeducacioncontinua(
							nroeval, codempresa, nropregunta)
							VALUES ('$nroeval', '$codempresa1', '$nropregunta')" );
			
			pg_query( $con, "UPDATE evaleducacioncontinua
			SET lote='$lote'
			WHERE nroeval = '$nroeval' and codempresa = '$codempresa1'" );

			$respuesta->script("Ocultar()");
			
			// Bitacora
			include( "bitacora.php" );
			$codopc = "V_189";
			$fecha1 = date( "Y-n-j", time() );
			$hora = date( "G:i:s", time() );
			$accion = "Resultados Previstos: Educacion Continua: " . $nroeval;
			$terminal = $_SERVER[ 'REMOTE_ADDR' ];
			$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );
			// Fin grabacion de registro de auditoria
		}
		else
		{
			$respuesta->script('swal("Datos", "La Pregunta ya fue registrada!", "warning")');
		}
	} 
	else 
	{

		$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
	return $respuesta;
}

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
			
			   $tabla = 'evalbioquimica';
			
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
			
			   $tabla = 'evaldengue';
			
			   if($cantidad == 0)
			   {
				   $cantidad = 1;
			   }
			
			   $codopc = "V_182";
			
			   for ($i = 1; $i <= $cantidad; $i++) 
			   {
				   $resultado = $form["muestra$i"];

				   $cadena1     = "select * from matdengue where nroeval = '$nroeval' and codempresa = '$codempresa1' and nromuestra = 'muestra$i'";
				   $lista1      = pg_query($con, $cadena1);
				   $registro1   = pg_fetch_array($lista1);
				   
				   $cantregis1  = pg_num_rows($lista1);
				   
				   if($cantregis1 == 0)
			   	   {
				   		pg_query( $con, "INSERT INTO matdengue(
						nroeval, codempresa, resulprevisto, nromuestra)
						VALUES ('$nroeval', '$codempresa1', '$resultado', 'muestra$i')" );
				   }
				   else
				   {
					   pg_query( $con, "UPDATE matdengue
						SET resulprevisto='$resultado'
						WHERE nroeval = '$nroeval' and codempresa = '$codempresa1' and nromuestra = 'muestra$i'" );
				   }
			   }
			
			break;
		case '3':
			   
				$tabla = 'evalhematologia';
			
			   $cadena1     = "select * from evalhematologia where nroeval = '$nroeval' and codempresa = '$codempresa1'";
			   $lista1      = pg_query($con, $cadena1);
			   $registro1   = pg_fetch_array($lista1);
			   $cantregis1  = pg_num_rows($lista1);

			   $codopc = "V_183";
				
			    if($sbsinaltr == '')
				{
					$sbsinaltr = 2;
				}
			
				if($sbgranur == '')
				{
					$sbgranur = 2;
				}
			
				if($sbnucleor == '')
				{
					$sbnucleor = 2;
				}
			
				if($sbvacuolar == '')
				{
					$sbvacuolar = 2;
				}
			
				if($srsinaltr == '')
				{
					$srsinaltr = 2;
				}
			
				if($sranisocitr == '')
				{
					$sranisocitr = 2;
				}
			
				if($srmicrocitor == '')
				{
					$srmicrocitor = 2;
				}
			
				if($srmacrocitor == '')
				{
					$srmacrocitor = 2;
				}
			
				if($srnormocitr == '')
				{
					$srnormocitr = 2;
				}
			
				if($srpoiquilocitr == '')
				{
					$srpoiquilocitr = 2;
				}
			
				if($srnormocromr == '')
				{
					$srnormocromr = 2;
				}
			
				if($srhipocromiar == '')
				{
					$srhipocromiar = 2;
				}
			
				if($srpolicromar == '')
				{
					$srpolicromar = 2;
				}
			
				if($srnormoblar == '')
				{
					$srnormoblar = 2;
				}
			
				if($spmacroplaqsar == '')
				{
					$spmacroplaqsar = 2;
				}
			
				if($spmacropaqr == '')
				{
					$spmacropaqr = 2;
				}
			
				if($parleishmaniar == '')
				{
					$parleishmaniar = 2;
				}
			
				if($parplasmodr == '')
				{
					$parplasmodr = 2;
				}
			
			   if($cantregis1 == 0)
			   {
				   pg_query( $con, "INSERT INTO evalhematologia(
					nroeval, codempresa, permes, peranio, flneutrobandr, flneutrosegmr, fllinfor, fllinforeactr, flmonocitor, fleosinofilor, flbasofilor, flblastosr, flmielocitosr, flmetamielor, sbsinaltr, sbgranur, sbnucleor, sbvacuolar, srsinaltr, sranisocitr, srmicrocitor, srmacrocitor, srnormocitr, srpoiquilocitr, srnormocromr, srhipocromiar, srpolicromar, srnormoblar, spmacroplaqsar, spmacropaqr, parleishmaniar, parplasmodr)
					VALUES ('$nroeval', '$codempresa1', '$mes', '$anio', '$flneutrobandr', '$flneutrosegmr', '$fllinfor', '$fllinforeactr', '$flmonocitor', '$fleosinofilor', '$flbasofilor', '$flblastosr', '$flmielocitosr', '$flmetamielor', '$sbsinaltr', '$sbgranur', '$sbnucleor', '$sbvacuolar', '$srsinaltr', '$sranisocitr', '$srmicrocitor, '$srmacrocitor', '$srnormocitr', '$srpoiquilocitr', '$srnormocromr', '$srhipocromiar', '$srpolicromar', '$srnormoblar', '$spmacroplaqsar', '$spmacropaqr', '$parleishmaniar', '$parplasmodr');" );
			   }
			   else
			   {
				  pg_query( $con, "UPDATE evalhematologia
					SET permes='$mes', peranio='$anio', flneutrobandr='$flneutrobandr', flneutrosegmr='$flneutrosegmr', fllinfor='$fllinfor', fllinforeactr='$fllinforeactr', flmonocitor='$flmonocitor', fleosinofilor='$fleosinofilor', flbasofilor='$flbasofilor', flblastosr='$flblastosr', flmielocitosr='$flmielocitosr', flmetamielor='$flmetamielor', sbsinaltr='$sbsinaltr', sbgranur='$sbgranur', sbnucleor='$sbnucleor', sbvacuolar='$sbvacuolar', srsinaltr='$srsinaltr', sranisocitr='$sranisocitr', srmicrocitor='$srmicrocitor', srmacrocitor='$srmacrocitor', srnormocitr='$srnormocitr', srpoiquilocitr='$srpoiquilocitr', srnormocromr='$srnormocromr', srhipocromiar='$srhipocromiar', srpolicromar='$srpolicromar', srnormoblar='$srnormoblar', spmacroplaqsar='$spmacroplaqsar', spmacropaqr='$spmacropaqr', parleishmaniar='$parleishmaniar', parplasmodr='$parplasmodr'
					WHERE nroeval='$nroeval' and codempresa='$codempresa1'" );
			   }
			
			break;
		case '4':
			   
			   $tabla = 'evalinfluenza';
			
			   if($cantidad == 0)
			   {
				   $cantidad = 1;
			   }
			
			   $codopc = "V_184";
			
			   for ($i = 1; $i <= $cantidad; $i++) 
			   {
				   $resultado = $form["lamina$i"];

				   $cadena1     = "select * from matinfluenza where nroeval = '$nroeval' and codempresa = '$codempresa1' and nrolamina = 'lamina$i'";
				   $lista1      = pg_query($con, $cadena1);
				   $registro1   = pg_fetch_array($lista1);
				   
				   $cantregis1  = pg_num_rows($lista1);
				   
				   if($cantregis1 == 0)
			   	   {
				   		pg_query( $con, "INSERT INTO matinfluenza(
					nroeval, codempresa, resulprevisto, nrolamina)
					VALUES ('$nroeval', '$codempresa1', '$resultado', 'lamina$i')" );
				   }
				   else
				   {
					   pg_query( $con, "UPDATE matinfluenza
						SET resulprevisto='$resultado'
						WHERE nroeval = '$nroeval' and codempresa = '$codempresa1' and nrolamina = 'lamina$i'" );
				   }
			   }

			break;
		case '5':
			
			   $tabla = 'evalpintestinal';
			
			   $cadena1     = "select * from evalpintestinal where nroeval = '$nroeval' and codempresa = '$codempresa1'";
			   $lista1      = pg_query($con, $cadena1);
			   $registro1   = pg_fetch_array($lista1);
			   $cantregis1  = pg_num_rows($lista1);

			   $codopc = "V_185";
				
			    if($quisteencor == '')
				{
					$quisteencor = 2;
				}
			
				if($ooquister == '')
				{
					$ooquister = 2;
				}
			
				if($formasvacur == '')
				{
					$formasvacur = 2;
				}
			
				if($quistecolir == '')
				{
					$quistecolir = 2;
				}
			
				if($huevoascar == '')
				{
					$huevoascar = 2;
				}
			
				if($huevohymer == '')
				{
					$huevohymer = 2;
				}
			
				if($quistehistr == '')
				{
					$quistehistr = 2;
				}
			
				if($huevouncir == '')
				{
					$huevouncir = 2;
				}
			
				if($huevohymenar == '')
				{
					$huevohymenar = 2;
				}
			
				if($quistegiarr == '')
				{
					$quistegiarr = 2;
				}
			
				if($huevotricr == '')
				{
					$huevotricr = 2;
				}
			
				if($huevovermr == '')
				{
					$huevovermr = 2;
				}
			
				if($quisteiodar == '')
				{
					$quisteiodar = 2;
				}
			
				if($huevotaenr == '')
				{
					$huevotaenr = 2;
				}
			
				if($huevoschir == '')
				{
					$huevoschir = 2;
				}
			
				if($quistechilr == '')
				{
					$quistechilr = 2;
				}
			
				if($larvastronr == '')
				{
					$larvastronr = 2;
				}
			
				if($larvafilar == '')
				{
					$larvafilar = 2;
				}
			
				if($ooisteisor == '')
				{
					$ooisteisor = 2;
				}
			
				if($larvauncir == '')
				{
					$larvauncir = 2;
				}
			
				if($larvaancyr == '')
				{
					$larvaancyr = 2;
				}
			
				if($noseobsr == '')
				{
					$noseobsr = 2;
				}
			
			   if($cantregis1 == 0)
			   {
				   pg_query( $con, "INSERT INTO evalpintestinal(
					nroeval, codempresa, permes, peranio, quisteencor, ooquister, formasvacur, quistecolir, huevoascar, huevohymer, quistehistr, huevouncir, huevohymenar, quistegiarr, huevotricr, huevovermr, quisteiodar, huevotaenr, huevoschir, quistechilr, larvastronr, larvafilar, ooisteisor, larvauncir, larvaancyr, noseobsr, otrosespr)
					VALUES ('$nroeval', '$codempresa1', '$mes', '$anio', '$quisteencor', '$ooquister', '$formasvacur', '$quistecolir', '$huevoascar', '$huevohymer', '$quistehistr', '$huevouncir', '$huevohymenar', '$quistegiarr', '$huevotricr', '$huevovermr', '$quisteiodar', '$huevotaenr', '$huevoschir', '$quistechilr', '$larvastronr', '$larvafilar', '$ooisteisor', '$larvauncir', '$larvaancyr', '$noseobsr', '$otrosespr')" );
			   }
			   else
			   {
				  pg_query( $con, "UPDATE evalpintestinal
						SET quisteencor='$quisteencor', ooquister='$ooquister', formasvacur='$formasvacur', quistecolir='$quistecolir', huevoascar='$huevoascar', huevohymer='$huevohymer', quistehistr='$quistehistr', huevouncir='$huevouncir', huevohymenar='$huevohymenar', quistegiarr='$quistegiarr', huevotricr='$huevotricr', huevovermr='$huevovermr', quisteiodar='$quisteiodar', huevotaenr='$huevotaenr', huevoschir='$huevoschir', quistechilr='$quistechilr', larvastronr='$larvastronr', larvafilar='$larvafilar', ooisteisor='$ooisteisor', larvauncir='$larvauncir', larvaancyr='$larvaancyr', noseobsr='$noseobsr', otrosespr='$otrosespr'
						WHERE nroeval='$nroeval' and codempresa='$codempresa1'" );
			   }
			
			break;
		case '6':
			   
			   $tabla = 'evalrotavirus';
			
			   if($cantidad == 0)
			   {
				   $cantidad = 1;
			   }
			
			   $codopc = "V_186";
			
			   for ($i = 1; $i <= $cantidad; $i++) 
			   {
				   $resultado = $form["muestra$i"];

				   $cadena1     = "select * from matrotavirus where nroeval = '$nroeval' and codempresa = '$codempresa1' and nromuestra = 'muestra$i'";
				   $lista1      = pg_query($con, $cadena1);
				   $registro1   = pg_fetch_array($lista1);
				   
				   $cantregis1  = pg_num_rows($lista1);
				   
				   if($cantregis1 == 0)
			   	   {
				   		pg_query( $con, "INSERT INTO matrotavirus(
						nroeval, codempresa, resulprevisto, nromuestra)
						VALUES ('$nroeval', '$codempresa1', '$resultado', 'muestra$i')" );
				   }
				   else
				   {
					   pg_query( $con, "UPDATE matrotavirus
						SET resulprevisto='$resultado'
						WHERE nroeval = '$nroeval' and codempresa = '$codempresa1' and nromuestra = 'muestra$i'" );
				   }
			   }

			break;
		case '7':
			
		   $tabla = 'evalsifilis';
			
		   if($cantidad == 0)
		   {
			   $cantidad = 1;
		   }
		   
		   $codopc = "V_187";
			
		   for ($i = 1; $i <= $cantidad; $i++) 
		   {
			   $reactivo  	 = $form["reactivo$i"];
			   $esreactivor  = $form["esreactivor$i"];
			   $noesreactivor= $form["noesreactivor$i"];
			   $dilucionr	 = $form["dilucionr$i"];
			   $nrotubo 	 = $form["nrotubo$i"];

			   $cadena1     = "select * from resulsifilis where nroeval = '$nroeval' and codempresa = '$codempresa1' and reactivo = '$reactivo' and nrotubo = '$nrotubo'";
			   $lista1      = pg_query($con, $cadena1);
			   $registro1   = pg_fetch_array($lista1);

			   $cantregis1  = pg_num_rows($lista1);

			   if($cantregis1 == 0)
			   {
				   	$unro = pg_query( $con, "select max(nrotubo) as ultimo from resulsifilis where nroeval = '$nroeval' and codempresa = '$codempresa1' and reactivo = '$reactivo'" );

					while ( $rowcod = pg_fetch_array( $unro ) ) {
						$nrotubo = $rowcod[ 'ultimo' ] + 1;
					}
				   
				    pg_query( $con, "INSERT INTO resulsifilis(
					nroeval, codempresa, reactivo, nrotubo, esreactivor, noesreactivor, dilucionr)
					VALUES ('$nroeval', '$codempresa1', '$reactivo', '$nrotubo', '$esreactivor', '$noesreactivor', '$dilucionr')" );
			   }
			   else
			   {
				   pg_query( $con, "UPDATE resulsifilis
					SET esreactivor='$esreactivor', noesreactivor='$noesreactivor', dilucionr='$dilucionr'
					WHERE nroeval = '$nroeval' and codempresa = '$codempresa1' and reactivo = '$reactivo' and nrotubo = '$nrotubo'" );
			   }
		   }
			
			break;
		case '8':
			
			   $tabla = 'evalmalaria';
			
			   if($cantidad == 0)
			   {
				   $cantidad = 1;
			   }

			   $codopc = "V_188";

			   for ($i = 1; $i <= $cantidad; $i++) 
			   {
				   $resultado = $form["lamina$i"];
				   $norden    = $form["norden$i"];

				   $cadena1     = "select * from lamimalaria where nroeval = '$nroeval' and codempresa = '$codempresa1' and norden = '$norden'";
				   $lista1      = pg_query($con, $cadena1);
				   $registro1   = pg_fetch_array($lista1);

				   $cantregis1  = pg_num_rows($lista1);

				   if($cantregis1 == 0)
				   {
						$unro = pg_query( $con, "select max(norden) as ultimo from lamimalaria where nroeval = '$nroeval' and codempresa = '$codempresa1'" );

						while ( $rowcod = pg_fetch_array( $unro ) ) {
							$norden = $rowcod[ 'ultimo' ] + 1;
						}
					   
					   pg_query( $con, "INSERT INTO lamimalaria(
					nroeval, codempresa, norden, resulprevisto, codlamina)
					VALUES ('$nroeval', '$codempresa1', '$norden', '$resultado', 'lamina$i')" );
				   }
				   else
				   {
					   pg_query( $con, "UPDATE lamimalaria
						SET resulprevisto='$resultado'
						WHERE nroeval = '$nroeval' and codempresa = '$codempresa1' and codlamina = 'lamina$i' and norden = '$norden'" );
				   }
			   }
			
			break;
		case '9':
			
			$tabla = 'evaleducacioncontinua';
			
			$unro = pg_query( $con, "select max(CAST(coalesce(nroeval, '0') AS integer)) as ultimo from evaleducacioncontinua where codempresa = '$codempresa'" );

			while ( $rowcod = pg_fetch_array( $unro ) ) {
				$nroeval = $rowcod[ 'ultimo' ] + 1;
			}

			$tabla = 'evaleducacioncontinua';
			break;
	}
	
	pg_query( $con, "UPDATE ".$tabla."
			SET lote='$lote'
			WHERE nroeval = '$nroeval' and codempresa = '$codempresa1'" );

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
					$('#nropregunta').val('');
				    gridReload();
			  });
			
			  $('#myModal').on('shown.bs.modal', function () {
					$('#nropregunta').focus();
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
			padding: 10px 0px 0px 0px;
			vertical-align: top;
		}
		
		#wb_FontAwesomeIcon4:hover {
			background-color: transparent;
			background-image: none;
			border: 0px #245580 solid;
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
			width: 20%;
			height: 26px;
			line-height: 26px;
			z-index: 35;
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
		   border: 1px #000000 solid;
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
		   border: 1px #000000 solid;
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
		   border: 1px #000000;
		   text-align: left;
		   vertical-align: middle;
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
		
		
		.general
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
		.general:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		.general
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		.general1
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
		.general1:focus
		{
		   border-color: #66AFE9;
		   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
		   outline: 0;
		}
		.general1
		{
		   display: block;
		   width: 100%;
		   height: 22px;
		   line-height: 22px;
		   z-index: 31;
		}
		
		#wb_LayoutGrid77 {
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
		
		#LayoutGrid77 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0px 15px 0px 15px;
			margin-right: auto;
			margin-left: auto;
		}
		
		#LayoutGrid77 .row {
			margin-right: -15px;
			margin-left: 15px;
		}
		
		#LayoutGrid77 .col-1,
		#LayoutGrid77 .col-2 {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 0px;
			min-height: 1px;
			padding-right: 15px;
			padding-left: 15px;
			position: relative;
		}
		
		#LayoutGrid77 .col-1,
		#LayoutGrid77 .col-2 {
			float: left;
		}
		
		#LayoutGrid77 .col-1 {
			background-color: transparent;
			background-image: none;
			width: 100%;
			text-align: left;
		}
		
		#LayoutGrid77 .col-2 {
			background-color: transparent;
			background-image: none;
			display: none;
			width: 0;
			text-align: left;
		}
		
		#LayoutGrid77:before,
		#LayoutGrid77:after,
		#LayoutGrid77 .row:before,
		#LayoutGrid77 .row:after {
			display: table;
			content: " ";
		}
		
		#LayoutGrid77:after,
		#LayoutGrid77 .row:after {
			clear: both;
		}
		
		@media (max-width: 480px) {
			#LayoutGrid77 .col-1,
			#LayoutGrid77 .col-2 {
				float: none;
				width: 100%;
			}
		}
		
		#wb_LayoutGrid77 {
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
		#wb_LayoutGrid77 {
				margin-top: 0px;
				margin-bottom: 0px;
			}
		#LayoutGrid77 {
				padding: 0px 15px 0px 15px;
			}
		#LayoutGrid77 .row {
				margin-right: -15px;
				margin-left: -15px;
			}
		#LayoutGrid77 .col-1,
		#LayoutGrid77 .col-2 {
				padding-right: 15px;
				padding-left: 15px;
			}
		#LayoutGrid77 .col-1 {
				display: block;
				width: 33.33333333%;
				text-align: left;
			}
		#LayoutGrid77 .col-2 {
				display: block;
				width: 66.66666667%;
				text-align: left;
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
	
	<script>
		$( function () {
			var lastsel2;

			jQuery( "#listapacientes" ).jqGrid( {
				url: 'datoseducacioncontinua1.php?nroeval=<?php echo $nroeval; ?>&codempresa=<?php echo $codempresa; ?>',
				datatype: 'json',
				mtype: 'GET',
				loadonce: true,
				height: 200,
				recordpos: 'left',
				pagerpos: 'right',

				gridview: true,

				colNames: ['Borrar', 'Pregunta', 'Respuesta Prevista'],
				colModel: [ {
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
					name: 'textopregunta',
					index: 'textopregunta',
					width: 400,
					align: "left",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 100,
							size: 80,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}, {
					name: 'respuesta',
					index: 'respuesta',
					width: 200,
					align: "center",
					editable: true,
					searchoptions: {
						attr: {
							maxlength: 80,
							size: 80,
							style: "width:auto;padding:1;max-width:100%;height:3em;float:left"
						}
					}
				}],

				caption: "RESPUESTAS",
				ignoreCase: true,
				pager: '#perpage',
				rowNum: 7,
				rowList: [ 7, 15, 30 ],
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
				},

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
		
	</script>
	
	<script language="JavaScript">
		
		function gridReload()
		{ 
			var nroeval    = jQuery("#nroeval").val();
			var codempresa = jQuery("#codempresa1").val();
			
	
			jQuery("#listapacientes").jqGrid('setGridParam',{url:"datoseducacioncontinua1.php?nroeval="+nroeval+"&codempresa="+codempresa,datatype:'json'}).trigger("reloadGrid");

		}
		
		function Ocultar()
		{ 
			$("[data-dismiss=modal]").trigger({ type: "click" });
		}
		
		function confirmacion(cod, est, tipo) 
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
						window.location = "eliminar_resultados_previstos.php?nroeval=" + cod + "&codempresa=" + est + "&nropregunta=" + tipo;
					  } 
					  else 
					  {
						swal("El registro salvado!");
					  }
				});
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

		function validarcar(e) { // 1
			tecla = (document.all) ? e.keyCode : e.which; // 2
			if (tecla==8) return true; // 3
			patron =/[<>!=*&%$#'"{}?]/; // 4
			te = String.fromCharCode(tecla); // 5
			return !patron.test(te); // 6
		}
		
		function agregar(e)
		{
			var cont = jQuery("#cantidad").val();
			
			if(e.keyCode == 13 || e.keyCode == 9)
			{
			  	cont++;
				
				if(cont == 0)
				{
				   cont = 1;
				}
				
				var fila='<tr><td class="cell1"><span style="color:#000000; font-size: 14px;"> Muestra '+cont+'</span></td><td class="cell1"><input type="text" id="muestra'+cont+'" name="muestra'+cont+'" class="general"  spellcheck="false" maxlength="100" onkeypress="return agregar(event)"></td></tr>';

				$('#respuesta_clinica_detallesTable1').append(fila);
				$('#muestra'+cont).last().focus();

				jQuery("#cantidad").val(cont);
			}
		}
		
		function agregar1(e)
		{
			var cont = jQuery("#cantidad").val();
			
			if(cont == 0)
			{
			   cont = 1;
			}
			
			if(e.keyCode == 13 || e.keyCode == 9)
			{
			  	cont++;
			
				var fila='<tr><td class="cell1"><span style="color:#000000; font-size: 14px;"> Lamina '+cont+'</span></td><td class="cell1"><input type="text" id="lamina'+cont+'" name="lamina'+cont+'"  spellcheck="false" maxlength="100" class="general" onkeypress="return agregar1(event)"></td></tr>';

				$('#respuesta_clinica_detallesTable1').append(fila);
				$('#lamina'+cont).last().focus();

				jQuery("#cantidad").val(cont);
			}
		}
		
		function agregar2(e)
		{
			var cont = jQuery("#cantidad").val();
			
			if(cont == 0)
			{
			   cont = 1;
			}
			   
			if(e.keyCode == 13 || e.keyCode == 9)
			{
			  	cont++;
			
				var fila='<tr><td class="cell1"><input type="text" id="reactivo'+cont+'" name="reactivo'+cont+'" value="" class="general1" spellcheck="false" maxlength="50" autofocus></td><td class="cell1"><input type="text" id="nrotubo'+cont+'" name="nrotubo'+cont+'" value="" class="general1" spellcheck="false" maxlength="1" background-color:#DCDCDC;" readonly></td><td class="cell1"><input type="text" id="esreactivor'+cont+'" name="esreactivor'+cont+'" value="" class="general1" spellcheck="false" maxlength="50"></td><td class="cell1"><input type="text" id="noesreactivor'+cont+'" name="noesreactivor'+cont+'" value="" class="general1" spellcheck="false" maxlength="20"></td><td class="cell1"><input type="text" id="dilucionr'+cont+'" name="dilucionr'+cont+'" value="" class="general1" spellcheck="false" maxlength="100" onkeypress="return agregar2(event)"></td></tr>';

				$('#respuesta_clinica_detallesTable1').append(fila);
				$('#reactivo'+cont).last().focus();

				jQuery("#cantidad").val(cont);
			}
		}
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
				<input type="hidden" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>">
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
				<div id="wb_LayoutGrid6">
					<div id="LayoutGrid6">
						<div class="row">
							<div class="col-1">
								<div id="wb_Text4"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Lote: </strong></span> </div>
							</div>
							<div class="col-2">
								<input type="text" id="lote" name="lote" value="<?php echo $lote; ?>" spellcheck="false" maxlength="20" autofocus>
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
									   if(trim($codempresa) === trim($depto["codempresa"]))
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

	<?php
		if($texamen != 9)
		{
			echo '<div id="wb_turnos_detallesLayoutGrid4">
					<div id="turnos_detallesLayoutGrid4">
						<div class="row">
							<div class="col-1">

								<button type="button" class="btn btn-primary btn-lg" onclick="xajax_ValidarFormulario(xajax.getFormValues(formu));">
											Guardar Datos</button>
							</div>
						</div>
					</div>
				</div>';
		}

	?>
	<br>
	<?php
		if($texamen == 9)
		{
			echo '<div id="wb_LayoutGrid77">
					<div id="LayoutGrid77">
						<div class="row">
							<div class="col-1">
							  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" id="button">
								Agregar
								</button>
							</div>
							<div class="col-2">
							</div>
						</div>
					</div>
				</div>';
		}

	?>
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
									<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Analitos</span>
									</th>
									<th width="550" class="cell0"><span style="color:#000000; font-size: 14px;"> Resultado Previsto</span>
									</th>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;"> Glicemia</span>
									</td>
									<td class="cell2"><input type="text" id="resulprevisto1" name="resulprevisto1" value="'.$resulprevisto1.'" spellcheck="false" maxlength="100" autofocus>
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;"> Urea</span>
									</td>
									<td class="cell2"><input type="text" id="resulprevisto2" name="resulprevisto2" value="'.$resulprevisto2.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;"> Creatinina</span>
									</td>
									<td class="cell2"><input type="text" id="resulprevisto3" name="resulprevisto3" value="'.$resulprevisto3.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;"> Colesterol</span>
									</td>
									<td class="cell1"><span style="color:#000000;"> </span>
									<input type="text" id="resulprevisto4" name="resulprevisto4" value="'.$resulprevisto4.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;"> Trigliceridos</span>
									</td>
									<td class="cell1"><span style="color:#000000;"> </span>
									<input type="text" id="resulprevisto5" name="resulprevisto5" value="'.$resulprevisto5.'" spellcheck="false" maxlength="100">
									</td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;">GOT (AST)</span>
									</td>
									<td class="cell1"><input type="text" id="resulprevisto6" name="resulprevisto6" value="'.$resulprevisto6.'" spellcheck="false" maxlength="100"></td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;">GPT (ALT)</span>
									</td>
									<td class="cell1"><input type="text" id="resulprevisto7" name="resulprevisto7" value="'.$resulprevisto7.'" spellcheck="false" maxlength="100"></td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;">Proteinas totales</span>
									</td>
									<td class="cell1"><input type="text" id="resulprevisto8" name="resulprevisto8" value="'.$resulprevisto8.'" spellcheck="false" maxlength="100"></td>
								</tr>
								<tr>
									<td class="cell1"><span style="color:#000000; font-size: 14px;"> Albumina</span>
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
									<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Material de Control</span>
									</th>
									<th width="550" class="cell0"><span style="color:#000000; font-size: 14px;"> Resultado Previsto</span>
									</th>
								</tr>';
								
								if($cantidad != 0)
								{
									$i = 0;
									
									while ($row = pg_fetch_array($result))
									{
										$i = $i + 1;
										
										echo '<tr>
											<td class="cell1"><span style="color:#000000; font-size: 14px;"> Muestra '.$i.'</span>
											</td>
											<td class="cell2"><input type="text" id="muestra'.$i.'" name="muestra'.$i.'" value="'.$row["resulprevisto"].'" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar(event)" autofocus>
											</td>
										</tr>';
									}
								}
								else
								{
									echo '<tr>
										<td class="cell1"><span style="color:#000000; font-size: 14px;"> Muestra 1</span>
										</td>
										<td class="cell2"><input type="text" id="muestra1" name="muestra1" value="" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar(event)" autofocus>
										</td>
									</tr>';
								}
								
						echo  '</table>
						</div>
					</div>
				</div>
			</div>';

				break;
			case '3':
				
				echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
						<div id="respuesta_clinica_detallesLayoutGrid1">
							<div class="row">
								<div class="col-1">
									<table width="748" id="respuesta_clinica_detallesTable1" align="center">
										<tr>
											<th colspan="2" class="cell0"><span style="color:#000000; font-size: 14px;"> FORMULA LEUCOCITARIA</span>
											</th>
										</tr>
										<tr>
											<td width="584" class="cell1"><span style="color:#000000; font-size: 14px;"> Neutr&oacute;filos en Banda</span>
											</td>
											<td width="152" class="cell1"><input type="text" id="flneutrobandr" name="flneutrobandr" value="'.$flneutrobandr.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000" autofocus>
											</td>
										</tr>
										<tr>
											<td class="cell1"><span style="color:#000000; font-size: 14px;"> Neutr&oacute;filos Segmentados</span>
											</td>
											<td class="cell1"><input type="text" id="flneutrosegmr" name="flneutrosegmr" value="'.$flneutrosegmr.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000">
											</td>
										</tr>
										<tr>
											<td class="cell1"><span style="color:#000000; font-size: 14px;"> Linfocitos</span>
											</td>
											<td class="cell1"><input type="text" id="fllinfor" name="fllinfor" value="'.$fllinfor.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000">
											</td>
										</tr>
										<tr>
											<td class="cell1"><span style="color:#000000; font-size: 14px;"> Linfocitos Reactivos</span>
											</td>
											<td class="cell1">
											<input type="text" id="fllinforeactr" name="fllinforeactr" value="'.$fllinforeactr.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000">
											</td>
										</tr>
										<tr>
											<td class="cell1"><span style="color:#000000; font-size: 14px;"> Monocitos</span>
											</td>
											<td class="cell1">
											<input type="text" id="flmonocitor" name="flmonocitor" value="'.$flmonocitor.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000">
											</td>
										</tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Eosin&oacute;filos</span></td>
										  <td class="cell1"><input type="text" id="fleosinofilor" name="fleosinofilor" value="'.$fleosinofilor.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Bas&oacute;filos</span></td>
										  <td class="cell1"><input type="text" id="flbasofilor" name="flbasofilor" value="'.$flbasofilor.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Blastos</span></td>
										  <td class="cell1"><input type="text" id="flblastosr" name="flblastosr" value="'.$flblastosr.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Mielocitos</span></td>
										  <td class="cell1"><input type="text" id="flmielocitosr" name="flmielocitosr" value="'.$flmielocitosr.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; border-bottom: #000000 solid;  width: 97%; color: #000000"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Metamielocitos</span></td>
										  <td class="cell1"><input type="text" id="flmetamielor" name="flmetamielor" value="'.$flmetamielor.'" spellcheck="false" maxlength="100" style="border-left:#000000 solid; width: 97%; color: #000000"></td>
									  </tr>
										<tr>
										  <th colspan="2" class="cell0"><span style="color:#000000; font-size: 14px;"> SERIE BLANCA &#45; ELEMENTOS ENCONTRADOS</span>	
											</th>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Sin alteraciones</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="sbsinaltr" name="sbsinaltr" value="1" '.$chk1.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Granulaciones t&oacute;xicas en Neutr&oacute;filos</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="sbgranur" name="sbgranur" value="1" '.$chk2.' spellcheck="false" ></td>
									  </tr>

										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Presencia de Nucl&eacute;olos</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="sbnucleor" name="sbnucleor" value="1" '.$chk3.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Presencia de vacuolas en el citoplasma (excepto en monocitos)</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="sbvacuolar" name="sbvacuolar" value="1" '.$chk4.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <th colspan="2" class="cell0"><span style="color:#000000; font-size: 14px;"> SERIE ROJA &#45; ELEMENTOS ENCONTRADOS </span>
										</th>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Sin alteraciones</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srsinaltr" name="srsinaltr" value="1" '.$chk5.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Anisocitosis</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="sranisocitr" name="sranisocitr" value="1" '.$chk6.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Microcitos</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srmicrocitor" name="srmicrocitor" value="1" '.$chk7.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Macrocitos</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srmacrocitor" name="srmacrocitor" value="1" '.$chk8.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Normoc&iacute;ticos</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srnormocitr" name="srnormocitr" value="1" '.$chk9.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Poiquilocitosis</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srpoiquilocitr" name="srpoiquilocitr" value="1" '.$chk10.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Normocr&oacute;mico</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srnormocromr" name="srnormocromr" value="1" '.$chk11.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Hipocrom&iacute;a</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srhipocromiar" name="srhipocromiar" value="1" '.$chk12.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Policromat&oacute;filos</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srpolicromar" name="srpolicromar" value="1" '.$chk13.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Normoblastos / Eritroblastos</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="srnormoblar" name="srnormoblar" value="1" '.$chk14.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <th colspan="2" class="cell0"><span style="color:#000000; font-size: 14px;"> SERIE PLAQUETARIA </span>
										</th>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Sin alteraciones</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="spmacroplaqsar" name="spmacroplaqsar" value="1" '.$chk15.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Presencia de Macroplaquetas</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="spmacropaqr" name="spmacropaqr" value="1" '.$chk16.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <th colspan="2" class="cell0"><span style="color:#000000; font-size: 14px;"> PARASITOS </span>
										</th>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Leishmania sp.</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="parleishmaniar" name="parleishmaniar" value="1" '.$chk17.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Plasmodium sp.</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="parplasmodr" name="parplasmodr" value="1" '.$chk18.' spellcheck="false" ></td>
									  </tr>
									</table>
								</div>
							</div>
						</div>
					</div>';
				
				break;
			case '4':

				echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
						<div id="respuesta_clinica_detallesLayoutGrid1">
							<div class="row">
								<div class="col-1">
									<table width="748" id="respuesta_clinica_detallesTable1" align="center">
										<tr>
											<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Material de Control</span>
											</th>
											<th width="550" class="cell0"><span style="color:#000000; font-size: 14px;"> Resultado Previsto</span>
											</th>
										</tr>';
										if($cantidad != 0)
										{
											$i = 0;

											while ($row = pg_fetch_array($result))
											{
												$i = $i + 1;

												echo '<tr>
													<td class="cell1"><span style="color:#000000; font-size: 14px;"> Lamina '.$i.'</span>
													</td>
													<td class="cell2"><input type="text" id="lamina'.$i.'" name="lamina'.$i.'" value="'.$row["resulprevisto"].'" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar1(event)" autofocus>
													</td>
												</tr>';
											}
										}
										else
										{
											echo '<tr>
												<td class="cell1"><span style="color:#000000; font-size: 14px;"> Lamina 1</span>
												</td>
												<td class="cell2"><input type="text" id="lamina1" name="lamina1" value="" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar1(event)" autofocus>
												</td>
											</tr>';
										}
										
								echo  '</table>
								</div>
							</div>
						</div>
					</div>';

				break;
			case '5':

				echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
						<div id="respuesta_clinica_detallesLayoutGrid1">
							<div class="row">
								<div class="col-1">
									<table width="748" id="respuesta_clinica_detallesTable1" align="center">
										<tr>
										  <th colspan="2" class="cell0"><span style="color:#000000; font-size: 14px;"> PAR&Aacute;SITOS ENCONTRADOS</span>	
											</th>
									  </tr>
										<tr>
										  <td width="584" class="cell1"><span style="color:#000000; font-size: 14px;"> Quistes de Endolimax nana</span></td>
										  <td width="152" class="cell1" style="text-align: center"><input type="checkbox" id="quisteencor" name="quisteencor" value="1" '.$chk1.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> Ooquistes de Cryptosporidium sp.</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="ooquister" name="ooquister" value="1" '.$chk2.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Formas vacuoladas de Blastocystis hominis </span> </td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="formasvacur" name="formasvacur" value="1" '.$chk3.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Quistes de Entamoeba coli </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="quistecolir" name="quistecolir" value="1" '.$chk4.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos de Ascaris lumbricoides</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevoascar" name="huevoascar" value="1" '.$chk5.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos de Hymenolepis diminuta </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevohymer" name="huevohymer" value="1" '.$chk6.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Quistes de Entamoeba histolytica</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="quistehistr" name="quistehistr" value="1" '.$chk7.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos de Uncinaria </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevouncir" name="huevouncir" value="1" '.$chk8.' spellcheck="false"></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos  de Hymenolepis nana </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevohymenar" name="huevohymenar" value="1" '.$chk9.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Quistes de Giardia lamblia </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="quistegiarr" name="quistegiarr" value="1" '.$chk10.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos de Trichuris trichiura </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevotricr" name="huevotricr" value="1" '.$chk11.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos de Enterobius vermicularis </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevovermr" name="huevovermr" value="1" '.$chk12.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Quistes de Iodamoeba butschlii </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="quisteiodar" name="quisteiodar" value="1" '.$chk13.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos de Taenia </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevotaenr" name="huevotaenr" value="1" '.$chk14.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Huevos de Schistosoma mansoni </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="huevoschir" name="huevoschir" value="1" '.$chk15.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Quistes de  Chilomastix mesnili </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="quistechilr" name="quistechilr" value="1" '.$chk16.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Larvas Rabditoides de Strongyloides stercoralis </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="larvastronr" name="larvastronr" value="1" '.$chk17.' spellcheck="false" ></td>
									  </tr>
										<tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Larvas filariformes de Necator americanus </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="larvafilar" name="larvafilar" value="1" '.$chk18.' spellcheck="false" ></td>
									  </tr>
									  <tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Ooquistes de Isospora belli </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="ooisteisor" name="ooisteisor" value="1" '.$chk19.' spellcheck="false" ></td>
									  </tr>
									  <tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Larvas Rabditoides de Uncinaria </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="larvauncir" name="larvauncir" value="1" '.$chk20.' spellcheck="false" ></td>
									  </tr>
									  <tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;">Larvas filariformes de Ancylostoma duodenal </span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="larvaancyr" name="larvaancyr" value="1" '.$chk21.' spellcheck="false" ></td>
									  </tr>
									  <tr>
										  <td class="cell1"><span style="color:#000000; font-size: 14px;"> No se observa</span></td>
										  <td class="cell1" style="text-align: center"><input type="checkbox" id="noseobsr" name="noseobsr" value="1" '.$chk22.' spellcheck="false" ></td>
									  </tr>
									  <tr>
										  <td height="25" colspan="2" class="cell1"><span style="color:#000000; font-size: 14px;"> Otros</span></td>
									  </tr>
									  <tr>
										<td colspan="2" class="cell1"><input type="text" name="otrosespr" id="otrosespr" value="'.$otrosespr.'" maxlength="250" style="width: 80%; color: #000000; onkeypress="return validarcar(event)" onchange="conMayusculas(this)"></td>
										<br>
									  </tr>
									</table>
								</div>
							</div>
						</div>
					</div>';

				break;
			case '6':

				echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
						<div id="respuesta_clinica_detallesLayoutGrid1">
							<div class="row">
								<div class="col-1">
									<table width="748" id="respuesta_clinica_detallesTable1" align="center">
										<tr>
											<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Material de Control</span>
											</th>
											<th width="550" class="cell0"><span style="color:#000000; font-size: 14px;"> Resultado Previsto</span>
											</th>
										</tr>';

										if($cantidad != 0)
										{
											$i = 0;

											while ($row = pg_fetch_array($result))
											{
												$i = $i + 1;

												echo '<tr>
													<td class="cell1"><span style="color:#000000; font-size: 14px;"> Muestra '.$i.'</span>
													</td>
													<td class="cell2"><input type="text" id="muestra'.$i.'" name="muestra'.$i.'" value="'.$row["resulprevisto"].'" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar(event)" autofocus>
													</td>
												</tr>';
											}
										}
										else
										{
											echo '<tr>
												<td class="cell1"><span style="color:#000000; font-size: 14px;"> Muestra 1</span>
												</td>
												<td class="cell2"><input type="text" id="muestra1" name="muestra1" value="" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar(event)" autofocus>
												</td>
											</tr>';
										}

								echo  '</table>
								</div>
							</div>
						</div>
					</div>';

				break;
			case '7':

				echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
						<div id="respuesta_clinica_detallesLayoutGrid1">
							<div class="row">
								<div class="col-1">
								   <table width="748" id="respuesta_clinica_detallesTable1" align="center">
									<tr>
									<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Test</span>
									</th>
									<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Tubo</span>
									</th>
								  <th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Reactivo</span>
									</th>
									<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> No Reactivo</span>
									</th>
									<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Diluci&oacute;n</span>
									</th>
								</tr>';

									if($cantidad != 0)
									{
										$i = 0;

										while ($row = pg_fetch_array($result))
										{
											$i = $i + 1;

											echo '<tr>
												<td class="cell1"><span style="color:#000000; font-size: 14px;"><input type="text" id="reactivo'.$i.'" name="reactivo'.$i.'" value="'.$row["reactivo"].'" class="general1" spellcheck="false" maxlength="50" background-color:#DCDCDC;" readonly>
												</td>
												<td class="cell1"><span style="color:#000000; font-size: 14px;"><input type="text" id="nrotubo'.$i.'" name="nrotubo'.$i.'" value="'.$row["nrotubo"].'" class="general1" spellcheck="false" maxlength="1" background-color:#DCDCDC;" readonly>
												</td>
												<td class="cell2"><input type="text" id="esreactivor'.$i.'" name="esreactivor'.$i.'" value="'.$row["esreactivor"].'" class="general1" spellcheck="false" maxlength="50">
												</td>
												<td class="cell2"><input type="text" id="noesreactivor'.$i.'" name="noesreactivor'.$i.'" value="'.$row["noesreactivor"].'" class="general1" spellcheck="false" maxlength="20">
												</td>
												<td class="cell2"><input type="text" id="dilucionr'.$i.'" name="dilucionr'.$i.'" value="'.$row["dilucionr"].'" class="general1" spellcheck="false" maxlength="100" onkeypress="return agregar2(event)" autofocus>
												</td>
											</tr>';
										}
									}
									else
									{
										echo '<tr>
												<td class="cell1"><input type="text" id="reactivo1" name="reactivo1" value="" class="general1" spellcheck="false" maxlength="50" autofocus>
												</td>
												<td class="cell1"><input type="text" id="nrotubo1" name="nrotubo1" value="" class="general1" spellcheck="false" maxlength="1" background-color:#DCDCDC;" readonly>
												</td>
												<td class="cell2"><input type="text" id="esreactivor1" name="esreactivor1" value="" class="general1" spellcheck="false" maxlength="50">
												</td>
												<td class="cell2"><input type="text" id="noesreactivor1" name="noesreactivor1" value="" class="general1" spellcheck="false" maxlength="20">
												</td>
												<td class="cell2"><input type="text" id="dilucionr1" name="dilucionr1" value="" class="general1" spellcheck="false" maxlength="100" onkeypress="return agregar2(event)">
												</td>
											</tr>';
									}

								echo  '</table>
								</div>
							</div>
						</div>
					</div>';
				
				break;
			case '8':

				echo '<div id="wb_respuesta_clinica_detallesLayoutGrid1">
						<div id="respuesta_clinica_detallesLayoutGrid1">
							<div class="row">
								<div class="col-1">
									<table width="748" id="respuesta_clinica_detallesTable1" align="center">
										<tr>
											<th width="186" class="cell0"><span style="color:#000000; font-size: 14px;"> Material de Control</span>
											</th>
											<th width="550" class="cell0"><span style="color:#000000; font-size: 14px;"> Resultado Previsto</span>
											</th>
										</tr>';
										if($cantidad != 0)
										{
											$i = 0;

											while ($row = pg_fetch_array($result))
											{
												$i = $i + 1;

												echo '<tr>
													<td class="cell1"><span style="color:#000000; font-size: 14px;"> Lamina '.$i.'</span>
													</td>
													<td class="cell2"><input type="text" id="lamina'.$i.'" name="lamina'.$i.'" value="'.$row["resulprevisto"].'" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar1(event)" autofocus>
													<input type="hidden" id="norden'.$i.'" name="norden'.$i.'" value="'.$row["norden"].'">
													</td>
												</tr>';
											}
										}
										else
										{
											echo '<tr>
												<td class="cell1"><span style="color:#000000; font-size: 14px;"> Lamina 1</span>
												</td>
												<td class="cell2"><input type="text" id="lamina1" name="lamina1" value="" class="general" spellcheck="false" maxlength="100" onkeypress="return agregar1(event)" autofocus>
												</td>
											</tr>';
										}
										
								echo  '</table>
								</div>
							</div>
						</div>
					</div>';

				break;
			case '9':
				
				echo '<div id="wb_turnos_detallesLayoutGrid2">
						<div id="turnos_detallesLayoutGrid2">
							<div class="row">
								<div class="col-1">
									<div id="wb_turnos_detallesText2">
										<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>RESPUESTAS PREVISTAS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong></span>
									</div>
								</div>
							</div>
						</div>
					</div>';
				
				echo '<div id="wb_LayoutGrid4">
						<div id="LayoutGrid4">
							<div class="row">
								<div class="col-1">
									<div class="jqGrid">
										<br/>
										<table id="listapacientes"></table>
										<div id="perpage"></div>
								  </div>
								</div>
							</div>
						</div>
					</div>';

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
		
	<!-- Modal -->

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <br>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
			Pregunta
			<select name="nropregunta" size="1" id="nropregunta" style="width: 80%" autofocus>
                       <option value=""></option>
                        <?php
							$tabla_dpto = pg_query($link, "select * from preguntaedcontinua");
							while($depto = pg_fetch_array($tabla_dpto)) 
							{
							   if(trim($nropregunta) == trim($depto["nropregunta"]))
								{
									echo '<option value="'.$depto["nropregunta"].'" selected>'.utf8_decode($depto["textopregunta"]).'</option>';
								}
								else
								{
									echo '<option value="'.$depto["nropregunta"].'">'.utf8_decode($depto["textopregunta"]).'</option>';
								}
							}
            			?>
    				</select>
			  
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="xajax_AgregarResultado(xajax.getFormValues('formu'));">Guardar Datos</button>
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
	
	<!-- jqGrid Lib(js, css) -->
	<link rel="stylesheet" href="jqgrid/jquery-ui.css"/>
	<link rel="stylesheet" href="jqgrid/ui.jqgrid.css"/>

	<script src="jqgrid/grid.locale-es.js"></script>
	<script src="jqgrid/jquery.jqGrid.min.js"></script>
<!-- end -->
<link rel="stylesheet" href="jqgrid/style.css"/>

</body>
<?php
if ($_GET["mensage"]==1)
{
	echo "<script type=''>
     swal('El registro ha sido eliminado!','','success'); 
     </script>"; 
}
?>
</html>
<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

include("conexion.php");
$link=Conectarse();

include("conexionsaa.php");
$consaa=Conectarsesaa();

include("conexiontb.php");
$contb=Conectarsetb();

include("conexionpol.php");
$conpol=Conectarsepol();

$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

$elusuario=$nomyape;

$v_11  = $_SESSION['V_11'];
$v_111 = $_SESSION['V_111'];	// Conectar Paciente TB
$v_112 = $_SESSION['V_112'];	// Historia Clínica
$v_113 = $_SESSION['V_113'];	// Turnos

$nropaciente  = $_GET["nropaciente"]; //Identificador del registro

$query = "select * from paciente where nropaciente = '$nropaciente'";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$fechareg 		= $row["fechareg"];
$tdocumento 	= $row["tdocumento"];
$cedula 		= $row["cedula"];
$pnombre 		= $row["pnombre"];
$snombre 		= $row["snombre"];
$papellido 		= $row["papellido"];
$sapellido 		= $row["sapellido"];
$sexo 			= $row["sexo"];
$fechanac 		= $row["fechanac"];
$edada 			= $row["edada"];
$edadm 			= $row["edadm"];
$ecivil 		= $row["ecivil"];
$nacionalidad 	= $row["nacionalidad"];
$telefono 		= $row["telefono"];
$email 			= $row["email"];
$codexterno 	= $row["codexterno"];
$estado 		= $row["estado"];
$dccionr 		= $row["dccionr"];
$paisr 			= $row["paisr"];
$coddptor 		= $row["coddptor"];
$coddistr 		= $row["coddistr"];
$nomyapefam 	= $row["nomyapefam"];
$telefonof 		= $row["telefonof"];
$celularf 		= $row["celularf"];
$obs 			= $row["obs"];
$fechauact 		= $row["fechauact"];
$codusup 		= $row["codusup"];
$tb 			= $row["tb"];
$esetnia 		= $row["esetnia"];
$codetnia 		= $row["codetnia"];

$chequeo2=" ";

if ($sexo==1)
{
	$chequeo1='checked="checked"';
}

if ($sexo==2)
{
	$chequeo2='checked="checked"';
}

$chequeo12=" ";

if ($estado==1)
{
	$chequeo11='checked="checked"';
}

if ($estado==2)
{
	$chequeo12='checked="checked"';
}

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

switch ($ecivil) {
    case '1':
        $nomcivil = "1. Soltero/a";
        break;
    case '2':
        $nomcivil = "2. Casado/a";
        break;
    case '3':
        $nomcivil = "3. Viudo/a";
        break;
	case '4':
        $nomcivil = "4. Unido/a";
        break;
	case '5':
        $nomcivil = "5. Separado/a";
        break;
	case '6':
        $nomcivil = "6. Divorciado/a";
        break;
	case '7':
        $nomcivil = "7. No se sabe";
        break;
}

switch ($tb) {
    case '1':
        $nomtb = "1. Si";
        break;
    case '2':
        $nomtb = "2. No";
        break;
}

$tabla_etnia = pg_query($consaa, "select * from etnias");

while($depto = pg_fetch_array($tabla_etnia))
{
   if($depto['codetnia'] == $codetnia)
   {
       $codetnianom = $depto['codetnia']."- ".$depto['nometnia'];

   }
}

// Bitacora
include("bitacora.php");
$codopc = "V_11";
$fecha2=date("Y-n-j", time());
$hora=date("G:i:s",time());
$accion="Accede a Pacientes: Nro.: ".$nropaciente;
$terminal = $_SERVER['REMOTE_ADDR'];
$a=archdlog($_SESSION['codusu'],$codopc,$fecha2,$hora,$accion,$terminal);
// Fin grabacion de registro de auditoria

//incluímos la clase xajax
include('xajax/xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();

//registramos funciones

$xajax->register(XAJAX_FUNCTION,'ValidarFormulario');
$xajax->register(XAJAX_FUNCTION,'ValidarTB');
$xajax->register(XAJAX_FUNCTION,'GenerarTurno');

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequest();

$xajax->configure('javascript URI','xajax/');
//Funciones

function ValidarFormulario($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('utf-8');

	$con	=	Conectarse();
	$consaa	=	Conectarsesaa();

	$mensaje='';

	$sql1 = "select * from paciente where cedula = '$cedula'";

	$res1=pg_query($consaa,$sql1);
	$countsaa=pg_num_rows($res1);

	$fechauact = date("Y-n-j", time());

	if($pnombre=="")
    {
    	  $mensaje = '- Rellene el campo Primer Nombre!\n';

		  $respuesta->Assign("pnombre", "style.backgroundColor", "yellow");

    }
	else
	{
		$respuesta->Assign("pnombre", "style.backgroundColor", "white");
	}

	if($papellido=="")
    {
			$mensaje .= '- Rellene el campo Primer Apellido!\n';

		  $respuesta->Assign("papellido", "style.backgroundColor", "yellow");

    }
	else
	{
		$respuesta->Assign("papellido", "style.backgroundColor", "white");
	}

	if($fechanac=="")
    {
    	  $mensaje .= '- Rellene el campo Fecha Nacimiento!\n';

		  $respuesta->Assign("fechanac", "style.backgroundColor", "yellow");

    }
	else
	{
		$respuesta->Assign("fechanac", "style.backgroundColor", "white");
	}

	if($mensaje == "")
	{
		$tdocumento  = substr($tdocumento,0,1);
		$ecivil		 = substr($ecivil,0,1);
		$tb		 	 = substr($tb,0,1);
		$codetnia	 = substr($codetnia,0,2);

		if($edada == "")
		{
			$edada = 0;
		}

		if($edadm == "")
		{
			$edadm = 0;
		}

		if($sexo == "")
		{
			$sexo = 0;
		}

		if($tdocumento == "")
		{
			$tdocumento = 0;
		}

		if($ecivil == "")
		{
			$ecivil = 0;
		}

		if($fechanac == "")
		{
			$fechanac = 'null';
		}
		else
		{
			$fechanac = "'".$fechanac."'";
		}

		$pnombre = str_replace("'", '', $pnombre);
		$snombre = str_replace("'", '', $snombre);
		$papellido = str_replace("'", '', $papellido);
		$sapellido = str_replace("'", '', $sapellido);
		$dccionr = str_replace("'", '', $dccionr);

		pg_query($con,"UPDATE paciente
		   SET fechareg='$fechareg', tdocumento='$tdocumento', cedula='$cedula', pnombre='$pnombre',
			   snombre='$snombre', papellido='$papellido', sapellido='$sapellido', sexo='$sexo', fechanac=$fechanac, edada='$edada',
			   edadm='$edadm', ecivil='$ecivil', nacionalidad='$nacionalidad', telefono='$telefono', email='$email', codexterno='$codexterno',
			   estado='$estado', dccionr='$dccionr', paisr='$paisr', coddptor='$coddptor', coddistr='$coddistr', nomyapefam='$nomyapefam',
			   telefonof='$telefonof', celularf='$celularf', obs='$obs', fechauact='$fechauact', codusup='$codusup', tb='$tb', esetnia='$esetnia', codetnia='$codetnia'
		 WHERE nropaciente = '$nropaciente'");

			$respuesta->script('swal("Datos", "Datos Modificado Exitosamente!", "success")');

			// Bitacora

			$codopc = "V_11";
			$fecha1=date("Y-n-j", time());
			$hora=date("G:i:s",time());
			$accion="Pacientes: Modificar-Reg.: Nro. Paciente: ".$nropaciente;
			$terminal = $_SERVER['REMOTE_ADDR'];
			$a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
			// Fin grabacion de registro de auditoria

 	}
	else
	{
		$respuesta->script('swal("Los datos obligatorios no deben estar en blanco:", "'.$mensaje.'", "warning")');
	}
	return $respuesta;
}

function ValidarTB($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('utf-8');

	$con =	Conectarse();

	$sql = "select * from sintomaticos where upper(cedula) = upper('$cedula')";

	$res=pg_query($contb,$sql);
	$numsinto=pg_num_rows($res);

	$sql1 = "select * from pacientes where upper(cedula) = upper('$cedula')";

	$res1=pg_query($contb,$sql1);
	$numpaci=pg_num_rows($res1);

	if($numsinto != 0 || $numpaci != 0)
	{
		$nomtb = "1. Si";
		$mensaje = "Es un Paciente de TB!";
	}
	else
	{
		$nomtb = "2. No";
		$mensaje = "No es un Paciente de TB!";
	}

	$respuesta->Assign("tb","value",$nomtb);

	$respuesta->script('swal("Datos", "'.$mensaje.'", "warning")');

	return $respuesta;
}

function GenerarTurno($form)
{
	extract($form);

	$respuesta = new xajaxResponse();
	$respuesta->setCharacterEncoding('utf-8');

	$respuesta->redirect("nuevo_asignar_turnos_pacientes.php?nropaciente=$nropaciente");

	return $respuesta;
}

if($_SESSION['usuario'] != "SI")
{
	header("Location: index.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<?php
		  	//En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
		 $xajax->printJavascript("xajax/");
?>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/>
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

<!----------- PARA MODAL  ---------->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">


<link href="font-awesome.min.css" rel="stylesheet"/>

<style>
div#container
{
   width: 970px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;
}
</style>

<link href="font-awesome.min.css" rel="stylesheet">

<style>
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
#pacientes_detallesLine52
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesButton2
{
   border: 1px #2E6DA4 solid;
   border-radius: 4px;
   background-color: #FF4500;
   background-image: none;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#pacientes_detallesLine50
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesButton1
{
   border: 1px #2E6DA4 solid;
   border-radius: 4px;
   background-color: #FF4500;
   background-image: none;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#tdocumento
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
#tdocumento:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#Line9
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_LayoutGrid1
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
}
#LayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 10px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid1 .col-1
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
#LayoutGrid1 .col-1
{
   float: left;
}
#LayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 100%;
   text-align: center;
}
#LayoutGrid1:before,
#LayoutGrid1:after,
#LayoutGrid1 .row:before,
#LayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid1:after,
#LayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid1 .col-1
{
   float: none;
   width: 100%;
}
}
#wb_LayoutGrid2
{
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
#LayoutGrid2
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid2 .col-1
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
#LayoutGrid2 .col-1
{
   float: left;
}
#LayoutGrid2 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 100%;
   text-align: left;
}
#LayoutGrid2:before,
#LayoutGrid2:after,
#LayoutGrid2 .row:before,
#LayoutGrid2 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid2:after,
#LayoutGrid2 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid2 .col-1
{
   float: none;
   width: 100%;
}
}
#wb_Image3
{
   vertical-align: top;
}
#Image3
{
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
#wb_Image4
{
   vertical-align: top;
}
#Image4
{
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
#wb_LayoutGrid3
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
#LayoutGrid3
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid3 .col-1
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
#LayoutGrid3 .col-1
{
   float: left;
}
#LayoutGrid3 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 100%;
   text-align: center;
}
#LayoutGrid3:before,
#LayoutGrid3:after,
#LayoutGrid3 .row:before,
#LayoutGrid3 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid3:after,
#LayoutGrid3 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid3 .col-1
{
   float: none;
   width: 100%;
}
}
#wb_Text1
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text1 div
{
   text-align: left;
}
#wb_FontAwesomeIcon2
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon2:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon2
{
   height: 32px;
   width: 66px;
}
#FontAwesomeIcon2 i
{
   color: #265A88;
   display: inline-block;
   font-size: 32px;
   line-height: 32px;
   vertical-align: middle;
   width: 32px;
}
#wb_FontAwesomeIcon2:hover i
{
   color: #337AB7;
}
#wb_FontAwesomeIcon1
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon1:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon1
{
   height: 26px;
   width: 37px;
}
#FontAwesomeIcon1 i
{
   color: #2E8B57;
   display: inline-block;
   font-size: 26px;
   line-height: 26px;
   vertical-align: middle;
   width: 25px;
}
#wb_FontAwesomeIcon1:hover i
{
   color: #FF8C00;
}
#Layer1
{
   background-color: transparent;
   background-image: none;
}
#Layer2
{
   background-color: transparent;
   background-image: none;
}
#wb_FontAwesomeIcon3
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon3:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon3
{
   height: 36px;
   width: 49px;
}
#FontAwesomeIcon3 i
{
   color: #FF0000;
   display: inline-block;
   font-size: 36px;
   line-height: 36px;
   vertical-align: middle;
   width: 36px;
}
#wb_FontAwesomeIcon3:hover i
{
   color: #337AB7;
}
#wb_pacientes_detallesLayoutGrid1
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
#pacientes_detallesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
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
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   float: left;
}
#pacientes_detallesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-4
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1:before,
#pacientes_detallesLayoutGrid1:after,
#pacientes_detallesLayoutGrid1 .row:before,
#pacientes_detallesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid1:after,
#pacientes_detallesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   float: none;
   width: 100%;
}
}
#nropaciente
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #DCDCDC;
   background-image: none;
   color :#000000;
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
#nropaciente:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_pacientes_detallesText1
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText1 div
{
   text-align: left;
}
#pacientes_detallesLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesText2
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText2 div
{
   text-align: left;
}
#pacientes_detallesLine5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#fechareg
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#fechareg:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine8
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesLayoutGrid2
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
#pacientes_detallesLayoutGrid2
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
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
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   float: left;
}
#pacientes_detallesLayoutGrid2 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-4
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2:before,
#pacientes_detallesLayoutGrid2:after,
#pacientes_detallesLayoutGrid2 .row:before,
#pacientes_detallesLayoutGrid2 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid2:after,
#pacientes_detallesLayoutGrid2 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   float: none;
   width: 100%;
}
}
#wb_pacientes_detallesText3
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText3 div
{
   text-align: left;
}
#pacientes_detallesLine10
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine12
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesText4
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText4 div
{
   text-align: left;
}
#pacientes_detallesLine14
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#cedula
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#cedula:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine16
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesLayoutGrid3
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
#pacientes_detallesLayoutGrid3
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
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
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   float: left;
}
#pacientes_detallesLayoutGrid3 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-4
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3:before,
#pacientes_detallesLayoutGrid3:after,
#pacientes_detallesLayoutGrid3 .row:before,
#pacientes_detallesLayoutGrid3 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid3:after,
#pacientes_detallesLayoutGrid3 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   float: none;
   width: 100%;
}
}
#pnombre
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#pnombre:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_pacientes_detallesText5
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText5 div
{
   text-align: left;
}
#pacientes_detallesLine18
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine20
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesText6
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText6 div
{
   text-align: left;
}
#pacientes_detallesLine22
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#snombre
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#snombre:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine24
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesLayoutGrid4
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
#pacientes_detallesLayoutGrid4
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
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
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   float: left;
}
#pacientes_detallesLayoutGrid4 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-4
{
   background-color: transparent;
   background-image: none;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4:before,
#pacientes_detallesLayoutGrid4:after,
#pacientes_detallesLayoutGrid4 .row:before,
#pacientes_detallesLayoutGrid4 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid4:after,
#pacientes_detallesLayoutGrid4 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   float: none;
   width: 100%;
}
}
#papellido
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#papellido:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_pacientes_detallesText7
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText7 div
{
   text-align: left;
}
#pacientes_detallesLine26
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine28
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesText8
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText8 div
{
   text-align: left;
}
#pacientes_detallesLine30
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#sapellido
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#sapellido:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine32
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_empresas_detallesLayoutGrid6
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
#empresas_detallesLayoutGrid6
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
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
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid6 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid6 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid6:before,
#empresas_detallesLayoutGrid6:after,
#empresas_detallesLayoutGrid6 .row:before,
#empresas_detallesLayoutGrid6 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid6:after,
#empresas_detallesLayoutGrid6 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText6
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText6 div
{
   text-align: left;
}
#empresas_detallesLine21
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine22
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine23
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesTable1
{
   border: 0px transparent solid;
   background-color: transparent;
   background-image: none;
   border-collapse: separate;
   border-spacing: 0px;
}
#empresas_detallesTable1 td
{
   padding: 0px 0px 0px 0px;
}
#empresas_detallesTable1 .cell0
{
   background-color: transparent;
   background-image: none;
   text-align: center;
   vertical-align: middle;
   font-size: 0;
}
#wb_empresas_detallesRadioButton1
{
   position: relative;
}
#wb_empresas_detallesRadioButton1, #wb_empresas_detallesRadioButton1 *, #wb_empresas_detallesRadioButton1 *::before, #wb_empresas_detallesRadioButton1 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_empresas_detallesRadioButton1 input[type='radio']
{
   position: absolute;
   padding: 0;
   margin: 0;
   opacity: 0;
   z-index: 1;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
}
#wb_empresas_detallesRadioButton1 label
{
   display: inline-block;
   vertical-align: middle;
   position: absolute;
   left: 0;
   top: 0;
   width: 0;
   height: 0;
   padding: 0;
}
#wb_empresas_detallesRadioButton1 label::before
{
   content: "";
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   background-color: #FFFFFF;
   border: 1px #CCCCCC solid;
   border-radius: 50%;
}
#wb_empresas_detallesRadioButton1 label::after
{
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   padding: 0;
   text-align: center;
   line-height: 20px;
   border-radius: 50%;
   color: #FFFFFF;
   content: " ";
   -webkit-transform: scale(0, 0);
   -moz-transform: scale(0, 0);
   transform: scale(0, 0);
}
#wb_empresas_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_empresas_detallesRadioButton1 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_empresas_detallesRadioButton2
{
   position: relative;
}
#wb_empresas_detallesRadioButton2, #wb_empresas_detallesRadioButton2 *, #wb_empresas_detallesRadioButton2 *::before, #wb_empresas_detallesRadioButton2 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_empresas_detallesRadioButton2 input[type='radio']
{
   position: absolute;
   padding: 0;
   margin: 0;
   opacity: 0;
   z-index: 1;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
}
#wb_empresas_detallesRadioButton2 label
{
   display: inline-block;
   vertical-align: middle;
   position: absolute;
   left: 0;
   top: 0;
   width: 0;
   height: 0;
   padding: 0;
}
#wb_empresas_detallesRadioButton2 label::before
{
   content: "";
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   background-color: #FFFFFF;
   border: 1px #CCCCCC solid;
   border-radius: 50%;
}
#wb_empresas_detallesRadioButton2 label::after
{
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   padding: 0;
   text-align: center;
   line-height: 20px;
   border-radius: 50%;
   color: #FFFFFF;
   content: " ";
   -webkit-transform: scale(0, 0);
   -moz-transform: scale(0, 0);
   transform: scale(0, 0);
}
#wb_empresas_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_empresas_detallesRadioButton2 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_empresas_detallesText7
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText7 div
{
   text-align: left;
}
#wb_empresas_detallesText8
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText8 div
{
   text-align: left;
}
#wb_pacientes_detallesLayoutGrid5
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
#pacientes_detallesLayoutGrid5
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
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
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   float: left;
}
#pacientes_detallesLayoutGrid5 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5:before,
#pacientes_detallesLayoutGrid5:after,
#pacientes_detallesLayoutGrid5 .row:before,
#pacientes_detallesLayoutGrid5 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid5:after,
#pacientes_detallesLayoutGrid5 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   float: none;
   width: 100%;
}
}
#wb_pacientes_detallesText9
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText9 div
{
   text-align: left;
}
#wb_pacientes_detallesText10
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText10 div
{
   text-align: left;
}
#wb_pacientes_detallesText11
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText11 div
{
   text-align: left;
}
#fechanac
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#fechanac:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#edada
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#edada:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#edadm
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#edadm:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine7
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine9
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine11
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesLayoutGrid6
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
#pacientes_detallesLayoutGrid6
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
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
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   float: left;
}
#pacientes_detallesLayoutGrid6 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6:before,
#pacientes_detallesLayoutGrid6:after,
#pacientes_detallesLayoutGrid6 .row:before,
#pacientes_detallesLayoutGrid6 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid6:after,
#pacientes_detallesLayoutGrid6 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   float: none;
   width: 100%;
}
}
#wb_pacientes_detallesText12
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText12 div
{
   text-align: left;
}
#wb_pacientes_detallesText13
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText13 div
{
   text-align: left;
}
#pacientes_detallesLine13
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine15
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine17
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#nacionalidad
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#nacionalidad:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine21
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#ecivil
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
#ecivil:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine19
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesLayoutGrid7
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
#pacientes_detallesLayoutGrid7
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
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
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   float: left;
}
#pacientes_detallesLayoutGrid7 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7:before,
#pacientes_detallesLayoutGrid7:after,
#pacientes_detallesLayoutGrid7 .row:before,
#pacientes_detallesLayoutGrid7 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid7:after,
#pacientes_detallesLayoutGrid7 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   float: none;
   width: 100%;
}
}
#wb_pacientes_detallesText14
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText14 div
{
   text-align: left;
}
#wb_pacientes_detallesText15
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText15 div
{
   text-align: left;
}
#wb_pacientes_detallesText16
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText16 div
{
   text-align: left;
}
#pacientes_detallesLine23
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine25
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine27
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#telefono
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#telefono:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#email
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#email:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#codexterno
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#codexterno:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine29
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine31
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine33
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_empresas_detallesLayoutGrid9
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
#empresas_detallesLayoutGrid9
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
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
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid9 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid9 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid9:before,
#empresas_detallesLayoutGrid9:after,
#empresas_detallesLayoutGrid9 .row:before,
#empresas_detallesLayoutGrid9 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid9:after,
#empresas_detallesLayoutGrid9 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText11
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText11 div
{
   text-align: left;
}
#empresas_detallesLine32
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine33
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine34
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesTable2
{
   border: 0px transparent solid;
   background-color: transparent;
   background-image: none;
   border-collapse: separate;
   border-spacing: 0px;
}
#empresas_detallesTable2 td
{
   padding: 0px 0px 0px 0px;
}
#empresas_detallesTable2 .cell0
{
   background-color: transparent;
   background-image: none;
   text-align: center;
   vertical-align: middle;
   font-size: 0;
}
#wb_empresas_detallesRadioButton3
{
   position: relative;
}
#wb_empresas_detallesRadioButton3, #wb_empresas_detallesRadioButton3 *, #wb_empresas_detallesRadioButton3 *::before, #wb_empresas_detallesRadioButton3 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_empresas_detallesRadioButton3 input[type='radio']
{
   position: absolute;
   padding: 0;
   margin: 0;
   opacity: 0;
   z-index: 1;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
}
#wb_empresas_detallesRadioButton3 label
{
   display: inline-block;
   vertical-align: middle;
   position: absolute;
   left: 0;
   top: 0;
   width: 0;
   height: 0;
   padding: 0;
}
#wb_empresas_detallesRadioButton3 label::before
{
   content: "";
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   background-color: #FFFFFF;
   border: 1px #CCCCCC solid;
   border-radius: 50%;
}
#wb_empresas_detallesRadioButton3 label::after
{
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   padding: 0;
   text-align: center;
   line-height: 20px;
   border-radius: 50%;
   color: #FFFFFF;
   content: " ";
   -webkit-transform: scale(0, 0);
   -moz-transform: scale(0, 0);
   transform: scale(0, 0);
}
#wb_empresas_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_empresas_detallesRadioButton3 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_empresas_detallesRadioButton4
{
   position: relative;
}
#wb_empresas_detallesRadioButton4, #wb_empresas_detallesRadioButton4 *, #wb_empresas_detallesRadioButton4 *::before, #wb_empresas_detallesRadioButton4 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_empresas_detallesRadioButton4 input[type='radio']
{
   position: absolute;
   padding: 0;
   margin: 0;
   opacity: 0;
   z-index: 1;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
}
#wb_empresas_detallesRadioButton4 label
{
   display: inline-block;
   vertical-align: middle;
   position: absolute;
   left: 0;
   top: 0;
   width: 0;
   height: 0;
   padding: 0;
}
#wb_empresas_detallesRadioButton4 label::before
{
   content: "";
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   background-color: #FFFFFF;
   border: 1px #CCCCCC solid;
   border-radius: 50%;
}
#wb_empresas_detallesRadioButton4 label::after
{
   display: inline-block;
   position: absolute;
   width: 20px;
   height: 20px;
   left: 0;
   top: 0;
   padding: 0;
   text-align: center;
   line-height: 20px;
   border-radius: 50%;
   color: #FFFFFF;
   content: " ";
   -webkit-transform: scale(0, 0);
   -moz-transform: scale(0, 0);
   transform: scale(0, 0);
}
#wb_empresas_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_empresas_detallesRadioButton4 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_empresas_detallesText12
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText12 div
{
   text-align: left;
}
#wb_empresas_detallesText13
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText13 div
{
   text-align: left;
}
#wb_courier_detallesLayoutGrid2
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
#courier_detallesLayoutGrid2
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#courier_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
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
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   float: left;
}
#courier_detallesLayoutGrid2 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid2 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#courier_detallesLayoutGrid2:before,
#courier_detallesLayoutGrid2:after,
#courier_detallesLayoutGrid2 .row:before,
#courier_detallesLayoutGrid2 .row:after
{
   display: table;
   content: " ";
}
#courier_detallesLayoutGrid2:after,
#courier_detallesLayoutGrid2 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_courier_detallesText2
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_courier_detallesText2 div
{
   text-align: left;
}
#courier_detallesLine5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine7
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine8
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#dccionr
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#dccionr:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_pacientes_detallesLayoutGrid8
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
#pacientes_detallesLayoutGrid8
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
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
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   float: left;
}
#pacientes_detallesLayoutGrid8 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid8 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid8:before,
#pacientes_detallesLayoutGrid8:after,
#pacientes_detallesLayoutGrid8 .row:before,
#pacientes_detallesLayoutGrid8 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid8:after,
#pacientes_detallesLayoutGrid8 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_pacientes_detallesText17
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText17 div
{
   text-align: left;
}
#pacientes_detallesLine34
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine35
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine36
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine37
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#paisr
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#paisr:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_empresas_detallesLayoutGrid3
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
#empresas_detallesLayoutGrid3
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
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
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid3 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid3 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid3:before,
#empresas_detallesLayoutGrid3:after,
#empresas_detallesLayoutGrid3 .row:before,
#empresas_detallesLayoutGrid3 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid3:after,
#empresas_detallesLayoutGrid3 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText3
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText3 div
{
   text-align: left;
}
#empresas_detallesLine9
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine10
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine11
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine12
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#coddptor
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
#coddptor:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_empresas_detallesLayoutGrid4
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
#empresas_detallesLayoutGrid4
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
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
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid4 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid4 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid4:before,
#empresas_detallesLayoutGrid4:after,
#empresas_detallesLayoutGrid4 .row:before,
#empresas_detallesLayoutGrid4 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid4:after,
#empresas_detallesLayoutGrid4 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText4
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText4 div
{
   text-align: left;
}
#empresas_detallesLine13
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine14
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine15
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine16
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#coddistr
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
#coddistr:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_LayoutGrid6
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
#LayoutGrid6
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
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
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   float: left;
}
#LayoutGrid6 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid6 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#LayoutGrid6:before,
#LayoutGrid6:after,
#LayoutGrid6 .row:before,
#LayoutGrid6 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid6:after,
#LayoutGrid6 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   float: none;
   width: 100%;
}
}
#nomyapefam
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#nomyapefam:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Text4
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#Line7
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line13
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line14
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line15
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesLayoutGrid9
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
#pacientes_detallesLayoutGrid9
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
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
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   float: left;
}
#pacientes_detallesLayoutGrid9 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9:before,
#pacientes_detallesLayoutGrid9:after,
#pacientes_detallesLayoutGrid9 .row:before,
#pacientes_detallesLayoutGrid9 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid9:after,
#pacientes_detallesLayoutGrid9 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   float: none;
   width: 100%;
}
}
#wb_pacientes_detallesText18
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText18 div
{
   text-align: left;
}
#wb_pacientes_detallesText19
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText19 div
{
   text-align: left;
}
#pacientes_detallesLine38
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine39
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine40
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#telefonof
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#telefonof:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#celularf
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#celularf:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine41
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine42
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine43
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_empresas_detallesLayoutGrid8
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
#empresas_detallesLayoutGrid8
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
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
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid8 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid8 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid8:before,
#empresas_detallesLayoutGrid8:after,
#empresas_detallesLayoutGrid8 .row:before,
#empresas_detallesLayoutGrid8 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid8:after,
#empresas_detallesLayoutGrid8 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText10
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText10 div
{
   text-align: left;
}
#empresas_detallesLine28
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine29
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine30
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine31
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#obs
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#obs:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_pacientes_detallesLayoutGrid10
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
#pacientes_detallesLayoutGrid10
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid10 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
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
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   float: left;
}
#pacientes_detallesLayoutGrid10 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10:before,
#pacientes_detallesLayoutGrid10:after,
#pacientes_detallesLayoutGrid10 .row:before,
#pacientes_detallesLayoutGrid10 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid10:after,
#pacientes_detallesLayoutGrid10 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   float: none;
   width: 100%;
}
}
#wb_pacientes_detallesText20
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText20 div
{
   text-align: left;
}
#wb_pacientes_detallesText21
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText21 div
{
   text-align: left;
}
#wb_pacientes_detallesText22
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_pacientes_detallesText22 div
{
   text-align: left;
}
#pacientes_detallesLine44
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine45
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine46
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#fechauact
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #DCDCDC;
   background-image: none;
   color :#000000;
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
#fechauact:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#codusup
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#codusup:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesEditbox20
{
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #FFFFFF;
   background-image: none;
   color :#000000;
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
#pacientes_detallesEditbox20:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#pacientes_detallesLine47
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine48
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine49
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_pacientes_detallesLayoutGrid11
{
   clear: both;
   position: relative;
   table-layout: fixed;
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
#pacientes_detallesLayoutGrid11
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientes_detallesLayoutGrid11 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
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
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   float: left;
}
#pacientes_detallesLayoutGrid11 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid11 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid11 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid11:before,
#pacientes_detallesLayoutGrid11:after,
#pacientes_detallesLayoutGrid11 .row:before,
#pacientes_detallesLayoutGrid11 .row:after
{
   display: table;
   content: " ";
}
#pacientes_detallesLayoutGrid11:after,
#pacientes_detallesLayoutGrid11 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   float: none;
   width: 100%;
}
}
#pacientes_detallesLine51
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine53
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesLine54
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#pacientes_detallesButton3
{
   border: 1px #2E6DA4 solid;
   border-radius: 4px;
   background-color: #FF4500;
   background-image: none;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#wb_LayoutGrid7
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
#LayoutGrid7
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid7 .col-1, #LayoutGrid7 .col-2
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
#LayoutGrid7 .col-1, #LayoutGrid7 .col-2
{
   float: left;
}
#LayoutGrid7 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 100%;
   text-align: left;
}
#LayoutGrid7 .col-2
{
   background-color: transparent;
   background-image: none;
   display: none;
   width: 0;
   text-align: left;
}
#LayoutGrid7:before,
#LayoutGrid7:after,
#LayoutGrid7 .row:before,
#LayoutGrid7 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid7:after,
#LayoutGrid7 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid7 .col-1, #LayoutGrid7 .col-2
{
   float: none;
   width: 100%;
}
}
#Button1
{
   border: 1px #2E6DA4 solid;
   border-radius: 4px;
   background-color: #3370B7;
   background-image: none;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
}
#Line16
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line11
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_sintomas_detallesLayoutGrid1
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
#sintomas_detallesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#sintomas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#sintomas_detallesLayoutGrid1 .col-1, #sintomas_detallesLayoutGrid1 .col-2
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
#sintomas_detallesLayoutGrid1 .col-1, #sintomas_detallesLayoutGrid1 .col-2
{
   float: left;
}
#sintomas_detallesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 100%;
   text-align: left;
}
#sintomas_detallesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   display: none;
   width: 0;
   text-align: left;
}
#sintomas_detallesLayoutGrid1:before,
#sintomas_detallesLayoutGrid1:after,
#sintomas_detallesLayoutGrid1 .row:before,
#sintomas_detallesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#sintomas_detallesLayoutGrid1:after,
#sintomas_detallesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#sintomas_detallesLayoutGrid1 .col-1, #sintomas_detallesLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#sintomas_detallesLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_sintomas_detallesText1
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_sintomas_detallesText1 div
{
   text-align: left;
}
#sintomas_detallesLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_LayoutGrid9
{
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
#LayoutGrid9
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 15px 15px 15px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid9 .col-1, #LayoutGrid9 .col-2
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
#LayoutGrid9 .col-1, #LayoutGrid9 .col-2
{
   float: left;
}
#LayoutGrid9 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 50%;
   text-align: center;
}
#LayoutGrid9 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 50%;
   text-align: center;
}
#LayoutGrid9:before,
#LayoutGrid9:after,
#LayoutGrid9 .row:before,
#LayoutGrid9 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid9:after,
#LayoutGrid9 .row:after
{
   clear: both;
}
@media (max-width: 768px)
{
#LayoutGrid9 .col-1, #LayoutGrid9 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_Text8
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 20px 0px 20px 0px;
   margin: 0;
   text-align: center;
}
#wb_Text8 div
{
   text-align: center;
}
#wb_FontAwesomeIcon8
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   margin: 0px 10px 0px 0px;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon8:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon8
{
   height: 22px;
   width: 22px;
}
#FontAwesomeIcon8 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 22px;
   line-height: 22px;
   vertical-align: middle;
   width: 12px;
}
#wb_FontAwesomeIcon8:hover i
{
   color: #FFFF00;
}
#wb_FontAwesomeIcon9
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   margin: 0px 10px 0px 0px;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon9:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon9
{
   height: 22px;
   width: 22px;
}
#FontAwesomeIcon9 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 22px;
   line-height: 22px;
   vertical-align: middle;
   width: 20px;
}
#wb_FontAwesomeIcon9:hover i
{
   color: #FFFF00;
}
#wb_FontAwesomeIcon10
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon10:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon10
{
   height: 22px;
   width: 32px;
}
#FontAwesomeIcon10 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 22px;
   line-height: 22px;
   vertical-align: middle;
   width: 18px;
}
#wb_FontAwesomeIcon10:hover i
{
   color: #FFFF00;
}
#wb_FontAwesomeIcon11
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   margin: 0px 10px 0px 0px;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon11:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon11
{
   height: 22px;
   width: 22px;
}
#FontAwesomeIcon11 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 22px;
   line-height: 22px;
   vertical-align: middle;
   width: 18px;
}
#wb_FontAwesomeIcon11:hover i
{
   color: #FFFF00;
}
#wb_ResponsiveMenu1
{
   background-color: rgba(159,182,192,1.00);
   display: block;
   text-align: center;
   width: 100%;
}
#ResponsiveMenu1
{
   background-color: #9FB6C0;
   display: inline-block;
   height: 45px;
}
#wb_ResponsiveMenu1 ul
{
   list-style: none;
   margin: 0;
   padding: 0;
   position: relative;
}
#wb_ResponsiveMenu1 ul:after
{
   clear: both;
   content: "";
   display: block;
}
#wb_ResponsiveMenu1 ul li
{
   background-color: #9FB6C0;
   display: list-item;
   float: left;
   list-style: none;
   z-index: 9999;
}
#wb_ResponsiveMenu1 ul li i
{
   font-size: 0px;
   width: 0px;
}
#wb_ResponsiveMenu1 ul li a
{
   color: #FFFFFF;
   font-family: Arial;
   font-size: 13px;
   font-weight: normal;
   font-style: normal;
   padding: 15px 20px 15px 20px;
   text-align: center;
   text-decoration: none;
}
#wb_ResponsiveMenu1 > ul > li > a
{
   height: 15px;
}
.ResponsiveMenu1 a
{
   display: block;
}
#wb_ResponsiveMenu1 li a:hover, #wb_ResponsiveMenu1 li .active
{
   background-color: #5A7C8B;
   color: #F0F8FF;
}
#wb_ResponsiveMenu1 ul ul
{
   display: none;
   position: absolute;
   top: 45px;
}
#wb_ResponsiveMenu1 ul li:hover > ul
{
   display: list-item;
}
#wb_ResponsiveMenu1 ul ul li
{
   background-color: #DCDCDC;
   color: #696969;
   float: none;
   position: relative;
   width: 209px;
}
#wb_ResponsiveMenu1 ul ul li a:hover, #wb_ResponsiveMenu1 ul ul li .active
{
   background-color: #5A7C8B;
   color: #FFFFFF;
}
#wb_ResponsiveMenu1 ul ul li i
{
   margin-right: 0px;
   vertical-align: middle;
}
#wb_ResponsiveMenu1 ul ul li a
{
   color: #696969;
   padding: 5px 15px 5px 15px;
   text-align: left;
   vertical-align: middle;
}
#wb_ResponsiveMenu1 ul ul ul li
{
   left: 209px;
   position: relative;
   top: -45px;
}
#wb_ResponsiveMenu1 .arrow-down
{
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
#wb_ResponsiveMenu1 .arrow-left
{
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
#wb_ResponsiveMenu1 li a:hover .arrow-down
{
   border-top-color: #F0F8FF;
}
#wb_ResponsiveMenu1 ul ul li a:hover .arrow-left, #wb_ResponsiveMenu1 ul ul li .active .arrow-left
{
   border-left-color: #FFFFFF;
}
#wb_ResponsiveMenu1 .toggle,[id^=ResponsiveMenu1-submenu]
{
   display: none;
}
@media all and (max-width:768px)
{
#wb_ResponsiveMenu1
{
   margin: 0;
   text-align: left;
}
#wb_ResponsiveMenu1 ul li a, #wb_ResponsiveMenu1 .toggle
{
   font-size: 13px;
   font-weight: normal;
   font-style: normal;
   padding: 5px 15px 5px 15px;
}
#wb_ResponsiveMenu1 .toggle + a
{
   display: none !important;
}
.ResponsiveMenu1
{
   display: none;
   z-index: 9999;
}
#ResponsiveMenu1
{
   background-color: transparent;
   display: none;
}
#wb_ResponsiveMenu1 > ul > li > a
{
   height: auto;
}
#wb_ResponsiveMenu1 .toggle
{
   display: block;
   background-color: #9FB6C0;
   color: #FFFFFF;
   padding: 0px 15px 0px 15px;
   line-height: 26px;
   text-decoration: none;
   border: none;
}
#wb_ResponsiveMenu1 .toggle:hover
{
   background-color: #5A7C8B;
   color: #F0F8FF;
}
[id^=ResponsiveMenu1-submenu]:checked + ul
{
   display: block !important;
}
#ResponsiveMenu1-title
{
   height: 45px;
   line-height: 45px !important;
   text-align: center;
}
#wb_ResponsiveMenu1 ul li
{
   display: block;
   width: 100%;
}
#wb_ResponsiveMenu1 ul ul .toggle,
#wb_ResponsiveMenu1 ul ul a
{
   padding: 0 30px;
}
#wb_ResponsiveMenu1 a:hover,
#wb_ResponsiveMenu1 ul ul ul a
{
   background-color: #DCDCDC;
   color: #696969;
}
#wb_ResponsiveMenu1 ul li ul li .toggle,
#wb_ResponsiveMenu1 ul ul a
{
   background-color: #DCDCDC;
   color: #696969;
}
#wb_ResponsiveMenu1 ul ul ul a
{
   padding: 5px 15px 5px 45px;
}
#wb_ResponsiveMenu1 ul li a
{
   text-align: left;
}
#wb_ResponsiveMenu1 ul li a br
{

   display: none;
}
#wb_ResponsiveMenu1 ul li i
{
   margin-right: 0px;
}
#wb_ResponsiveMenu1 ul ul
{
   float: none;
   position: static;
}
#wb_ResponsiveMenu1 ul ul li:hover > ul,
#wb_ResponsiveMenu1 ul li:hover > ul
{
   display: none;
}
#wb_ResponsiveMenu1 ul ul li
{
   display: block;
   width: 100%;
}
#wb_ResponsiveMenu1 ul ul ul li
{
   position: static;
}
#ResponsiveMenu1-icon
{
   display: block;
   position: absolute;
   left: 20px;
   top: 10px;
}
#ResponsiveMenu1-icon span
{
   display: block;
   margin-top: 4px;
   height: 2px;
   background-color: #FFFFFF;
   color: #FFFFFF;
   width: 24px;
}
#wb_ResponsiveMenu1 ul li ul li .toggle:hover
{
   background-color: #5A7C8B;
   color: #FFFFFF;
}
#wb_ResponsiveMenu1 .toggle .arrow-down
{
   border-top-color: #FFFFFF;
}
#wb_ResponsiveMenu1 .toggle:hover .arrow-down, #wb_ResponsiveMenu1 li .active .arrow-down
{
   border-top-color: #F0F8FF;
}
#wb_ResponsiveMenu1 ul li ul li .toggle .arrow-down
{
   border-top-color: #696969;
}
#wb_ResponsiveMenu1 ul li ul li .toggle:hover .arrow-down, #wb_ResponsiveMenu1 ul li ul li .active .arrow-down
{
   border-top-color: #FFFFFF;
}
}
#wb_ResponsiveMenu1.affix
{
   top: 0 !important;
   position: fixed !important;
   left: 50% !important;
   margin-left: -470px;
}
#pacientes_detallesLine53
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 166;
}
#pacientes_detallesLine42
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 143;
}
#coddistr
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 128;
}
#empresas_detallesLine14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 126;
}
#empresas_detallesTable2
{
   display: table;
   width: 100%;
   height: 20px;
   z-index: 96;
}
#pacientes_detallesLine31
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 84;
}
#telefono
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 79;
}
#pacientes_detallesLine1
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 67;
}
#pacientes_detallesLine20
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 26;
}
#wb_FontAwesomeIcon1
{
   position: absolute;
   left: 13px;
   top: 13px;
   width: 37px;
   height: 26px;
   text-align: center;
   z-index: 5;
}
#pacientes_detallesLine54
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 169;
}
#pacientes_detallesLine43
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 145;
}
#Line7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 130;
}
#empresas_detallesLine15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 127;
}
#courier_detallesLine5
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 106;
}
#pacientes_detallesLine21
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 75;
}
#nacionalidad
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 74;
}
#pacientes_detallesLine32
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 38;
}
#pacientes_detallesLine10
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 16;
}
#nropaciente
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 9;
}
#pacientes_detallesLine2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 8;
}
#wb_FontAwesomeIcon10
{
   display: inline-block;
   width: 32px;
   height: 22px;
   text-align: center;
   z-index: 182;
}
#pacientes_detallesLine44
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 153;
}
#nomyapefam
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 134;
}
#empresas_detallesLine16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 129;
}
#empresas_detallesLine9
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 118;
}
#courier_detallesLine6
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 108;
}
#pacientes_detallesLine33
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 88;
}
#email
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 83;
}
#pacientes_detallesLine11
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 63;
}
#pacientes_detallesLine3
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 57;
}
#pacientes_detallesLine22
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 28;
}
#fechareg
{
   display: block;
   width: 100%;
   height: 31px;
   line-height: 31px;
   z-index: 13;
}
#wb_FontAwesomeIcon3
{
   position: absolute;
   left: 3px;
   top: 6px;
   width: 49px;
   height: 36px;
   text-align: center;
   z-index: 6;
}
#wb_FontAwesomeIcon11
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 181;
}
#Line11
{
   display: block;
   width: 100%;
   height: 61px;
   z-index: 174;
}
#pacientes_detallesLine45
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 161;
}
#empresas_detallesLine28
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 146;
}
#pacientes_detallesLine34
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 112;
}
#courier_detallesLine7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 109;
}
#codexterno
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 87;
}
#pacientes_detallesLine23
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 78;
}
#pnombre
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 25;
}
#pacientes_detallesLine12
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 18;
}
#pacientes_detallesLine4
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 10;
}
#Line9
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 3;
}
#pacientes_detallesLine46
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 157;
}
#empresas_detallesLine29
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 148;
}
#paisr
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 116;
}
#pacientes_detallesLine35
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 114;
}
#courier_detallesLine8
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 111;
}
#pacientes_detallesLine13
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 69;
}
#sexo1
{
   display: inline-block;
   z-index: 41;
}
#pacientes_detallesLine24
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 30;
}
#cedula
{
   display: block;
   width: 100%;
   height: 31px;
   line-height: 31px;
   z-index: 21;
}
#pacientes_detallesLine5
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 12;
}
#Layer1
{
   position: absolute;
   text-align: left;
   left: 73px;
   top: 1286px;
   width: 63px;
   height: 52px;
   z-index: 231;
}
#pacientes_detallesLine47
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 155;
}
#telefonof
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 138;
}
#Line13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 132;
}
#pacientes_detallesLine36
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 115;
}
#pacientes_detallesLine25
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 86;
}
#pacientes_detallesLine6
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 65;
}
#sexo2
{
   display: inline-block;
   z-index: 43;
}
#snombre
{
   display: block;
   width: 100%;
   height: 31px;
   line-height: 31px;
   z-index: 29;
}
#pacientes_detallesLine14
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 20;
}
#Layer2
{
   position: absolute;
   text-align: left;
   left: 9px;
   top: 1286px;
   width: 54px;
   height: 52px;
   z-index: 232;
}
#wb_Image3
{
   display: inline-block;
   width: 142px;
   height: 118px;
   z-index: 0;
}
#pacientes_detallesButton1
{
   display: inline-block;
   width: 184px;
   height: 25px;
   z-index: 165;
}
#pacientes_detallesLine48
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 159;
}
#celularf
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 142;
}
#Line14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 133;
}
#pacientes_detallesLine37
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 117;
}
#estado1
{
   display: inline-block;
   z-index: 91;
}
#pacientes_detallesLine15
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 76;
}
#pacientes_detallesLine7
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 61;
}
#papellido
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 33;
}
#pacientes_detallesLine26
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 32;
}
#wb_Image4
{
   display: inline-block;
   width: 743px;
   height: 147px;
   z-index: 1;
}
#wb_FontAwesomeIcon8
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 179;
}
#pacientes_detallesButton2
{
   display: inline-block;
   width: 184px;
   height: 25px;
   z-index: 168;
}
#pacientes_detallesLine49
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 163;
}
#fechauact
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 154;
}
#pacientes_detallesLine38
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 137;
}
#Line15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 135;
}
#estado2
{
   display: inline-block;
   z-index: 93;
}
#pacientes_detallesLine27
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 82;
}
#sapellido
{
   display: block;
   width: 100%;
   height: 31px;
   line-height: 31px;
   z-index: 37;
}
#pacientes_detallesLine16
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 22;
}
#tdocumento
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 17;
}
#pacientes_detallesLine8
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 14;
}
#wb_FontAwesomeIcon9
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 180;
}
#Line16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 172;
}
#pacientes_detallesButton3
{
   display: inline-block;
   width: 184px;
   height: 25px;
   z-index: 171;
}
#codusup
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 158;
}
#pacientes_detallesLine39
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 144;
}
#pacientes_detallesLine17
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 73;
}
#ecivil
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 70;
}
#pacientes_detallesLine9
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 59;
}
#fechanac
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 58;
}
#wb_empresas_detallesRadioButton1
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 41;
}
#pacientes_detallesLine28
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 34;
}
#pacientes_detallesLine29
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 80;
}
#edada
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 62;
}
#wb_empresas_detallesRadioButton2
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 43;
}
#pacientes_detallesLine18
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 24;
}
#dccionr
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 110;
}
#wb_empresas_detallesRadioButton3
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 91;
}
#pacientes_detallesLine19
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 71;
}
#obs
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 150;
}
#empresas_detallesLine30
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 149;
}
#wb_empresas_detallesRadioButton4
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 93;
}
#empresas_detallesLine31
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 151;
}
#sintomas_detallesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 175;
}
#Button1
{
   display: inline-block;
   width: 96px;
   height: 25px;
   z-index: 173;
}
#empresas_detallesLine10
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 120;
}
#empresas_detallesLine32
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 89;
}
#empresas_detallesLine21
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 39;
}
#sintomas_detallesLine2
{
   display: block;
   width: 100%;
   height: 16px;
   z-index: 177;
}
#pacientes_detallesLine50
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 164;
}
#empresas_detallesLine11
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 121;
}
#empresas_detallesLine33
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 97;
}
#empresas_detallesLine22
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 47;
}
#wb_ResponsiveMenu1
{
   display: inline-block;
   width: 100%;
   z-index: 2;
}
#pacientes_detallesLine51
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 170;
}
#pacientes_detallesEditbox20
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 162;
}
#pacientes_detallesLine40
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 141;
}
#empresas_detallesLine12
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 123;
}
#empresas_detallesLine34
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 95;
}
#empresas_detallesLine23
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 45;
}
#pacientes_detallesLine52
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 167;
}
#pacientes_detallesLine41
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 139;
}
#empresas_detallesLine13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 124;
}
#coddptor
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 122;
}
#edadm
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 66;
}
#empresas_detallesTable1
{
   display: table;
   width: 100%;
   height: 20px;
   z-index: 46;
}
#pacientes_detallesLine30
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 36;
}
@media only screen and (min-width: 1024px)
{
div#container
{
   width: 1024px;
}
#pacientes_detallesLine52
{
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
#pacientes_detallesButton2
{
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
#pacientes_detallesLine50
{
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
#pacientes_detallesButton1
{
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
#tdocumento
{
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
#Line9
{
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
#wb_LayoutGrid1
{
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
#wb_LayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid1
{
   padding: 10px 15px 0px 15px;
}
#LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid1 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_LayoutGrid2
{
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
#wb_LayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid2 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Image3
{
   width: 171px;
   height: 142px;
   visibility: visible;
   display: inline-block;
}
#Image3
{
   width: 171px;
   height: 142px;
}
#wb_Image4
{
   width: 743px;
   height: 147px;
   visibility: visible;
   display: inline-block;
}
#Image4
{
   width: 743px;
   height: 147px;
}
#wb_LayoutGrid3
{
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
#wb_LayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid3 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Text1
{
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
#wb_FontAwesomeIcon2
{
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
#FontAwesomeIcon2
{
   width: 66px;
   height: 32px;
}
#FontAwesomeIcon2 i
{
   line-height: 32px;
   font-size: 32px;
}
#wb_FontAwesomeIcon1
{
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
#FontAwesomeIcon1
{
   width: 37px;
   height: 26px;
}
#FontAwesomeIcon1 i
{
   line-height: 26px;
   font-size: 26px;
}
#Layer1
{
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
#Layer2
{
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
#wb_FontAwesomeIcon3
{
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
#FontAwesomeIcon3
{
   width: 49px;
   height: 36px;
}
#FontAwesomeIcon3 i
{
   line-height: 36px;
   font-size: 36px;
}
#wb_pacientes_detallesLayoutGrid1
{
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
#wb_pacientes_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: center;
}
#pacientes_detallesLayoutGrid1 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#nropaciente
{
   visibility: visible;
   display: block;
   color: #000000;
   font-size: 13px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   border: 1px #CCCCCC solid;
   border-radius: 4px;
   background-color: #DCDCDC;
   background-image: none;
}
#wb_pacientes_detallesText1
{
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
#pacientes_detallesLine2
{
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
#pacientes_detallesLine4
{
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
#wb_pacientes_detallesText2
{
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
#pacientes_detallesLine5
{
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
#fechareg
{
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
#pacientes_detallesLine8
{
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
#wb_pacientes_detallesLayoutGrid2
{
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
#wb_pacientes_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: center;
}
#pacientes_detallesLayoutGrid2 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#wb_pacientes_detallesText3
{
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
#pacientes_detallesLine10
{
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
#pacientes_detallesLine12
{
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
#wb_pacientes_detallesText4
{
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
#pacientes_detallesLine14
{
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
#cedula
{
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
#pacientes_detallesLine16
{
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
#wb_pacientes_detallesLayoutGrid3
{
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
#wb_pacientes_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: center;
}
#pacientes_detallesLayoutGrid3 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pnombre
{
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
#wb_pacientes_detallesText5
{
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
#pacientes_detallesLine18
{
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
#pacientes_detallesLine20
{
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
#wb_pacientes_detallesText6
{
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
#pacientes_detallesLine22
{
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
#snombre
{
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
#pacientes_detallesLine24
{
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
#wb_pacientes_detallesLayoutGrid4
{
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
#wb_pacientes_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: center;
}
#pacientes_detallesLayoutGrid4 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#papellido
{
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
#wb_pacientes_detallesText7
{
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
#pacientes_detallesLine26
{
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
#pacientes_detallesLine28
{
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
#wb_pacientes_detallesText8
{
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
#pacientes_detallesLine30
{
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
#sapellido
{
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
#pacientes_detallesLine32
{
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
#wb_empresas_detallesLayoutGrid6
{
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
#wb_empresas_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_empresas_detallesText6
{
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
#empresas_detallesLine21
{
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
#empresas_detallesLine22
{
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
#empresas_detallesLine23
{
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
#empresas_detallesTable1
{
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
#empresas_detallesTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText7
{
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
#wb_empresas_detallesText8
{
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
#wb_pacientes_detallesLayoutGrid5
{
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
#wb_pacientes_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText9
{
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
#wb_pacientes_detallesText10
{
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
#wb_pacientes_detallesText11
{
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
#fechanac
{
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
#edada
{
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
#edadm
{
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
#pacientes_detallesLine1
{
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
#pacientes_detallesLine3
{
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
#pacientes_detallesLine6
{
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
#pacientes_detallesLine7
{
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
#pacientes_detallesLine9
{
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
#pacientes_detallesLine11
{
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
#wb_pacientes_detallesLayoutGrid6
{
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
#wb_pacientes_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText12
{
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
#wb_pacientes_detallesText13
{
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
#pacientes_detallesLine13
{
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
#pacientes_detallesLine15
{
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
#pacientes_detallesLine17
{
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
#nacionalidad
{
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
#pacientes_detallesLine21
{
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
#ecivil
{
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
#pacientes_detallesLine19
{
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
#wb_pacientes_detallesLayoutGrid7
{
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
#wb_pacientes_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText14
{
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
#wb_pacientes_detallesText15
{
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
#wb_pacientes_detallesText16
{
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
#pacientes_detallesLine23
{
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
#pacientes_detallesLine25
{
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
#pacientes_detallesLine27
{
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
#telefono
{
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
#email
{
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
#codexterno
{
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
#pacientes_detallesLine29
{
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
#pacientes_detallesLine31
{
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
#pacientes_detallesLine33
{
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
#wb_empresas_detallesLayoutGrid9
{
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
#wb_empresas_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_empresas_detallesText11
{
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
#empresas_detallesLine32
{
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
#empresas_detallesLine33
{
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
#empresas_detallesLine34
{
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
#empresas_detallesTable2
{
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
#empresas_detallesTable2 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton3 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton4
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton4 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton4 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton4 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText12
{
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
#wb_empresas_detallesText13
{
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
#wb_courier_detallesLayoutGrid2
{
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
#wb_courier_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#courier_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_courier_detallesText2
{
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
#courier_detallesLine5
{
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
#courier_detallesLine6
{
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
#courier_detallesLine7
{
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
#courier_detallesLine8
{
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
#dccionr
{
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
#wb_pacientes_detallesLayoutGrid8
{
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
#wb_pacientes_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_pacientes_detallesText17
{
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
#pacientes_detallesLine34
{
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
#pacientes_detallesLine35
{
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
#pacientes_detallesLine36
{
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
#pacientes_detallesLine37
{
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
#paisr
{
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
#wb_empresas_detallesLayoutGrid3
{
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
#wb_empresas_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_empresas_detallesText3
{
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
#empresas_detallesLine9
{
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
#empresas_detallesLine10
{
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
#empresas_detallesLine11
{
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
#empresas_detallesLine12
{
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
#coddptor
{
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
#wb_empresas_detallesLayoutGrid4
{
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
#wb_empresas_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_empresas_detallesText4
{
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
#empresas_detallesLine13
{
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
#empresas_detallesLine14
{
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
#empresas_detallesLine15
{
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
#empresas_detallesLine16
{
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
#coddistr
{
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
#wb_LayoutGrid6
{
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
#wb_LayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#LayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#nomyapefam
{
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
#wb_Text4
{
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
#Line7
{
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
#Line13
{
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
#Line14
{
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
#Line15
{
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
#wb_pacientes_detallesLayoutGrid9
{
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
#wb_pacientes_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText18
{
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
#wb_pacientes_detallesText19
{
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
#pacientes_detallesLine38
{
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
#pacientes_detallesLine39
{
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
#pacientes_detallesLine40
{
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
#telefonof
{
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
#celularf
{
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
#pacientes_detallesLine41
{
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
#pacientes_detallesLine42
{
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
#pacientes_detallesLine43
{
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
#wb_empresas_detallesLayoutGrid8
{
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
#wb_empresas_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_empresas_detallesText10
{
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
#empresas_detallesLine28
{
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
#empresas_detallesLine29
{
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
#empresas_detallesLine30
{
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
#empresas_detallesLine31
{
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
#obs
{
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
#wb_pacientes_detallesLayoutGrid10
{
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
#wb_pacientes_detallesLayoutGrid10
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid10
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid10 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid10 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText20
{
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
#wb_pacientes_detallesText21
{
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
#wb_pacientes_detallesText22
{
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
#pacientes_detallesLine44
{
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
#pacientes_detallesLine45
{
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
#pacientes_detallesLine46
{
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
#fechauact
{
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
#codusup
{
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
#pacientes_detallesEditbox20
{
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
#pacientes_detallesLine47
{
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
#pacientes_detallesLine48
{
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
#pacientes_detallesLine49
{
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
#wb_pacientes_detallesLayoutGrid11
{
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
#wb_pacientes_detallesLayoutGrid11
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid11
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid11 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid11 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid11 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLayoutGrid11 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#pacientes_detallesLine51
{
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
#pacientes_detallesLine53
{
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
#pacientes_detallesLine54
{
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
#pacientes_detallesButton3
{
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
}
@media only screen and (min-width: 980px) and (max-width: 1023px)
{
div#container
{
   width: 980px;
}
#pacientes_detallesLine52
{
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

#pacientes_detallesLine50
{
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

#tdocumento
{
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
#Line9
{
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
#wb_LayoutGrid1
{
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
#wb_LayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid1
{
   padding: 10px 15px 0px 15px;
}
#LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid1 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_LayoutGrid2
{
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
#wb_LayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid2 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Image3
{
   width: 178px;
   height: 148px;
   visibility: visible;
   display: inline-block;
}
#Image3
{
   width: 178px;
   height: 148px;
}
#wb_Image4
{
   width: 743px;
   height: 147px;
   visibility: visible;
   display: inline-block;
}
#Image4
{
   width: 743px;
   height: 147px;
}
#wb_LayoutGrid3
{
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
#wb_LayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid3 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Text1
{
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
#wb_FontAwesomeIcon2
{
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
#FontAwesomeIcon2
{
   width: 66px;
   height: 32px;
}
#FontAwesomeIcon2 i
{
   line-height: 32px;
   font-size: 32px;
}
#wb_FontAwesomeIcon1
{
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
#FontAwesomeIcon1
{
   width: 37px;
   height: 26px;
}
#FontAwesomeIcon1 i
{
   line-height: 26px;
   font-size: 26px;
}
#Layer1
{
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
#Layer2
{
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
#wb_FontAwesomeIcon3
{
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
#FontAwesomeIcon3
{
   width: 49px;
   height: 36px;
}
#FontAwesomeIcon3 i
{
   line-height: 36px;
   font-size: 36px;
}
#wb_pacientes_detallesLayoutGrid1
{
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
#wb_pacientes_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesEditbox1
{
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
#wb_pacientes_detallesText1
{
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
#pacientes_detallesLine2
{
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
#pacientes_detallesLine4
{
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
#wb_pacientes_detallesText2
{
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
#pacientes_detallesLine5
{
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
#fechareg
{
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
#pacientes_detallesLine8
{
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
#wb_pacientes_detallesLayoutGrid2
{
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
#wb_pacientes_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#wb_pacientes_detallesText3
{
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
#pacientes_detallesLine10
{
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
#pacientes_detallesLine12
{
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
#wb_pacientes_detallesText4
{
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
#pacientes_detallesLine14
{
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
#cedula
{
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
#pacientes_detallesLine16
{
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
#wb_pacientes_detallesLayoutGrid3
{
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
#wb_pacientes_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pnombre
{
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
#wb_pacientes_detallesText5
{
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
#pacientes_detallesLine18
{
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
#pacientes_detallesLine20
{
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
#wb_pacientes_detallesText6
{
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
#pacientes_detallesLine22
{
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
#snombre
{
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
#pacientes_detallesLine24
{
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
#wb_pacientes_detallesLayoutGrid4
{
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
#wb_pacientes_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#papellido
{
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
#wb_pacientes_detallesText7
{
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
#pacientes_detallesLine26
{
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
#pacientes_detallesLine28
{
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
#wb_pacientes_detallesText8
{
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
#pacientes_detallesLine30
{
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
#sapellido
{
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
#pacientes_detallesLine32
{
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
#wb_empresas_detallesLayoutGrid6
{
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
#wb_empresas_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText6
{
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
#empresas_detallesLine21
{
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
#empresas_detallesLine22
{
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
#empresas_detallesLine23
{
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
#empresas_detallesTable1
{
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
#empresas_detallesTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText7
{
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
#wb_empresas_detallesText8
{
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
#wb_pacientes_detallesLayoutGrid5
{
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
#wb_pacientes_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText9
{
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
#wb_pacientes_detallesText10
{
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
#wb_pacientes_detallesText11
{
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
#fechanac
{
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
#edada
{
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
#edadm
{
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
#pacientes_detallesLine1
{
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
#pacientes_detallesLine3
{
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
#pacientes_detallesLine6
{
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
#pacientes_detallesLine7
{
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
#pacientes_detallesLine9
{
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
#pacientes_detallesLine11
{
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
#wb_pacientes_detallesLayoutGrid6
{
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
#wb_pacientes_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText12
{
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
#wb_pacientes_detallesText13
{
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
#pacientes_detallesLine13
{
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
#pacientes_detallesLine15
{
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
#pacientes_detallesLine17
{
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
#nacionalidad
{
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
#pacientes_detallesLine21
{
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

#pacientes_detallesLine19
{
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
#wb_pacientes_detallesLayoutGrid7
{
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
#wb_pacientes_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText14
{
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
#wb_pacientes_detallesText15
{
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
#wb_pacientes_detallesText16
{
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
#pacientes_detallesLine23
{
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
#pacientes_detallesLine25
{
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
#pacientes_detallesLine27
{
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
#telefono
{
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
#email
{
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
#codexterno
{
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
#pacientes_detallesLine29
{
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
#pacientes_detallesLine31
{
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
#pacientes_detallesLine33
{
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
#wb_empresas_detallesLayoutGrid9
{
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
#wb_empresas_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText11
{
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
#empresas_detallesLine32
{
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
#empresas_detallesLine33
{
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
#empresas_detallesLine34
{
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
#empresas_detallesTable2
{
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
#empresas_detallesTable2 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton3 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton4
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton4 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton4 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton4 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText12
{
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
#wb_empresas_detallesText13
{
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
#wb_courier_detallesLayoutGrid2
{
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
#wb_courier_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_courier_detallesText2
{
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
#courier_detallesLine5
{
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
#courier_detallesLine6
{
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
#courier_detallesLine7
{
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
#courier_detallesLine8
{
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
#dccionr
{
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
#wb_pacientes_detallesLayoutGrid8
{
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
#wb_pacientes_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_pacientes_detallesText17
{
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
#pacientes_detallesLine34
{
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
#pacientes_detallesLine35
{
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
#pacientes_detallesLine36
{
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
#pacientes_detallesLine37
{
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
#paisr
{
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
#wb_empresas_detallesLayoutGrid3
{
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
#wb_empresas_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText3
{
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
#empresas_detallesLine9
{
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
#empresas_detallesLine10
{
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
#empresas_detallesLine11
{
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
#empresas_detallesLine12
{
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
#coddptor
{
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
#wb_empresas_detallesLayoutGrid4
{
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
#wb_empresas_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText4
{
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
#empresas_detallesLine13
{
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
#empresas_detallesLine14
{
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
#empresas_detallesLine15
{
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
#empresas_detallesLine16
{
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
#coddistr
{
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
#wb_LayoutGrid6
{

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
#wb_LayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#nomyapefam
{
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
#wb_Text4
{
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
#Line7
{
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
#Line13
{
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
#Line14
{
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
#Line15
{
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
#wb_pacientes_detallesLayoutGrid9
{
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
#wb_pacientes_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText18
{
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
#wb_pacientes_detallesText19
{
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
#pacientes_detallesLine38
{
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
#pacientes_detallesLine39
{
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
#pacientes_detallesLine40
{
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
#telefonof
{
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
#celularf
{
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
#pacientes_detallesLine41
{
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
#pacientes_detallesLine42
{
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
#pacientes_detallesLine43
{
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
#wb_empresas_detallesLayoutGrid8
{
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
#wb_empresas_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText10
{
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
#empresas_detallesLine28
{
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
#empresas_detallesLine29
{
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
#empresas_detallesLine30
{
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
#empresas_detallesLine31
{
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
#obs
{
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
#wb_pacientes_detallesLayoutGrid10
{
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
#wb_pacientes_detallesLayoutGrid10
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid10
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid10 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid10 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText20
{
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
#wb_pacientes_detallesText21
{
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
#wb_pacientes_detallesText22
{
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
#pacientes_detallesLine44
{
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
#pacientes_detallesLine45
{
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
#pacientes_detallesLine46
{
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
#fechauact
{
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
#codusup
{
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
#pacientes_detallesEditbox20
{
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
#pacientes_detallesLine47
{
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
#pacientes_detallesLine48
{
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
#pacientes_detallesLine49
{
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

#pacientes_detallesLayoutGrid11
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid11 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}

#pacientes_detallesLine51
{
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
#pacientes_detallesLine53
{
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
#pacientes_detallesLine54
{
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

@media only screen and (min-width: 800px) and (max-width: 979px)
{
div#container
{
   width: 800px;
}
#pacientes_detallesLine52
{
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

#pacientes_detallesLine50
{
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

#tdocumento
{
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
#Line9
{
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
#wb_LayoutGrid1
{
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
#wb_LayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid1
{
   padding: 10px 15px 0px 15px;
}
#LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid1 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_LayoutGrid2
{
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
#wb_LayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid2 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Image3
{
   width: 142px;
   height: 118px;
   visibility: visible;
   display: inline-block;
}
#Image3
{
   width: 142px;
   height: 118px;
}
#wb_Image4
{
   width: 590px;
   height: 116px;
   visibility: visible;
   display: inline-block;
}
#Image4
{
   width: 590px;
   height: 116px;
}
#wb_LayoutGrid3
{
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
#wb_LayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid3 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Text1
{
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
#wb_FontAwesomeIcon2
{
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
#FontAwesomeIcon2
{
   width: 66px;
   height: 32px;
}
#FontAwesomeIcon2 i
{
   line-height: 32px;
   font-size: 32px;
}
#wb_FontAwesomeIcon1
{
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
#FontAwesomeIcon1
{
   width: 37px;
   height: 26px;
}
#FontAwesomeIcon1 i
{
   line-height: 26px;
   font-size: 26px;
}
#Layer1
{
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
#Layer2
{
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
#wb_FontAwesomeIcon3
{
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
#FontAwesomeIcon3
{
   width: 49px;
   height: 36px;
}
#FontAwesomeIcon3 i
{
   line-height: 36px;
   font-size: 36px;
}
#wb_pacientes_detallesLayoutGrid1
{
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
#wb_pacientes_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}

#wb_pacientes_detallesText1
{
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
#pacientes_detallesLine2
{
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
#pacientes_detallesLine4
{
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
#wb_pacientes_detallesText2
{
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
#pacientes_detallesLine5
{
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
#fechareg
{
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
#pacientes_detallesLine8
{
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
#wb_pacientes_detallesLayoutGrid2
{
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
#wb_pacientes_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#wb_pacientes_detallesText3
{
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
#pacientes_detallesLine10
{
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
#pacientes_detallesLine12
{
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
#wb_pacientes_detallesText4
{
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
#pacientes_detallesLine14
{
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
#cedula
{
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
#pacientes_detallesLine16
{
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
#wb_pacientes_detallesLayoutGrid3
{
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
#wb_pacientes_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pnombre
{
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
#wb_pacientes_detallesText5
{
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
#pacientes_detallesLine18
{
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
#pacientes_detallesLine20
{
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
#wb_pacientes_detallesText6
{
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
#pacientes_detallesLine22
{
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
#snombre
{
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
#pacientes_detallesLine24
{
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
#wb_pacientes_detallesLayoutGrid4
{
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
#wb_pacientes_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#papellido
{
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
#wb_pacientes_detallesText7
{
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
#pacientes_detallesLine26
{
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
#pacientes_detallesLine28
{
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
#wb_pacientes_detallesText8
{
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
#pacientes_detallesLine30
{
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
#sapellido
{
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
#pacientes_detallesLine32
{
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
#wb_empresas_detallesLayoutGrid6
{
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
#wb_empresas_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText6
{
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
#empresas_detallesLine21
{
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
#empresas_detallesLine22
{
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
#empresas_detallesLine23
{
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
#empresas_detallesTable1
{
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
#empresas_detallesTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText7
{
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
#wb_empresas_detallesText8
{
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
#wb_pacientes_detallesLayoutGrid5
{
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
#wb_pacientes_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText9
{
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
#wb_pacientes_detallesText10
{
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
#wb_pacientes_detallesText11
{
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
#fechanac
{
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
#edada
{
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
#edadm
{
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
#pacientes_detallesLine1
{
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
#pacientes_detallesLine3
{
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
#pacientes_detallesLine6
{
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
#pacientes_detallesLine7
{
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
#pacientes_detallesLine9
{
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
#pacientes_detallesLine11
{
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
#wb_pacientes_detallesLayoutGrid6
{
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
#wb_pacientes_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText12
{
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
#wb_pacientes_detallesText13
{
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
#pacientes_detallesLine13
{
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
#pacientes_detallesLine15
{
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
#pacientes_detallesLine17
{
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
#nacionalidad
{
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
#pacientes_detallesLine21
{
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

#pacientes_detallesLine19
{
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
#wb_pacientes_detallesLayoutGrid7
{
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
#wb_pacientes_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText14
{
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
#wb_pacientes_detallesText15
{
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
#wb_pacientes_detallesText16
{
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
#pacientes_detallesLine23
{
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
#pacientes_detallesLine25
{
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
#pacientes_detallesLine27
{
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
#telefono
{
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
#email
{
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
#codexterno
{
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
#pacientes_detallesLine29
{
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
#pacientes_detallesLine31
{
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
#pacientes_detallesLine33
{
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
#wb_empresas_detallesLayoutGrid9
{
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
#wb_empresas_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText11
{
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
#empresas_detallesLine32
{
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
#empresas_detallesLine33
{
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
#empresas_detallesLine34
{
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
#empresas_detallesTable2
{
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
#empresas_detallesTable2 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton3 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton4
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton4 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton4 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton4 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText12
{
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
#wb_empresas_detallesText13
{
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
#wb_courier_detallesLayoutGrid2
{
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
#wb_courier_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_courier_detallesText2
{
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
#courier_detallesLine5
{
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
#courier_detallesLine6
{
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
#courier_detallesLine7
{
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
#courier_detallesLine8
{
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
#dccionr
{
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
#wb_pacientes_detallesLayoutGrid8
{
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
#wb_pacientes_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_pacientes_detallesText17
{
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
#pacientes_detallesLine34
{
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
#pacientes_detallesLine35
{
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
#pacientes_detallesLine36
{
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
#pacientes_detallesLine37
{
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
#paisr
{
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
#wb_empresas_detallesLayoutGrid3
{
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
#wb_empresas_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText3
{
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
#empresas_detallesLine9
{
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
#empresas_detallesLine10
{
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
#empresas_detallesLine11
{
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
#empresas_detallesLine12
{
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
#coddptor
{
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
#wb_empresas_detallesLayoutGrid4
{
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
#wb_empresas_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText4
{
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
#empresas_detallesLine13
{
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
#empresas_detallesLine14
{
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
#empresas_detallesLine15
{
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
#empresas_detallesLine16
{
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
#coddistr
{
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
#wb_LayoutGrid6
{
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
#wb_LayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#nomyapefam
{
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
#wb_Text4
{
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
#Line7
{
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
#Line13
{
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
#Line14
{
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
#Line15
{
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
#wb_pacientes_detallesLayoutGrid9
{
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
#wb_pacientes_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText18
{
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
#wb_pacientes_detallesText19
{
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
#pacientes_detallesLine38
{
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
#pacientes_detallesLine39
{
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
#pacientes_detallesLine40
{
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
#telefonof
{
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
#celularf
{
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
#pacientes_detallesLine41
{
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
#pacientes_detallesLine42
{
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
#pacientes_detallesLine43
{
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
#wb_empresas_detallesLayoutGrid8
{
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
#wb_empresas_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText10
{
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
#empresas_detallesLine28
{
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
#empresas_detallesLine29
{
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
#empresas_detallesLine30
{
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
#empresas_detallesLine31
{
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
#obs
{
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
#wb_pacientes_detallesLayoutGrid10
{
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
#wb_pacientes_detallesLayoutGrid10
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid10
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid10 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid10 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText20
{
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
#wb_pacientes_detallesText21
{
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
#wb_pacientes_detallesText22
{
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
#pacientes_detallesLine44
{
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
#pacientes_detallesLine45
{
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
#pacientes_detallesLine46
{
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
#fechauact
{
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
#codusup
{
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
#pacientes_detallesEditbox20
{
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
#pacientes_detallesLine47
{
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
#pacientes_detallesLine48
{
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
#pacientes_detallesLine49
{
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

#pacientes_detallesLayoutGrid11
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid11 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}

#pacientes_detallesLine51
{
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

#pacientes_detallesLine53
{
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
#pacientes_detallesLine54
{
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

@media only screen and (min-width: 768px) and (max-width: 799px)
{
div#container
{
   width: 768px;
}
#pacientes_detallesLine52
{
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

#pacientes_detallesLine50
{
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

#tdocumento
{
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
#Line9
{
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
#wb_LayoutGrid1
{
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
#wb_LayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid1
{
   padding: 10px 15px 0px 15px;
}
#LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid1 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_LayoutGrid2
{
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
#wb_LayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid2 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Image3
{
   width: 105px;
   height: 87px;
   visibility: visible;
   display: inline-block;
}
#Image3
{
   width: 105px;
   height: 87px;
}
#wb_Image4
{
   width: 561px;
   height: 110px;
   visibility: visible;
   display: inline-block;
}
#Image4
{
   width: 561px;
   height: 110px;
}
#wb_LayoutGrid3
{
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
#wb_LayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid3 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Text1
{
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
#wb_FontAwesomeIcon2
{
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
#FontAwesomeIcon2
{
   width: 66px;
   height: 32px;
}
#FontAwesomeIcon2 i
{
   line-height: 32px;
   font-size: 32px;
}
#wb_FontAwesomeIcon1
{
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
#FontAwesomeIcon1
{
   width: 37px;
   height: 26px;
}
#FontAwesomeIcon1 i
{
   line-height: 26px;
   font-size: 26px;
}
#Layer1
{
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
#Layer2
{
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
#wb_FontAwesomeIcon3
{
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
#FontAwesomeIcon3
{
   width: 49px;
   height: 36px;
}
#FontAwesomeIcon3 i
{
   line-height: 36px;
   font-size: 36px;
}
#wb_pacientes_detallesLayoutGrid1
{
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
#wb_pacientes_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}

#wb_pacientes_detallesText1
{
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
#pacientes_detallesLine2
{
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
#pacientes_detallesLine4
{
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
#wb_pacientes_detallesText2
{
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
#pacientes_detallesLine5
{
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
#fechareg
{
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
#pacientes_detallesLine8
{
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
#wb_pacientes_detallesLayoutGrid2
{
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
#wb_pacientes_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#wb_pacientes_detallesText3
{
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
#pacientes_detallesLine10
{
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
#pacientes_detallesLine12
{
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
#wb_pacientes_detallesText4
{
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
#pacientes_detallesLine14
{
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
#cedula
{
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
#pacientes_detallesLine16
{
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
#wb_pacientes_detallesLayoutGrid3
{
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
#wb_pacientes_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pnombre
{
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
#wb_pacientes_detallesText5
{
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
#pacientes_detallesLine18
{
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
#pacientes_detallesLine20
{
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
#wb_pacientes_detallesText6
{
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
#pacientes_detallesLine22
{
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
#snombre
{
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
#pacientes_detallesLine24
{
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
#wb_pacientes_detallesLayoutGrid4
{
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
#wb_pacientes_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-4
{
   display: block;
   width: 16.66666667%;
   text-align: left;
}
#papellido
{
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
#wb_pacientes_detallesText7
{
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
#pacientes_detallesLine26
{
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
#pacientes_detallesLine28
{
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
#wb_pacientes_detallesText8
{
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
#pacientes_detallesLine30
{
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
#sapellido
{
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
#pacientes_detallesLine32
{
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
#wb_empresas_detallesLayoutGrid6
{
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
#wb_empresas_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText6
{
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
#empresas_detallesLine21
{
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
#empresas_detallesLine22
{
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
#empresas_detallesLine23
{
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
#empresas_detallesTable1
{
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
#empresas_detallesTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText7
{
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
#wb_empresas_detallesText8
{
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
#wb_pacientes_detallesLayoutGrid5
{
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
#wb_pacientes_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText9
{
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
#wb_pacientes_detallesText10
{
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
#wb_pacientes_detallesText11
{
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
#fechanac
{
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
#edada
{
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
#edadm
{
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
#pacientes_detallesLine1
{
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
#pacientes_detallesLine3
{
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
#pacientes_detallesLine6
{
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
#pacientes_detallesLine7
{
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
#pacientes_detallesLine9
{
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
#pacientes_detallesLine11
{
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
#wb_pacientes_detallesLayoutGrid6
{
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
#wb_pacientes_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText12
{
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
#wb_pacientes_detallesText13
{
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
#pacientes_detallesLine13
{
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
#pacientes_detallesLine15
{
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
#pacientes_detallesLine17
{
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
#nacionalidad
{
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
#pacientes_detallesLine21
{
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

#pacientes_detallesLine19
{
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
#wb_pacientes_detallesLayoutGrid7
{
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
#wb_pacientes_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText14
{
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
#wb_pacientes_detallesText15
{
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
#wb_pacientes_detallesText16
{
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
#pacientes_detallesLine23
{
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
#pacientes_detallesLine25
{
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
#pacientes_detallesLine27
{
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
#telefono
{
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
#email
{
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
#codexterno
{
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
#pacientes_detallesLine29
{
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
#pacientes_detallesLine31
{
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
#pacientes_detallesLine33
{
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
#wb_empresas_detallesLayoutGrid9
{
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
#wb_empresas_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText11
{
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
#empresas_detallesLine32
{
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
#empresas_detallesLine33
{
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
#empresas_detallesLine34
{
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
#empresas_detallesTable2
{
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
#empresas_detallesTable2 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton3 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton4
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton4 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton4 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton4 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText12
{
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
#wb_empresas_detallesText13
{
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
#wb_courier_detallesLayoutGrid2
{
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
#wb_courier_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_courier_detallesText2
{
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
#courier_detallesLine5
{
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
#courier_detallesLine6
{
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
#courier_detallesLine7
{
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
#courier_detallesLine8
{
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
#dccionr
{
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
#wb_pacientes_detallesLayoutGrid8
{
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
#wb_pacientes_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_pacientes_detallesText17
{
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
#pacientes_detallesLine34
{
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
#pacientes_detallesLine35
{
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
#pacientes_detallesLine36
{
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
#pacientes_detallesLine37
{
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
#paisr
{
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
#wb_empresas_detallesLayoutGrid3
{
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
#wb_empresas_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText3
{
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
#empresas_detallesLine9
{
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
#empresas_detallesLine10
{
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
#empresas_detallesLine11
{
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
#empresas_detallesLine12
{
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
#coddptor
{
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
#wb_empresas_detallesLayoutGrid4
{
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
#wb_empresas_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText4
{
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
#empresas_detallesLine13
{
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
#empresas_detallesLine14
{
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
#empresas_detallesLine15
{
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
#empresas_detallesLine16
{
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
#coddistr
{
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
#wb_LayoutGrid6
{
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
#wb_LayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid6 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#nomyapefam
{
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
#wb_Text4
{
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
#Line7
{
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
#Line13
{
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
#Line14
{
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
#Line15
{
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
#wb_pacientes_detallesLayoutGrid9
{
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
#wb_pacientes_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText18
{
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
#wb_pacientes_detallesText19
{
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
#pacientes_detallesLine38
{
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
#pacientes_detallesLine39
{
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
#pacientes_detallesLine40
{
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
#telefonof
{
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
#celularf
{
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
#pacientes_detallesLine41
{
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
#pacientes_detallesLine42
{
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
#pacientes_detallesLine43
{
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
#wb_empresas_detallesLayoutGrid8
{
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
#wb_empresas_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesText10
{
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
#empresas_detallesLine28
{
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
#empresas_detallesLine29
{
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
#empresas_detallesLine30
{
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
#empresas_detallesLine31
{
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
#obs
{
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
#wb_pacientes_detallesLayoutGrid10
{
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
#wb_pacientes_detallesLayoutGrid10
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid10
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid10 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid10 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-2
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-3
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#wb_pacientes_detallesText20
{
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
#wb_pacientes_detallesText21
{
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
#wb_pacientes_detallesText22
{
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
#pacientes_detallesLine44
{
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
#pacientes_detallesLine45
{
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
#pacientes_detallesLine46
{
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
#fechauact
{
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
#codusup
{
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
#pacientes_detallesEditbox20
{
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
#pacientes_detallesLine47
{
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
#pacientes_detallesLine48
{
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
#pacientes_detallesLine49
{
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

#pacientes_detallesLayoutGrid11
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid11 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}

#pacientes_detallesLine51
{
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
#pacientes_detallesLine53
{
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
#pacientes_detallesLine54
{
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

@media only screen and (min-width: 480px) and (max-width: 767px)
{
div#container
{
   width: 480px;
}
#pacientes_detallesLine52
{
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

#pacientes_detallesLine50
{
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

#tdocumento
{
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
#Line9
{
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
#wb_LayoutGrid1
{
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
#wb_LayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid1
{
   padding: 10px 15px 0px 15px;
}
#LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid1 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_LayoutGrid2
{
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
#wb_LayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid2 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Image3
{
   width: 76px;
   height: 63px;
   visibility: visible;
   display: inline-block;
}
#Image3
{
   width: 76px;
   height: 63px;
}
#wb_Image4
{
   width: 374px;
   height: 73px;
   visibility: visible;
   display: inline-block;
}
#Image4
{
   width: 374px;
   height: 73px;
}
#wb_LayoutGrid3
{
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
#wb_LayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid3 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Text1
{
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
#wb_FontAwesomeIcon2
{
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
#FontAwesomeIcon2
{
   width: 66px;
   height: 32px;
}
#FontAwesomeIcon2 i
{
   line-height: 32px;
   font-size: 32px;
}
#wb_FontAwesomeIcon1
{
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
#FontAwesomeIcon1
{
   width: 37px;
   height: 26px;
}
#FontAwesomeIcon1 i
{
   line-height: 26px;
   font-size: 26px;
}
#Layer1
{
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
#Layer2
{
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
#wb_FontAwesomeIcon3
{
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
#FontAwesomeIcon3
{
   width: 49px;
   height: 36px;
}
#FontAwesomeIcon3 i
{
   line-height: 36px;
   font-size: 36px;
}
#wb_pacientes_detallesLayoutGrid1
{
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
#wb_pacientes_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}

#wb_pacientes_detallesText1
{
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
#pacientes_detallesLine2
{
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
#pacientes_detallesLine4
{
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
#wb_pacientes_detallesText2
{
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
#pacientes_detallesLine5
{
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
#fechareg
{
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
#pacientes_detallesLine8
{
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
#wb_pacientes_detallesLayoutGrid2
{
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
#wb_pacientes_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText3
{
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
#pacientes_detallesLine10
{
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
#pacientes_detallesLine12
{
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
#wb_pacientes_detallesText4
{
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
#pacientes_detallesLine14
{
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
#cedula
{
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
#pacientes_detallesLine16
{
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
#wb_pacientes_detallesLayoutGrid3
{
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
#wb_pacientes_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#pnombre
{
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
#wb_pacientes_detallesText5
{
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
#pacientes_detallesLine18
{
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
#pacientes_detallesLine20
{
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
#wb_pacientes_detallesText6
{
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
#pacientes_detallesLine22
{
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
#snombre
{
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
#pacientes_detallesLine24
{
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
#wb_pacientes_detallesLayoutGrid4
{
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
#wb_pacientes_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#papellido
{
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
#wb_pacientes_detallesText7
{
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
#pacientes_detallesLine26
{
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
#pacientes_detallesLine28
{
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
#wb_pacientes_detallesText8
{
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
#pacientes_detallesLine30
{
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
#sapellido
{
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
#pacientes_detallesLine32
{
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
#wb_empresas_detallesLayoutGrid6
{
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
#wb_empresas_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText6
{
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
#empresas_detallesLine21
{
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
#empresas_detallesLine22
{
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
#empresas_detallesLine23
{
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
#empresas_detallesTable1
{
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
#empresas_detallesTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText7
{
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
#wb_empresas_detallesText8
{
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
#wb_pacientes_detallesLayoutGrid5
{
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
#wb_pacientes_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText9
{
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
#wb_pacientes_detallesText10
{
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
#wb_pacientes_detallesText11
{
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
#fechanac
{
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
#edada
{
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
#edadm
{
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
#pacientes_detallesLine1
{
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
#pacientes_detallesLine3
{
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
#pacientes_detallesLine6
{
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
#pacientes_detallesLine7
{
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
#pacientes_detallesLine9
{
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
#pacientes_detallesLine11
{
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
#wb_pacientes_detallesLayoutGrid6
{
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
#wb_pacientes_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText12
{
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
#wb_pacientes_detallesText13
{
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
#pacientes_detallesLine13
{
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
#pacientes_detallesLine15
{
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
#pacientes_detallesLine17
{
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
#nacionalidad
{
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
#pacientes_detallesLine21
{
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

#pacientes_detallesLine19
{
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
#wb_pacientes_detallesLayoutGrid7
{
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
#wb_pacientes_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText14
{
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
#wb_pacientes_detallesText15
{
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
#wb_pacientes_detallesText16
{
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
#pacientes_detallesLine23
{
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
#pacientes_detallesLine25
{
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
#pacientes_detallesLine27
{
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
#telefono
{
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
#email
{
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
#codexterno
{
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
#pacientes_detallesLine29
{
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
#pacientes_detallesLine31
{
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
#pacientes_detallesLine33
{
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
#wb_empresas_detallesLayoutGrid9
{
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
#wb_empresas_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText11
{
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
#empresas_detallesLine32
{
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
#empresas_detallesLine33
{
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
#empresas_detallesLine34
{
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
#empresas_detallesTable2
{
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
#empresas_detallesTable2 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton3 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton4
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton4 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton4 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton4 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText12
{
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
#wb_empresas_detallesText13
{
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
#wb_courier_detallesLayoutGrid2
{
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
#wb_courier_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#courier_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_courier_detallesText2
{
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
#courier_detallesLine5
{
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
#courier_detallesLine6
{
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
#courier_detallesLine7
{
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
#courier_detallesLine8
{
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
#dccionr
{
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
#wb_pacientes_detallesLayoutGrid8
{
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
#wb_pacientes_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText17
{
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
#pacientes_detallesLine34
{
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
#pacientes_detallesLine35
{
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
#pacientes_detallesLine36
{
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
#pacientes_detallesLine37
{
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
#paisr
{
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
#wb_empresas_detallesLayoutGrid3
{
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
#wb_empresas_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText3
{
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
#empresas_detallesLine9
{
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
#empresas_detallesLine10
{
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
#empresas_detallesLine11
{
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
#empresas_detallesLine12
{
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
#coddptor
{
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
#wb_empresas_detallesLayoutGrid4
{
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
#wb_empresas_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText4
{
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
#empresas_detallesLine13
{
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
#empresas_detallesLine14
{
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
#empresas_detallesLine15
{
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
#empresas_detallesLine16
{
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
#coddistr
{
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
#wb_LayoutGrid6
{
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
#wb_LayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid6 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#nomyapefam
{
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
#wb_Text4
{
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
#Line7
{
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
#Line13
{
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
#Line14
{
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
#Line15
{
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
#wb_pacientes_detallesLayoutGrid9
{
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
#wb_pacientes_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText18
{
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
#wb_pacientes_detallesText19
{
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
#pacientes_detallesLine38
{
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
#pacientes_detallesLine39
{
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
#pacientes_detallesLine40
{
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
#telefonof
{
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
#celularf
{
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
#pacientes_detallesLine41
{
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
#pacientes_detallesLine42
{
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
#pacientes_detallesLine43
{
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
#wb_empresas_detallesLayoutGrid8
{
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
#wb_empresas_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText10
{
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
#empresas_detallesLine28
{
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

#empresas_detallesLine29
{
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
#empresas_detallesLine30
{
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
#empresas_detallesLine31
{
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
#obs
{
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
#wb_pacientes_detallesLayoutGrid10
{
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
#wb_pacientes_detallesLayoutGrid10
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid10
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid10 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid10 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText20
{
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
#wb_pacientes_detallesText21
{
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
#wb_pacientes_detallesText22
{
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
#pacientes_detallesLine44
{
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
#pacientes_detallesLine45
{
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
#pacientes_detallesLine46
{
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
#fechauact
{
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
#codusup
{
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
#pacientes_detallesEditbox20
{
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
#pacientes_detallesLine47
{
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
#pacientes_detallesLine48
{
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
#pacientes_detallesLine49
{
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

#pacientes_detallesLayoutGrid11
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid11 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}

#pacientes_detallesLine51
{
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
#pacientes_detallesLine53
{
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
#pacientes_detallesLine54
{
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

@media only screen and (max-width: 479px)
{
div#container
{
   width: 320px;
}
#pacientes_detallesLine52
{
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

#pacientes_detallesLine50
{
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

#tdocumento
{
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
#Line9
{
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
#wb_LayoutGrid1
{
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
#wb_LayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid1
{
   padding: 10px 15px 0px 15px;
}
#LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid1 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_LayoutGrid2
{
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
#wb_LayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid2 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Image3
{
   width: 47px;
   height: 39px;
   visibility: visible;
   display: inline-block;
}
#Image3
{
   width: 47px;
   height: 39px;
}
#wb_Image4
{
   width: 222px;
   height: 43px;
   visibility: visible;
   display: inline-block;
}
#Image4
{
   width: 222px;
   height: 43px;
}
#wb_LayoutGrid3
{
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
#wb_LayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid3 .col-1
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: center;
}
#wb_Text1
{
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
#wb_FontAwesomeIcon2
{
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
#FontAwesomeIcon2
{
   width: 66px;
   height: 32px;
}
#FontAwesomeIcon2 i
{
   line-height: 32px;
   font-size: 32px;
}
#wb_FontAwesomeIcon1
{
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
#FontAwesomeIcon1
{
   width: 37px;
   height: 26px;
}
#FontAwesomeIcon1 i
{
   line-height: 26px;
   font-size: 26px;
}
#Layer1
{
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
#Layer2
{
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
#wb_FontAwesomeIcon3
{
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
#FontAwesomeIcon3
{
   width: 49px;
   height: 36px;
}
#FontAwesomeIcon3 i
{
   line-height: 36px;
   font-size: 36px;
}
#wb_pacientes_detallesLayoutGrid1
{
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
#wb_pacientes_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid1 .col-1, #pacientes_detallesLayoutGrid1 .col-2, #pacientes_detallesLayoutGrid1 .col-3, #pacientes_detallesLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid1 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}

#wb_pacientes_detallesText1
{
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
#pacientes_detallesLine2
{
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
#pacientes_detallesLine4
{
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
#wb_pacientes_detallesText2
{
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
#pacientes_detallesLine5
{
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
#fechareg
{
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
#pacientes_detallesLine8
{
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
#wb_pacientes_detallesLayoutGrid2
{
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
#wb_pacientes_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid2 .col-1, #pacientes_detallesLayoutGrid2 .col-2, #pacientes_detallesLayoutGrid2 .col-3, #pacientes_detallesLayoutGrid2 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid2 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText3
{
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
#pacientes_detallesLine10
{
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
#pacientes_detallesLine12
{
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
#wb_pacientes_detallesText4
{
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
#pacientes_detallesLine14
{
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
#cedula
{
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
#pacientes_detallesLine16
{
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
#wb_pacientes_detallesLayoutGrid3
{
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
#wb_pacientes_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid3 .col-1, #pacientes_detallesLayoutGrid3 .col-2, #pacientes_detallesLayoutGrid3 .col-3, #pacientes_detallesLayoutGrid3 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid3 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#pnombre
{
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
#wb_pacientes_detallesText5
{
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
#pacientes_detallesLine18
{
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
#pacientes_detallesLine20
{
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
#wb_pacientes_detallesText6
{
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
#pacientes_detallesLine22
{
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
#snombre
{
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
#pacientes_detallesLine24
{
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
#wb_pacientes_detallesLayoutGrid4
{
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
#wb_pacientes_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid4 .col-1, #pacientes_detallesLayoutGrid4 .col-2, #pacientes_detallesLayoutGrid4 .col-3, #pacientes_detallesLayoutGrid4 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid4 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#papellido
{
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
#wb_pacientes_detallesText7
{
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
#pacientes_detallesLine26
{
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
#pacientes_detallesLine28
{
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
#wb_pacientes_detallesText8
{
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
#pacientes_detallesLine30
{
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
#sapellido
{
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
#pacientes_detallesLine32
{
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
#wb_empresas_detallesLayoutGrid6
{
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
#wb_empresas_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid6 .col-1, #empresas_detallesLayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText6
{
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
#empresas_detallesLine21
{
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
#empresas_detallesLine22
{
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
#empresas_detallesLine23
{
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
#empresas_detallesTable1
{
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
#empresas_detallesTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText7
{
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
#wb_empresas_detallesText8
{
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
#wb_pacientes_detallesLayoutGrid5
{
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
#wb_pacientes_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid5 .col-1, #pacientes_detallesLayoutGrid5 .col-2, #pacientes_detallesLayoutGrid5 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid5 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText9
{
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
#wb_pacientes_detallesText10
{
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
#wb_pacientes_detallesText11
{
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
#fechanac
{
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
#edada
{
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
#edadm
{
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
#pacientes_detallesLine1
{
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
#pacientes_detallesLine3
{
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
#pacientes_detallesLine6
{
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
#pacientes_detallesLine7
{
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
#pacientes_detallesLine9
{
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
#pacientes_detallesLine11
{
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
#wb_pacientes_detallesLayoutGrid6
{
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
#wb_pacientes_detallesLayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid6 .col-1, #pacientes_detallesLayoutGrid6 .col-2, #pacientes_detallesLayoutGrid6 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid6 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid6 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText12
{
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
#wb_pacientes_detallesText13
{
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
#pacientes_detallesLine13
{
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
#pacientes_detallesLine15
{
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
#pacientes_detallesLine17
{
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
#nacionalidad
{
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
#pacientes_detallesLine21
{
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

#pacientes_detallesLine19
{
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
#wb_pacientes_detallesLayoutGrid7
{
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
#wb_pacientes_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid7 .col-1, #pacientes_detallesLayoutGrid7 .col-2, #pacientes_detallesLayoutGrid7 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid7 .col-3

{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText14
{
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
#wb_pacientes_detallesText15
{
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
#wb_pacientes_detallesText16
{
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
#pacientes_detallesLine23
{
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
#pacientes_detallesLine25
{
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
#pacientes_detallesLine27
{
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
#telefono
{
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
#email
{
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
#codexterno
{
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
#pacientes_detallesLine29
{
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
#pacientes_detallesLine31
{
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
#pacientes_detallesLine33
{
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
#wb_empresas_detallesLayoutGrid9
{
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
#wb_empresas_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid9 .col-1, #empresas_detallesLayoutGrid9 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText11
{
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
#empresas_detallesLine32
{
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
#empresas_detallesLine33
{
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
#empresas_detallesLine34
{
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
#empresas_detallesTable2
{
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
#empresas_detallesTable2 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_empresas_detallesRadioButton3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton3 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesRadioButton4
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_empresas_detallesRadioButton4 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_empresas_detallesRadioButton4 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_empresas_detallesRadioButton4 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_empresas_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_empresas_detallesText12
{
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
#wb_empresas_detallesText13
{
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
#wb_courier_detallesLayoutGrid2
{
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
#wb_courier_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid2 .col-1, #courier_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#courier_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_courier_detallesText2
{
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
#courier_detallesLine5
{
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
#courier_detallesLine6
{
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
#courier_detallesLine7
{
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
#courier_detallesLine8
{
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
#dccionr
{
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
#wb_pacientes_detallesLayoutGrid8
{
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
#wb_pacientes_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid8 .col-1, #pacientes_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText17
{
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
#pacientes_detallesLine34
{
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
#pacientes_detallesLine35
{
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
#pacientes_detallesLine36
{
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
#pacientes_detallesLine37
{
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
#paisr
{
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
#wb_empresas_detallesLayoutGrid3
{
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
#wb_empresas_detallesLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid3 .col-1, #empresas_detallesLayoutGrid3 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid3 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid3 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText3
{
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
#empresas_detallesLine9
{
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
#empresas_detallesLine10
{
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
#empresas_detallesLine11
{
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
#empresas_detallesLine12
{
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
#coddptor
{
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
#wb_empresas_detallesLayoutGrid4
{
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
#wb_empresas_detallesLayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid4 .col-1, #empresas_detallesLayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText4
{
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
#empresas_detallesLine13
{
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
#empresas_detallesLine14
{
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
#empresas_detallesLine15
{
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
#empresas_detallesLine16
{
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
#coddistr
{
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
#wb_LayoutGrid6
{
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
#wb_LayoutGrid6
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid6 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#nomyapefam
{
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
#wb_Text4
{
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
#Line7
{
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
#Line13
{
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
#Line14
{
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
#Line15
{
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

#wb_pacientes_detallesLayoutGrid9
{
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
#wb_pacientes_detallesLayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid9
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid9 .col-1, #pacientes_detallesLayoutGrid9 .col-2, #pacientes_detallesLayoutGrid9 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid9 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid9 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText18
{
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
#wb_pacientes_detallesText19
{
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
#pacientes_detallesLine38
{
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
#pacientes_detallesLine39
{
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
#pacientes_detallesLine40
{
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
#telefonof
{
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
#celularf
{
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
#pacientes_detallesLine41
{
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
#pacientes_detallesLine42
{
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
#pacientes_detallesLine43
{
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
#wb_empresas_detallesLayoutGrid8
{
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
#wb_empresas_detallesLayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid8 .col-1, #empresas_detallesLayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid8 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid8 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesText10
{
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
#empresas_detallesLine28
{
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
#empresas_detallesLine29
{
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
#empresas_detallesLine30
{
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
#empresas_detallesLine31
{
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
#obs
{
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
#wb_pacientes_detallesLayoutGrid10
{
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
#wb_pacientes_detallesLayoutGrid10
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#pacientes_detallesLayoutGrid10
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid10 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid10 .col-1, #pacientes_detallesLayoutGrid10 .col-2, #pacientes_detallesLayoutGrid10 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}
#pacientes_detallesLayoutGrid10 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#pacientes_detallesLayoutGrid10 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_pacientes_detallesText20
{
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
#wb_pacientes_detallesText21
{
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
#wb_pacientes_detallesText22
{
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
#pacientes_detallesLine44
{
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
#pacientes_detallesLine45
{
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
#pacientes_detallesLine46
{
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
#fechauact
{
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
#codusup
{
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
#pacientes_detallesEditbox20
{
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
#pacientes_detallesLine47
{
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
#pacientes_detallesLine48
{
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
#pacientes_detallesLine49
{
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

#pacientes_detallesLayoutGrid11
{
   padding: 0px 15px 0px 15px;
}
#pacientes_detallesLayoutGrid11 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientes_detallesLayoutGrid11 .col-1, #pacientes_detallesLayoutGrid11 .col-2, #pacientes_detallesLayoutGrid11 .col-3
{
   padding-right: 15px;
   padding-left: 15px;
}

#pacientes_detallesLine51
{
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
#pacientes_detallesLine53
{
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
#pacientes_detallesLine54
{
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

#tb
{
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
#tb
{
   display: block;
   width: 80%;
   height: 28px;
   z-index: 70;
}
#tb
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
#tb:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
	
#codetnia
{
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
	
#codetnia
{
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
	
#codetnia
{
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
	
#codetnia
{
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
	
#codetnia
{
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
	
#codetnia
{
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
	
#codetnia
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 128;
}
	
#codetnia
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
	
#codetnia:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
	

</style>

<script src="jquery-1.12.4.min.js"></script>
<script src="wb.stickylayer.min.js"></script>
<script src="affix.min.js"></script>

<script>
$(document).ready(function()
{
   $("#Layer2").stickylayer({orientation: 2, position: [45, 50], delay: 500});
//   $("#wb_ResponsiveMenu1").affix({offset:{top: $("#wb_ResponsiveMenu1").offset().top}});
});
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

function calcularEdad()
{
	// Si la fecha es correcta, calculamos la edad

	var fecha = document.getElementById('fechanac').value;

	if (typeof fecha != "string" && fecha && esNumero(fecha.getTime()))
	{
		fecha = formatDate(fecha, "yyyy-MM-dd");
	}

	var values = fecha.split("-");
	var dia = values[2];
	var mes = values[1];
	var ano = values[0];

	// cogemos los valores actuales
	var fecha_hoy = new Date();
	var ahora_ano = fecha_hoy.getYear();
	var ahora_mes = fecha_hoy.getMonth() + 1;
	var ahora_dia = fecha_hoy.getDate();

	// realizamos el calculo
	var edad = (ahora_ano + 1900) - ano;
	if (ahora_mes < mes) {
		edad--;
	}
	if ((mes == ahora_mes) && (ahora_dia < dia)) {
		edad--;
	}
	if (edad > 1900) {
		edad -= 1900;
	}

	// calculamos los meses
	var meses = 0;

	if (ahora_mes > mes && dia > ahora_dia)
		meses = ahora_mes - mes - 1;
	else if (ahora_mes > mes)
		meses = ahora_mes - mes
	if (ahora_mes < mes && dia < ahora_dia)
		meses = 12 - (mes - ahora_mes);
	else if (ahora_mes < mes)
		meses = 12 - (mes - ahora_mes + 1);
	if (ahora_mes == mes && dia > ahora_dia)
		meses = 11;

	// calculamos los dias
	var dias = 0;
	if (ahora_dia > dia)
		dias = ahora_dia - dia;
	if (ahora_dia < dia) {
		ultimoDiaMes = new Date(ahora_ano, ahora_mes - 1, 0);
		dias = ultimoDiaMes.getDate() - (dia - ahora_dia);
	}

	if(meses != 0 && edad == 0)
	{
		window.document.formu.edadm.value = meses;
		window.document.formu.edada.value = "0";
	}
	else
	{
		window.document.formu.edada.value = edad;
		window.document.formu.edadm.value = "0";
	}


	return
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

function buscador()
{
    $("#cedula").focusout(function(){
			  $.ajax({
					url:'buscarpacientes.php',
				  type:'POST',
				  dataType:'json',
				  data:{ cedula:$('#cedula').val()}
			  }).done(function(respuesta){
				  $("#pnombre").val(respuesta.pnombre);
				  $("#snombre").val(respuesta.snombre);
				  $("#papellido").val(respuesta.papellido);
				  $("#sapellido").val(respuesta.sapellido);
				  $("#fechanac").val(respuesta.fechanac);
				  $("#nacionalidad").val(respuesta.nacionalidad);
				  $("#telefono").val(respuesta.telefono);
				  $("#email").val(respuesta.email);
				  $("#dccionr").val(respuesta.dccionr);
				  $("#coddptor").val(respuesta.coddptor);
				  $("#paisr").val(respuesta.paisr);

				  $(document).ready(calcularEdad());

				  $(document).ready(function() {
						var form_data = {
								is_ajax: 1,
								departamento: respuesta.coddptor,
								distrito: respuesta.coddistr
						};

						$.ajax({
								type: "POST",
								url: "ListaDistrito.php",
								data: form_data,
								success: function(response)
								{
									$('.sin-json select').html(response).fadeIn();
								}
						});
				  });

				  if(respuesta.sexo == 1)
				  {
					  $("#sexo1").attr('checked', true);
					  //$("#sexo2").attr('checked', false);
				  }
				  else
				  {
					  //$("#sexo1").attr('checked', false);
					  $("#sexo2").attr('checked', true);
				  }

				  switch(respuesta.ecivil) {
						case '1':
							$("#ecivil").val("1. Soltero/a");
							break;
						case '2':
							$("#ecivil").val("2. Casado/a");
							break;
						case '3':
							$("#ecivil").val("3. Viudo/a");
							break;
						case '4':
							$("#ecivil").val("4. Unido/a");
							break;
						case '5':
							$("#ecivil").val("5. Separado/a");
							break;
						case '6':
							$("#ecivil").val("6. Divorciado/a");
							break;
						default:
							$("#ecivil").val("7. No se sabe");
				}

				switch(respuesta.tdocumento) {
						case '1':
							$("#tdocumento").val("1. Cedula");
							break;
						case '2':
							$("#tdocumento").val("2. Pasaporte");
							break;
						case '3':
							$("#tdocumento").val("3. Carnet Indigena");
							break;
						case '4':
							$("#tdocumento").val("4. Otros");
							break;
						default:
							$("#tdocumento").val("5. No Tiene");
				}

			  });
			});
}

function cargar()
{
    $(document).ready(function() {
						var form_data = {
								is_ajax: 1,
								departamento: window.document.formu.coddptor1.value,
								distrito: window.document.formu.coddistr1.value
						};

						$.ajax({
								type: "POST",
								url: "ListaDistrito.php",
								data: form_data,
								success: function(response)
								{
									$('.sin-json select').html(response).fadeIn();
								}
						});
	});
}

function openHistoria()
{
	nropaciente   = window.document.formu.nropaciente.value;

	window.open("impresion_historia_clinica.php?nropaciente="+nropaciente);
}
	
function activaetnia()
{
   if (window.document.formu.esetnia[1].checked == true)//Aplica
   {
              window.document.formu.codetnia.disabled = false;
              window.document.formu.codetnia.style.backgroundColor = "#FFF";
              window.document.formu.codetnia.focus();

   }

  if (window.document.formu.esetnia[0].checked == true)//No aplica
   {

              window.document.formu.codetnia.style.backgroundColor = "#CCC";
              window.document.formu.codetnia.selectedIndex=0;
              window.document.formu.codetnia.disabled = true;

   }
}
	
function ListaEtnia()
{
    $(document).ready(function() {

    var data = {};
    $("#listaetnia option").each(function(i,el) {
       data[$(el).data("value")] = $(el).val();
    });
    console.log(data, $("#listaetnia option").val());

        var value = $('#codetnia').val();

        $('#codetnia1').val($('#listaetnia [value="' + value + '"]').data('value'));
    });

}
</script>

</head>
<body onLoad="cargar()">
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
<div id="wb_LayoutGrid3">
	<div id="LayoutGrid3">
		<div class="row">
			<div class="col-1">
				<hr id="Line9"/>
				<div id="wb_Text1">
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br />
					<br />
					</strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>FICHA DEL PACIENTE</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><br />
					<br />
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<form name="formu" id="formu" method="post" action="insertar_pacientes.php">

<div id="Layer2">
<div id="wb_FontAwesomeIcon3">
<a href="menu.php"><div id="FontAwesomeIcon3"><i class="fa fa-commenting-o">&nbsp;</i></div></a></div>
</div>

<div id="wb_pacientes_detallesLayoutGrid1">
<div id="pacientes_detallesLayoutGrid1">
<div class="row">
<div class="col-1">
<div id="wb_pacientes_detallesText1">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Número de Paciente: </strong></span>
</div>
<hr id="pacientes_detallesLine2">
</div>
<div class="col-2">
<input type="text" id="nropaciente" name="nropaciente" value="<?php echo $nropaciente; ?>" maxlength="10" spellcheck="false" onkeypress="return validarnum(event)" readonly>
<hr id="pacientes_detallesLine4">
</div>
<div class="col-3">
<div id="wb_pacientes_detallesText2">
<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Fecha Registro:</strong></span>
</div>
<hr id="pacientes_detallesLine5">
</div>
<div class="col-4">
<input type="date" id="fechareg" name="fechareg" value="<?php echo $fechareg; ?>" spellcheck="false">
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

<input type="text" name="tdocumento" id="tdocumento" list="listatipodocumento" value="<?php echo $nomdocumento; ?>" onkeypress="return validarcar(event)">
<hr id="pacientes_detallesLine12">
</div>
<div class="col-3">
<div id="wb_pacientes_detallesText4">
<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Nro. Documento:</strong></span>
</div>
<hr id="pacientes_detallesLine14">
</div>
<div class="col-4">
<input type="text" id="cedula" name="cedula" value="<?php echo $cedula; ?>" maxlength="15" spellcheck="false" onkeypress="return validarcar(event)" onChange="buscador()" autofocus>
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
<input type="text" id="pnombre" name="pnombre" value="<?php echo $pnombre; ?>" maxlength="30" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="pacientes_detallesLine20">
</div>
<div class="col-3">
<div id="wb_pacientes_detallesText6">
<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Segundo Nombre:</strong></span>
</div>
<hr id="pacientes_detallesLine22">
</div>
<div class="col-4">
<input type="text" id="snombre" name="snombre" value="<?php echo $snombre; ?>" maxlength="30" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
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
<input type="text" id="papellido" name="papellido" value="<?php echo $papellido; ?>" maxlength="30" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="pacientes_detallesLine28">
</div>
<div class="col-3">
<div id="wb_pacientes_detallesText8">
<span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Segundo Apellido:</strong></span>
</div>
<hr id="pacientes_detallesLine30">
</div>
<div class="col-4">
<input type="text" id="sapellido" name="sapellido" value="<?php echo $sapellido; ?>" maxlength="30" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="pacientes_detallesLine32">
</div>
</div>
</div>
</div>

<div id="wb_empresas_detallesLayoutGrid6">
<div id="empresas_detallesLayoutGrid6">
<div class="row">
<div class="col-1">
<hr id="empresas_detallesLine21">
<div id="wb_empresas_detallesText6">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Sexo: </strong></span>
</div>
</div>
<div class="col-2">
<hr id="empresas_detallesLine23">
<table id="empresas_detallesTable1">
<tr>
<td class="cell0"><div id="wb_empresas_detallesRadioButton1">
<input type="radio" id="sexo1" name="sexo" value="1" <?php echo $chequeo1;?>><label for="sexo1"></label>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesText7">
<span style="color:#808080;font-family:Arial;font-size:13px;"> Masculino</span>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesRadioButton2">
<input type="radio" id="sexo2" name="sexo" value="2" <?php echo $chequeo2;?>><label for="sexo2"></label>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesText8">
<span style="color:#808080;font-family:Arial;font-size:13px;"> Femenino</span>
</div>
</td>
</tr>
</table>
<hr id="empresas_detallesLine22">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid5">
<div id="pacientes_detallesLayoutGrid5">
<div class="row">
<div class="col-1">
<div id="wb_pacientes_detallesText9">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Fecha Nacimiento: </strong></span>
</div>
<hr id="pacientes_detallesLine3">
<input type="date" id="fechanac" name="fechanac" value="<?php echo $fechanac; ?>" spellcheck="false" onChange="calcularEdad()">
<hr id="pacientes_detallesLine9">
</div>
<div class="col-2">
<div id="wb_pacientes_detallesText10">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Edad en Años: </strong></span>
</div>
<hr id="pacientes_detallesLine7">
<input type="text" id="edada" name="edada" value="<?php echo $edada; ?>" maxlength="3" spellcheck="false" onkeypress="return validarnum(event)">
<hr id="pacientes_detallesLine11">
</div>
<div class="col-3">
<div id="wb_pacientes_detallesText11">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Edad en Meses: </strong></span>
</div>
<hr id="pacientes_detallesLine6">
<input type="text" id="edadm" name="edadm" value="<?php echo $edadm; ?>" maxlength="3" spellcheck="false" onkeypress="return validarnum(event)">
<hr id="pacientes_detallesLine1">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid6">
<div id="pacientes_detallesLayoutGrid6">
<div class="row">
<div class="col-1">
<div id="wb_pacientes_detallesText12">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Estado Civil: </strong></span>
</div>
<hr id="pacientes_detallesLine13">
<input type="text" name="ecivil" id="ecivil" list="listaestadocivil" value="<?php echo $nomcivil; ?>" onkeypress="return validarcar(event)">
<hr id="pacientes_detallesLine19">
</div>
<div class="col-2">
<div id="wb_pacientes_detallesText13">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nacionalidad: </strong></span>
</div>
<hr id="pacientes_detallesLine17">
<input type="text" id="nacionalidad" name="nacionalidad" value="<?php echo $nacionalidad; ?>" maxlength="100" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="pacientes_detallesLine21">
</div>
<div class="col-3">
<hr id="pacientes_detallesLine15">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid7">
<div id="pacientes_detallesLayoutGrid7">
<div class="row">
<div class="col-1">
<div id="wb_pacientes_detallesText14">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Teléfono: </strong></span>
</div>
<hr id="pacientes_detallesLine23">
<input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>" maxlength="30" spellcheck="false" onkeypress="return validarcar(event)">
<hr id="pacientes_detallesLine29">
</div>
<div class="col-2">
<div id="wb_pacientes_detallesText15">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>E-Mail: </strong></span>
</div>
<hr id="pacientes_detallesLine27">
<input type="email" id="email" name="email" value="<?php echo $email; ?>" maxlength="50" spellcheck="false" onkeypress="return validarcar(event)">
<hr id="pacientes_detallesLine31">
</div>
<div class="col-3">
<div id="wb_pacientes_detallesText16">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Código Externo: </strong></span>
</div>
<hr id="pacientes_detallesLine25">
<input type="text" id="codexterno" name="codexterno" value="<?php echo $codexterno; ?>" maxlength="20" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="pacientes_detallesLine33">
</div>
</div>
</div>
</div>

<div id="wb_empresas_detallesLayoutGrid9">
<div id="empresas_detallesLayoutGrid9">
<div class="row">
<div class="col-1">
<hr id="empresas_detallesLine32">
<div id="wb_empresas_detallesText11">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Estado: <br></strong></span>
</div>
</div>
<div class="col-2">
<hr id="empresas_detallesLine34">
<table id="empresas_detallesTable2">
<tr>
<td class="cell0"><div id="wb_empresas_detallesRadioButton3">
<input type="radio" id="estado1" name="estado" value="1" <?php echo $chequeo11;?>><label for="estado1"></label>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesText12">
<span style="color:#808080;font-family:Arial;font-size:13px;"> Activo</span>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesRadioButton4">
<input type="radio" id="estado2" name="estado" value="2" <?php echo $chequeo12;?>><label for="estado2"></label>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesText13">
<span style="color:#808080;font-family:Arial;font-size:13px;"> Inactivo</span>
</div>
</td>
</tr>
</table>
<hr id="empresas_detallesLine33">
</div>
</div>
</div>
</div>

<div id="wb_courier_detallesLayoutGrid2">
<div id="courier_detallesLayoutGrid2">
<div class="row">
<div class="col-1">
<hr id="courier_detallesLine5">
<div id="wb_courier_detallesText2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Dirección de residencia: </strong></span>
</div>
<hr id="courier_detallesLine6">
</div>
<div class="col-2">
<hr id="courier_detallesLine7">
<input type="text" id="dccionr" name="dccionr" value="<?php echo $dccionr; ?>" maxlength="200" spellcheck="false" onkeypress="return validarcar(event)">
<hr id="courier_detallesLine8">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid8">
<div id="pacientes_detallesLayoutGrid8">
<div class="row">
<div class="col-1">
<hr id="pacientes_detallesLine34">
<div id="wb_pacientes_detallesText17">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>País de residencia: </strong></span>
</div>
<hr id="pacientes_detallesLine35">
</div>
<div class="col-2">
<hr id="pacientes_detallesLine36">
<input type="text" id="paisr" name="paisr" value="<?php echo $paisr; ?>" maxlength="100" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="pacientes_detallesLine37">
</div>
</div>
</div>
</div>

<div id="wb_empresas_detallesLayoutGrid3">
<div id="empresas_detallesLayoutGrid3">
<div class="row">
<div class="col-1">
<hr id="empresas_detallesLine9">
<div id="wb_empresas_detallesText3">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Departamento de residencia: </strong></span>
</div>
<hr id="empresas_detallesLine10">
</div>
<div class="col-2">
<hr id="empresas_detallesLine11">

<div class="selector-departamento">
            <select name="coddptor" id="coddptor"></select>
            <input type="hidden" id="coddptor1" name="coddptor1" value="<?php echo $coddptor; ?>">
            <script type="text/javascript">

				var form_data = {
						is_ajax: 1,
						departamento: window.document.formu.coddptor1.value
				};

                $(document).ready(function() {
                    $.ajax({
                            data:  form_data,
							type: "POST",
                            url: "ListaDepartamento.php",
                            success: function(response)
                            {
                                $('.selector-departamento select').html(response).fadeIn();

                            }
                    });

                });
            </script>
 </div>
<hr id="empresas_detallesLine12">
</div>
</div>
</div>
</div>

<div id="wb_empresas_detallesLayoutGrid4">
<div id="empresas_detallesLayoutGrid4">
<div class="row">
<div class="col-1">
<hr id="empresas_detallesLine13">
<div id="wb_empresas_detallesText4">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Distrito de residencia: </strong></span>
</div>
<hr id="empresas_detallesLine14">
</div>
<div class="col-2">
<hr id="empresas_detallesLine15">
<div class="sin-json">
	<select name="coddistr" id="coddistr"></select>
	<input type="hidden" id="coddistr1" name="coddistr1" value="<?php echo $coddistr; ?>">
	<script type="text/javascript">
		$(document).ready(function() {
			$(".selector-departamento select").change(function() {
				var form_data = {
						is_ajax: 1,
						departamento: $(".selector-departamento select").val(),
						distrito: ""
				};
				$.ajax({
						type: "POST",
						url: "ListaDistrito.php",
						data: form_data,
						success: function(response)
						{
							$('.sin-json select').html(response).fadeIn();
						}
				});
			});

		});
	</script>
</div>
<hr id="empresas_detallesLine16">
</div>
</div>
</div>
</div>
	
<div id="wb_empresas_detallesLayoutGrid9">
<div id="empresas_detallesLayoutGrid9">
<div class="row">
<div class="col-1">
<hr id="empresas_detallesLine32">
<div id="wb_empresas_detallesText11">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Etnia: <br></strong></span>
</div>
</div>
<div class="col-2">
<hr id="empresas_detallesLine34">
<table id="empresas_detallesTable2">
<tr>
<td class="cell0"><div id="wb_empresas_detallesRadioButton3">
<input type="radio" id="esetnia1" name="esetnia" value="1" checked onClick="activaetnia()"><label for="esetnia1"></label>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesText12">
<span style="color:#808080;font-family:Arial;font-size:13px;"> No aplica</span>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesRadioButton4">
<input type="radio" id="esetnia2" name="esetnia" value="2" onClick="activaetnia()"><label for="esetnia2"></label>
</div>
</td>
<td class="cell0"><div id="wb_empresas_detallesText13">
<span style="color:#808080;font-family:Arial;font-size:13px;"> Aplica</span>
</div>
</td>
</tr>
</table>
<hr id="empresas_detallesLine33">
</div>
	
<div class="col-2">
<hr id="empresas_detallesLine15">
<div class="sin-json">
	<input type="text" name="codetnia" id="codetnia" list="listaetnia" style="width: 80%; <?php if($codetnia == 1){ echo "background-color:rgb(204, 204, 204);"; }  ?>"  onkeypress="return validarcar(event)" onChange="ListaEtnia()" value="<?php echo $codetnianom; ?>" <?php if($codetnia == 1){ echo "disabled"; }  ?>>

	<input type="hidden" name="codetnia1" id="codetnia1" value="<?php echo $codetnia; ?>" >
</div>
<hr id="empresas_detallesLine16">
</div>
	
</div>
</div>
</div>

<div id="wb_LayoutGrid6">
<div id="LayoutGrid6">
<div class="row">
<div class="col-1">
<hr id="Line7">
<div id="wb_Text4">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nombre de Familiar Responsable: </strong></span>
</div>
<hr id="Line13">
</div>
<div class="col-2">
<hr id="Line14">
<input type="text" id="nomyapefam" name="nomyapefam" value="<?php echo $nomyapefam; ?>" maxlength="150" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="Line15">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid9">
<div id="pacientes_detallesLayoutGrid9">
<div class="row">
<div class="col-1">
<div id="wb_pacientes_detallesText18">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Teléfono: </strong></span>
</div>
<hr id="pacientes_detallesLine38">
<input type="text" id="telefonof" name="telefonof" value="<?php echo $telefonof; ?>" maxlength="30" spellcheck="false" onkeypress="return validarcar(event)">
<hr id="pacientes_detallesLine41">
</div>
<div class="col-2">
<div id="wb_pacientes_detallesText19">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Celular:</strong></span>
</div>
<hr id="pacientes_detallesLine40">
<input type="text" id="celularf" name="celularf" value="<?php echo $celularf; ?>" maxlength="50" spellcheck="false" onkeypress="return validarcar(event)">
<hr id="pacientes_detallesLine42">
</div>
<div class="col-3">
<hr id="pacientes_detallesLine39">
<hr id="pacientes_detallesLine43">
</div>
</div>
</div>
</div>

<div id="wb_empresas_detallesLayoutGrid8">
<div id="empresas_detallesLayoutGrid8">
<div class="row">
<div class="col-1">
<hr id="empresas_detallesLine28">
<div id="wb_empresas_detallesText10">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Observaciones: </strong></span>
</div>
<hr id="empresas_detallesLine29">
</div>
<div class="col-2">
<hr id="empresas_detallesLine30">
<input type="text" id="obs" name="obs" value="<?php echo $obs; ?>" maxlength="250" spellcheck="false" onkeypress="return validarcar(event)" onchange="conMayusculas(this)">
<hr id="empresas_detallesLine31">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid10">
<div id="pacientes_detallesLayoutGrid10">
<div class="row">
<div class="col-1">
<div id="wb_pacientes_detallesText20">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Fecha Ultima actualización: </strong></span>
</div>
<hr id="pacientes_detallesLine44">
<input type="date" id="fechauact" name="fechauact" value="<?php echo $fechauact; ?>" readonly spellcheck="false">
<hr id="pacientes_detallesLine47">
</div>
<div class="col-2">
<div id="wb_pacientes_detallesText21">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Usuario del Sistema: </strong></span>
</div>
<hr id="pacientes_detallesLine46">
<input type="text" id="codusup" name="codusup" value="<?php echo $codusup; ?>" spellcheck="false" onkeypress="return validarcar(event)">
<hr id="pacientes_detallesLine48">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid6">
<div id="pacientes_detallesLayoutGrid6">
<div class="row">
<div class="col-1">
<div id="wb_pacientes_detallesText12">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Paciente TB: </strong></span>
</div>
<hr id="pacientes_detallesLine13">
<input type="text" name="tb" id="tb" list="listatb" value="<?php echo $nomtb; ?>" onkeypress="return validarcar(event)" style="font-size:13px;">
<hr id="pacientes_detallesLine19">
</div>
</div>
</div>
</div>

<div id="wb_pacientes_detallesLayoutGrid11" class="">
<div id="pacientes_detallesLayoutGrid11">
<div class="row">
<div class="col-1">
<hr id="pacientes_detallesLine50">

<?php
	 if ($v_111==2 || $v_111==3)
		{
		 echo '<input type="button" id="pacientes_detallesButton1" onclick="xajax_ValidarTB(xajax.getFormValues(formu));" name="pactb" value="Conectar Paciente TB">';
		}
 ?>
<hr id="pacientes_detallesLine53">
</div>
<div class="col-2">
<hr id="pacientes_detallesLine52">

<?php
	 if ($v_112==1)
		{
		 echo '<input type="button" id="pacientes_detallesButton2" onclick="openHistoria();" name="hcli" value="Historia Clínica">';
		}
 ?>
<hr id="pacientes_detallesLine54">
</div>
<div class="col-3">
<hr id="pacientes_detallesLine51">

<?php
	 if ($v_113==1)
		{
		 echo '<input type="button" id="pacientes_detallesButton3" onclick="xajax_GenerarTurno(xajax.getFormValues(formu));" name="turnos" value="Turnos">';
		}
 ?>
</div>
</div>
</div>
</div>

<div id="wb_LayoutGrid7">
	<div id="LayoutGrid7">
		<div class="row">
			<div class="col-1">
				<hr id="Line16"/>

				<?php
	             if ($v_11==2 || $v_11==3)
	                {
				     echo '<button type="button" class="btn btn-primary btn-lg" onclick="xajax_ValidarFormulario(xajax.getFormValues(formu));">Guardar Datos</span></button>';
	                }
	             ?>
				<hr id="Line11"/>
			</div>
			<div class="col-2">
			</div>
		</div>
	</div>
</div>

</form>

<datalist id="listaestadocivil">
  <option value="1. Soltero/a">
  <option value="2. Casado/a">
  <option value="3. Viudo/a">
  <option value="4. Unido/a">
  <option value="5. Separado/a">
  <option value="6. Divorciado/a">
  <option value="7. No se sabe">
</datalist>

<datalist id="listatipodocumento">
  <option value="1. Cedula">
  <option value="2. Pasaporte">
  <option value="3. Carnet Indigena">
  <option value="4. Otros">
  <option value="5. No Tiene">
</datalist>

<datalist id="listatb">
  <option value="1. Si">
  <option value="2. No">
</datalist>
	
<datalist id="listaetnia">
  <?php
		$tabla_etnia = pg_query($consaa, "select * from etnias");
		while($depto = pg_fetch_array($tabla_etnia))
		{
		   if($depto['codetnia'] == $codetnia)
		   {
			   echo '<option data-value = "'.$depto['codetnia'].'" value = "'.$depto['codetnia']."- ".$depto['nometnia'].'" selected></option>';

		   }
		   else
		   {
			   echo '<option data-value = "'.$depto['codetnia'].'" value = "'.$depto['codetnia']."- ".$depto['nometnia'].'"></option>';
		   }
		}


	?>
</datalist>

<div id="wb_sintomas_detallesLayoutGrid1">
	<div id="sintomas_detallesLayoutGrid1">
		<div class="row">
			<div class="col-1">
				<hr id="sintomas_detallesLine1"/>
				<div id="wb_sintomas_detallesText1">
					<span style="color:#FF0000;font-family:Arial;font-size:13px;">[&nbsp;<a href="#" onclick="window.location.href='pacientes.php';"> VOLVER </a>&nbsp;]</span>

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
            <br />
			</div>

		</div>
	</div>
</div>

</body>
<?php

if ($_GET["mensage"]==2)
{
	echo "<script type=''>
     swal('Datos Procesados Exitosamente!','','success');
     </script>";
}

?>
</html>

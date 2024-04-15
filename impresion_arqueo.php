<?php
@Header("Content-type: text/html; charset=iso-8859-1");
session_start();

$nomyape1 = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
include("bitacora.php");

include("numerosALetras.class.php");

$con=Conectarse();	

$elusuario=$apellido.", ".$nombre;

$fecha       = $_GET['fecha'];
$hora        = $_GET['hora'];
$codservicio = $_GET['codservicio'];

function acentos($cadena) 
{
   $search = explode(",","Í,�,�,�,�,�,�,�,�,�,�,�,�,á,é,í,ó,ú,ñ,�á,�é,�í,�ó,�ú,�ñ,Ó,� ,É,� ,Ú,“,� ,¿,Ñ,Á,�");
   $replace = explode(",","�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,\",\",�,�,�,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);
 
   return $cadena;
}
		
$html =  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico"/>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() { 	
		$("#btnImprimir").click(function (){
				window.print();
		});	
	});		
</script>
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blicas</title>
<style>

#contenedor {
	width: 950px;
	height: 1400px;
	margin: auto;
}

#infoPer {
	width:900px;
	height:500px;
	float:left;
	border: solid 1px;
	font-family:Verdana, Geneva, sans-serif; 16px}

#fecha {
	width: 200px;
	height: 20px;
	margin: auto;
}
	
.lineas {
	width: 940px;
	height: 1150px;
	float: left;
	margin-left: 4px;
}
	


#Cab {
	width:930px;
	height:50px;
	float:left;
	border: solid 1px;}

#cab1 {
	width: 730px;
	height: 20px;
	float: left;
	margin-left: 3px;
	margin-top: 2px;
	padding-top: 0px;
	padding-left: 10px;
	text-align: center;
	padding-bottom: 4px;
	border-bottom: dashed 2px;
	border-left: dotted 1px;
	border-top: dotted 1px;
	border-right: 0px;
	font-size: 22px;
	font-weight: bold;
}

#cab2 {
	width: 200px;
	height: 20px;
	float: left;
	margin-top: 2px;
	padding-top: 4px;
	border-bottom: dashed 2px;
	border-right: dotted 1px;
	border-top: dotted 1px;
	border-left: 0px;
	font-weight: bold;
}

.nombresApell {
	width: 310px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 3px;
}

.nombresApel2 {
	width: 314px;
	height: 20px;
	float: left;
	text-align: center;
}


#sexo {
	width: 300px;
	height: 20px;
	float: left;
	border: solid 1px;
}

#nroCi {
	width: 98px;
	height: 20px;
	float: left;
	border: dotted 1px;
	font-weight: bold;
	text-align: center;
	margin-right: 2px;
}

#fechaNac {
	width: 98px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#lugNac {
	width: 228px;
	height: 20px;
	float: left;
	border: dotted 1px;
	font-weight: bold;
	text-align: center;
	margin-right: 2px;
}

#paisDoc {
	width: 98px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#anoImi {
	width: 198px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#Nacionalidad {
	width: 200px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
}

#nroCi1 {
	width: 101px;
	height: 20px;
	float: left;
	text-align: center;
}

#fechaNac1 {
	width: 103px;
	height: 20px;
	float: left;
	text-align: center;
}

#lugNac1 {
	width: 232px;
	height: 20px;
	float: left;
	text-align: center;
}

#paisDoc1 {
	width: 102px;
	height: 20px;
	float: left;
	text-align: center;
}

#anoImi1 {
	width: 202px;
	height: 20px;
	float: left;
	text-align: center;
}

#Nacionalidad1 {
	width: 202px;
	height: 20px;
	float: left;
	text-align: center;
}

#regNro {
	width: 101px;
	height: 20px;
	float: left;
	text-align: center;
	font-weight: bold;
	border: dotted 1px;
	margin-right: 2px;
}

#tomo {
	width: 98px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#folio {
	width: 198px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#libroCod {
	width: 328px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#renovacion {
	width: 200px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
}

#regNro1 {
	width: 105px;
	height: 20px;
	float: left;
	text-align: center;
}

#tomo1 {
	width: 102px;
	height: 20px;
	float: left;
	text-align: center;
}

#folio1 {
	width: 202px;
	height: 20px;
	float: left;
	text-align: center;
}

#libroCod1 {
	width: 332px;
	height: 20px;
	float: left;
	text-align: center;
}

#renovacion1 {
	width: 202px;
	height: 20px;
	float: left;
	text-align: center;
}
	
#direccpar {
	width: 308px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#tel {
	width: 102px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#cel {
	width: 98px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#ciudad {
	width: 208px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#departamento {
	width: 210px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
}

#direccpar1 {
	width: 312px;
	height: 20px;
	float: left;
	text-align: center;
}

#tel1 {
	width: 106px;
	height: 20px;
	float: left;
	text-align: center;
}

#cel1 {
	width: 102px;
	height: 20px;
	float: left;
	text-align: center;
}

#ciudad1 {
	width: 212px;
	height: 20px;
	float: left;
	text-align: center;
}

#departamento1 {
	width: 212px;
	height: 20px;
	float: left;
	text-align: center;
}

#direccLab {
	width: 308px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#telLab {
	width: 102px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#ciuLab {
	width: 302px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#dptoLab {
	width: 218px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
}

#direccLab1 {
	width: 312px;
	height: 20px;
	float: left;
	text-align: center;
}

#telLab1 {
	width: 106px;
	height: 20px;
	float: left;
	text-align: center;
}

#ciuLab1 {
	width: 306px;
	height: 20px;
	float: left;
	text-align: center;
}

#dptoLab1 {
	width: 220px;
	height: 20px;
	float: left;
	text-align: center;
}

#infoCurri {
	width: 950px;
	height: 890px;
	float: left;
}

#cabCurri {
	width: 940px;
	height: 220px;
16px
;
	margin-left: 4px;
	}

#cabcurri1 {
	width: 930px;
	height: 200px;
	float: left;
	padding-top: 12px;
	font-weight: bold;
	font-size: 16px;
	text-align: center;
}

#cabcurri2 {
	width: 350px;
	height: 30px;
	float: left;
	font-size: 22px;
	font-weight: bold;
	text-align: center;
}

#Prof {
	width: 298px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

.Insti {
	width: 298px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

.pais1 {
	width: 108px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

.Inscrp {
	width:100px;
	height:30px;
	float:left;
	border: solid 1px;}

.ano1 {
	width: 98px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
	margin-right: 2px;
}

#Prof1 {
	width: 302px;
	height: 20px;
	float: left;
	text-align: center;
}

.Insti1 {
	width: 302px;
	height: 20px;
	float: left;
	text-align: center;
}

.pais11 {
	width: 112px;
	height: 20px;
	float: left;
	text-align: center;
}

.Inscrp1 {
	width: 127px;
	height: 20px;
	float: left;
	text-align: center;
}

.ano11 {
	width: 102px;
	height: 20px;
	float: left;
	text-align: center;
}

.Inscrp {
	width: 125px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
}

#Posgr {
	width: 300px;
	height: 20px;
	float: left;
	border: dotted 1px;
	text-align: center;
	font-weight: bold;
}


#detalle {
	width: 500px;
	height: 600px;
	padding: 5px;
	float: left;
	margin-top: 20px;
}
	
.detalleimg {
	width: 500px;
	height: 290px;
	float: left;
	background: url(images.jpg) no-repeat center;
	border: solid 1px;
}
	
.detalleimg1 {
	width: 500px;
	height: 290px;
	float: left;
	background: url(Escudo_Reverso_Paraguay.jpg) no-repeat center;
	border: solid 1px;
	margin-top: 5px;
}

.detalleimg2 {
	width: 430px;
	height: 290px;
	float: left;
	margin-left: 70px;
}

.detalleimg3 {
	width: 136px;
	height: 290px;
	float: left;
	-webkit-transform: rotate(-90deg);
	-moz-transform: rotate(-90deg);
	position: absolute;
	left: 299px;
	top: 765px;
	font-weight: bold;
	filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
	
#detalle1 {
	width: 250px;
	height: 200px;
	float: left;
	}
	
#detalle12 {
	width: 250px;
	height: 100px;
	float: left;
}
	
#detalle2 {
	width:250px;
	height:250px;
	float:left;
	}
	
.lineasdeta {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 22px;
	font-weight: bold;
}

.lineasdetagene {
	width: 500px;
	height: 140px;
	float: left;
	margin-top: 40px;
}

.lineasdeta21 {
	width: 500px;
	height: 17px;
	float: left;
	text-align: center;
	font-style: oblique;
	font-size: 12px;
	padding-top: 3px;
}

.lineasdeta22 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
	font-weight: bold;
	font-size: 14px;
}

.lineasdeta23 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
	font-weight: bold;
	font-size: 14px;
}

.lineasdeta24 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 13px;
}

.lineasdeta25 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
}

.lineasdeta251 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
}

.lineasdeta26 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
}

.lineasdeta27 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
}

.lineasdeta28 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 13px;
}

.lineasdeta281 {
	width: 200px;
	height: 20px;
	float: left;
	text-align: left;
	font-size: 13px;
	margin-left: 10px;
}

.lineasdeta29 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
}

.lineasdeta30 {
	width: 500px;
	height: 20px;
	float: left;
	text-align: center;
}

.lineasdeta31 {
	width: 150px;
	height: 20px;
	float: left;
	text-align: center;
	font-weight: bold;
}
.lineasdeta32 {
	width: 200px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 13px;
}

.lineasdeta1 {
	width: 150px;
	height: 20px;
	float: left;
	text-align: center;
	border: solid 1px;
	margin-left: 2px;
}
	
.lineasdeta111 {
	width: 300px;
	height: 20px;
	float: left;
	text-align: left;
	font-size: 14px;
	font-weight: bold;
	margin-left: 20px;
}
	
	
.lineasdeta12 {
	width: 70px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 13px;
	font-weight: bold;
}

.lineasdeta121 {
	width: 70px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 13px;
}
	
.lineasdeta2 {
	width: 410px;
	height: 20px;
	float: left;
	text-align: center;
}
	
	
.lineasdeta211 {
	width: 410px;
	height: 20px;
	float: left;
	text-align: center;
	margin-top: 40px;
}

.lineasdeta3 {
	width: 200px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
}

.lineasdeta3_1 {
	width: 200px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 13px;
}

.lineasdeta3_2 {
	width: 120px;
	height: 20px;
	float: left;
	text-align: left;
	font-size: 13px;
	margin-top: 10px;
}

.lineasdeta3_3 {
	width: 276px;
	height: 20px;
	float: left;
	text-align: left;
	font-size: 14px;
	font-weight: bold;
	margin-top: 10px;
}

.lineasdeta3_4 {
	width: 195px;
	height: 20px;
	float: left;
	text-align: left;
	font-size: 13px;
	margin-top: 10px;
}

.lineasdeta3_5 {
	width: 200px;
	height: 20px;
	float: left;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
	margin-top: 10px;
}

.lineasdeta4 {
	width: 405px;
	height: 30px;
	float: left;
	padding-left: 5px;
}
	
.lineasdeta5 {
	width: 405px;
	height: 30px;
	float: left;
	margin-top: 30px;
	padding-left: 5px;
}
	

#cuadros {
	width:430px;
	height:500px;
	float:left;}

.titcuadro {
	width: 215px;
	height: 30px;
	float: left;
	font-size: 22px;
	text-align: center;
	font-weight: bold;
}

.titcuadro1 {
	width: 210px;
	height: 30px;
	float: left;
	text-align: center;
	font-size: 22px;
	font-weight: bold;
}

.titcuadro2 {
	width: 215px;
	height: 30px;
	float: left;
	font-weight: bold;
	text-align: center;
	font-size: 22px;
}

.titcuadro3 {
	width: 210px;
	height: 30px;
	float: left;
	text-align: center;
	font-size: 22px;
	font-weight: bold;
}

.cuadro {
	width: 210px;
	height: 198px;
	float: left;
	border: solid 1px;
	margin-top: 10px;
	margin-left: 3px;
}

#obsdeta {
	width: 940px;
	height: 110px;
	float: left;
	padding: 5px;
}

#cuadrodeta {
	width:400px;
	height:100px;
	float:left;}

#cuadrodeta1 {
	width: 440px;
	height: 100px;
	float: left;
	border: solid 1px;
	margin-left: 98px;
}	

.cuadrodeta2 {
	width: 400px;
	height: 20px;
	float: left;
	font-weight: bold;
	font-size: 14px;
	margin-left: 20px;
	margin-top: 5px;
}
	
.cuadrodeta3 {
	width:70px;
	height:20px;
	float:left;}
	
.cuadrodeta4 {
	width: 200px;
	height: 20px;
	float: left;
}

.cuadrodeta5 {
	width: 400px;
	height: 20px;
	float: left;
	font-size: 14px;
	margin-left: 20px;
}

.cuadrodeta6 {
	width: 400px;
	height: 20px;
	float: left;
	font-size: 14px;
	margin-left: 20px;
}

.cuadrodeta7 {
	width: 90px;
	height: 20px;
	float: left;
}
	
.cuadrodeta8 {
	width: 40px;
	height: 20px;
	float: left;
	font-weight: bold;
}
	
.cuadrodeta9 {
	width: 60px;
	height: 20px;
	float: left;
	text-align: center;
}
	
#usuario {
	width:400px;
	height:48px;
	float:left;}
	
#usuario1 {
	width: 200px;
	height: 48px;
	float: left;
	font-size: 22px;
	font-weight: bold;
}

#usuario2 {
	width: 200px;
	height: 48px;
	float: left;
	font-size: 20px;
}
	
#obs {
	width:400px;
	height:48px;
	float:left;}

#obs1 {
	width: 200px;
	height: 48px;
	float: left;
	font-weight: bold;
	font-size: 22px;
}

#obs2 {
	width: 200px;
	height: 48px;
	float: left;
	font-size: 20px;
}
	
#wb_Text8 {   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}

.boton_personalizado{
    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }
  .boton_personalizado:hover{
    color: #1883ba;
    background-color: #ffffff;
  }</style>

</head>

<body>';

$sql 	= "select *
		  from arqueo
		  where fecha    = '$fecha' 
		  and   hora     = '$hora'";
			  
$tab	=  pg_query($con, $sql);
$row 	=  pg_fetch_array($tab);

if($row['fecha'] != "")
{
	$fecha1=$row[fecha];
	$fecha1= "  ".$fecha1;
	$fecha1= strtotime($fecha1);	
	$dia2=date("j", $fecha1);
	$mes2=date("n", $fecha1);
	$anho2=date("Y",$fecha1);
}
else
{
	$dia2="";
	$mes2="";
	$anho2="";
}

$codservicio= $row["codservicio"];
$codcaja   = $row["codcaja"];
$montocalc = $row['monto'];
$b1        = $row['b1'];
$b5        = $row['b5'];
$b10	   = $row['b10'];
$b50       = $row['b50'];
$b100      = $row['b100'];
$b500      = $row['b500'];
$b1000     = $row['b1000'];
$b2000     = $row['b2000'];
$b5000     = $row['b5000'];
$b10000    = $row['b10000'];
$b20000    = $row['b20000'];
$b50000    = $row['b50000'];
$b100000   = $row['b100000'];
$codreg    = $row['codreg'];
$subcreg   = $row['subcreg'];
$region    = $row['codreg'].$row['subcreg'];
$coddist   = $row['coddist'];
$codserv   = $row['codserv'];
$cheques   = $row['cheques'];
$totcheques= $row['totcheques'];
$obs 	   = $row['obs'];
$cantbille = $row['monto'];
$idapertura = $row['idapertura'];

$monto1    = $b100000*100000;
$monto2    = $b50000*50000;
$monto3    = $b20000*20000;
$monto4    = $b10000*10000;
$monto5    = $b5000*5000;
$monto6    = $b2000*2000;
$monto7    = $b1000*1000;
$monto8    = $b500*500;
$monto9    = $b100*100;
$monto10   = $b50*50;
$monto11   = $b10*10;
$monto12   = $b5*5;
$monto13   = $b1*1;

$letra = numtoletras($montocalc);

$sql1 	= "select r.nroreciboser ,
       			  min(r.nrorecibo) as desde,
       			  max(r.nrorecibo) as hasta,
				  sum(r.monto*r.cantidad) as monto
		  from ingresocaja i, recibos r
		  where i.nroingreso  = r.nroingreso
		  and   i.fecha       = '$fecha' 
		  and   i.codservicio = '$codservicio'
		  and   i.idapertura  = '$idapertura'
		  and   i.estado      != 2
		  group by r.nroreciboser";
			  
$tab1	  =  pg_query($con, $sql1);
$numrecibo= pg_num_rows($tab1);
$row1 	=  pg_fetch_array($tab1);
$cantrecibo = 10-$numrecibo;

$nroreciboser = $row1['nroreciboser']; 
$desde      = $row1['desde']; 
$hasta      = $row1['hasta']; 
$montonanu  = $row1['monto']; 

$sql2 	= "select r.nroreciboser ,
       			  min(r.nrorecibo) as desde,
       			  max(r.nrorecibo) as hasta,
				  sum(r.monto*r.cantidad) as monto
		  from ingresocaja i, recibos r
		  where i.nroingreso  = r.nroingreso
		  and   i.fecha       = '$fecha' 
		  and   i.codservicio = '$codservicio' 
		  and   i.estado      = 2
		  and   i.idapertura  = '$idapertura'
		  group by r.nroreciboser";
			  
$tab2	    =  pg_query($con, $sql2);
$row2 	    =  pg_fetch_array($tab2);

$desde1     = $row2['desde']; 
$hasta1     = $row2['hasta']; 
$montoanu   = $row2['monto']; 

if($desde1 == $hasta1 )
{
	$anulados = $desde1;	
}
else
{
	$anulados = $desde1." - ".$hasta1;	
}

$monto = $montonanu;

$tabe  = pg_query($con, "SELECT sum(r.monto*r.cantidad) as monto
								FROM ingresocaja i, recibos r
								WHERE i.nroingreso   = r.nroingreso
								AND   i.nrorecibo    = r.nrorecibo
								AND   i.nroreciboser = r.nroreciboser
								AND   i.estado != 2
								AND   i.fecha   = '$fecha'
								and   i.idapertura  = '$idapertura'
								AND   i.formapago = 1");
$rowe   = pg_fetch_array($tabe);
$montoe = $rowe['monto'];
	
$tabc  = pg_query($con, "SELECT sum(r.monto*r.cantidad) as monto
								FROM ingresocaja i, recibos r
								WHERE i.nroingreso   = r.nroingreso
								AND   i.nrorecibo    = r.nrorecibo
								AND   i.nroreciboser = r.nroreciboser
								AND   i.fecha   = '$fecha'
								and   i.idapertura  = '$idapertura'
								AND   i.estado != 2
								AND   i.formapago = 2");
$rowc      = pg_fetch_array($tabc);
$montoc    = $rowc['monto'];

$tabh  = pg_query($con, "SELECT sum(r.monto*r.cantidad) as monto
								FROM ingresocaja i, recibos r
								WHERE i.nroingreso   = r.nroingreso
								AND   i.nrorecibo    = r.nrorecibo
								AND   i.nroreciboser = r.nroreciboser
								AND   i.fecha   = '$fecha'
								and   i.idapertura  = '$idapertura'
								AND   i.estado != 2
								AND   i.formapago = 6");
$rowh      = pg_fetch_array($tabh);
$montoh    = $rowh['monto'];
 
$html .= '<button id="btnImprimir" class="boton_personalizado" aria-label="Left Align"> Imprimir</button>
<div id="contenedor">
<div id="cabCurri">
      <div id="cabcurri1"><img src="images/images1.jpg" width="100" height="100"/>
      <br />
      <div style="font-size: 24px; padding-bottom: 5px; margin-top: 5px;">Ministerio de Salud P&uacute;blica y Bienestar Social</div>
      <div style="font-size: 18px; padding-bottom: 5px; margin-top: 5px;">Laboratorion Central</div>
      </div>
</div>
  <div class="lineas">
        <div style="height: 150px;">
        	<div style="font-size: 22px; text-decoration: underline; font-weight: bold; text-align: center; margin-top: 20px;">ARQUEO DE CAJA</div>
            <div style="font-size: 16px; font-weight: bold; margin-top: 5px; height: 20px;">
            	<div style="width: 640px; float: left">Nombre del Usuario: '.htmlentities($nomyape1).'</div>
            	<div style="width: 150px; float: left">Hora: '.$hora.'</div>
                <div style="width: 140px; float: left">Fecha: '.$dia2.'/'.$mes2.'/'.$anho2.'</div>
            </div>
       	  <div style="font-size: 16px; margin-top: 5px; height: 20px;">
            	<div style="width: 175px; float: left; text-decoration: underline;">RECIBOS UTILIZADOS:</div>
           	<div style="width: 200px; float: left">Fondo Sujeto al Arqueo.</div>
       	  </div>
    </div>
    <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">Importe Gs.</div>
    <div style="height: 25px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">Anulado</div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">Hasta</div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">Desde</div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px;">Serie</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">'.number_format($monto,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">'.number_format($anulados,0,',','.').'</div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$hasta.'</div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$desde.'</div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px;">'.$nroreciboser.'</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px;"></div>
  </div>

  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px;"></div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px;"></div>
  </div>
  <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid;"></div>
    <div style="height: 25px; width: 150px; float: right; font-weight: bold; text-align: center; padding-top: 5px;"></div>
  </div>
  <div style="height: 26px; width: 810px; margin-left: 60px; border-right: 1px solid; padding-left: 1px;">
      <div style="height: 20px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid; border-bottom: 1px solid;">'.number_format($monto,0,',','.').'</div>
    <div style="height: 20px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid; border-bottom: 1px solid;">Total</div>
  </div>
  <div style="height: 30px; width: 810px; margin-left: 60px; padding-left: 1px;">
      <div style="height: 20px; width: 130px; float: left; padding-top: 5px; font-size: 18px;">Total guaran&iacute;es:</div>
    <div style="height: 20px; width: 500px; float: left; padding-top: 5px; font-size: 18px;">'.strtoupper($letra).'</div>
  </div>
  <div style="height: 30px; width: 810px; margin-left: 60px; margin-top: 20px; text-align: center; font-size: 20px; text-decoration: underline;">EXISTENCIA DE DINERO EN EFECTIVO Y CHEQUE /S EN CAJA:
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; font-weight: bold; text-align: center; padding-top: 5px; padding-right:5px;  border-left: 1px solid; font-size: 20px;">Monto</div>
    <div style="height: 25px; width: 155px; float: right; font-weight: bold; text-align: center; padding-top: 5px; border-left: 1px solid; font-size: 20px;">Cantidad</div>
    <div style="height: 25px; width: 400px; float: left; font-weight: bold; text-align: center; padding-top: 5px; font-size: 20px;">Billetes de Gs:</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto1,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b100000.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">100.000</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto2,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b50000.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">50.000</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto3,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b20000.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">20.000</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto4,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b10000.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">10.000</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto5,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b5000.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">5.000</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto6,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b2000.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">2.000</div>
  </div>
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto7,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b1000.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">1.000</div>
  </div>
  
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto8,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b500.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">500</div>
  </div>
  
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto9,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b100.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">100</div>
  </div>
  
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto10,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b50.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">50</div>
  </div>
  
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto11,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b10.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">10</div>
  </div>
  
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto12,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b5.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">5</div>
  </div>
  
  <div style="height: 30px; border-bottom: 1px dotted; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($monto13,0,',','.').'</div>
    <div style="height: 25px; width: 155px; float: right; text-align: center; padding-top: 5px; border-left: 1px solid;">'.$b1.'</div>
    <div style="height: 25px; width: 400px; float: left; text-align: center; padding-top: 5px;">1</div>
  </div>
  
  <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px;  border-left: 1px solid; border-top: 1px double;">'.number_format($montoe,0,',','.').'</div>
      <div style="height: 25px; width: 400px; float: left; text-decoration: underline; font-weight: bold; font-size: 18px;">Total efectivo Gs.</div>
  </div>
  <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px; border-left: 1px solid;">'.number_format($montoc,0,',','.').'</div>
      <div style="height: 25px; width: 400px; float: left; text-decoration: underline; font-size: 18px;">Monto Cheque</div>
  </div>
  <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px;  border-left: 1px solid;">'.number_format($montoh,0,',','.').'</div>
      <div style="height: 25px; width: 400px; float: left; text-decoration: underline; font-size: 18px;">Monto Homebanking</div>
  </div>
  <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 24px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px;  border-left: 1px solid; border-top: 1px double; border-bottom: 1px double; font-weight: bold; font-size: 22px;">'.number_format($monto,0,',','.').'</div>
      <div style="height: 25px; width: 400px; float: left; font-weight: bold; font-size: 22px; text-align: center;">Fondo arqueado: Total Gs.</div>
  </div>
  <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px;  border-left: 1px solid;">'.number_format($monto,0,',','.').'</div>
      <div style="height: 25px; width: 400px; float: left; padding-top: 5px; text-decoration: underline; font-size: 18px;">Importe de Recibos: Gs.</div>
  </div>
  <div style="height: 30px; border-bottom: 1px solid; width: 810px; margin-left: 60px; border-left: 1px solid; border-right: 1px solid;">
      <div style="height: 25px; width: 200px; float: right; text-align: right; padding-top: 5px; padding-right:5px;  border-left: 1px solid;">0</div>
      <div style="height: 25px; width: 400px; float: left; padding-top: 5px; text-decoration: underline; font-size: 18px;">Sobrante / Faltante: Gs.</div>
  </div>
  <div style="height: 80px; width: 810px; margin-left: 60px; margin-top: 30px; border: 1px solid;">
      <div style="height: 25px; width: 60px; float: left; padding-top: 5px; text-decoration: underline; font-size: 18px;">Obs.:</div>
      <div style="height: 60px; width: 700px; float: left; padding-top: 5px;">&nbsp;</div>
  </div>
  <div style="height: 30px; width: 810px; margin-left: 60px; margin-top: 30px;">
      <div style="height: 25px; width: 200px; float: right; text-align: left; padding-top: 5px; font-size: 20px;">Firma:</div>
      <div style="height: 25px; width: 400px; float: left; padding-top: 5px; font-size: 20px;">Realizado por:</div>
  </div>
  <div style="height: 30px; width: 810px; margin-left: 60px; margin-top: 30px;">
      <div style="height: 25px; width: 200px; float: right; text-align: left; padding-top: 5px; font-size: 20px;">Firma:</div>
      <div style="height: 25px; width: 400px; float: left; padding-top: 5px; font-size: 20px;">Corroborado por:</div>
  </div>
  </div>
</div>';


$html.=  '</body></html>';

echo $html;     	

	// Bitacora

	$codopc = "V_154";
	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Impresion de Arqueo: Fecha: " . $fecha;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );

?>
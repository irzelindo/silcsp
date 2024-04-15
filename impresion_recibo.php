<?php
@Header("Content-type: text/html; charset=iso-8859-1");
session_start();

$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

include("conexion.php");
include("bitacora.php");

include("numerosALetras.class.php");

$con=Conectarse();	

$nroingreso = $_GET['nroingreso'];

$hora = date("H:i");

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
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<style>

#contenedor {
	width: 950px;
	height: 350px;
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
	height: 1500px;
	float: left;
	margin-left: 4px;
	border: 1px solid;
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
	height: 196px;
16px
;
	margin-left: 4px;
	}

#cabcurri1 {
	width: 380px;
	height: 180px;
	float: left;
	padding-top: 12px;
	font-weight: bold;
	font-size: 16px;
	margin-left: 5px;
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
</style>

</head>

<body>';

$sql 	= "select *
		  from ingresocaja
		  where nroingreso = '$nroingreso'";
			  
$tab	=  pg_query($con, $sql);
$row 	=  pg_fetch_array($tab);

$sql1 	= "select norden, 
				  codarancel, 
				  monto,
				  sum(monto) as total
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel, monto
		  order by norden";
			  
$tab1	  =  pg_query($con, $sql1);

$sql6 	= "select norden, 
				  codarancel, 
				  monto,
				  sum(monto) as total
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel, monto
		  order by norden";
			  
$tab6	  =  pg_query($con, $sql6);

$sql10 	= "select norden, 
				  codarancel, 
				  monto,
				  sum(monto) as total
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel, monto
		  order by norden";
			  
$tab10	  =  pg_query($con, $sql10);

$sql4 	= "select norden, 
				  codarancel, 
				  sum(monto) as monto
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel
		  order by norden";
			  
$tab4	  =  pg_query($con, $sql4);

$sql8 	= "select norden, 
				  codarancel, 
				  sum(monto) as monto
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel
		  order by norden";
			  
$tab8	  =  pg_query($con, $sql8);

$sql12 	= "select norden, 
				  codarancel, 
				  sum(monto) as monto
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel
		  order by norden";
			  
$tab12	  =  pg_query($con, $sql12);

$sql5 	= "select norden, 
				  codarancel, 
				  sum(monto) as monto
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel
		  order by norden";
			  
$tab5	  =  pg_query($con, $sql5);

$sql9 	= "select norden, 
				  codarancel, 
				  sum(monto) as monto
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel
		  order by norden";
			  
$tab9	  =  pg_query($con, $sql9);

$sql13 	= "select norden, 
				  codarancel, 
				  sum(monto) as monto
		  from recibos
		  where nroingreso = '$nroingreso' 
		  group by norden, codarancel
		  order by norden";
			  
$tab13	  =  pg_query($con, $sql13);

$sql2 	= "select sum(monto) as total
		  from recibos
		  where nroingreso = '$nroingreso'";
			  
$tab2	=  pg_query($con, $sql2);
$row1 	=  pg_fetch_array($tab2);

$total = $row1['total'];

$recibide  = $row['recibide']; 
$fpago     = $row['formapago'];
$fpagootr  = $row['otrafp'];
$estado    = $row['estado'];
$nrecibonew= $row['nrorecibo1'];
$nserienew = $row['nroserie1'];
$nreciboold= $row['nrorecibo2'];
$nserieold = $row['nroserie2'];
$nserieold = $row['nroserie2'];
$codcaja     = $row["codcaja"];
$codservicio = $row["codservicio"];
$fecha 		 = $row["fecha"];
$hora 		 = $row["hora"];
$nropaciente = $row["nropaciente"];
$nomyape 	 = $row["nomyape"];
$nrecibo 	 = $row["nrorecibo"];
$nserie      = $row["nroreciboser"];


$letra = numtoletras($total);



$html .= '<div id="contenedor">
<div style="width: 570px; height: 325px; float: left;">
	<div style="width: 100px; height: 85px; float: left;"><img src="images/images1.jpg" width="98" height="82" /></div>
	<div style="width: 455px; float: left; font-weight: bold; text-align: center;">MINISTERIO DE SALUD P&Uacute;BLICA DE BIENESTAR SOCIAL</div>
    <div style="width: 460px; float: left; font-weight: bold; font-size: 12px; text-align: center;">LABORATORIO CENTRAL</div>
    <div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center;">Avda Venezuela y Tte. Escurra</div>
    <div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center; height: 30px;">Tel/Fax: 021 292653 - Asunci&oacute;n - Paraguay</div>
	<div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center; height: 30px;"></div>
    <div style="width: 85px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px;">Instituci&oacute;n:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px;">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</div>
    <div style="width: 100px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Dependencia:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">LABORATORIO CENTRAL</div>
    <div style="width: 80px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Recib&iacute; de:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">'.$recibide.'</div>
    <div style="width: 80px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Domicilio:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;"> </div>
    <div style="width: 120px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Son Guaran&iacute;es:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">'.strtoupper($letra).'</div>
    <div style="width: 570px; float: left; font-weight: bold; font-size: 14px; height: 20px; margin-top: 10px; text-align: center;">______________________</div>
</div>
<div style="width: 375px; height: 80px; float: left;">
  <div style="width: 200px; float: left; font-weight: bold; height: 60px;">
  	<div style="text-align: center; font-size: 18px;">RECIBO DE INGRESOS</div>
    <div style="font-size: 12px; text-align: center;">Decreto Ley Nro. 21376/98</div>
    <div style="font-size: 12px; text-align: center;">RUC: 80000905-3</div>
  </div>
  <div style="width: 170px; float: left; font-weight: bold; height: 60px;">
    <div style="font-size: 12px; text-align: center; width: 80px; float: left; margin-top: 35px;">Serie: '.$nserie.'</div>
    <div style="font-size: 20px; text-align: right; width: 85px; float: left; margin-top: 30px;">'.$nrecibo.'</div>
  </div>
</div>


<div style="width: 375px; height: 233px; float: left; border: 1px solid; behavior: url(border-radius.htc); -moz-border-radius: 15px; -webkit-border-radius: 15px; border-radius: 15px;">
	<div style="width: 192px; float: left; text-align: center; font-weight: bold; height: 212px; border-right: 1px solid;">
    	<div style="width: 192px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">Servicios</div>';
    	while ($row2 = pg_fetch_array($tab1))
		{
			$codarancel = $row2['codarancel'];
			
			$sql3 	= "select *
			  from aranceles
			  where codarancel = '$codarancel'";
				  
			$tab3	=  pg_query($con, $sql3);
			$row3 	=  pg_fetch_array($tab3);
			
			$nomarancel = $row3['nomarancel'];
			$monto      = $row2['monto'];
	
			$html .= '<div style="width: 187px; float: left; text-align: left; font-weight: bold; padding-left:5px; font-size:8px;">'.$nomarancel.'</div>';
		}
    $html .='</div>
    <div style="width: 182px; float: left; text-align: center; font-weight: bold; height:212px;">
        <div style="width: 80px; float: left; text-align: center; font-weight: bold; height: 212px; border-right: 1px solid;">
        	<div style="width: 80px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">C&oacute;digo</div>';
        
			while ($row4 = pg_fetch_array($tab4))
			{
				$html .= '<div style="width: 80px; float: left; text-align: center; font-weight: bold; font-size:11px;">'.$row4['codarancel'].'</div>';
			}

    $html .='</div>
    	<div style="width: 100px; float: left; text-align: center; font-weight: bold; height: 212px;">
       	  <div style="width: 100px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">Monto</div>';
		  
            while ($row5 = pg_fetch_array($tab5))
			{
				$html .= '<div style="width: 100px; float: left; text-align: center; font-weight: bold; font-size:11px;">'.number_format($row5['monto'],0, ",", ".").'</div>';
			}
			
    $html .= '</div>
    </div>
    <div  style="width: 375px; float: left;">
      <div style="width: 192px; float: left; text-align: center; font-weight: bold;">'.date("d/m/Y")." ".$hora.'</div>
    <div style="width: 75px; float: left; font-weight: bold; border-top: 1px solid; border-left: 1px solid; padding-left: 5px;">Total&nbsp;</div>
    <div style="width: 102px; float: left; text-align: center; font-weight: bold; border-top: 1px solid;">'.number_format($total,0, ",", ".").'</div>
  </div>
</div>
</div>';

$html .= '<br><br>
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
<br><br><div id="contenedor">
<div style="width: 570px; height: 325px; float: left;">
	<div style="width: 100px; height: 85px; float: left;"><img src="images/images1.jpg" width="98" height="82" /></div>
	<div style="width: 455px; float: left; font-weight: bold; text-align: center;">MINISTERIO DE SALUD P&Uacute;BLICA DE BIENESTAR SOCIAL</div>
    <div style="width: 460px; float: left; font-weight: bold; font-size: 12px; text-align: center;">LABORATORIO CENTRAL</div>
    <div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center;">Avda Venezuela y Tte. Escurra</div>
    <div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center; height: 30px;">Tel/Fax: 021 292653 - Asunci&oacute;n - Paraguay</div>
	<div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center; height: 30px;"></div>
    <div style="width: 85px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px;">Instituci&oacute;n:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px;">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</div>
    <div style="width: 100px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Dependencia:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">LABORATORIO CENTRAL</div>
    <div style="width: 80px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Recib&iacute; de:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">'.$recibide.'</div>
    <div style="width: 80px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Domicilio:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;"></div>
    <div style="width: 120px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Son Guaran&iacute;es:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">'.strtoupper($letra).'</div>
    <div style="width: 570px; float: left; font-weight: bold; font-size: 14px; height: 20px; margin-top: 10px; text-align: center;">______________________</div>
</div>
<div style="width: 375px; height: 80px; float: left;">
  <div style="width: 200px; float: left; font-weight: bold; height: 60px;">
  	<div style="text-align: center; font-size: 18px;">RECIBO DE INGRESOS</div>
    <div style="font-size: 12px; text-align: center;">Decreto Ley Nro. 21376/98</div>
    <div style="font-size: 12px; text-align: center;">RUC: 80000905-3</div>
  </div>
  <div style="width: 170px; float: left; font-weight: bold; height: 60px;">
    <div style="font-size: 12px; text-align: center; width: 80px; float: left; margin-top: 35px;">Serie: '.$nserie.'</div>
    <div style="font-size: 20px; text-align: right; width: 85px; float: left; margin-top: 30px;">'.$nrecibo.'</div>
  </div>
</div>


<div style="width: 375px; height: 233px; float: left; border: 1px solid; behavior: url(border-radius.htc); -moz-border-radius: 15px; -webkit-border-radius: 15px; border-radius: 15px;">
	<div style="width: 192px; float: left; text-align: center; font-weight: bold; height: 212px; border-right: 1px solid;">
    	<div style="width: 192px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">Servicios</div>';
    	while ($row6 = pg_fetch_array($tab6))
		{
			$codarancel = $row6['codarancel'];
			
			$sql7 	= "select *
			  from aranceles
			  where codarancel = '$codarancel'";
				  
			$tab7	=  pg_query($con, $sql7);
			$row7	=  pg_fetch_array($tab7);
			
			$nomarancel = $row7['nomarancel'];
			$monto      = $row6['monto'];
	
			$html .= '<div style="width: 187px; float: left; text-align: left; font-weight: bold; padding-left:5px; font-size:8px;">'.$nomarancel.'</div>';
		}
    $html .='</div>
    <div style="width: 182px; float: left; text-align: center; font-weight: bold; height:212px;">
        <div style="width: 80px; float: left; text-align: center; font-weight: bold; height: 212px; border-right: 1px solid;">
        	<div style="width: 80px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">C&oacute;digo</div>';
        
			while ($row8 = pg_fetch_array($tab8))
			{
				$html .= '<div style="width: 80px; float: left; text-align: center; font-weight: bold; font-size:11px;">'.$row8['codarancel'].'</div>';
			}

    $html .='</div>
    	<div style="width: 100px; float: left; text-align: center; font-weight: bold; height: 212px;">
       	  <div style="width: 100px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">Monto</div>';
		  
            while ($row9 = pg_fetch_array($tab9))
			{
				$html .= '<div style="width: 100px; float: left; text-align: center; font-weight: bold; font-size:11px;">'.number_format($row9['monto'],0, ",", ".").'</div>';
			}
			
    $html .= '</div>
    </div>
    <div  style="width: 375px; float: left;">
      <div style="width: 192px; float: left; text-align: center; font-weight: bold;">'.date("d/m/Y")." ".$hora.'</div>
    <div style="width: 75px; float: left; font-weight: bold; border-top: 1px solid; border-left: 1px solid; padding-left: 5px;">Total&nbsp;</div>
    <div style="width: 102px; float: left; text-align: center; font-weight: bold; border-top: 1px solid;">'.number_format($total,0, ",", ".").'</div>
  </div>
</div>
</div>';

$html .= '<br><br>
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
<br><br><div id="contenedor">
<div style="width: 570px; height: 325px; float: left;">
	<div style="width: 100px; height: 85px; float: left;"><img src="images/images1.jpg" width="98" height="82" /></div>
	<div style="width: 455px; float: left; font-weight: bold; text-align: center;">MINISTERIO DE SALUD P&Uacute;BLICA DE BIENESTAR SOCIAL</div>
    <div style="width: 460px; float: left; font-weight: bold; font-size: 12px; text-align: center;">LABORATORIO CENTRAL</div>
    <div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center;">Avda Venezuela y Tte. Escurra</div>
    <div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center; height: 30px;">Tel/Fax: 021 292653 - Asunci&oacute;n - Paraguay</div>
	<div style="width: 455px; float: left; font-weight: bold; font-size: 12px; text-align: center; height: 30px;"></div>
    <div style="width: 85px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px;">Instituci&oacute;n:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px;">MINISTERIO DE SALUD P&Uacute;BLICA Y BIENESTAR SOCIAL</div>
	<div style="width: 85px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px;">Dependencia:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">LABORATORIO CENTRAL</div>
    <div style="width: 80px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Recib&iacute; de:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">'.$recibide.'</div>
    <div style="width: 80px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Domicilio:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;"></div>
    <div style="width: 120px; float: left; font-weight: bold; font-size: 16px; height: 20px; padding-left: 10px; margin-top: 20px;">Son Guaran&iacute;es:</div>
    <div style="width: 400px; float: left; font-weight: bold; font-size: 12px; height: 20px; margin-top: 20px;">'.strtoupper($letra).'</div>
    <div style="width: 570px; float: left; font-weight: bold; font-size: 14px; height: 20px; margin-top: 10px; text-align: center;">______________________</div>
</div>
<div style="width: 375px; height: 80px; float: left;">
  <div style="width: 200px; float: left; font-weight: bold; height: 60px;">
  	<div style="text-align: center; font-size: 18px;">RECIBO DE INGRESOS</div>
    <div style="font-size: 12px; text-align: center;">Decreto Ley Nro. 21376/98</div>
    <div style="font-size: 12px; text-align: center;">RUC: 80000905-3</div>
  </div>
  <div style="width: 170px; float: left; font-weight: bold; height: 60px;">
    <div style="font-size: 12px; text-align: center; width: 80px; float: left; margin-top: 35px;">Serie: '.$nserie.'</div>
    <div style="font-size: 20px; text-align: right; width: 85px; float: left; margin-top: 30px;">'.$nrecibo.'</div>
  </div>
</div>


<div style="width: 375px; height: 233px; float: left; border: 1px solid; behavior: url(border-radius.htc); -moz-border-radius: 15px; -webkit-border-radius: 15px; border-radius: 15px;">
	<div style="width: 192px; float: left; text-align: center; font-weight: bold; height: 212px; border-right: 1px solid;">
    	<div style="width: 192px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">Servicios</div>';
    	while ($row10 = pg_fetch_array($tab10))
		{
			$codarancel = $row10['codarancel'];
			
			$sql11 	= "select *
			  from aranceles
			  where codarancel = '$codarancel'";
				  
			$tab11	=  pg_query($con, $sql11);
			$row11	=  pg_fetch_array($tab11);
			
			$nomarancel = $row11['nomarancel'];
			$monto      = $row10['monto'];
	
			$html .= '<div style="width: 187px; float: left; text-align: left; font-weight: bold; padding-left:5px; font-size:8px;">'.$nomarancel.'</div>';
		}
    $html .='</div>
    <div style="width: 182px; float: left; text-align: center; font-weight: bold; height:212px;">
        <div style="width: 80px; float: left; text-align: center; font-weight: bold; height: 212px; border-right: 1px solid;">
        	<div style="width: 80px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">C&oacute;digo</div>';
        
			while ($row12 = pg_fetch_array($tab12))
			{
				$html .= '<div style="width: 80px; float: left; text-align: center; font-weight: bold; font-size:11px;">'.$row12['codarancel'].'</div>';
			}

    $html .='</div>
    	<div style="width: 100px; float: left; text-align: center; font-weight: bold; height: 212px;">
       	  <div style="width: 100px; float: left; border-bottom: 1px solid; text-align: center; font-weight: bold;">Monto</div>';
		  
            while ($row13 = pg_fetch_array($tab13))
			{
				$html .= '<div style="width: 100px; float: left; text-align: center; font-weight: bold; font-size:11px;">'.number_format($row13['monto'],0, ",", ".").'</div>';
			}
			
    $html .= '</div>
    </div>
    <div  style="width: 375px; float: left;">
      <div style="width: 192px; float: left; text-align: center; font-weight: bold;">'.date("d/m/Y")." ".$hora.'</div>
    <div style="width: 75px; float: left; font-weight: bold; border-top: 1px solid; border-left: 1px solid; padding-left: 5px;">Total&nbsp;</div>
    <div style="width: 102px; float: left; text-align: center; font-weight: bold; border-top: 1px solid;">'.number_format($total,0, ",", ".").'</div>
  </div>
</div>
</div>';

$html.=  '</body></html>';

echo $html;     	

	// Bitacora
	$codopc = "V_151";
	$fecha1 = date( "Y-n-j", time() );
	$hora = date( "G:i:s", time() );
	$accion = "Imprecion de Recibo: Nro. Ingreso: " . $nroingreso;
	$terminal = $_SERVER[ 'REMOTE_ADDR' ];
	$a = archdlog( $_SESSION[ 'codusu' ], $codopc, $fecha1, $hora, $accion, $terminal );

?>
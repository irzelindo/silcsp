<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

include("conexion.php"); 
$link=Conectarse();

include("conexionsaa.php");
$consaa=Conectarsesaa();

$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

$elusuario=$nomyape;


if ($_GET["mensage2"]==2 || $_GET["mensage2"]==1)
  {
  $codempresa     = $_SESSION['codempresa'];
  $razonsocial     = $_SESSION['razonsocial'];    
  $coddpto      = $_SESSION['coddpto'];
  $coddist = $_SESSION['coddist'];

  $laboratorio = $_SESSION['laboratorio'];
  $ruc = $_SESSION['ruc'];
  $responsable = $_SESSION['responsable'];
  $cargoresp = $_SESSION['cargoresp'];
  $dccion = $_SESSION['dccion'];
  $barrio = $_SESSION['barrio'];
  $zona = $_SESSION['zona'];
  $telefono = $_SESSION['telefono'];
  $celular = $_SESSION['celular'];
  $email = $_SESSION['email'];
  $obs = $_SESSION['obs'];
  $estado = $_SESSION['estado'];
  }
else
  {
  $unro = pg_query( $link, "select max(codempresa) as ultimo from empresas" );

  while ( $rowcod = pg_fetch_array( $unro ) ) 
  {
	 $codempresa = $rowcod[ 'ultimo' ] + 1;
  }
	
  $razonsocial     = "";  
  $coddpto      = "";
  $coddist      = ""; 

  $laboratorio = 2;
  $ruc = "";
  $responsable = "";
  $cargoresp = "";
  $dccion = "";
  $barrio = "";
  $zona = 0;
  $telefono = "";
  $celular = "";
  $email = "";
  $obs = "";
  $estado = 1;
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
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/>
<link rel="shortcut icon" href="favicon.ico"/> 
<meta http-equiv="Content-Language" content="es-py"/>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1; Content-Encoding: gzip; Vary: Accept-Encoding;" />
<meta name="description" content="Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica"/>
<meta name="keywords" content="Estudios clinicos, bacteriologia, analisis, bioquimica, Paraguay, salud, muestras clinicas"/>
<meta name="author" content="Victor Diaz Ovando"/>
<meta name="Distribution" content="Global" />
<meta name="Robots" content="index,follow" />

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
#Line9
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line14, #Line14b
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line7, #Line7b
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line2
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
#wb_LayoutGrid4
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
#LayoutGrid4
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
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
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   float: left;
}
#LayoutGrid4 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 50%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 50%;
   text-align: left;
}
#LayoutGrid4:before,
#LayoutGrid4:after,
#LayoutGrid4 .row:before,
#LayoutGrid4 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid4:after,
#LayoutGrid4 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_Text2 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#codempresa
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
#codempresa:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_LayoutGrid6,#wb_LayoutGrid6b
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
#LayoutGrid6,#LayoutGrid6b
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid6 .row, #LayoutGrid6b .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
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
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   float: left;
}
#LayoutGrid6 .col-1, #LayoutGrid6b .col-1
{
   background-color: transparent;
   background-image: none;
   width: 50%;
   text-align: left;
}
#LayoutGrid6 .col-2, #LayoutGrid6b .col-2
{
   background-color: transparent;
   background-image: none;
   width: 50%;
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

#LayoutGrid6b:before,
#LayoutGrid6b:after,
#LayoutGrid6b .row:before,
#LayoutGrid6b .row:after
{
   display: table;
   content: " ";
}

#LayoutGrid6:after,
#LayoutGrid6 .row:after
{
   clear: both;
}

#LayoutGrid6b:after,
#LayoutGrid6b .row:after
{
   clear: both;
}

@media (max-width: 480px)
{
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   float: none;
   width: 100%;
}
}
#razonsocial, #textobase
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
#razonsocial:focus, #textobase:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_Text4, #wb_Text4b 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text4 div, #wb_Text4b div
{
   text-align: left;
}
#Line3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line13, #Line13b
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line15, #Line15b
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
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

#codempresa
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 10;
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
#Line7, #Line7b
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 12;
}
#wb_FontAwesomeIcon10
{
   display: inline-block;
   width: 32px;
   height: 22px;
   text-align: center;
   z-index: 29;
}
#wb_FontAwesomeIcon3
{
   position: absolute;
   left: 3px;
   top: 6px;
   width: 49px;
   height: 36px;
   text-align: center;
   z-index: 18;
}
#razonsocial, #textobase
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}
#wb_FontAwesomeIcon11
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 28;
}
#Line11
{
   display: block;
   width: 100%;
   height: 61px;
   z-index: 21;
}
#Line9
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 3;
}
#Layer1
{
   position: absolute;
   text-align: left;
   left: 97px;
   top: 716px;
   width: 63px;
   height: 52px;
   z-index: 30;
}
#Layer2
{
   position: absolute;
   text-align: left;
   left: 8px;
   top: 706px;
   width: 54px;
   height: 52px;
   z-index: 31;
}
#Line13, #Line13b
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 14;
}
#wb_Image3
{
   display: inline-block;
   width: 142px;
   height: 118px;
   z-index: 0;
}
#Line14, #Line14b
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 15;
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
   z-index: 26;
}
#Line15, #Line15b
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 17;
}
#wb_FontAwesomeIcon9
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 27;
}
#Line16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 19;
}
#sintomas_detallesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 22;
}
#Button1
{
   display: inline-block;
   width: 136px;
   height: 25px;
   z-index: 20;
}
#Line2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 6;
}
#sintomas_detallesLine2
{
   display: block;
   width: 100%;
   height: 16px;
   z-index: 24;
}
#Line3
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 8;
}
#wb_ResponsiveMenu1
{
   display: inline-block;
   width: 100%;
   z-index: 2;
}
#Line4
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 9;
}
#Line5
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 11;
}
@media only screen and (min-width: 1024px)
{
div#container
{
   width: 1024px;
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
#Line14, #Line14b
{
   height: 11px;
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
#Line7, #Line7b
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_Text2
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
#codempresa
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6, #LayoutGrid6b
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row, #LayoutGrid6b .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6b .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#LayoutGrid6 .col-2, #LayoutGrid6b .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#razonsocial, #textobase
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
#wb_Text4, #wb_Text4b
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13, #Line13b
{
   height: 11px;
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
#Line15, #Line15b
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
}
@media only screen and (min-width: 980px) and (max-width: 1023px)
{
div#container
{
   width: 980px;
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
#Line14, #Line14b
{
   height: 11px;
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
#Line7, #Line7b
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#codempresa
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6, #LayoutGrid6b
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row, #LayoutGrid6b .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6b .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid6 .col-2, #LayoutGrid6b .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#razonsocial, #textobase
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
#wb_Text4, #wb_Text4b
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13, #Line13b
{
   height: 11px;
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
#Line15, #Line15b
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
}
@media only screen and (min-width: 800px) and (max-width: 979px)
{
div#container
{
   width: 800px;
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
#Line14, #Line14b
{
   height: 11px;
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
#Line7, #Line7b
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#codempresa
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6, #LayoutGrid6b
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row, #LayoutGrid6b .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6b .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid6 .col-2, #LayoutGrid6b .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#razonsocial, #textobase
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
#wb_Text4, #wb_Text4b
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13, #Line13b
{
   height: 11px;
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
#Line15, #Line15b
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
}
@media only screen and (min-width: 768px) and (max-width: 799px)
{
div#container
{
   width: 768px;
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
#Line14, #Line14b
{
   height: 11px;
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
#Line7, #Line7b
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#codempresa
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
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
#wb_LayoutGrid6, #wb_LayoutGrid6b
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6,#LayoutGrid6b
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row, #LayoutGrid6b .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6b .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid6 .col-2, #LayoutGrid6b .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#razonsocial, #textobase
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
#wb_Text4, #wb_Text4b
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13, #Line13b
{
   height: 11px;
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
#Line15, #Line15b
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
}
@media only screen and (min-width: 480px) and (max-width: 767px)
{
div#container
{
   width: 480px;
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
#Line14, #Line14b
{
   height: 11px;
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
#Line7, #Line7b
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_Text2
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
#codempresa
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6, #LayoutGrid6b
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row, #LayoutGrid6b .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6b .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid6 .col-2, #LayoutGrid6b .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#razonsocial, #textobase
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
#wb_Text4, #wb_Text4b
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13, #Line13b
{
   height: 11px;
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
#Line15, #Line15b
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
}
@media only screen and (max-width: 479px)
{
div#container
{
   width: 320px;
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
#Line14, #Line14b
{
   height: 11px;
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
#Line7, #Line7b
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_Text2
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
#codempresa
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
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
#wb_LayoutGrid6,#wb_LayoutGrid6b
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid6, #LayoutGrid6b
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid6 .row,#LayoutGrid6b .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6 .col-2, #LayoutGrid6b .col-1, #LayoutGrid6b .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid6 .col-1, #LayoutGrid6b .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid6 .col-2, #LayoutGrid6b .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#razonsocial, #textobase
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
#wb_Text4, #wb_Text4b
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13, #Line13b
{
   height: 11px;
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
#Line15, #Line15b
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
}

#textobase
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
   overflow: auto;
   resize: none;
}
#textobase:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#textobase
{
   display: block;
   width: 100%;
   height: 26px;
   z-index: 16;
}

/*------------------------------------------------------------------------------------------------------*/

#wb_LayoutGrid5
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
#LayoutGrid5
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
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
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   float: left;
}
#LayoutGrid5 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#LayoutGrid5:before,
#LayoutGrid5:after,
#LayoutGrid5 .row:before,
#LayoutGrid5 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid5:after,
#LayoutGrid5 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_Text3 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
#Line6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line8
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#coddist, #coddpto
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
#coddist:focus, #coddpto:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#Line6
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 19;
}
#Editbox1
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 10;
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
#Line7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 12;
}
#wb_FontAwesomeIcon10
{
   display: inline-block;
   width: 32px;
   height: 22px;
   text-align: center;
   z-index: 40;
}
#Line8
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 23;
}
#wb_FontAwesomeIcon3
{
   position: absolute;
   left: 3px;
   top: 6px;
   width: 49px;
   height: 36px;
   text-align: center;
   z-index: 18;
}
#Editbox3
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}
#wb_FontAwesomeIcon11
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 39;
}
#Line11
{
   display: block;
   width: 100%;
   height: 61px;
   z-index: 32;
}

#Layer1
{
   position: absolute;
   text-align: left;
   left: 97px;
   top: 716px;
   width: 63px;
   height: 52px;
   z-index: 41;
}
#Layer2
{
   position: absolute;
   text-align: left;
   left: 8px;
   top: 706px;
   width: 54px;
   height: 52px;
   z-index: 42;
}
#Line13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 14;
}
#wb_Image3
{
   display: inline-block;
   width: 142px;
   height: 118px;
   z-index: 0;
}
#Line14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 15;
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
   z-index: 37;
}
#Line15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 17;
}
#wb_FontAwesomeIcon9
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 38;
}

#Line1
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 21;
}

#Button1
{
   display: inline-block;
   width: 136px;
   height: 25px;
   z-index: 31;
}
#Line2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 6;
}

#Line3
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 8;
}

#coddist, #coddpto
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 22;
}
#Line5
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 11;
}
@media only screen and (min-width: 1024px)
{
div#container
{
   width: 1024px;
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
#Line14
{
   height: 11px;
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
#Line7
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#coddist, #coddpto
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
}
@media only screen and (min-width: 980px) and (max-width: 1023px)
{
div#container
{
   width: 980px;
}

#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13
{
   height: 11px;
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
#Line15
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#coddist, #coddpto
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
}
@media only screen and (min-width: 800px) and (max-width: 979px)
{
div#container
{
   width: 800px;
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
#Line14
{
   height: 11px;
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
#Line7
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Editbox3
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13
{
   height: 11px;
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
#Line15
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#coddist, #coddpto
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
}
@media only screen and (min-width: 768px) and (max-width: 799px)
{
div#container
{
   width: 768px;
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
#Line14
{
   height: 11px;
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
#Line7
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Editbox3
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13
{
   height: 11px;
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
#Line15
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#coddist, #coddpto
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
}
@media only screen and (min-width: 480px) and (max-width: 767px)
{
div#container
{
   width: 480px;
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
#Line14
{
   height: 11px;
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
#Line7
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Editbox3
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13
{
   height: 11px;
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
#Line15
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#coddist, #coddpto
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
}
@media only screen and (max-width: 479px)
{
div#container
{
   width: 320px;
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
#Line14
{
   height: 11px;
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
#Line7
{
   height: 11px;
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Editbox3
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#Line13
{
   height: 11px;
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
#Line15
{
   height: 11px;
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
#Button1
{
   width: 136px;
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
#Line11
{
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#coddist, #coddpto
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
}
/*------------------------------------------------------------------------------------------------------------------------------------------*/

#empresas_detallesLine15
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesCombobox2
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
#empresas_detallesCombobox2:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#empresas_detallesLine11
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesCombobox1
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
#empresas_detallesCombobox1:focus
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
#Line4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line2
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
#wb_LayoutGrid4
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
#LayoutGrid4
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
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
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   float: left;
}
#LayoutGrid4 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 50%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 50%;
   text-align: left;
}
#LayoutGrid4:before,
#LayoutGrid4:after,
#LayoutGrid4 .row:before,
#LayoutGrid4 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid4:after,
#LayoutGrid4 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_Text2 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#Editbox1
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
#Editbox1:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#Line3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
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
#wb_LayoutGrid5
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
#LayoutGrid5
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
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
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   float: left;
}
#LayoutGrid5 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#LayoutGrid5:before,
#LayoutGrid5:after,
#LayoutGrid5 .row:before,
#LayoutGrid5 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid5:after,
#LayoutGrid5 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_Text3 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
#Line6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line8
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Table1
{
   border: 0px transparent solid;
   background-color: transparent;
   background-image: none;
   border-collapse: separate;
   border-spacing: 0px;
}
#Table1 td
{
   padding: 0px 0px 0px 0px;
}
#Table1 .cell0
{
   background-color: transparent;
   background-image: none;
   text-align: center;
   vertical-align: middle;
   font-size: 0;
}
#wb_laboratorio1
{
   position: relative;
}
#wb_laboratorio1, #wb_laboratorio1 *, #wb_laboratorio1 *::before, #wb_laboratorio1 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_laboratorio1 input[type='radio']
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
#wb_laboratorio1 label
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
#wb_laboratorio1 label::before
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
#wb_laboratorio1 label::after
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
#wb_laboratorio1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_laboratorio1 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_laboratorio2
{
   position: relative;
}
#wb_laboratorio2, #wb_laboratorio2 *, #wb_laboratorio2 *::before, #wb_laboratorio2 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_laboratorio2 input[type='radio']
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
#wb_laboratorio2 label
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
#wb_laboratorio2 label::before
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
#wb_laboratorio2 label::after
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
#wb_laboratorio2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_laboratorio2 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_Text5 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text5 div
{
   text-align: left;
}
#wb_Text6 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text6 div
{
   text-align: left;
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
#Editbox3
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
#Editbox3:focus
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
#wb_empresas_detallesLayoutGrid1
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
#empresas_detallesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
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
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid1:before,
#empresas_detallesLayoutGrid1:after,
#empresas_detallesLayoutGrid1 .row:before,
#empresas_detallesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid1:after,
#empresas_detallesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#ruc
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
#ruc:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_empresas_detallesText1 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText1 div
{
   text-align: left;
}
#empresas_detallesLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_courier_detallesLayoutGrid1
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
#courier_detallesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#courier_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
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
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   float: left;
}
#courier_detallesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#courier_detallesLayoutGrid1:before,
#courier_detallesLayoutGrid1:after,
#courier_detallesLayoutGrid1 .row:before,
#courier_detallesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#courier_detallesLayoutGrid1:after,
#courier_detallesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_courier_detallesText1 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_courier_detallesText1 div
{
   text-align: left;
}
#courier_detallesLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#responsable
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
#responsable:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_empresas_detallesLayoutGrid2
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
#empresas_detallesLayoutGrid2
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
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
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid2 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid2 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid2:before,
#empresas_detallesLayoutGrid2:after,
#empresas_detallesLayoutGrid2 .row:before,
#empresas_detallesLayoutGrid2 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid2:after,
#empresas_detallesLayoutGrid2 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText2 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText2 div
{
   text-align: left;
}
#empresas_detallesLine5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine7
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine8
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#cargoresp, #email
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
#cargoresp:focus, #email:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
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
#dccion
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
#dccion:focus
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
#empresas_detallesLine12
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
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
#empresas_detallesLine16
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_empresas_detallesLayoutGrid5
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
#empresas_detallesLayoutGrid5
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
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
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid5 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid5 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid5:before,
#empresas_detallesLayoutGrid5:after,
#empresas_detallesLayoutGrid5 .row:before,
#empresas_detallesLayoutGrid5 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid5:after,
#empresas_detallesLayoutGrid5 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText5 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText5 div
{
   text-align: left;
}
#empresas_detallesLine17
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine18
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine19
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine20
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#barrio
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
#barrio:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
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
#wb_zona
{
   position: relative;
}
#wb_zona, #wb_zona *, #wb_zona *::before, #wb_zona *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_zona input[type='radio']
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
#wb_zona label
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
#wb_zona label::before
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
#wb_zona label::after
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
#wb_zona input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_zona input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_zona2
{
   position: relative;
}
#wb_zona2, #wb_zona2 *, #wb_zona2 *::before, #wb_zona2 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_zona2 input[type='radio']
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
#wb_zona2 label
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
#wb_zona2 label::before
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
#wb_zona2 label::after
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
#wb_zona2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_zona2 input[type='radio']:focus + label::before
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
#wb_courier_detallesLayoutGrid3
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
#courier_detallesLayoutGrid3
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#courier_detallesLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid3 .col-1, #courier_detallesLayoutGrid3 .col-2
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
#courier_detallesLayoutGrid3 .col-1, #courier_detallesLayoutGrid3 .col-2
{
   float: left;
}
#courier_detallesLayoutGrid3 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid3 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#courier_detallesLayoutGrid3:before,
#courier_detallesLayoutGrid3:after,
#courier_detallesLayoutGrid3 .row:before,
#courier_detallesLayoutGrid3 .row:after
{
   display: table;
   content: " ";
}
#courier_detallesLayoutGrid3:after,
#courier_detallesLayoutGrid3 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#courier_detallesLayoutGrid3 .col-1, #courier_detallesLayoutGrid3 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_courier_detallesText3 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_courier_detallesText3 div
{
   text-align: left;
}
#courier_detallesLine9
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine10
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine11
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine12
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
#wb_empresas_detallesLayoutGrid7
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
#empresas_detallesLayoutGrid7
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#empresas_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid7 .col-1, #empresas_detallesLayoutGrid7 .col-2
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
#empresas_detallesLayoutGrid7 .col-1, #empresas_detallesLayoutGrid7 .col-2
{
   float: left;
}
#empresas_detallesLayoutGrid7 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid7 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#empresas_detallesLayoutGrid7:before,
#empresas_detallesLayoutGrid7:after,
#empresas_detallesLayoutGrid7 .row:before,
#empresas_detallesLayoutGrid7 .row:after
{
   display: table;
   content: " ";
}
#empresas_detallesLayoutGrid7:after,
#empresas_detallesLayoutGrid7 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#empresas_detallesLayoutGrid7 .col-1, #empresas_detallesLayoutGrid7 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_empresas_detallesText9 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_empresas_detallesText9 div
{
   text-align: left;
}
#empresas_detallesLine24
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine25
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine26
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#empresas_detallesLine27
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#celular
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
#celular:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_courier_detallesLayoutGrid4
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
#courier_detallesLayoutGrid4
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#courier_detallesLayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid4 .col-1, #courier_detallesLayoutGrid4 .col-2
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
#courier_detallesLayoutGrid4 .col-1, #courier_detallesLayoutGrid4 .col-2
{
   float: left;
}
#courier_detallesLayoutGrid4 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid4 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#courier_detallesLayoutGrid4:before,
#courier_detallesLayoutGrid4:after,
#courier_detallesLayoutGrid4 .row:before,
#courier_detallesLayoutGrid4 .row:after
{
   display: table;
   content: " ";
}
#courier_detallesLayoutGrid4:after,
#courier_detallesLayoutGrid4 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#courier_detallesLayoutGrid4 .col-1, #courier_detallesLayoutGrid4 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_courier_detallesText4 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_courier_detallesText4 div
{
   text-align: left;
}
#courier_detallesLine13
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine14
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine15
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#courier_detallesLine16
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#responsable
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
#responsable:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
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
#wb_estado1
{
   position: relative;
}
#wb_estado1, #wb_estado1 *, #wb_estado1 *::before, #wb_estado1 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_estado1 input[type='radio']
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
#wb_estado1 label
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
#wb_estado1 label::before
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
#wb_estado1 label::after
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
#wb_estado1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_estado1 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_estado2
{
   position: relative;
}
#wb_estado2, #wb_estado2 *, #wb_estado2 *::before, #wb_estado2 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_estado2 input[type='radio']
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
#wb_estado2 label
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
#wb_estado2 label::before
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
#wb_estado2 label::after
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
#wb_estado2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_estado2 input[type='radio']:focus + label::before
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
#empresas_detallesTable2
{
   display: table;
   width: 100%;
   height: 20px;
   z-index: 126;
}
#empresas_detallesLine25
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 103;
}
#empresas_detallesCombobox2
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 70;
}
#empresas_detallesLine14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 68;
}
#empresas_detallesLine7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 51;
}
#courier_detallesLine4
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 47;
}
#Line6
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 13;
}
#Editbox1
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 10;
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
#empresas_detallesLine26
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 104;
}
#empresas_detallesLine15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 69;
}
#courier_detallesLine5
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 54;
}
#empresas_detallesLine8
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 53;
}
#Line7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 30;
}
#wb_FontAwesomeIcon10
{
   display: inline-block;
   width: 32px;
   height: 22px;
   text-align: center;
   z-index: 146;
}
#empresas_detallesLine27
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 106;
}
#courier_detallesLine10
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 97;
}
#empresas_detallesLine16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 71;
}
#empresas_detallesLine9
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 60;
}
#courier_detallesLine6
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 56;
}
#Editbox3
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 34;
}
#laboratorio1
{
   display: inline-block;
   z-index: 15;
}
#Line8
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 19;
}
#wb_FontAwesomeIcon3
{
   position: absolute;
   left: 3px;
   top: 6px;
   width: 49px;
   height: 36px;
   text-align: center;
   z-index: 12;
}
#wb_FontAwesomeIcon11
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 145;
}
#Line11
{
   display: block;
   width: 100%;
   height: 61px;
   z-index: 138;
}
#empresas_detallesLine28
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 113;
}
#courier_detallesLine11
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 98;
}
#empresas_detallesLine17
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 72;
}
#courier_detallesLine7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 57;
}
#laboratorio2
{
   display: inline-block;
   z-index: 17;
}
#Line9
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 3;
}
#empresas_detallesLine29
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 115;
}
#courier_detallesLine12
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 100;
}
#zona
{
   display: inline-block;
   z-index: 80;
}
#empresas_detallesLine18
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 74;
}
#courier_detallesLine8
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 59;
}
#Layer1
{
   position: absolute;
   text-align: left;
   left: 102px;
   top: 878px;
   width: 63px;
   height: 52px;
   z-index: 163;
}
#courier_detallesLine13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 107;
}
#courier_detallesLine9
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 95;
}
#zona2
{
   display: inline-block;
   z-index: 82;
}
#empresas_detallesLine19
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 75;
}
#Line13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 32;
}
#Table1
{
   display: table;
   width: 100%;
   height: 20px;
   z-index: 20;
}
#Layer2
{
   position: absolute;
   text-align: left;
   left: 13px;
   top: 868px;
   width: 54px;
   height: 52px;
   z-index: 164;
}
#wb_Image3
{
   display: inline-block;
   width: 142px;
   height: 118px;
   z-index: 0;
}
#estado1
{
   display: inline-block;
   z-index: 121;
}
#courier_detallesLine14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 109;
}
#Line14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 33;
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
   z-index: 143;
}
#estado2
{
   display: inline-block;
   z-index: 123;
}
#courier_detallesLine15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 110;
}
#ruc
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 40;
}
#Line15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 35;
}
#wb_FontAwesomeIcon9
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 144;
}
#Line16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 136;
}
#courier_detallesLine16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 112;
}
#responsable
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 111;
}
#wb_zona
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 80;
}
#cargoresp, #email
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 52;
}
#wb_zona2
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 82;
}
#barrio
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 76;
}
#responsable
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 46;
}
#wb_estado1
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 121;
}
#celular
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 105;
}
#dccion
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 58;
}
#wb_estado2
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 123;
}
#obs
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 117;
}
#empresas_detallesLine30
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 116;
}
#telefono
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 99;
}
#empresas_detallesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 36;
}
#empresas_detallesLine31
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 118;
}
#empresas_detallesLine20
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 77;
}
#empresas_detallesLine2
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 38;
}
#Line1
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 21;
}
#sintomas_detallesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 139;
}
#Button1
{
   display: inline-block;
   width: 136px;
   height: 25px;
   z-index: 137;
}
#empresas_detallesLine32
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 119;
}
#empresas_detallesLine21
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 78;
}
#empresas_detallesLine10
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 62;
}
#empresas_detallesLine3
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 39;
}
#Line2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 6;
}
#sintomas_detallesLine2
{
   display: block;
   width: 100%;
   height: 16px;
   z-index: 141;
}
#empresas_detallesLine33
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 127;
}
#empresas_detallesLine22
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 86;
}
#empresas_detallesLine11
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 63;
}
#courier_detallesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 42;
}
#empresas_detallesLine4
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 41;
}
#Line3
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 8;
}
#wb_ResponsiveMenu1
{
   display: inline-block;
   width: 100%;
   z-index: 2;
}
#empresas_detallesLine34
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 125;
}
#empresas_detallesLine23
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 84;
}
#empresas_detallesLine12
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 65;
}
#empresas_detallesLine5
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 48;
}
#courier_detallesLine2
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 44;
}
#wb_laboratorio1
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 15;
}
#Line4
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 9;
}
#empresas_detallesLine24
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 101;
}
#empresas_detallesTable1
{
   display: table;
   width: 100%;
   height: 20px;
   z-index: 85;
}
#empresas_detallesLine13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 66;
}
#empresas_detallesCombobox1
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 64;
}
#empresas_detallesLine6
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 50;
}
#courier_detallesLine3
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 45;
}
#wb_laboratorio2
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 17;
}
#Line5
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 11;
}
@media only screen and (min-width: 1024px)
{
div#container
{
   width: 1024px;
}
#empresas_detallesCombobox2
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
#empresas_detallesCombobox1
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_Text2
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
#Editbox1
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_Text3
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
#Line6
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
#Line1
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
#Line8
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
#Table1
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
#Table1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_laboratorio1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_laboratorio2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_Text5
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
#wb_Text6
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
#wb_empresas_detallesLayoutGrid1
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
#wb_empresas_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_courier_detallesLayoutGrid1
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
#wb_courier_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#courier_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_empresas_detallesLayoutGrid2
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
#wb_empresas_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
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
#wb_empresas_detallesLayoutGrid5
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
#wb_empresas_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#empresas_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_zona
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_zona input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_zona label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_zona label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_zona input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
}
@media only screen and (min-width: 980px) and (max-width: 1023px)
{
div#container
{
   width: 980px;
}
#empresas_detallesCombobox2
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
#empresas_detallesCombobox1
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text3
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
#Line6
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
#Line1
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
#Line8
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
#Table1
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
#Table1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_laboratorio1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_laboratorio2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_Text5
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
#wb_Text6
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
#wb_empresas_detallesLayoutGrid1
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
#wb_empresas_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_courier_detallesLayoutGrid1
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
#wb_courier_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesLayoutGrid2
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
#wb_empresas_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
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
#wb_empresas_detallesLayoutGrid5
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
#wb_empresas_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_zona
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_zona input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_zona label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_zona label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_zona input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
}
@media only screen and (min-width: 800px) and (max-width: 979px)
{
div#container
{
   width: 800px;
}
#empresas_detallesCombobox2
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
#empresas_detallesCombobox1
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text3
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
#Line6
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
#Line1
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
#Line8
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
#Table1
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
#Table1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_laboratorio1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_laboratorio2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_Text5
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
#wb_Text6
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
#wb_empresas_detallesLayoutGrid1
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
#wb_empresas_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_courier_detallesLayoutGrid1
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
#wb_courier_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesLayoutGrid2
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
#wb_empresas_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
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
#wb_empresas_detallesLayoutGrid5
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
#wb_empresas_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_zona
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_zona input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_zona label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_zona label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_zona input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
}
@media only screen and (min-width: 768px) and (max-width: 799px)
{
div#container
{
   width: 768px;
}
#empresas_detallesCombobox2
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
#empresas_detallesCombobox1
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_Text3
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
#Line6
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
#Line1
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
#Line8
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
#Table1
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
#Table1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_laboratorio1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_laboratorio2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_Text5
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
#wb_Text6
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
#wb_empresas_detallesLayoutGrid1
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
#wb_empresas_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_courier_detallesLayoutGrid1
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
#wb_courier_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#courier_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_empresas_detallesLayoutGrid2
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
#wb_empresas_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
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
#wb_empresas_detallesLayoutGrid5
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
#wb_empresas_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#empresas_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_zona
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_zona input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_zona label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_zona label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_zona input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
}
@media only screen and (min-width: 480px) and (max-width: 767px)
{
div#container
{
   width: 480px;
}
#empresas_detallesCombobox2
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
#empresas_detallesCombobox1
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_laboratorio1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_laboratorio2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
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
#wb_empresas_detallesLayoutGrid1
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
#wb_empresas_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_courier_detallesLayoutGrid1
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
#wb_courier_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#courier_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesLayoutGrid2
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
#wb_empresas_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
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
#wb_empresas_detallesLayoutGrid5
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
#wb_empresas_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_zona
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_zona input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_zona label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_zona label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_zona input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
}
@media only screen and (max-width: 479px)
{
div#container
{
   width: 320px;
}
#empresas_detallesCombobox2
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
#empresas_detallesCombobox1
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
#Line4
{
   height: 10px;
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
#Line2
{
   height: 10px;
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
#wb_LayoutGrid4
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
#wb_LayoutGrid4
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid4
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid4 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid4 .col-1, #LayoutGrid4 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid4 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_Text2
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
#Editbox1
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
#Line3
{
   height: 10px;
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
#Line5
{
   height: 10px;
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
#wb_LayoutGrid5
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
#wb_LayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid5 .col-1, #LayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_laboratorio1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_laboratorio2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_laboratorio2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_laboratorio2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_laboratorio2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_laboratorio2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
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
#wb_empresas_detallesLayoutGrid1
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
#wb_empresas_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid1 .col-1, #empresas_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_courier_detallesLayoutGrid1
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
#wb_courier_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#courier_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#courier_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#courier_detallesLayoutGrid1 .col-1, #courier_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#courier_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#courier_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_empresas_detallesLayoutGrid2
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
#wb_empresas_detallesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid2 .col-1, #empresas_detallesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
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
#wb_empresas_detallesLayoutGrid5
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
#wb_empresas_detallesLayoutGrid5
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#empresas_detallesLayoutGrid5
{
   padding: 0px 15px 0px 15px;
}
#empresas_detallesLayoutGrid5 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#empresas_detallesLayoutGrid5 .col-1, #empresas_detallesLayoutGrid5 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#empresas_detallesLayoutGrid5 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#empresas_detallesLayoutGrid5 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_zona
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_zona input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_zona label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_zona label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_zona input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_estado2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_estado2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_estado2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_estado2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_estado2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
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

 <!----------- PARA ALERTAS  ---------->
<script src="jquery.ui.draggable.js" type="text/javascript"></script>

<script src="js/sweetalert.min.js" type="text/javascript"></script>

<script language="JavaScript"> 

function verificaempresas()
{ 
     	if (window.document.formu.codempresa.value == "" || window.document.formu.razonsocial.value == ""  || window.document.formu.ruc.value == "") 
		    {
            if(window.document.formu.codempresa.value == "")
              {
    		    window.document.formu.codempresa.style.backgroundColor='yellow';    
              }
            else
              {
    		    window.document.formu.codempresa.style.backgroundColor='white';    
              } 

            if(window.document.formu.razonsocial.value == "")
              {
    		    window.document.formu.razonsocial.style.backgroundColor='yellow';    
              }
            else
              {
    		    window.document.formu.razonsocial.style.backgroundColor='white';    
              }

            if(window.document.formu.ruc.value == "")
              {
    		    window.document.formu.ruc.style.backgroundColor='yellow';    
              }
            else
              {
    		    window.document.formu.ruc.style.backgroundColor='white';    
              }               

           	 //entonces (no algo esta en blanco) devuelvo el valor cadena vacia 
           	 swal("","Los datos obligatorios no deben estar en blanco:\n - C\u00f3digo,\n - Raz\u00f3n Social,\n - Nro. de RUC","warning"); 
			return false;
     	    }
         else
            {
            window.document.formu.submit(); 
            }   
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


function Limpiar()
{
   var i;
   if (window.document.formu.coddist.length > 0)
   {
	for (i = window.document.formu.coddist.length - 1; i > -1; i--) 
	{ 
	window.document.formu.coddist.remove(i);
	}  // aqui se me cae
   }
}

function SeleccionarDpto()
{
      var indice = window.document.formu.coddpto.selectedIndex;
      var valor = window.document.formu.coddpto.options[indice].text;
	  var otro = window.document.formu.coddpto.options[indice].value;
      <?php
	    $tabla_reg = pg_query($consaa, "select * from departamentos");
		while($empl = pg_fetch_array($tabla_reg)) 
		     {
		     ?>
			 if( otro == '<?php echo $empl['coddpto']; ?>' ) 
			 {
//				window.document.formu.subreg.value = "<?php echo $empl['subcreg']; ?>";
//				window.document.fr.regotro.value = <?php echo $empl['coddpto']?>;
//				window.document.fr.reg.value = valor;
			 }
		     <?php
		     }
		     ?>
      //Guardamos en un hidden
//	 window.document.fr.subcreg.value = window.document.formu.subreg.value;
}

function ComponerLista(depto) 
{
		//window.document.f.coddpto.disabled = true;
		window.document.formu.coddist.lenght = 0;
		LimpiarCbo(window.document.formu.coddist);
		//LimpiarCbo(window.document.f.establecimiento);
		SeleccionarDistrito(depto);
		window.document.formu.coddpto.disabled = false;
}

function SeleccionarDistrito(depto) 
{
	var o;
	window.document.formu.coddist.disabled = true;
	<?php
		$tabla_coddist = pg_query($consaa, "select * from distritos order by nomdist");
		while($empl = pg_fetch_array($tabla_coddist)) 
		{
	?>
	if( depto == '<?php echo $empl['coddpto']; ?>') 
	  {
	  o = window.document.createElement("OPTION");
	  o.text =  "<?php echo $empl['nomdist']; ?>";
	  o.value = "<?php echo $empl['coddist']; ?>";
	  window.document.formu.coddist.options.add(o);
	  }
	<?php
		}
	?>
	window.document.formu.coddist.disabled = false;
}

function LimpiarCbo(f)
 {
   var i;
   if (f.length > 0)
   {
	for (i = f.length - 1; i > -1; i--) 
	{ 
		f.remove(i);
	}  // aqui se me cae
   }
 }

</script>


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
<div id="wb_LayoutGrid3">
	<div id="LayoutGrid3">
		<div class="row">
			<div class="col-1">
				<hr id="Line9"/>
				<div id="wb_Text1">
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br />
					<br />
					</strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>ACTUALIZAR EMPRESAS / LABORATORIOS PRIVADOS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><br />
					<br />
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<form name="formu" method="post" action="insertar_empresas.php">
    <div id="wb_LayoutGrid4">
    	<div id="LayoutGrid4">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line2"/>
    				<div id="wb_Text2">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>C&oacute;digo: </strong></span>
    				</div>
    				<hr id="Line3"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line4"/>
                    <input type="text" class="form-control" placeholder="" name="codempresa" id="codempresa" size="10" maxlength="10" value="<?php echo $codempresa; ?>" onkeypress="return validarcar(event)" type=hidden   spellcheck="false"/>
                    
    				<hr id="Line5"/>
    			</div>
    		</div>
    	</div>
    </div>
    <div id="wb_LayoutGrid6">
    	<div id="LayoutGrid6">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7"/>
    				<div id="wb_Text4">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Raz&oacute;n Social: </strong></span>
    				</div>
    				<hr id="Line13"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14"/>
                    <input type="text" class="form-control" placeholder="" id="razonsocial" name="razonsocial" size="100" maxlength="200" value="<?php echo $razonsocial;?>" onkeypress="return validarcar(event)" onchange="conMayusculas(this)" spellcheck="false"/>
                    
    				<hr id="Line15"/>
    			</div>
    		</div>
    	</div>
    </div>   
 
    <div id="wb_LayoutGrid5">
    	<div id="LayoutGrid5">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line6"/>
    				<div id="wb_Text3">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Laboratorio Privado: <br />
    					</strong></span>
    				</div>
    			</div>
    			<div class="col-2">
    				<hr id="Line8"/>
    				<table id="Table1">
                    <?php
    	            $chequeol1=" ";
    	            $chequeol2=" ";
    	            if ($laboratorio==1)
    	               {
    	               	$chequeol1='checked="checked"';
    	               }
    	            if ($laboratorio==2)
    	               {
    	               	$chequeol2='checked="checked"';
    	               }
    	            ?>
                    
    				<tr>
    					<td class="cell0">
    						<div id="wb_laboratorio1">
    							<input type="radio" id="laboratorio1" name="laboratorio" value="1" <?php echo $chequeol1;?>/><label for="laboratorio1"></label>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_Text5">
    							<span style="color:#808080;font-family:Arial;font-size:13px;"> SI</span>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_laboratorio2">
    							<input type="radio" id="laboratorio2" name="laboratorio" value="2" <?php echo $chequeol2;?>/><label for="laboratorio2"></label>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_Text6">
    							<span style="color:#808080;font-family:Arial;font-size:13px;"> NO</span>
    						</div>
    					</td>
    				</tr>
    				</table>
    				<hr id="Line1"/>
    			</div>
    		</div>
    	</div>
    </div>

    <div id="wb_empresas_detallesLayoutGrid1">
    	<div id="empresas_detallesLayoutGrid1">
    		<div class="row">
    			<div class="col-1">
    				<hr id="empresas_detallesLine1"/>
    				<div id="wb_empresas_detallesText1">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nro. de RUC: </strong></span>
    				</div>
    				<hr id="empresas_detallesLine2"/>
    			</div>
    			<div class="col-2">
    				<hr id="empresas_detallesLine3"/>
                    <input type="text" class="form-control" placeholder="" id="ruc" name="ruc" size="50" maxlength="50" value="<?php echo $ruc;?>" onkeypress="return validarcar(event)" spellcheck="false" />
    				<hr id="empresas_detallesLine4"/>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div id="wb_courier_detallesLayoutGrid1">
    	<div id="courier_detallesLayoutGrid1">
    		<div class="row">
    			<div class="col-1">
    				<hr id="courier_detallesLine1"/>
    				<div id="wb_courier_detallesText1">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Persona Responsable: </strong></span>
    				</div>
    				<hr id="courier_detallesLine2"/>
    			</div>
    			<div class="col-2">
    				<hr id="courier_detallesLine3"/>
                    <input type="text" class="form-control" placeholder="" id="responsable" name="responsable" size="100" maxlength="150" value="<?php echo $responsable;?>" onchange="conMayusculas(this)" onkeypress="return validarcar(event)" spellcheck="false" />
    
    				<hr id="courier_detallesLine4"/>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div id="wb_empresas_detallesLayoutGrid2">
    	<div id="empresas_detallesLayoutGrid2">
    		<div class="row">
    			<div class="col-1">
    				<hr id="empresas_detallesLine5"/>
    				<div id="wb_empresas_detallesText2">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Cargo Responsable: </strong></span>
    				</div>
    				<hr id="empresas_detallesLine6"/>
    			</div>
    			<div class="col-2">
    				<hr id="empresas_detallesLine7"/>

                    <input type="text" class="form-control" placeholder="" id="cargoresp" name="cargoresp" size="100" maxlength="100" value="<?php echo $cargoresp;?>" onkeypress="return validarcar(event)" spellcheck="false" />

                    
    				<hr id="empresas_detallesLine8"/>
    			</div>
    		</div>
    	</div>
    </div>    
    
    <div id="wb_courier_detallesLayoutGrid2">
    	<div id="courier_detallesLayoutGrid2">
    		<div class="row">
    			<div class="col-1">
    				<hr id="courier_detallesLine5"/>
    				<div id="wb_courier_detallesText2">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Direcci&oacute;n: </strong></span>
    				</div>
    				<hr id="courier_detallesLine6"/>
    			</div>
    			<div class="col-2">
    				<hr id="courier_detallesLine7"/>

                    <input type="text" class="form-control" placeholder="" id="dccion" name="dccion" size="100" maxlength="200" value="<?php echo $dccion;?>" onkeypress="return validarcar(event)" spellcheck="false" />
                    
                    
    				<hr id="courier_detallesLine8"/>
    			</div>
    		</div>
    	</div>
    </div>    
    
    <div id="wb_LayoutGrid5">
    	<div id="LayoutGrid5">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line6"/>
    				<div id="wb_Text3">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Departamento: </strong></span>
    				</div>
    			</div>
                
    			<div class="col-2">
    				<hr id="Line1"/>
    				<select name="coddpto" size="1" id="coddpto" onchange="Limpiar()"  onblur="SeleccionarDpto()">
    					<option value=""></option>
                        <?php
            			$tabla_dpto = pg_query($consaa, "select * from departamentos order by coddpto");
            			while($depto = pg_fetch_array($tabla_dpto)) 
            			{
            		       if($depto["coddpto"]==$coddpto)
                             {//Para que ponga predeterminado el que hay guardado
                             ?>
            		          <option value = "<?php echo $depto['coddpto']; ?>" selected="" > 
            	              <?php echo $depto['nomdpto']; ?></option>
                              <?php 
            			  	  }
                              else
            				  {?>
            		          <option value = "<?php echo $depto['coddpto']; ?>" > 
            		          <?php echo $depto['nomdpto']; ?></option>
                              <?php
            				  }?> 
                        <?php
            			}
            			?>
    				</select>
                                       
                    
    				<hr id="Line8"/>
    			</div>
                
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid5">
    	<div id="LayoutGrid5">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line6"/>
    				<div id="wb_Text3">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Distrito: </strong></span>
    				</div>
    			</div>
                
    			<div class="col-2">
    				<hr id="Line1"/>
    				<select name="coddist" size="1" id="coddist" onfocus="ComponerLista(window.document.formu.coddpto.value)">
    					<option value=""></option>
                        <?php
            			$tabla_dpto = pg_query($consaa, "select * from distritos order by coddist");
            			while($depto = pg_fetch_array($tabla_dpto)) 
            			{
            		       if($depto["coddist"]==$coddist)
                             {//Para que ponga predeterminado el que hay guardado
                             ?>
            		          <option value = "<?php echo $depto['coddist']; ?>" selected="" > 
            	              <?php echo $depto['nomdist']; ?></option>
                              <?php 
            			  	  }
                              else
            				  {?>
            		          <option value = "<?php echo $depto['coddist']; ?>" > 
            		          <?php echo $depto['nomdist']; ?></option>
                              <?php
            				  }?> 
                        <?php
            			}
            			?>
    				</select>
                                       
                    
    				<hr id="Line8"/>
    			</div>
                
    		</div>
    	</div>
    </div>

    <div id="wb_empresas_detallesLayoutGrid5">
    	<div id="empresas_detallesLayoutGrid5">
    		<div class="row">
    			<div class="col-1">
    				<hr id="empresas_detallesLine17"/>
    				<div id="wb_empresas_detallesText5">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Barrio: </strong></span>
    				</div>
    				<hr id="empresas_detallesLine18"/>
    			</div>
    			<div class="col-2">
    				<hr id="empresas_detallesLine19"/>
                    <input type="text" class="form-control" placeholder="" id="barrio" name="barrio" size="150" maxlength="200" value="<?php echo $barrio;?>" onkeypress="return validarcar(event)" spellcheck="false" />

                    
    				<hr id="empresas_detallesLine20"/>
    			</div>
    		</div>
    	</div>
    </div>

    <div id="wb_empresas_detallesLayoutGrid6">
    	<div id="empresas_detallesLayoutGrid6">
    		<div class="row">
    			<div class="col-1">
    				<hr id="empresas_detallesLine21"/>
    				<div id="wb_empresas_detallesText6">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Zona: <br />
    					</strong></span>
    				</div>
    			</div>
    			<div class="col-2">
    				<hr id="empresas_detallesLine23"/>
    				<table id="empresas_detallesTable1">

                        <?php
        	            $chequeoz1=" ";
        	            $chequeoz2=" ";
        	            if ($zona==1)
        	               {
        	               	$chequeoz1='checked="checked"';
        	               }
        	            if ($zona==2)
        	               {
        	               	$chequeoz2='checked="checked"';
        	               }
        	            ?>
                    
    				<tr>
    					<td class="cell0">
    						<div id="wb_zona">
    							<input type="radio" id="zona1" name="zona" value="1" <?php echo $chequeoz1;?>/><label for="zona"></label>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_empresas_detallesText7">
    							<span style="color:#808080;font-family:Arial;font-size:13px;"> Urbana</span>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_zona2">
    							<input type="radio" id="zona2" name="zona" value="2" <?php echo $chequeoz2;?>/><label for="zona2"></label>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_empresas_detallesText8">
    							<span style="color:#808080;font-family:Arial;font-size:13px;"> Rural</span>
    						</div>
    					</td>
    				</tr>
    				</table>
    				<hr id="empresas_detallesLine22"/>
    			</div>
    		</div>
    	</div>
    </div>

    <div id="wb_courier_detallesLayoutGrid3">
    	<div id="courier_detallesLayoutGrid3">
    		<div class="row">
    			<div class="col-1">
    				<hr id="courier_detallesLine9"/>
    				<div id="wb_courier_detallesText3">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Tel&eacute;fonos: </strong></span>
    				</div>
    				<hr id="courier_detallesLine10"/>
    			</div>
    			<div class="col-2">
    				<hr id="courier_detallesLine11"/>
                    <input type="text" class="form-control" placeholder="" id="telefono" name="telefono" size="30" maxlength="30" value="<?php echo $telefono;?>" onkeypress="return validarcar(event)" spellcheck="false" />

                    
    				<hr id="courier_detallesLine12"/>
    			</div>
    		</div>
    	</div>
    </div>

    <div id="wb_empresas_detallesLayoutGrid7">
    	<div id="empresas_detallesLayoutGrid7">
    		<div class="row">
    			<div class="col-1">
    				<hr id="empresas_detallesLine24"/>
    				<div id="wb_empresas_detallesText9">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Celular: </strong></span>
    				</div>
    				<hr id="empresas_detallesLine25"/>
    			</div>
    			<div class="col-2">
    				<hr id="empresas_detallesLine26"/>
                    <input type="text" class="form-control" placeholder="" id="celular" name="celular" size="30" maxlength="30" value="<?php echo $celular;?>" onkeypress="return validarcar(event)" spellcheck="false" />
                    
    				<hr id="empresas_detallesLine27"/>
    			</div>
    		</div>
    	</div>
    </div>

    <div id="wb_courier_detallesLayoutGrid4">
    	<div id="courier_detallesLayoutGrid4">
    		<div class="row">
    			<div class="col-1">
    				<hr id="courier_detallesLine13"/>
    				<div id="wb_courier_detallesText4">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>E-Mail: </strong></span>
    				</div>
    				<hr id="courier_detallesLine14"/>
    			</div>
    			<div class="col-2">
    				<hr id="courier_detallesLine15"/>
                    <input type="text" class="form-control" placeholder="" id="email" name="email" size="100" maxlength="100" value="<?php echo $email;?>" onkeypress="return validarcar(event)" spellcheck="false" />
                    
    				<hr id="courier_detallesLine16"/>
    			</div>
    		</div>
    	</div>
    </div>

    <div id="wb_empresas_detallesLayoutGrid8">
    	<div id="empresas_detallesLayoutGrid8">
    		<div class="row">
    			<div class="col-1">
    				<hr id="empresas_detallesLine28"/>
    				<div id="wb_empresas_detallesText10">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Observaciones: </strong></span>
    				</div>
    				<hr id="empresas_detallesLine29"/>
    			</div>
    			<div class="col-2">
    				<hr id="empresas_detallesLine30"/>

                    <input type="text" class="form-control" placeholder="" id="obs" name="obs" size="100" maxlength="250" value="<?php echo $obs;?>" onkeypress="return validarcar(event)" spellcheck="false" />
                    
    				<hr id="empresas_detallesLine31"/>
    			</div>
    		</div>
    	</div>
    </div>

    <div id="wb_empresas_detallesLayoutGrid9">
    	<div id="empresas_detallesLayoutGrid9">
    		<div class="row">
    			<div class="col-1">
    				<hr id="empresas_detallesLine32"/>
    				<div id="wb_empresas_detallesText11">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Estado: <br />
    					</strong></span>
    				</div>
    			</div>
    			<div class="col-2">
    				<hr id="empresas_detallesLine34"/>
    				<table id="empresas_detallesTable2">
                    <?php
    	            $chequeoe1=" ";
    	            $chequeoe2=" ";
    	            if ($estado==1)
    	               {
    	               	$chequeoe1='checked="checked"';
    	               }
    	            if ($estado==2)
    	               {
    	               	$chequeoe2='checked="checked"';
    	               }
    	            ?>                    
                    
    				<tr>
    					<td class="cell0">
    						<div id="wb_estado1">
    							<input type="radio" id="estado1" name="estado" value="1" <?php echo $chequeoe1;?>/><label for="estado1"></label>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_empresas_detallesText12">
    							<span style="color:#808080;font-family:Arial;font-size:13px;"> Activo</span>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_estado2">
    							<input type="radio" id="estado2" name="estado" value="2" <?php echo $chequeoe2;?>/><label for="estado2"></label>
    						</div>
    					</td>
    					<td class="cell0">
    						<div id="wb_empresas_detallesText13">
    							<span style="color:#808080;font-family:Arial;font-size:13px;"> Inactivo</span>
    						</div>
    					</td>
    				</tr>
    				</table>
    				<hr id="empresas_detallesLine33"/>
    			</div>
    		</div>
    	</div>
    </div>

    
</form>

<div id="Layer2">
	<div id="wb_FontAwesomeIcon3">
		<a href="menu.php">
		<div id="FontAwesomeIcon3">
			<i class="fa fa-commenting-o">&nbsp;</i>
		</div>
		</a>
	</div>
</div>
<div id="wb_LayoutGrid7">
	<div id="LayoutGrid7">
		<div class="row">
			<div class="col-1">
				<hr id="Line16"/>
				<input type="button" id="Button1" onclick="verificaempresas()" name="guardar" value="Guardar Datos"/>
				<hr id="Line11"/>
			</div>
			<div class="col-2">
			</div>
		</div>
	</div>
</div>
<div id="wb_sintomas_detallesLayoutGrid1">
	<div id="sintomas_detallesLayoutGrid1">
		<div class="row">
			<div class="col-1">
				<hr id="sintomas_detallesLine1"/>
				<div id="wb_sintomas_detallesText1">
					<span style="color:#FF0000;font-family:Arial;font-size:13px;">[&nbsp;<a href="#" onclick="window.location.href='empresas.php';"> VOLVER </a>&nbsp;]</span>
                    
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
<?php

if ($_GET["mensage2"]==2)
    {
	echo "<script type=''>
    window.document.formu.razonsocial.style.backgroundColor='yellow';
     swal('','Ya existe otro registro con esa Denominaci\u00f3n!','error');
     </script>"; 
    }
if ($_GET["mensage2"]==1)
    {
	echo "<script type=''>
    window.document.formu.codempresa.style.backgroundColor='yellow';
     swal('','Ya existe otro registro con ese C\u00f3digo!','error');
     </script>"; 
    }
    
?>

<script type="text/javascript" src="js/script.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
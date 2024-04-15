<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

include("conexion.php"); 
$link=Conectarse();
$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

$elusuario=$nomyape;


if ($_GET["mensage2"]==1 || $_GET["mensage2"]==2)
  {
  $codservicio    = $_SESSION['codservicio'];
  $director       = $_SESSION['director'];  
  $archivo1       = $_SESSION['archivo1'];  
  $archivo2       = $_SESSION['archivo2'];  
  $cargodir       = $_SESSION['cargodir'];  
  $nomyapefir     = $_SESSION['nomyapefir'];
  $cuentagral     = $_SESSION['cuentagral'];   
  $nomctagral     = $_SESSION['nomctagral'];   
  $nomyapedep     = $_SESSION['nomyapedep'];   
  $concepto       = $_SESSION['concepto'];
  //-----------------------------//
  $n_recibo_ini   = $_SESSION['n_recibo_ini'];
  $n_recibo       = $_SESSION['n_recibo'];
  $n_recibo_fin   = $_SESSION['n_recibo_fin'];
  $serie          = $_SESSION['serie'];
  $np_mensaje     = $_SESSION['np_mensaje'];
  $decreto        = $_SESSION['decreto'];
  $ruc            = $_SESSION['ruc']; 
  }
else
  {
  $codservicio    = "";
  $director       = " ";
  $archivo1       = "";  
  $archivo2       = "";  
  $cargodir       = "";  
  $nomyapefir     =  "";
  $cuentagral     =  ""; 
  $nomctagral     =  ""; 
  $nomyapedep     =  ""; 
  $concepto       =  ""; 
  //-----------------------------//
  $n_recibo_ini   = "";
  $n_recibo       = "";
  $n_recibo_fin   = "";
  $serie          = "";
  $np_mensaje     = "";
  $decreto        = "";
  $ruc            = ""; 
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#codservicio:focus, #director:focus, #cargodir:focus, #nomyapefir:focus, #cuentagral:focus, #nomctagral:focus, #nomyapedepa:focus, #concepto:focus, #n_recibo_ini:focus, #n_recibo:focus, #n_recibo_fin:focus, #serie:focus, #np_mensaje:focus, #decreto:focus, #ruc:focus
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
#archivo1, #archivo2
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
#archivo1:focus, #archivo2:focus
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

#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#archivo1, #archivo2
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#archivo1, #archivo2
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#archivo1, #archivo2
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#archivo1, #archivo2
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#archivo1, #archivo2
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#archivo1, #archivo2
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#wb_LayoutGrid4, #wb_LayoutGrid4b
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
#codservicio, #director, #cargodir, #nomyapefir, #cuentagral, #nomctagral, #nomyapedep, #concepto, #n_recibo_ini, #n_recibo, #n_recibo_fin, #serie, #np_mensaje, #decreto, #ruc
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
#archivo1, #archivo2
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



#PhotoGallery1
{
   border-spacing: 3px;
   width: 100%;
}
#PhotoGallery1 .figure
{
   padding: 0px 0px 0px 0px;
   text-align: center;
   vertical-align: middle;
}
#PhotoGallery1 .figure img
{
   border-width: 0;
}

</style>
<style>

#usuarios_areasLine7
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasCombobox1
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
#usuarios_areasCombobox1:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#usuarios_areasLine11
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasTable1
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
   background-image: none;
   border-collapse: separate;
   border-spacing: 2px;
}
#usuarios_areasTable1 td
{
   padding: 2px 2px 2px 2px;
}
#usuarios_areasTable1 .cell0
{
   background-color: transparent;
   background-image: none;
   text-align: left;
   vertical-align: middle;
   font-size: 0;
}
#Line9
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
#Line7
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
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid4 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
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
#Editbox1:focus
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
#Editbox3
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
#Line13
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
#wb_usuarios_areasLayoutGrid1
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
#usuarios_areasLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#usuarios_areasLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
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
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   float: left;
}
#usuarios_areasLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#usuarios_areasLayoutGrid1:before,
#usuarios_areasLayoutGrid1:after,
#usuarios_areasLayoutGrid1 .row:before,
#usuarios_areasLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#usuarios_areasLayoutGrid1:after,
#usuarios_areasLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#usuarios_areasEditbox1
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
#usuarios_areasEditbox1:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_usuarios_areasText1 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_usuarios_areasText1 div
{
   text-align: left;
}
#usuarios_areasLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_usuarios_areasLayoutGrid2
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
#usuarios_areasLayoutGrid2
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#usuarios_areasLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
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
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   float: left;
}
#usuarios_areasLayoutGrid2 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid2 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#usuarios_areasLayoutGrid2:before,
#usuarios_areasLayoutGrid2:after,
#usuarios_areasLayoutGrid2 .row:before,
#usuarios_areasLayoutGrid2 .row:after
{
   display: table;
   content: " ";
}
#usuarios_areasLayoutGrid2:after,
#usuarios_areasLayoutGrid2 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_usuarios_areasText2 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_usuarios_areasText2 div
{
   text-align: left;
}
#usuarios_areasLine5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasLine6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasLine8
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_usuarios_areasLayoutGrid3
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
#usuarios_areasLayoutGrid3
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#usuarios_areasLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid3 .col-1, #usuarios_areasLayoutGrid3 .col-2
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
#usuarios_areasLayoutGrid3 .col-1, #usuarios_areasLayoutGrid3 .col-2
{
   float: left;
}
#usuarios_areasLayoutGrid3 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid3 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#usuarios_areasLayoutGrid3:before,
#usuarios_areasLayoutGrid3:after,
#usuarios_areasLayoutGrid3 .row:before,
#usuarios_areasLayoutGrid3 .row:after
{
   display: table;
   content: " ";
}
#usuarios_areasLayoutGrid3:after,
#usuarios_areasLayoutGrid3 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#usuarios_areasLayoutGrid3 .col-1, #usuarios_areasLayoutGrid3 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_usuarios_areasText3 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_usuarios_areasText3 div
{
   text-align: left;
}
#usuarios_areasLine9
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasLine10
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_areasLine12
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_usuarios_areasText5 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_usuarios_areasText5 div
{
   text-align: left;
}
#wb_usuarios_areasText6 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_usuarios_areasText6 div
{
   text-align: left;
}
#wb_usuarios_areasCheckbox1
{
   position: relative;
}
#wb_usuarios_areasCheckbox1, #wb_usuarios_areasCheckbox1 *, #wb_usuarios_areasCheckbox1 *::before, #wb_usuarios_areasCheckbox1 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']
{
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
#wb_usuarios_areasCheckbox1 label
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
#wb_usuarios_areasCheckbox1 label::before
{
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
#wb_usuarios_areasCheckbox1 label::after
{
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
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::after
{
   content: " ";
   background: url('data:image/svg+xml,%3Csvg%20height%3D%2218%22%20width%3D%2218%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20style%3D%22fill%3A%23FFFFFF%22%20transform%3D%22scale%280.01%29%22%3E%0D%0A%3Cpath%20transform%3D%22rotate%28180%29%20scale%28-1%2C1%29%20translate%280%2C-1536%29%22%20d%3D%22M1671%20970q0%20-40%20-28%20-68l-724%20-724l-136%20-136q-28%20-28%20-68%20-28t-68%2028l-136%20136l-362%20362q-28%2028%20-28%2068t28%2068l136%20136q28%2028%2068%2028t68%20-28l294%20-295l656%20657q28%2028%2068%2028t68%20-28l136%20-136q28%20-28%2028%20-68z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E') no-repeat center center;
   background-size: 80% 80%
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::before
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:focus + label::before
{
   outline: thin dotted;
}
#wb_usuarios_areasCheckbox2
{
   position: relative;
}
#wb_usuarios_areasCheckbox2, #wb_usuarios_areasCheckbox2 *, #wb_usuarios_areasCheckbox2 *::before, #wb_usuarios_areasCheckbox2 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_usuarios_areasCheckbox2 input[type='checkbox']
{
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
#wb_usuarios_areasCheckbox2 label
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
#wb_usuarios_areasCheckbox2 label::before
{
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
#wb_usuarios_areasCheckbox2 label::after
{
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
#wb_usuarios_areasCheckbox2 input[type='checkbox']:checked + label::after
{
   content: " ";
   background: url('data:image/svg+xml,%3Csvg%20height%3D%2218%22%20width%3D%2218%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20style%3D%22fill%3A%23FFFFFF%22%20transform%3D%22scale%280.01%29%22%3E%0D%0A%3Cpath%20transform%3D%22rotate%28180%29%20scale%28-1%2C1%29%20translate%280%2C-1536%29%22%20d%3D%22M1671%20970q0%20-40%20-28%20-68l-724%20-724l-136%20-136q-28%20-28%20-68%20-28t-68%2028l-136%20136l-362%20362q-28%2028%20-28%2068t28%2068l136%20136q28%2028%2068%2028t68%20-28l294%20-295l656%20657q28%2028%2068%2028t68%20-28l136%20-136q28%20-28%2028%20-68z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E') no-repeat center center;
   background-size: 80% 80%
}
#wb_usuarios_areasCheckbox2 input[type='checkbox']:checked + label::before
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_usuarios_areasCheckbox2 input[type='checkbox']:focus + label::before
{
   outline: thin dotted;
}
#wb_usuarios_areasCheckbox3
{
   position: relative;
}
#wb_usuarios_areasCheckbox3, #wb_usuarios_areasCheckbox3 *, #wb_usuarios_areasCheckbox3 *::before, #wb_usuarios_areasCheckbox3 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_usuarios_areasCheckbox3 input[type='checkbox']
{
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
#wb_usuarios_areasCheckbox3 label
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
#wb_usuarios_areasCheckbox3 label::before
{
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
#wb_usuarios_areasCheckbox3 label::after
{
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
#wb_usuarios_areasCheckbox3 input[type='checkbox']:checked + label::after
{
   content: " ";
   background: url('data:image/svg+xml,%3Csvg%20height%3D%2218%22%20width%3D%2218%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20style%3D%22fill%3A%23FFFFFF%22%20transform%3D%22scale%280.01%29%22%3E%0D%0A%3Cpath%20transform%3D%22rotate%28180%29%20scale%28-1%2C1%29%20translate%280%2C-1536%29%22%20d%3D%22M1671%20970q0%20-40%20-28%20-68l-724%20-724l-136%20-136q-28%20-28%20-68%20-28t-68%2028l-136%20136l-362%20362q-28%2028%20-28%2068t28%2068l136%20136q28%2028%2068%2028t68%20-28l294%20-295l656%20657q28%2028%2068%2028t68%20-28l136%20-136q28%20-28%2028%20-68z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E') no-repeat center center;
   background-size: 80% 80%
}
#wb_usuarios_areasCheckbox3 input[type='checkbox']:checked + label::before
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_usuarios_areasCheckbox3 input[type='checkbox']:focus + label::before
{
   outline: thin dotted;
}
#wb_distritosLayoutGrid1
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
#distritosLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#distritosLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#distritosLayoutGrid1 .col-1, #distritosLayoutGrid1 .col-2
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
#distritosLayoutGrid1 .col-1, #distritosLayoutGrid1 .col-2
{
   float: left;
}
#distritosLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#distritosLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#distritosLayoutGrid1:before,
#distritosLayoutGrid1:after,
#distritosLayoutGrid1 .row:before,
#distritosLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#distritosLayoutGrid1:after,
#distritosLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#distritosLayoutGrid1 .col-1, #distritosLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_distritosText1 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_distritosText1 div
{
   text-align: left;
}
#distritosLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#distritosLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#distritosLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#distritosLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
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
#wb_roles_detallesLayoutGrid1
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
#roles_detallesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#roles_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#roles_detallesLayoutGrid1 .col-1, #roles_detallesLayoutGrid1 .col-2
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
#roles_detallesLayoutGrid1 .col-1, #roles_detallesLayoutGrid1 .col-2
{
   float: left;
}
#roles_detallesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#roles_detallesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#roles_detallesLayoutGrid1:before,
#roles_detallesLayoutGrid1:after,
#roles_detallesLayoutGrid1 .row:before,
#roles_detallesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#roles_detallesLayoutGrid1:after,
#roles_detallesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#roles_detallesLayoutGrid1 .col-1, #roles_detallesLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_roles_detallesText1 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_roles_detallesText1 div
{
   text-align: left;
}
#roles_detallesLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#roles_detallesLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#roles_detallesLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#roles_detallesLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#roles_detallesTable1
{
   border: 1px #C0C0C0 solid;
   background-color: transparent;
   background-image: none;
   border-collapse: separate;
   border-spacing: 1px;
}
#roles_detallesTable1 td
{
   padding: 1px 1px 1px 1px;
}
#roles_detallesTable1 .cell0
{
   background-color: transparent;
   background-image: none;
   border: 1px #C0C0C0 solid;
   text-align: center;
   vertical-align: top;
   font-family: Arial;
   font-size: 13px;
   line-height: 16px;
}
#roles_detallesTable1 .cell1
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
#roles_detallesTable1 .cell2
{
   background-color: transparent;
   background-image: none;
   border: 1px #C0C0C0 solid;
   text-align: center;
   vertical-align: middle;
   font-size: 0;
}
#roles_detallesTable1 tr:nth-child(odd)
{
   background-color: #DCDCDC;
}
#wb_roles_detallesRadioButton5
{
   position: relative;
}
#wb_roles_detallesRadioButton5, #wb_roles_detallesRadioButton5 *, #wb_roles_detallesRadioButton5 *::before, #wb_roles_detallesRadioButton5 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton5 input[type='radio']
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
#wb_roles_detallesRadioButton5 label
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
#wb_roles_detallesRadioButton5 label::before
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
#wb_roles_detallesRadioButton5 label::after
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
#wb_roles_detallesRadioButton5 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton5 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton4
{
   position: relative;
}
#wb_roles_detallesRadioButton4, #wb_roles_detallesRadioButton4 *, #wb_roles_detallesRadioButton4 *::before, #wb_roles_detallesRadioButton4 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton4 input[type='radio']
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
#wb_roles_detallesRadioButton4 label
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
#wb_roles_detallesRadioButton4 label::before
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
#wb_roles_detallesRadioButton4 label::after
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
#wb_roles_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton4 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton3
{
   position: relative;
}
#wb_roles_detallesRadioButton3, #wb_roles_detallesRadioButton3 *, #wb_roles_detallesRadioButton3 *::before, #wb_roles_detallesRadioButton3 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton3 input[type='radio']
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
#wb_roles_detallesRadioButton3 label
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
#wb_roles_detallesRadioButton3 label::before
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
#wb_roles_detallesRadioButton3 label::after
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
#wb_roles_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton3 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton2
{
   position: relative;
}
#wb_roles_detallesRadioButton2, #wb_roles_detallesRadioButton2 *, #wb_roles_detallesRadioButton2 *::before, #wb_roles_detallesRadioButton2 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton2 input[type='radio']
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
#wb_roles_detallesRadioButton2 label
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
#wb_roles_detallesRadioButton2 label::before
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
#wb_roles_detallesRadioButton2 label::after
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
#wb_roles_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton2 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton9
{
   position: relative;
}
#wb_roles_detallesRadioButton9, #wb_roles_detallesRadioButton9 *, #wb_roles_detallesRadioButton9 *::before, #wb_roles_detallesRadioButton9 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton9 input[type='radio']
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
#wb_roles_detallesRadioButton9 label
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
#wb_roles_detallesRadioButton9 label::before
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
#wb_roles_detallesRadioButton9 label::after
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
#wb_roles_detallesRadioButton9 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton9 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton8
{
   position: relative;
}
#wb_roles_detallesRadioButton8, #wb_roles_detallesRadioButton8 *, #wb_roles_detallesRadioButton8 *::before, #wb_roles_detallesRadioButton8 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton8 input[type='radio']
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
#wb_roles_detallesRadioButton8 label
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
#wb_roles_detallesRadioButton8 label::before
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
#wb_roles_detallesRadioButton8 label::after
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
#wb_roles_detallesRadioButton8 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton8 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton7
{
   position: relative;
}
#wb_roles_detallesRadioButton7, #wb_roles_detallesRadioButton7 *, #wb_roles_detallesRadioButton7 *::before, #wb_roles_detallesRadioButton7 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton7 input[type='radio']
{
   position: absolute;
   padding: 0;
   margin: 0;
   opacity: 0;
   z-index: 1;
   width: 19px;
   height: 19px;
   left: 0;
   top: 0;
}
#wb_roles_detallesRadioButton7 label
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
#wb_roles_detallesRadioButton7 label::before
{
   content: "";
   display: inline-block;
   position: absolute;
   width: 19px;
   height: 19px;
   left: 0;
   top: 0;
   background-color: #FFFFFF;
   border: 1px #CCCCCC solid;
   border-radius: 50%;
}
#wb_roles_detallesRadioButton7 label::after
{
   display: inline-block;
   position: absolute;
   width: 19px;
   height: 19px;
   left: 0;
   top: 0;
   padding: 0;
   text-align: center;
   line-height: 19px;
   border-radius: 50%;
   color: #FFFFFF;
   content: " ";
   -webkit-transform: scale(0, 0);
   -moz-transform: scale(0, 0);
   transform: scale(0, 0);
}
#wb_roles_detallesRadioButton7 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton7 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton6
{
   position: relative;
}
#wb_roles_detallesRadioButton6, #wb_roles_detallesRadioButton6 *, #wb_roles_detallesRadioButton6 *::before, #wb_roles_detallesRadioButton6 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton6 input[type='radio']
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
#wb_roles_detallesRadioButton6 label
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
#wb_roles_detallesRadioButton6 label::before
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
#wb_roles_detallesRadioButton6 label::after
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
#wb_roles_detallesRadioButton6 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton6 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton11
{
   position: relative;
}
#wb_roles_detallesRadioButton11, #wb_roles_detallesRadioButton11 *, #wb_roles_detallesRadioButton11 *::before, #wb_roles_detallesRadioButton11 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton11 input[type='radio']
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
#wb_roles_detallesRadioButton11 label
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
#wb_roles_detallesRadioButton11 label::before
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
#wb_roles_detallesRadioButton11 label::after
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
#wb_roles_detallesRadioButton11 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton11 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton10
{
   position: relative;
}
#wb_roles_detallesRadioButton10, #wb_roles_detallesRadioButton10 *, #wb_roles_detallesRadioButton10 *::before, #wb_roles_detallesRadioButton10 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton10 input[type='radio']
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
#wb_roles_detallesRadioButton10 label
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
#wb_roles_detallesRadioButton10 label::before
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
#wb_roles_detallesRadioButton10 label::after
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
#wb_roles_detallesRadioButton10 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton10 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton13
{
   position: relative;
}
#wb_roles_detallesRadioButton13, #wb_roles_detallesRadioButton13 *, #wb_roles_detallesRadioButton13 *::before, #wb_roles_detallesRadioButton13 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton13 input[type='radio']
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
#wb_roles_detallesRadioButton13 label
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
#wb_roles_detallesRadioButton13 label::before
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
#wb_roles_detallesRadioButton13 label::after
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
#wb_roles_detallesRadioButton13 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton13 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton12
{
   position: relative;
}
#wb_roles_detallesRadioButton12, #wb_roles_detallesRadioButton12 *, #wb_roles_detallesRadioButton12 *::before, #wb_roles_detallesRadioButton12 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton12 input[type='radio']
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
#wb_roles_detallesRadioButton12 label
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
#wb_roles_detallesRadioButton12 label::before
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
#wb_roles_detallesRadioButton12 label::after
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
#wb_roles_detallesRadioButton12 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton12 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton17
{
   position: relative;
}
#wb_roles_detallesRadioButton17, #wb_roles_detallesRadioButton17 *, #wb_roles_detallesRadioButton17 *::before, #wb_roles_detallesRadioButton17 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton17 input[type='radio']
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
#wb_roles_detallesRadioButton17 label
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
#wb_roles_detallesRadioButton17 label::before
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
#wb_roles_detallesRadioButton17 label::after
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
#wb_roles_detallesRadioButton17 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton17 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton16
{
   position: relative;
}
#wb_roles_detallesRadioButton16, #wb_roles_detallesRadioButton16 *, #wb_roles_detallesRadioButton16 *::before, #wb_roles_detallesRadioButton16 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton16 input[type='radio']
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
#wb_roles_detallesRadioButton16 label
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
#wb_roles_detallesRadioButton16 label::before
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
#wb_roles_detallesRadioButton16 label::after
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
#wb_roles_detallesRadioButton16 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton16 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton15
{
   position: relative;
}
#wb_roles_detallesRadioButton15, #wb_roles_detallesRadioButton15 *, #wb_roles_detallesRadioButton15 *::before, #wb_roles_detallesRadioButton15 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton15 input[type='radio']
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
#wb_roles_detallesRadioButton15 label
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
#wb_roles_detallesRadioButton15 label::before
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
#wb_roles_detallesRadioButton15 label::after
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
#wb_roles_detallesRadioButton15 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton15 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton14
{
   position: relative;
}
#wb_roles_detallesRadioButton14, #wb_roles_detallesRadioButton14 *, #wb_roles_detallesRadioButton14 *::before, #wb_roles_detallesRadioButton14 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton14 input[type='radio']
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
#wb_roles_detallesRadioButton14 label
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
#wb_roles_detallesRadioButton14 label::before
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
#wb_roles_detallesRadioButton14 label::after
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
#wb_roles_detallesRadioButton14 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton14 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton20
{
   position: relative;
}
#wb_roles_detallesRadioButton20, #wb_roles_detallesRadioButton20 *, #wb_roles_detallesRadioButton20 *::before, #wb_roles_detallesRadioButton20 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton20 input[type='radio']
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
#wb_roles_detallesRadioButton20 label
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
#wb_roles_detallesRadioButton20 label::before
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
#wb_roles_detallesRadioButton20 label::after
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
#wb_roles_detallesRadioButton20 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton20 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton19
{
   position: relative;
}
#wb_roles_detallesRadioButton19, #wb_roles_detallesRadioButton19 *, #wb_roles_detallesRadioButton19 *::before, #wb_roles_detallesRadioButton19 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton19 input[type='radio']
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
#wb_roles_detallesRadioButton19 label
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
#wb_roles_detallesRadioButton19 label::before
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
#wb_roles_detallesRadioButton19 label::after
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
#wb_roles_detallesRadioButton19 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton19 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton18
{
   position: relative;
}
#wb_roles_detallesRadioButton18, #wb_roles_detallesRadioButton18 *, #wb_roles_detallesRadioButton18 *::before, #wb_roles_detallesRadioButton18 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton18 input[type='radio']
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
#wb_roles_detallesRadioButton18 label
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
#wb_roles_detallesRadioButton18 label::before
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
#wb_roles_detallesRadioButton18 label::after
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
#wb_roles_detallesRadioButton18 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton18 input[type='radio']:focus + label::before
{
   outline: thin dotted;
}
#wb_roles_detallesRadioButton1
{
   position: relative;
}
#wb_roles_detallesRadioButton1, #wb_roles_detallesRadioButton1 *, #wb_roles_detallesRadioButton1 *::before, #wb_roles_detallesRadioButton1 *::after
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
}
#wb_roles_detallesRadioButton1 input[type='radio']
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
#wb_roles_detallesRadioButton1 label
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
#wb_roles_detallesRadioButton1 label::before
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
#wb_roles_detallesRadioButton1 label::after
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
#wb_roles_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
   -webkit-transform: scale(0.8, 0.8);
   -moz-transform: scale(0.8, 0.8);
   transform: scale(0.8, 0.8);
}
#wb_roles_detallesRadioButton1 input[type='radio']:focus + label::before
{
   outline: thin dotted;
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
#wb_usuarios_areasText4 
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_usuarios_areasText4 div
{
   text-align: left;
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
#wb_roles_detallesRadioButton17
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 76;
}
#roles_detallesRadioButton6
{
   display: inline-block;
   z-index: 71;
}
#wb_roles_detallesRadioButton6
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 71;
}
#roles_detallesLine3
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 84;
}
#Editbox1
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 22;
}
#wb_FontAwesomeIcon1
{
   position: absolute;
   left: 13px;
   top: 13px;
   width: 37px;
   height: 26px;
   text-align: center;
   z-index: 17;
}
#roles_detallesLine4
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 86;
}
#wb_roles_detallesRadioButton18
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 82;
}
#roles_detallesRadioButton20
{
   display: inline-block;
   z-index: 80;
}
#roles_detallesRadioButton7
{
   display: inline-block;
   z-index: 70;
}
#wb_roles_detallesRadioButton7
{
   display: inline-block;
   width: 19px;
   height: 20px;
   z-index: 70;
}
#wb_usuarios_areasCheckbox1
{
   display: inline-block;
   width: 18px;
   height: 20px;
   z-index: 50;
}
#Line7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 24;
}
#wb_FontAwesomeIcon10
{
   display: inline-block;
   width: 32px;
   height: 22px;
   text-align: center;
   z-index: 137;
}
#wb_roles_detallesRadioButton19
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 81;
}
#roles_detallesRadioButton10
{
   display: inline-block;
   z-index: 73;
}
#roles_detallesRadioButton8
{
   display: inline-block;
   z-index: 69;
}
#wb_roles_detallesRadioButton8
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 69;
}
#wb_usuarios_areasCheckbox2
{
   display: inline-block;
   width: 18px;
   height: 20px;
   z-index: 48;
}
#usuarios_areasLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 31;
}
#wb_FontAwesomeIcon3
{
   position: absolute;
   left: 3px;
   top: 6px;
   width: 49px;
   height: 36px;
   text-align: center;
   z-index: 30;
}
#Editbox3
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 28;
}
#wb_FontAwesomeIcon11
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 136;
}
#Line11
{
   display: block;
   width: 100%;
   height: 61px;
   z-index: 129;
}
#roles_detallesRadioButton11
{
   display: inline-block;
   z-index: 72;
}
#roles_detallesRadioButton9
{
   display: inline-block;
   z-index: 68;
}
#wb_roles_detallesRadioButton9
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 68;
}
#wb_usuarios_areasCheckbox3
{
   display: inline-block;
   width: 18px;
   height: 20px;
   z-index: 46;
}
#usuarios_areasLine10
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 45;
}
#usuarios_areasLine2
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 33;
}
#Line9
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 15;
}
#roles_detallesRadioButton12
{
   display: inline-block;
   z-index: 75;
}
#usuarios_areasLine11
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 52;
}
#usuarios_areasLine3
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 34;
}
#Layer1
{
   position: absolute;
   text-align: left;
   left: 67px;
   top: 1215px;
   width: 63px;
   height: 52px;
   z-index: 194;
}
#roles_detallesRadioButton13
{
   display: inline-block;
   z-index: 74;
}
#usuarios_areasLine12
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 54;
}
#usuarios_areasLine4
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 36;
}
#Layer2
{
   position: absolute;
   text-align: left;
   left: 5px;
   top: 1215px;
   width: 54px;
   height: 52px;
   z-index: 195;
}
#Line13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 26;
}
#wb_Image3
{
   display: inline-block;
   width: 142px;
   height: 118px;
   z-index: 12;
}
#roles_detallesRadioButton14
{
   display: inline-block;
   z-index: 79;
}
#usuarios_areasTable1
{
   display: table;
   width: 100%;
   height: 28px;
   z-index: 53;
}
#usuarios_areasLine5
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 37;
}
#usuarios_areasEditbox1
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 35;
}
#Line14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 27;
}
#wb_Image4
{
   display: inline-block;
   width: 743px;
   height: 147px;
   z-index: 13;
}
#wb_FontAwesomeIcon8
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 134;
}
#roles_detallesRadioButton15
{
   display: inline-block;
   z-index: 78;
}
#usuarios_areasLine6
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 39;
}
#Line15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 29;
}
#wb_FontAwesomeIcon9
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 135;
}
#Line16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 127;
}
#roles_detallesRadioButton16
{
   display: inline-block;
   z-index: 77;
}
#usuarios_areasLine7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 40;
}
#wb_roles_detallesRadioButton20
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 80;
}
#roles_detallesRadioButton17
{
   display: inline-block;
   z-index: 76;
}
#distritosLine1
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 55;
}
#usuarios_areasLine8
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 42;
}
#roles_detallesRadioButton18
{
   display: inline-block;
   z-index: 82;
}
#wb_roles_detallesRadioButton10
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 73;
}
#distritosLine2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 57;
}
#usuarios_areasLine9
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 43;
}
#roles_detallesRadioButton19
{
   display: inline-block;
   z-index: 81;
}
#wb_roles_detallesRadioButton11
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 72;
}
#distritosLine3
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 58;
}
#usuarios_areasCheckbox1
{
   display: inline-block;
   z-index: 50;
}
#roles_detallesRadioButton1
{
   display: inline-block;
   z-index: 83;
}
#wb_roles_detallesRadioButton1
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 83;
}
#wb_roles_detallesRadioButton12
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 75;
}
#distritosLine4
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 60;
}
#cuentagral
{
   display: inline-block;
   z-index: 48;
}
#sintomas_detallesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 130;
}
#Button1
{
   display: inline-block;
   width: 136px;
   height: 25px;
   z-index: 128;
}
#wb_roles_detallesRadioButton13
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 74;
}
#roles_detallesRadioButton2
{
   display: inline-block;
   z-index: 67;
}
#wb_roles_detallesRadioButton2
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 67;
}
#nomyapefir
{
   display: inline-block;
   z-index: 46;
}
#usuarios_areasCombobox1
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 41;
}
#Line2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 18;
}
#sintomas_detallesLine2
{
   display: block;
   width: 100%;
   height: 16px;
   z-index: 132;
}
#wb_roles_detallesRadioButton14
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 79;
}
#roles_detallesRadioButton3
{
   display: inline-block;
   z-index: 66;
}
#wb_roles_detallesRadioButton3
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 66;
}
#Line3
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 20;
}
#wb_ResponsiveMenu1
{
   display: inline-block;
   width: 100%;
   z-index: 14;
}
#wb_roles_detallesRadioButton15
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 78;
}
#roles_detallesRadioButton4
{
   display: inline-block;
   z-index: 65;
}
#wb_roles_detallesRadioButton4
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 65;
}
#roles_detallesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 61;
}
#Combobox1
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 59;
}
#Line4
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 21;
}
#wb_roles_detallesRadioButton16
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 77;
}
#roles_detallesRadioButton5
{
   display: inline-block;
   z-index: 64;
}
#wb_roles_detallesRadioButton5
{
   display: inline-block;
   width: 20px;
   height: 20px;
   z-index: 64;
}
#roles_detallesTable1
{
   display: table;
   width: 100%;
   height: 170px;
   z-index: 85;
}
#roles_detallesLine2
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 63;
}
#Line5
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 23;
}
@media only screen and (min-width: 1024px)
{
div#container
{
   width: 1024px;
}
#usuarios_areasLine7
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
#usuarios_areasLine11
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
#usuarios_areasTable1
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
#usuarios_areasTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   line-height: 16px;
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
   left: 283px;
   top: -338px;
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
   background-color: #DCDCDC;
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
   background-color: #DCDCDC;
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
#wb_usuarios_areasLayoutGrid1
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
#wb_usuarios_areasLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#usuarios_areasLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#usuarios_areasEditbox1
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
#wb_usuarios_areasText1
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
#usuarios_areasLine1
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
#usuarios_areasLine2
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
#usuarios_areasLine3
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
#usuarios_areasLine4
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
#wb_usuarios_areasLayoutGrid2
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
#wb_usuarios_areasLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#usuarios_areasLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_usuarios_areasText2
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
#usuarios_areasLine5
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
#usuarios_areasLine6
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
#usuarios_areasLine8
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
#wb_usuarios_areasLayoutGrid3
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
#wb_usuarios_areasLayoutGrid3
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid3
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid3 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid3 .col-1, #usuarios_areasLayoutGrid3 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid3 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#usuarios_areasLayoutGrid3 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_usuarios_areasText3
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
#usuarios_areasLine9
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
#usuarios_areasLine10
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
#usuarios_areasLine12
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
#wb_usuarios_areasText5
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
#wb_usuarios_areasText6
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
#wb_usuarios_areasCheckbox1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::before
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_usuarios_areasCheckbox2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox2 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox2 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox2 input[type='checkbox']:checked + label::before
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_usuarios_areasCheckbox3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox3 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox3 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox3 input[type='checkbox']:checked + label::before
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_distritosLayoutGrid1
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
#wb_distritosLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#distritosLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#distritosLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#distritosLayoutGrid1 .col-1, #distritosLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#distritosLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#distritosLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_distritosText1
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
#distritosLine1
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
#distritosLine2
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
#distritosLine3
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
#distritosLine4
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
#Combobox1
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
#wb_roles_detallesLayoutGrid1
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
#wb_roles_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#roles_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#roles_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#roles_detallesLayoutGrid1 .col-1, #roles_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#roles_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#roles_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_roles_detallesText1
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
#roles_detallesLine1
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
#roles_detallesLine2
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
#roles_detallesLine3
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
#roles_detallesLine4
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
#roles_detallesTable1
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
#roles_detallesTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#roles_detallesTable1 .cell1
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   line-height: 16px;
}
#roles_detallesTable1 .cell2
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: center;
   line-height: 16px;
}
#wb_roles_detallesRadioButton5
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton5 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton5 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton5 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton5 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton4
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton4 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton4 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton4 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton4 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton3
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton3 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton3 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton3 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton3 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton2
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton2 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton2 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton2 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton2 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton9
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton9 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton9 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton9 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton9 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton8
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton8 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton8 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton8 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton8 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton7
{
   width: 19px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton7 input[type='radio']
{
   width: 19px;
   height: 19px;
}
#wb_roles_detallesRadioButton7 label::before
{
   width: 19px;
   height: 19px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton7 label::after
{
   width: 19px;
   height: 19px;
   line-height: 19px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton7 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton6
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton6 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton6 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton6 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton6 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton11
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton11 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton11 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton11 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton11 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton10
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton10 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton10 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton10 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton10 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton13
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton13 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton13 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton13 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton13 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton12
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton12 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton12 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton12 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton12 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton17
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton17 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton17 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton17 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton17 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton16
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton16 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton16 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton16 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton16 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton15
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton15 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton15 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton15 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton15 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton14
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton14 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton14 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton14 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton14 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton20
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton20 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton20 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton20 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton20 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton19
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton19 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton19 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton19 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton19 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton18
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton18 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton18 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton18 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton18 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_roles_detallesRadioButton1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_roles_detallesRadioButton1 input[type='radio']
{
   width: 20px;
   height: 20px;
}
#wb_roles_detallesRadioButton1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_roles_detallesRadioButton1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
   color: #FFFFFF;
}
#wb_roles_detallesRadioButton1 input[type='radio']:checked + label::after
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
#wb_LayoutGrid7
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
#wb_LayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid7 .col-1, #LayoutGrid7 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid7 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
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
#Line16
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
#Line11
{
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
#wb_sintomas_detallesLayoutGrid1
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
#wb_sintomas_detallesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#sintomas_detallesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#sintomas_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#sintomas_detallesLayoutGrid1 .col-1, #sintomas_detallesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#sintomas_detallesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#sintomas_detallesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#sintomas_detallesLine1
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
#wb_sintomas_detallesText1
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
#sintomas_detallesLine2
{
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
#wb_LayoutGrid9
{
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
#wb_LayoutGrid9
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid9
{
   padding: 15px 15px 15px 15px;
}
#LayoutGrid9 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid9 .col-1, #LayoutGrid9 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid9 .col-1
{
   display: block;
   width: 50%;
   text-align: center;
}
#LayoutGrid9 .col-2
{
   display: block;
   width: 50%;
   text-align: center;
}
#wb_Text8
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
#wb_FontAwesomeIcon8
{
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
#FontAwesomeIcon8
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon8 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon9
{
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
#FontAwesomeIcon9
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon9 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon10
{
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
#FontAwesomeIcon10
{
   width: 32px;
   height: 22px;
}
#FontAwesomeIcon10 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon11
{
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
#FontAwesomeIcon11
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon11 i
{
   line-height: 22px;
   font-size: 22px;
}
}
@media only screen and (min-width: 980px) and (max-width: 1023px)
{
div#container
{
   width: 980px;
}
#usuarios_areasTable1
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
#usuarios_areasTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   line-height: 16px;
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
   background-color: #DCDCDC;
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
   background-color: #DCDCDC;
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
#wb_usuarios_areasLayoutGrid1
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
#wb_usuarios_areasLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#usuarios_areasEditbox1
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
#wb_usuarios_areasText1
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
#usuarios_areasLine1
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
#usuarios_areasLine2
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
#usuarios_areasLine3
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
#usuarios_areasLine4
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
#wb_usuarios_areasLayoutGrid2
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
#wb_usuarios_areasLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_usuarios_areasCheckbox1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::before
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
#usuarios_areasTable1
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
#usuarios_areasTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   line-height: 16px;
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
   background-color: #DCDCDC;
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
   background-color: #DCDCDC;
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
#wb_usuarios_areasLayoutGrid1
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
#wb_usuarios_areasLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#usuarios_areasEditbox1
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
#wb_usuarios_areasText1
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
#usuarios_areasLine1
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
#usuarios_areasLine2
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
#usuarios_areasLine3
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
#usuarios_areasLine4
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
#wb_usuarios_areasLayoutGrid2
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
#wb_usuarios_areasLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_usuarios_areasCheckbox1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::before
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
#usuarios_areasTable1
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
#usuarios_areasTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   line-height: 16px;
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
   background-color: #DCDCDC;
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
   background-color: #DCDCDC;
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
#wb_usuarios_areasLayoutGrid1
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
#wb_usuarios_areasLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#usuarios_areasEditbox1
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
#wb_usuarios_areasText1
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
#usuarios_areasLine1
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
#usuarios_areasLine2
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
#usuarios_areasLine3
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
#usuarios_areasLine4
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
#wb_usuarios_areasLayoutGrid2
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
#wb_usuarios_areasLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_areasLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_usuarios_areasCheckbox1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::before
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
#usuarios_areasTable1
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
#usuarios_areasTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   line-height: 16px;
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
   background-color: #DCDCDC;
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
   background-color: #DCDCDC;
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
#wb_usuarios_areasLayoutGrid1
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
#wb_usuarios_areasLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_areasLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_areasEditbox1
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
#wb_usuarios_areasText1
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
#usuarios_areasLine1
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
#usuarios_areasLine2
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
#usuarios_areasLine3
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
#usuarios_areasLine4
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
#wb_usuarios_areasLayoutGrid2
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
#wb_usuarios_areasLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_areasLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_usuarios_areasCheckbox1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::before
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
#usuarios_areasTable1
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
#usuarios_areasTable1 .cell0
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   text-align: left;
   line-height: 16px;
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
   background-color: #DCDCDC;
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
   background-color: #DCDCDC;
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
#wb_usuarios_areasLayoutGrid1
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
#wb_usuarios_areasLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid1 .col-1, #usuarios_areasLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_areasLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_areasEditbox1
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
#wb_usuarios_areasText1
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
#usuarios_areasLine1
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
#usuarios_areasLine2
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
#usuarios_areasLine3
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
#usuarios_areasLine4
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
#wb_usuarios_areasLayoutGrid2
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
#wb_usuarios_areasLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_areasLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#usuarios_areasLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_areasLayoutGrid2 .col-1, #usuarios_areasLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_areasLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_areasLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_usuarios_areasCheckbox1
{
   width: 20px;
   height: 20px;
   visibility: visible;
   display: inline-block;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']
{
   width: 20px;
   height: 20px;
}
#wb_usuarios_areasCheckbox1 label::before
{
   width: 20px;
   height: 20px;
   border-color: #CCCCCC;
}
#wb_usuarios_areasCheckbox1 label::after
{
   width: 20px;
   height: 20px;
   line-height: 20px;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::after
{
   color: #FFFFFF;
}
#wb_usuarios_areasCheckbox1 input[type='checkbox']:checked + label::before
{
   background-color: #3370B7;
   background-image: none;
   border-color: #3370B7;
}
}
</style>


<script type = "text/javascript">
    function handleFiles1(files) {
      var d = document.getElementById("fileList1");
      
      if (!files.length) {
        d.innerHTML = "<p></p>";
      } else {
        d.innerHTML = "<p></p>";
        var list = document.createElement("p");
        
        d.appendChild(list);

		for (var i=0; i < files.length; i++) {
          var li = document.createElement("span");
		  list.appendChild(li);
          
          var img = document.createElement("img");
          img.src = window.URL.createObjectURL(files[i]);;
          img.height = 168;
          img.width = 259;
          img.onload = function() {
            window.URL.revokeObjectURL(this.src);
          }
          
          li.appendChild(img);
          
          var info = document.createElement("span");
          info.innerHTML = '' ;
          li.appendChild(info);
          
          window.document.formuabm.tamano1.value=files[i].size;
          window.document.formuabm.tipo1.value=files[i].type;
        }
      }
    } 

    function handleFiles2(files) {
      var d = document.getElementById("fileList2");
      
      if (!files.length) {
        d.innerHTML = "<p></p>";
      } else {
        d.innerHTML = "<p></p>";
        var list = document.createElement("p");
        
        d.appendChild(list);

		for (var i=0; i < files.length; i++) {
          var li = document.createElement("span");
		  list.appendChild(li);
          
          var img = document.createElement("img");
          img.src = window.URL.createObjectURL(files[i]);;
          img.height = 168;
          img.width = 259;
          img.onload = function() {
            window.URL.revokeObjectURL(this.src);
          }
          
          li.appendChild(img);
          
          var info = document.createElement("span");
          info.innerHTML = '' ;
          li.appendChild(info);
          
          window.document.formuabm.tamano2.value=files[i].size;
          window.document.formuabm.tipo2.value=files[i].type;
        }
      }
    }
</script>

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

function verificaarti()
{ 
        okay='SI';
        inix=window.document.formu.n_recibo_ini.value;
        finx=window.document.formu.n_recibo_fin.value;
        actx=window.document.formu.n_recibo.value;
        msgx=window.document.formu.np_mensaje.value;
     
        if(inix=='' && finx=='')
           {
            okay='SI';
           }
        else
           {
             inix=parseInt(inix);   
             finx=parseInt(finx);
             actx=parseInt(actx);
             msgx=parseInt(msgx);
        
            if(inix>0 && finx>0)
              {
               okay='SI'; 
              }
            else
              {
               okay='NO'; 
              }
           }      
     
     	if ( window.document.formu.codservicio.value == ""  || okay=='NO') 
		    {  
		     if(window.document.formu.codservicio.value == "") 
                {
                window.document.formu.codservicio.style.backgroundColor='yellow'; 
                }
             else
                {
                window.document.formu.codservicio.style.backgroundColor='white'; 
                }                 

		     if(okay=='NO') 
                {
                window.document.formu.n_recibo_ini.style.backgroundColor='yellow'; 
                window.document.formu.n_recibo_fin.style.backgroundColor='yellow'; 
                }
             else
                {
                window.document.formu.n_recibo_ini.style.backgroundColor='white'; 
                window.document.formu.n_recibo_fin.style.backgroundColor='white'; 
                } 
                                               
           	 //entonces (no algo esta en blanco) devuelvo el valor cadena vacia 
           	 swal("","Los datos obligatorios no deben estar en blanco (Debe indicar el Establecimiento) y los Valores deben ser coherentes","warning");
			return false;
     	    }
            window.document.formu.submit();  
}

function validarnros() 
{  
 inix=window.document.formu.n_recibo_ini.value;
 finx=window.document.formu.n_recibo_fin.value;
 actx=window.document.formu.n_recibo.value;
 msgx=window.document.formu.np_mensaje.value;

//alert(' ini: '+inix+' fin: '+finx+' act: '+actx+' msg: '+msgx)
 if(inix=='' || finx=='')
    {
     //alert('Debe indicar primeramente los Nros. inicial y final');   
     window.document.formu.n_recibo.value='';
     window.document.formu.np_mensaje.value='';
    }
 else   
    {
     inix=parseInt(inix);   
     finx=parseInt(finx);
     actx=parseInt(actx);
     msgx=parseInt(msgx);
        
     if(inix > finx)
        {
         swal("","Nro. Inicial no puede ser mayor que Nro. Final","warning");
         window.document.formu.n_recibo_fin.value='';
   
        }
     else
        {
         if(actx>0)
            {
             if(actx<inix || actx>finx)
                {
                 swal("","Nro. Actual debe estar entre los Nros. Inicial y Final","warning");
                 window.document.formu.n_recibo.value='';  
 
                }   
            }
         else
            {
             window.document.formu.n_recibo.value='';   
            }      
         if(msgx>0)
            {
             if(msgx<inix || msgx>finx)
                {
                 swal("","Nro. Para Emitir Mensaje debe estar entre los Nros. Inicial y Final","warning");
                 window.document.formu.np_mensaje.value=''; 
                }   
            }
         else
            {
            window.document.formu.np_mensaje.value='';    
            }         
        }   
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
					</strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>ACTUALIZAR CONFIGURACION GENERAL</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><br />
					<br />
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<form name="formu" method="post" action="insertar_configuracion_gral.php" enctype="multipart/form-data">

    <div id="wb_LayoutGrid4">
    	<div id="LayoutGrid4">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line2"/>
    				<div id="wb_Text2">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Establecimiento: </strong></span>
    				</div>
    				<hr id="Line3"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line4"/>
                    <select name="codservicio" size="1" id="codservicio" >
    					<option value=""></option>
                        <?php
            			$tabla_dpto = pg_query($link, "select * from establecimientos order by codservicio");
            			while($depto = pg_fetch_array($tabla_dpto)) 
            			{
            		       if($depto["codservicio"]==$codservicio)
                             {//Para que ponga predeterminado el que hay guardado
                             ?>
            		          <option value = "<?php echo $depto['codservicio']; ?>" selected="" > 
            	              <?php echo $depto['nomservicio']; ?></option>
                              <?php 
            			  	  }
                              else
            				  {?>
            		          <option value = "<?php echo $depto['codservicio']; ?>" > 
            		          <?php echo $depto['nomservicio']; ?></option>
                              <?php
            				  }?> 
                        <?php
            			}
            			?>
    				</select>
                    
    				<hr id="Line5"/>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div id="wb_LayoutGrid4">
    	<div id="LayoutGrid4">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line2"/>
    				<div id="wb_Text2">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Director: </strong></span>
    				</div>
    				<hr id="Line3"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line4"/>
                    <input type="text" class="form-control" placeholder="" name="director" id="director" size="100" maxlength="150" value="<?php echo $director; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line5"/>
    			</div>
    		</div>
    	</div>
    </div>    

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Cargo: </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="cargodir" id="cargodir" size="100" maxlength="100" value="<?php echo $cargodir; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nombre segundo firmante: </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="nomyapefir" id="nomyapefir" size="100" maxlength="150" value="<?php echo $nomyapefir; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 
    
    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Decreto </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="decreto" id="decreto" size="100" maxlength="100" value="<?php echo $decreto; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div>     

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>R.U.C. </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="ruc" id="ruc" size="50" maxlength="50" value="<?php echo $ruc; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div>     
    
    
    <div id="wb_LayoutGrid6b">
       <hr style="color: #CCCCCC;" />
    </div> 
    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>C&oacute;digo de Cuenta General: </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="cuentagral" id="cuentagral" size="100" maxlength="100" value="<?php echo $cuentagral; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Denominaci&oacute;n de la Cuenta: </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="nomctagral" id="nomctagral" size="100" maxlength="200" value="<?php echo $nomctagral; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 
  
    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nombre del Depositante: </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="nomyapedep" id="nomyapedep" size="100" maxlength="150" value="<?php echo $nomyapedep; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Concepto: </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="concepto" id="concepto" size="100" maxlength="200" value="<?php echo $concepto; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 
    
    <div id="wb_LayoutGrid6b">
       <hr style="color: #CCCCCC;" />
    </div>   
    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nro. Recibo Inicial </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="n_recibo_ini" id="n_recibo_ini" size="10" maxlength="10" value="<?php echo $n_recibo_ini; ?>" onkeypress="return validarnum(event)" spellcheck="false" onchange="validarnros();"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nro. Recibo Final </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="n_recibo_fin" id="n_recibo_fin" size="10" maxlength="10" value="<?php echo $n_recibo_fin; ?>" onkeypress="return validarnum(event)" spellcheck="false" onchange="validarnros();"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Serie </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="serie" id="serie" size="10" maxlength="10" value="<?php echo $serie; ?>" onkeypress="return validarcar(event)" spellcheck="false"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nro. Recibo Actual </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="n_recibo" id="n_recibo" size="10" maxlength="10" value="<?php echo $n_recibo; ?>" onkeypress="return validarnum(event)" spellcheck="false"  onchange="validarnros();"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 

    <div id="wb_LayoutGrid6b">
    	<div id="LayoutGrid6b">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7b"/>
    				<div id="wb_Text4b">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nro. p/Emitir mensaje </strong></span>
    				</div>
    				<hr id="Line13b"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14b"/>
                    
                    <input type="text" class="form-control" placeholder="" name="np_mensaje" id="np_mensaje" size="10" maxlength="10" value="<?php echo $np_mensaje; ?>" onkeypress="return validarnum(event)" spellcheck="false"  onchange="validarnros();"/>
                    
    				<hr id="Line15b"/>
    			</div>
    		</div>
    	</div>
    </div> 


    <div id="wb_LayoutGrid6b">
       <hr style="color: #CCCCCC;" />
    </div> 
    <div id="wb_LayoutGrid6">
    	<div id="LayoutGrid6">
    		<div class="row">
    			<div class="col-1">
    				<hr id="Line7"/>
    				<div id="wb_Text4">
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Firma Director: </strong></span>
    				</div>
    				<hr id="Line13"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14"/>
               <!--     <input type="text" class="form-control" placeholder="" id="archivo1" name="archivo1" size="30" maxlength="30" value="<?php echo $archivo1;?>" onkeypress="return validarcar(event)" spellcheck="false"/> -->
                    
 							<div id="wb_PhotoGallery1">
								<table id="PhotoGallery1">
								<tr>
									<td class="figure" style="width:200px;height:135px" align="center"> 
									    	
									<input type="file" class="form-control" id="archivo1" multiple accept="image/*" onchange="handleFiles1(this.files)" name="archivo1"/>
				                    								
				                    <br />
									<table border="1" width="200px" style="border: blue;">
				                    <tr>
				                    <td width="200px" height="135px">
									
									  <div id="fileList1" >
				    					<p></p>
				  					 </div>
				                    
				                    </td>
				                    </tr>
				                    </table>
										
									</td>
								</tr>
								</table>
							</div>                    
                    
    				<hr id="Line15"/>
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
    					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Firma 2do. firmante: </strong></span>
    				</div>
    				<hr id="Line13"/>
    			</div>
    			<div class="col-2">
    				<hr id="Line14"/>
               <!--     <input type="text" class="form-control" placeholder="" id="archivo1" name="archivo1" size="30" maxlength="30" value="<?php echo $archivo1;?>" onkeypress="return validarcar(event)" spellcheck="false"/> -->
                    
 							<div id="wb_PhotoGallery1">
								<table id="PhotoGallery1">
								<tr>
									<td class="figure" style="width:200px;height:135px" align="center"> 
									    	
									<input type="file" class="form-control" id="archivo2" multiple accept="image/*" onchange="handleFiles2(this.files)" name="archivo2"/>
				                    								
				                    <br />
									<table border="1" width="200px" style="border: blue;">
				                    <tr>
				                    <td width="200px" height="135px">
									
									  <div id="fileList2" >
				    					<p></p>
				  					 </div>
				                    
				                    </td>
				                    </tr>
				                    </table>
										
									</td>
								</tr>
								</table>
							</div>                    
                    
    				<hr id="Line15"/>
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
				<input type="button" id="Button1" onclick="verificaarti()" name="guardar" value="Guardar Datos"/>
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
					<span style="color:#FF0000;font-family:Arial;font-size:13px;">[&nbsp;<a href="#" onclick="window.location.href='configuracion_gral.php';"> VOLVER </a>&nbsp;]</span>
                    
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
    window.document.formu.archivo1.style.backgroundColor='yellow';
    window.document.formu.archivo2.style.backgroundColor='yellow';
     swal('','La imagen seleccionada debe ser JPG de hasta 500 Kb!','error');
     </script>"; 
    }
if ($_GET["mensage2"]==1)
    {
	echo "<script type=''>
    window.document.formu.codservicio.style.backgroundColor='yellow';
     swal('','Ya existe otro registro Para ese establecimiento!','error');
     </script>"; 
    }

    
?>

<script type="text/javascript" src="js/script.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
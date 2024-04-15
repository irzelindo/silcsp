<?php
@Header("Content-type: text/html; charset=iso-8859-1");
session_start();

include("conexion.php");
$link=Conectarse();

$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

$query = "select *
from usuarios u
where u.codusu = '$codusu'";

$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$elusuario=$nomyape;


if($_SESSION['usuario'] != "SI")
{
	header("Location: index.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="shortcut icon" href="favicon.ico"/>

<!------------ CSS ----------->

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

<!----------- PARA MODAL  ---------->
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

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
#Line14
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#desde
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
#desde:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#ci
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
#ci:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#coddgvs
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
#coddgvs:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#nomyape
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
#nomyape:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#Line4
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
#Line9
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
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid7 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
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
#Line10
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
#Line12
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line16
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#hasta
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
#hasta:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_listas_ordenesLayoutGrid1
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
#listas_ordenesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#listas_ordenesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
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
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   float: left;
}
#listas_ordenesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#listas_ordenesLayoutGrid1:before,
#listas_ordenesLayoutGrid1:after,
#listas_ordenesLayoutGrid1 .row:before,
#listas_ordenesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#listas_ordenesLayoutGrid1:after,
#listas_ordenesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_listas_ordenesText1
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_listas_ordenesText1 div
{
   text-align: left;
}
#listas_ordenesLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#listas_ordenesLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#listas_ordenesLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#listas_ordenesLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#listas_ordenesCombobox1
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
#listas_ordenesCombobox1:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
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
#codorigen
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
#codorigen:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#codservder
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
#codservder:focus
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
#codestudio
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
#codestudio:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_listas_ordenesLayoutGrid2
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
#listas_ordenesLayoutGrid2
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#listas_ordenesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
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
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   float: left;
}
#listas_ordenesLayoutGrid2 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid2 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#listas_ordenesLayoutGrid2:before,
#listas_ordenesLayoutGrid2:after,
#listas_ordenesLayoutGrid2 .row:before,
#listas_ordenesLayoutGrid2 .row:after
{
   display: table;
   content: " ";
}
#listas_ordenesLayoutGrid2:after,
#listas_ordenesLayoutGrid2 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_listas_ordenesText2
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_listas_ordenesText2 div
{
   text-align: left;
}
#listas_ordenesLine5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#listas_ordenesLine6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#listas_ordenesLine7
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#listas_ordenesLine8
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
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
#wb_usuarios_detallesLayoutGrid7
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
#usuarios_detallesLayoutGrid7
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#usuarios_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
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
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   float: left;
}
#usuarios_detallesLayoutGrid7 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_detallesLayoutGrid7 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#usuarios_detallesLayoutGrid7:before,
#usuarios_detallesLayoutGrid7:after,
#usuarios_detallesLayoutGrid7 .row:before,
#usuarios_detallesLayoutGrid7 .row:after
{
   display: table;
   content: " ";
}
#usuarios_detallesLayoutGrid7:after,
#usuarios_detallesLayoutGrid7 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_usuarios_detallesText7
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_usuarios_detallesText7 div
{
   text-align: left;
}
#usuarios_detallesLine23
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_detallesLine24
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#usuarios_detallesLine25
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#page1Combobox2
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
#page1Combobox2:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_estadistica_pacientesText1
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_estadistica_pacientesText1 div
{
   text-align: left;
}
#estadistica_pacientesLine1
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#estadistica_pacientesLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#estadistica_pacientesLine3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#estadistica_pacientesLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#estadistica_pacientesCombobox1
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
#estadistica_pacientesCombobox1:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}
#wb_estadistica_pacientesLayoutGrid1
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
#estadistica_pacientesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#estadistica_pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
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
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   float: left;
}
#estadistica_pacientesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#estadistica_pacientesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#estadistica_pacientesLayoutGrid1:before,
#estadistica_pacientesLayoutGrid1:after,
#estadistica_pacientesLayoutGrid1 .row:before,
#estadistica_pacientesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#estadistica_pacientesLayoutGrid1:after,
#estadistica_pacientesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_LayoutGrid8
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
#LayoutGrid8
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#LayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
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
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   float: left;
}
#LayoutGrid8 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid8 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#LayoutGrid8:before,
#LayoutGrid8:after,
#LayoutGrid8 .row:before,
#LayoutGrid8 .row:after
{
   display: table;
   content: " ";
}
#LayoutGrid8:after,
#LayoutGrid8 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   float: none;
   width: 100%;
}
}
#Line17
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#Line18
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_reporte_bitacoraImage1
{
   vertical-align: top;
}
#reporte_bitacoraImage1
{
   border: 0px #000000 solid;
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 0px 0px 0px;
   display: inline-block;
   width: 192px;
   height: 41px;
   vertical-align: top;
}
#wb_reporte_bitacoraImage2
{
   vertical-align: top;
}
#reporte_bitacoraImage2
{
   border: 0px #000000 solid;
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 0px 0px 0px;
   display: inline-block;
   width: 192px;
   height: 44px;
   vertical-align: top;
}
#reporte_bitacoraLine2
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#reporte_bitacoraLine1
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
#wb_FontAwesomeIcon5
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   margin: 0px 10px 0px 0px;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon5:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon5
{
   height: 22px;
   width: 22px;
}
#FontAwesomeIcon5 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 22px;
   line-height: 22px;
   vertical-align: middle;
   width: 12px;
}
#wb_FontAwesomeIcon5:hover i
{
   color: #FFFF00;
}
#wb_FontAwesomeIcon6
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   margin: 0px 10px 0px 0px;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon6:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon6
{
   height: 22px;
   width: 22px;
}
#FontAwesomeIcon6 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 22px;
   line-height: 22px;
   vertical-align: middle;
   width: 20px;
}
#wb_FontAwesomeIcon6:hover i
{
   color: #FFFF00;
}
#wb_FontAwesomeIcon8
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
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
   width: 32px;
}
#FontAwesomeIcon8 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 22px;
   line-height: 22px;
   vertical-align: middle;
   width: 18px;
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
   width: 18px;
}
#wb_FontAwesomeIcon9:hover i
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
#usuarios_detallesLine24
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 52;
}
#codestudio
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 40;
}
#empresas_detallesLine14
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 38;
}
#Line6
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 31;
}
#desde
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}
#ci
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}
#ci
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}

#coddgvs
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}
#coddgvs
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}

#nomyape
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
}
#nomyape
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 16;
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
#usuarios_detallesLine25
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 50;
}
#empresas_detallesLine15
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 39;
}
#hasta
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 23;
}
#Line7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 12;
}
#estadistica_pacientesLine1
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 53;
}
#empresas_detallesLine16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 41;
}
#Line8
{
   display: block;
   width: 100%;
   height: 12px;
   z-index: 35;
}
#listas_ordenesLine1
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 25;
}
#Line10
{
   display: block;
   width: 100%;
   height: 11px;
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
   z-index: 18;
}
#reporte_bitacoraLine1
{
   display: block;
   width: 100%;
   height: 9px;
   z-index: 63;
}
#estadistica_pacientesLine2
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 55;
}
#page1Combobox2
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 51;
}
#listas_ordenesLine2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 27;
}
#Line11
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 21;
}
#Line9
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 3;
}
#wb_FontAwesomeIcon5
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 66;
}
#wb_reporte_bitacoraImage1
{
   display: inline-block;
   width: 192px;
   height: 41px;
   z-index: 60;
}
#reporte_bitacoraLine2
{
   display: block;
   width: 100%;
   height: 9px;
   z-index: 59;
}
#estadistica_pacientesLine3
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 56;
}
#listas_ordenesLine3
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 28;
}
#Line12
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 22;
}
#Layer1
{
   position: absolute;
   text-align: left;
   left: 99px;
   top: 1350px;
   width: 63px;
   height: 52px;
   z-index: 70;
}
#wb_FontAwesomeIcon6
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 67;
}
#wb_reporte_bitacoraImage2
{
   display: inline-block;
   width: 192px;
   height: 44px;
   z-index: 64;
}
#estadistica_pacientesLine4
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 58;
}
#listas_ordenesLine4
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 30;
}
#Layer2
{
   position: absolute;
   text-align: left;
   left: 25px;
   top: 1350px;
   width: 54px;
   height: 52px;
   z-index: 71;
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
#listas_ordenesLine5
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 42;
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
   width: 32px;
   height: 22px;
   text-align: center;
   z-index: 69;
}
#listas_ordenesLine6
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 44;
}
#listas_ordenesCombobox1
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 29;
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
   z-index: 68;
}
#codsector
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 46;
}
#listas_ordenesLine7
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 45;
}
#Line16
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 24;
}
#Line17
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 61;
}
#listas_ordenesLine8
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 47;
}
#Line18
{
   display: block;
   width: 100%;
   height: 90px;
   z-index: 62;
}
#estadistica_pacientesCombobox1
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 57;
}
#Line1
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 33;
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
#wb_ResponsiveMenu1
{
   display: inline-block;
   width: 100%;
   z-index: 2;
}
#Combobox1
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 10;
}
#Line4
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 9;
}
#usuarios_detallesLine23
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 48;
}
#empresas_detallesLine13
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 36;
}
#codorigen
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 34;
}

#codservder
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 34;
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
#desde
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
#ci
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
   left: 273px;
   top: -2px;
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
   text-align: center;
}
#LayoutGrid7 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
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
#Line10
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
#Line12
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
#hasta
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
#wb_listas_ordenesLayoutGrid1
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
#wb_listas_ordenesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#listas_ordenesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_listas_ordenesText1
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
#listas_ordenesLine1
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
#listas_ordenesLine2
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
#listas_ordenesLine3
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
#listas_ordenesLine4
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
#listas_ordenesCombobox1
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
#codorigen
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

#codservder
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
#codestudio
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
#wb_listas_ordenesLayoutGrid2
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
#wb_listas_ordenesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#listas_ordenesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_listas_ordenesText2
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
#listas_ordenesLine5
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
#listas_ordenesLine6
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
#listas_ordenesLine7
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
#listas_ordenesLine8
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
#codsector
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
#wb_usuarios_detallesLayoutGrid7
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
#wb_usuarios_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#usuarios_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#usuarios_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_usuarios_detallesText7
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
#usuarios_detallesLine23
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
#usuarios_detallesLine24
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
#usuarios_detallesLine25
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
#page1Combobox2
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
#wb_estadistica_pacientesText1
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
#estadistica_pacientesLine1
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
#estadistica_pacientesLine2
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
#estadistica_pacientesLine3
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
#estadistica_pacientesLine4
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
#estadistica_pacientesCombobox1
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
#wb_estadistica_pacientesLayoutGrid1
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
#wb_estadistica_pacientesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#estadistica_pacientesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#estadistica_pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#estadistica_pacientesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: center;
}
#estadistica_pacientesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: center;
}
#wb_LayoutGrid8
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
#wb_LayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#Line17
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
#Line18
{
   height: 51px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#wb_reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
}
#wb_reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
}
#reporte_bitacoraLine2
{
   height: 9px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#reporte_bitacoraLine1
{
   height: 9px;
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon5
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
#FontAwesomeIcon5
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon5 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon6
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
#FontAwesomeIcon6
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon6 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon8
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
#FontAwesomeIcon8
{
   width: 32px;
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
}
@media only screen and (min-width: 980px) and (max-width: 1023px)
{
div#container
{
   width: 980px;
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
#desde
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
#ci
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

#coddgvs
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

#nomyape
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
#Line10
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
#Line12
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
#hasta
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
#wb_listas_ordenesLayoutGrid1
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
#wb_listas_ordenesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_listas_ordenesText1
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
#listas_ordenesLine1
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
#listas_ordenesLine2
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
#listas_ordenesLine3
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
#listas_ordenesLine4
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
#listas_ordenesCombobox1
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
#Combobox2
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
#codestudio
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
#wb_listas_ordenesLayoutGrid2
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
#wb_listas_ordenesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_listas_ordenesText2
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
#listas_ordenesLine5
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
#listas_ordenesLine6
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
#listas_ordenesLine7
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
#listas_ordenesLine8
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
#codsector
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
#wb_usuarios_detallesLayoutGrid7
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
#wb_usuarios_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#usuarios_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_usuarios_detallesText7
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
#usuarios_detallesLine23
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
#usuarios_detallesLine24
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
#usuarios_detallesLine25
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
#page1Combobox2
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
#wb_estadistica_pacientesText1
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
#estadistica_pacientesLine1
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
#estadistica_pacientesLine2
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
#estadistica_pacientesLine3
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
#estadistica_pacientesLine4
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
#estadistica_pacientesCombobox1
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
#wb_estadistica_pacientesLayoutGrid1
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
#wb_estadistica_pacientesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#estadistica_pacientesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#estadistica_pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#estadistica_pacientesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#estadistica_pacientesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_LayoutGrid8
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
#wb_LayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#Line17
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
#Line18
{
   height: 51px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#wb_reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
}
#wb_reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
}
#reporte_bitacoraLine2
{
   height: 9px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#reporte_bitacoraLine1
{
   height: 9px;
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon5
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
#FontAwesomeIcon5
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon5 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon6
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
#FontAwesomeIcon6
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon6 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon8
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
#FontAwesomeIcon8
{
   width: 32px;
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
}
@media only screen and (min-width: 800px) and (max-width: 979px)
{
div#container
{
   width: 800px;
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
#desde
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
#ci
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
#Line10
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
#Line12
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
#hasta
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
#wb_listas_ordenesLayoutGrid1
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
#wb_listas_ordenesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_listas_ordenesText1
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
#listas_ordenesLine1
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
#listas_ordenesLine2
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
#listas_ordenesLine3
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
#listas_ordenesLine4
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
#listas_ordenesCombobox1
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
#codorigen
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

#codservder
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
#codestudio
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
#wb_listas_ordenesLayoutGrid2
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
#wb_listas_ordenesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_listas_ordenesText2
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
#listas_ordenesLine5
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
#listas_ordenesLine6
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
#listas_ordenesLine7
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
#listas_ordenesLine8
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
#codsector
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
#wb_usuarios_detallesLayoutGrid7
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
#wb_usuarios_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#usuarios_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_usuarios_detallesText7
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
#usuarios_detallesLine23
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
#usuarios_detallesLine24
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
#usuarios_detallesLine25
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
#page1Combobox2
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
#wb_estadistica_pacientesText1
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
#estadistica_pacientesLine1
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
#estadistica_pacientesLine2
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
#estadistica_pacientesLine3
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
#estadistica_pacientesLine4
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
#estadistica_pacientesCombobox1
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
#wb_estadistica_pacientesLayoutGrid1
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
#wb_estadistica_pacientesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#estadistica_pacientesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#estadistica_pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#estadistica_pacientesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#estadistica_pacientesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_LayoutGrid8
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
#wb_LayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#Line17
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
#Line18
{
   height: 51px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#wb_reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
}
#wb_reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
}
#reporte_bitacoraLine2
{
   height: 9px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#reporte_bitacoraLine1
{
   height: 9px;
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon5
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
#FontAwesomeIcon5
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon5 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon6
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
#FontAwesomeIcon6
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon6 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon8
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
#FontAwesomeIcon8
{
   width: 32px;
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
}
@media only screen and (min-width: 768px) and (max-width: 799px)
{
div#container
{
   width: 768px;
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
#desde
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
#ci
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

#coddgvs
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

#nomyape
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
#Line10
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
#Line12
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
#hasta
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
#wb_listas_ordenesLayoutGrid1
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
#wb_listas_ordenesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_listas_ordenesText1
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
#listas_ordenesLine1
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
#listas_ordenesLine2
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
#listas_ordenesLine3
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
#listas_ordenesLine4
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
#listas_ordenesCombobox1
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
#codorigen
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


#codservder
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
#codestudio
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
#wb_listas_ordenesLayoutGrid2
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
#wb_listas_ordenesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid2 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#listas_ordenesLayoutGrid2 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_listas_ordenesText2
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
#listas_ordenesLine5
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
#listas_ordenesLine6
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
#listas_ordenesLine7
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
#listas_ordenesLine8
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
#codsector
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
#wb_usuarios_detallesLayoutGrid7
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
#wb_usuarios_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#usuarios_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#usuarios_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_usuarios_detallesText7
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
#usuarios_detallesLine23
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
#usuarios_detallesLine24
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
#usuarios_detallesLine25
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
#page1Combobox2
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
#wb_estadistica_pacientesText1
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
#estadistica_pacientesLine1
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
#estadistica_pacientesLine2
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
#estadistica_pacientesLine3
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
#estadistica_pacientesLine4
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
#estadistica_pacientesCombobox1
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
#wb_estadistica_pacientesLayoutGrid1
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
#wb_estadistica_pacientesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#estadistica_pacientesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#estadistica_pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#estadistica_pacientesLayoutGrid1 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#estadistica_pacientesLayoutGrid1 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#wb_LayoutGrid8
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
#wb_LayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid8 .col-1
{
   display: block;
   width: 33.33333333%;
   text-align: left;
}
#LayoutGrid8 .col-2
{
   display: block;
   width: 66.66666667%;
   text-align: left;
}
#Line17
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
#Line18
{
   height: 51px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#wb_reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
}
#wb_reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
   visibility: hidden;
   display: none;
}
#reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
}
#reporte_bitacoraLine2
{
   height: 9px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#reporte_bitacoraLine1
{
   height: 9px;
   visibility: visible;
   display: block;
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
   width: 100%;
   text-align: center;
}
#LayoutGrid9 .col-2
{
   display: block;
   width: 100%;
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
#wb_FontAwesomeIcon5
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
#FontAwesomeIcon5
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon5 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon6
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
#FontAwesomeIcon6
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon6 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon8
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
#FontAwesomeIcon8
{
   width: 32px;
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
}
@media only screen and (min-width: 480px) and (max-width: 767px)
{
div#container
{
   width: 480px;
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
#desde
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
#ci
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

#coddgvs
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

#nomyape
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
   width: 100%;
   text-align: left;
}
#LayoutGrid7 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
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
#Line10
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
#Line12
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
#hasta
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
#wb_listas_ordenesLayoutGrid1
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
#wb_listas_ordenesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#listas_ordenesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_listas_ordenesText1
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
#listas_ordenesLine1
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
#listas_ordenesLine2
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
#listas_ordenesLine3
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
#listas_ordenesLine4
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
#listas_ordenesCombobox1
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
#codorigen
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


#codservder
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
#codestudio
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
#wb_listas_ordenesLayoutGrid2
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
#wb_listas_ordenesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#listas_ordenesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_listas_ordenesText2
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
#listas_ordenesLine5
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
#listas_ordenesLine6
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
#listas_ordenesLine7
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
#listas_ordenesLine8
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
#codsector
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
#wb_usuarios_detallesLayoutGrid7
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
#wb_usuarios_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#usuarios_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_usuarios_detallesText7
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
#usuarios_detallesLine23
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
#usuarios_detallesLine24
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
#usuarios_detallesLine25
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
#page1Combobox2
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
#wb_estadistica_pacientesText1
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
#estadistica_pacientesLine1
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
#estadistica_pacientesLine2
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
#estadistica_pacientesLine3
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
#estadistica_pacientesLine4
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
#estadistica_pacientesCombobox1
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
#wb_estadistica_pacientesLayoutGrid1
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
#wb_estadistica_pacientesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#estadistica_pacientesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#estadistica_pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#estadistica_pacientesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#estadistica_pacientesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_LayoutGrid8
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
#wb_LayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid8 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid8 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#Line17
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
#Line18
{
   height: 51px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#wb_reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
}
#wb_reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
   visibility: hidden;
   display: none;
}
#reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
}
#reporte_bitacoraLine2
{
   height: 9px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#reporte_bitacoraLine1
{
   height: 9px;
   visibility: visible;
   display: block;
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
   width: 100%;
   text-align: center;
}
#LayoutGrid9 .col-2
{
   display: block;
   width: 100%;
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
#wb_FontAwesomeIcon5
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
#FontAwesomeIcon5
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon5 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon6
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
#FontAwesomeIcon6
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon6 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon8
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
#FontAwesomeIcon8
{
   width: 32px;
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
}
@media only screen and (max-width: 479px)
{
div#container
{
   width: 320px;
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
#desde
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
#ci
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

#coddgvs
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

#nomyape
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
   width: 100%;
   text-align: left;
}
#LayoutGrid7 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
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
#Line10
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
#Line12
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
#hasta
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
#wb_listas_ordenesLayoutGrid1
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
#wb_listas_ordenesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid1 .col-1, #listas_ordenesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#listas_ordenesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_listas_ordenesText1
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
#listas_ordenesLine1
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
#listas_ordenesLine2
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
#listas_ordenesLine3
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
#listas_ordenesLine4
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
#listas_ordenesCombobox1
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
#codorigen
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


#codservder
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
#codestudio
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
#wb_listas_ordenesLayoutGrid2
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
#wb_listas_ordenesLayoutGrid2
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#listas_ordenesLayoutGrid2
{
   padding: 0px 15px 0px 15px;
}
#listas_ordenesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#listas_ordenesLayoutGrid2 .col-1, #listas_ordenesLayoutGrid2 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#listas_ordenesLayoutGrid2 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#listas_ordenesLayoutGrid2 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_listas_ordenesText2
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
#listas_ordenesLine5
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
#listas_ordenesLine6
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
#listas_ordenesLine7
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
#listas_ordenesLine8
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
#codsector
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
#wb_usuarios_detallesLayoutGrid7
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
#wb_usuarios_detallesLayoutGrid7
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#usuarios_detallesLayoutGrid7
{
   padding: 0px 15px 0px 15px;
}
#usuarios_detallesLayoutGrid7 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#usuarios_detallesLayoutGrid7 .col-1, #usuarios_detallesLayoutGrid7 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#usuarios_detallesLayoutGrid7 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#usuarios_detallesLayoutGrid7 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_usuarios_detallesText7
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
#usuarios_detallesLine23
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
#usuarios_detallesLine24
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
#usuarios_detallesLine25
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
#page1Combobox2
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
#wb_estadistica_pacientesText1
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
#estadistica_pacientesLine1
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
#estadistica_pacientesLine2
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
#estadistica_pacientesLine3
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
#estadistica_pacientesLine4
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
#estadistica_pacientesCombobox1
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
#wb_estadistica_pacientesLayoutGrid1
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
#wb_estadistica_pacientesLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#estadistica_pacientesLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#estadistica_pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#estadistica_pacientesLayoutGrid1 .col-1, #estadistica_pacientesLayoutGrid1 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#estadistica_pacientesLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#estadistica_pacientesLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_LayoutGrid8
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
#wb_LayoutGrid8
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#LayoutGrid8
{
   padding: 0px 15px 0px 15px;
}
#LayoutGrid8 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#LayoutGrid8 .col-1, #LayoutGrid8 .col-2
{
   padding-right: 15px;
   padding-left: 15px;
}
#LayoutGrid8 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#LayoutGrid8 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#Line17
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
#Line18
{
   height: 51px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#wb_reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
   visibility: visible;
   display: inline-block;
}
#reporte_bitacoraImage1
{
   width: 192px;
   height: 41px;
}
#wb_reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
   visibility: hidden;
   display: none;
}
#reporte_bitacoraImage2
{
   width: 192px;
   height: 44px;
}
#reporte_bitacoraLine2
{
   height: 9px;
   visibility: visible;
   display: block;
   color: #A0A0A0;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
}
#reporte_bitacoraLine1
{
   height: 9px;
   visibility: visible;
   display: block;
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
   width: 100%;
   text-align: center;
}
#LayoutGrid9 .col-2
{
   display: block;
   width: 100%;
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
#wb_FontAwesomeIcon5
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
#FontAwesomeIcon5
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon5 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon6
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
#FontAwesomeIcon6
{
   width: 22px;
   height: 22px;
}
#FontAwesomeIcon6 i
{
   line-height: 22px;
   font-size: 22px;
}
#wb_FontAwesomeIcon8
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
#FontAwesomeIcon8
{
   width: 32px;
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

</style>
<script src="jquery-1.12.4.min.js"></script>
<script src="wb.stickylayer.min.js"></script>
<script src="affix.min.js"></script>
<script src="wb.carousel.min.js"></script>

<script>
var b = jQuery.noConflict();
b(document).ready(function()
{
   b("#Layer2").stickylayer({orientation: 2, position: [45, 50], delay: 500});
   var menuCarousel2Opts =
   {
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
   b("#menuCarousel2").carousel(menuCarousel2Opts);
   b("#menuCarousel2_back a").click(function()
   {
      b('#menuCarousel2').carousel('prev');
   });
   b("#menuCarousel2_next a").click(function()
   {
      b('#menuCarousel2').carousel('next');
   });
});
</script>

<script>
	$(document).ready(function(){

			$("#reporte1").click(function(){

				var ci     	= jQuery( "#ci" ).val();
				var coddgvs = jQuery( "#coddgvs" ).val();
				var nomyape = jQuery("#nomyape").val();
				var desde  	= jQuery("#desde").val();

				window.open('reporte_consulta_paciente.php?ci='+ci+'&coddgvs='+coddgvs+'&nomyape='+nomyape+'&desde='+desde, '_blank');

			});

			$("#reporte2").click(function(){

				var ci     	= jQuery( "#ci" ).val();
				var coddgvs = jQuery( "#coddgvs" ).val();
				var nomyape = jQuery("#nomyape").val();
				var desde  	= jQuery("#desde").val();

				window.open('reporte_consulta_paciente_excel.php?ci='+ci+'&coddgvs='+coddgvs+'&nomyape='+nomyape+'&desde='+desde, '_blank');

			});
	});
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
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br/>
					<br/>
					</strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>CONSULTA PACIENTE</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br/>
					</strong><br/>
					<br/>
					</span>
				</div>
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
					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nro. Cedula: </strong></span>
				</div>
				<hr id="Line3"/>
			</div>
			<d<div class="col-2">
				<hr id="Line14"/>
				<input type="text" id="ci" name="ci" value="" spellcheck="false"/>
				<hr id="Line15"/>
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
					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Id. DGVS: </strong></span>
				</div>
				<hr id="Line3"/>
			</div>
			<d<div class="col-2">
				<hr id="Line14"/>
				<input type="text" id="coddgvs" name="coddgvs" value="" spellcheck="false"/>
				<hr id="Line15"/>
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
					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Nombres: </strong></span>
				</div>
				<hr id="Line3"/>
			</div>
			<d<div class="col-2">
				<hr id="Line14"/>
				<input type="text" id="nomyape" name="nomyape" value="" spellcheck="false"/>
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
					<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Fecha Nacimiento: </strong></span>
				</div>
				<hr id="Line13"/>
			</div>
			<div class="col-2">
				<hr id="Line14"/>
				<input type="date" id="desde" name="desde" value="<?php echo $desde; ?>" spellcheck="false"/>
				<hr id="Line15"/>
			</div>
		</div>
	</div>
</div>
<div id="Layer2">
	<div id="wb_FontAwesomeIcon3">
		<div id="FontAwesomeIcon3">
            <a href="menu.php"><div id="FontAwesomeIcon3"><i class="fa fa-commenting-o">&nbsp;</i></div></a>
		</div>
	</div>
</div>

<div id="wb_LayoutGrid8">
	<div id="LayoutGrid8">
		<div class="row">
			<div class="col-1">
				<hr id="reporte_bitacoraLine2"/>
				<div id="wb_reporte_bitacoraImage1">
					<a href="#" id="reporte1"><img src="images/navegador.png" id="reporte_bitacoraImage1" alt=""/></a>
				</div>
				<hr id="Line17"/>
				<hr id="Line18"/>
			</div>
			<div class="col-2">
				<hr id="reporte_bitacoraLine1"/>
				<div id="wb_reporte_bitacoraImage2">
					<a href="#" id="reporte2"><img src="images/planilla.png" id="reporte_bitacoraImage2" alt=""/></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="wb_LayoutGrid9">
	<div id="LayoutGrid9">
		<div class="row">
			<div class="col-1">
				<div id="wb_Text8">
					<span style="color:#FFFFFF;font-family:Arial;font-size:13px;">© 2018 Laboratorio Central de Salud Pública. Todos los derechos reservados.<br/>
					Asunción, Paraguay</span>
				</div>
			</div>
			<div class="col-2">
				<div id="wb_FontAwesomeIcon5">
					<div id="FontAwesomeIcon5">
						<i class="fa fa-facebook-f">&nbsp;</i>
					</div>
				</div>
				<div id="wb_FontAwesomeIcon6">
					<div id="FontAwesomeIcon6">
						<i class="fa fa-twitter">&nbsp;</i>
					</div>
				</div>
				<div id="wb_FontAwesomeIcon9">
					<div id="FontAwesomeIcon9">
						<i class="fa fa-instagram">&nbsp;</i>
					</div>
				</div>
				<div id="wb_FontAwesomeIcon8">
					<div id="FontAwesomeIcon8">
						<i class="fa fa-youtube">&nbsp;</i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

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

if($row["codservicio"] != "")
{
	$codservicio1 = $row["codservicio"];
	$codservicio  = $row['codservicio'];
}
else
{
	if($_GET['codservicio'] != '')
	{
		$codservicio = $_GET['codservicio'];
		$codservicio1= "";
		$_SESSION['codservicio'] = "";
	}
	else
	{
		$codservicio = $_SESSION['codservicio'];
	}

}

if($_GET['codorigen'] != "")
{
	$codorigen = $_GET['codorigen'];
	$_SESSION['codorigen'] = "";
}
else
{
	$codorigen = $_SESSION['codorigen'];
}

if($_GET['codempresa'] != "")
{
	$codempresa = $_GET['codempresa'];
	$_SESSION['codempresa'] = "";
}
else
{
	$codempresa = $_SESSION['codempresa'];
}

if($_GET['codestudio'] != "")
{
	$codestudio = $_GET['codestudio'];
	$_SESSION['codestudio'] = "";
}
else
{
	$codestudio = $_SESSION['codestudio'];
}

if($_GET['codsector'] != "")
{
	$codsector = $_GET['codsector'];
	$_SESSION['codsector'] = "";
}
else
{
	$codsector = $_SESSION['codsector'];
}

if($_GET['desde'] != "")
{
	$desde = $_GET['desde'];
	$_SESSION['desde'] = "";
}
else
{
	if($_SESSION['desde'] != "")
	{
		$desde = $_SESSION['desde'];
	}
	else
	{
		$desde = date("Y-m-d", time());
	}
}

if($_GET['hasta'] != "")
{
	$hasta = $_GET['hasta'];
	$_SESSION['hasta'] = "";
}
else
{
	if($_SESSION['desde'] != "")
	{
		$hasta = $_SESSION['hasta'];
	}
	else
	{
		$hasta = date("Y-m-d", time());
	}
}


if($_GET['desder'] != "")
{
	$desder = $_GET['desder'];
	$_SESSION['desder'] = "";
}
else
{
	if($_SESSION['desder'] != "")
	{
		$desder = $_SESSION['desder'];
	}
	else
	{
		$desder = date("Y-m-d", time());
	}
}

if($_GET['hastar'] != "")
{
	$hastar = $_GET['hastar'];
	$_SESSION['hastar'] = "";
}
else
{
	if($_SESSION['hastar'] != "")
	{
		$hastar = $_SESSION['hastar'];
	}
	else
	{
		$hastar = date("Y-m-d", time());
	}
}

if($_GET['hora'] != "")
{
	$hora = $_GET['hora'];
	$_SESSION['hora'] = "";
}
else
{
	$hora = $_SESSION['hora'];
}

if($_GET['horaf'] != "")
{
	$horaf = $_GET['horaf'];
	$_SESSION['horaf'] = "";
}
else
{
	$horaf = $_SESSION['horaf'];
}

if($_GET['urgente'] != '')
{
	$urgente = $_GET['urgente'];
	$_SESSION['urgente'] = "";
}
else
{
	$urgente = $_SESSION['urgente'];
}


$elusuario=$nomyape;

$v_161  = $_SESSION['V_161']; //Carga, Validación Revalidación
$v_162 = $_SESSION['V_162']; //Impresión Resultados
$v_163 = $_SESSION['V_163 ']; //Carga, Validación Microbiología
$v_164 = $_SESSION['V_164']; //Email Resultados
$v_168 = $_SESSION['V_168']; //Histórico de Resultados
$v_169 = $_SESSION['V_169']; //Interfaces con Analizadores
$v_1691  = $_SESSION['V_1691']; //Preparar Muestras
$v_1692  = $_SESSION['V_1692']; //Confirmar Resultados

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
<script src="js/sweetalert2.all.min.js" type="text/javascript"></script>

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
   color: #337ab7;;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;
}


#wb_FontAwesomeIcon7
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon7:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon7
{
   height: 34px;
}
#FontAwesomeIcon7 i
{
   color: #2E8B57;
   display: inline-block;
   font-size: 34px;
   line-height: 34px;
   vertical-align: middle;
   width: 28px;
}
#wb_FontAwesomeIcon7:hover i
{
   color: #337AB7;
}


#wb_FontAwesomeIcon4
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_FontAwesomeIcon4:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#FontAwesomeIcon4
{
   height: 36px;
   width: 42px;
}
#FontAwesomeIcon4 i
{
   color: #FF0000;
   display: inline-block;
   font-size: 36px;
   line-height: 36px;
   vertical-align: middle;
   width: 31px;
}
#wb_FontAwesomeIcon4:hover i
{
   color: #337AB7;
}

#Button1
{
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

#wb_pacientesLayoutGrid1
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
#pacientesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#pacientesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#pacientesLayoutGrid1 .col-1, #pacientesLayoutGrid1 .col-2
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
#pacientesLayoutGrid1 .col-1, #pacientesLayoutGrid1 .col-2
{
   float: left;
}
#pacientesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#pacientesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#pacientesLayoutGrid1:before,
#pacientesLayoutGrid1:after,
#pacientesLayoutGrid1 .row:before,
#pacientesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#pacientesLayoutGrid1:after,
#pacientesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#pacientesLayoutGrid1 .col-1, #pacientesLayoutGrid1 .col-2
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

#Line2
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 5;
}

#Line3
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}

#Line3
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 7;
}

#Line5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}

#Line5
{
   display: block;
   width: 100%;
   height: 10px;
   z-index: 10;
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

#Combobox2
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
#Combobox2:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#Combobox2
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 9;
}

#Combobox3
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

#Combobox3:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#Combobox3
{
   display: block;
   width: 100%;
   height: 28px;
   z-index: 9;
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

#codestudio
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
</style>

<style>
a {
    color: #337ab7;
    text-decoration: none;
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
   text-decoration: none;
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
@media all and (max-width:800px)
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
   height: 39px;
   width: 43px;
}
#FontAwesomeIcon3 i
{
   color: #FF0000;
   display: inline-block;
   font-size: 39px;
   line-height: 39px;
   vertical-align: middle;
   width: 39px;
}
#wb_FontAwesomeIcon3:hover i
{
   color: #337AB7;
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
#Line9
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#wb_menuLayoutGrid1
{
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
#menuLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#menuLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
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
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   float: left;
}
#menuLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-3
{
   background-color: transparent;
   background-image: none;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-4
{
   background-color: transparent;
   background-image: none;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1:before,
#menuLayoutGrid1:after,
#menuLayoutGrid1 .row:before,
#menuLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#menuLayoutGrid1:after,
#menuLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   float: none;
   width: 100%;
}
}
#wb_menuFontAwesomeIcon1
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_menuFontAwesomeIcon1:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#menuFontAwesomeIcon1
{
   height: 34px;
   width: 36px;
}
#menuFontAwesomeIcon1 i
{
   color: #DC143C;
   display: inline-block;
   font-size: 34px;
   line-height: 34px;
   vertical-align: middle;
   width: 33px;
}
#wb_menuFontAwesomeIcon1:hover i
{
   color: #337AB7;
}
#wb_menuFontAwesomeIcon2
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_menuFontAwesomeIcon2:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#menuFontAwesomeIcon2
{
   height: 34px;
   width: 36px;
}
#menuFontAwesomeIcon2 i
{
   color: #DC143C;
   display: inline-block;
   font-size: 34px;
   line-height: 34px;
   vertical-align: middle;
   width: 33px;
}
#wb_menuFontAwesomeIcon2:hover i
{
   color: #337AB7;
}
#wb_menuFontAwesomeIcon3
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
   text-align: center;
   padding: 0px 0px 0px 0px;
   vertical-align: top;
}
#wb_menuFontAwesomeIcon3:hover
{
   background-color: transparent;
   background-image: none;
   border: 0px #245580 solid;
}
#menuFontAwesomeIcon3
{
   height: 34px;
   width: 36px;
}
#menuFontAwesomeIcon3 i
{
   color: #DC143C;
   display: inline-block;
   font-size: 34px;
   line-height: 34px;
   vertical-align: middle;
   width: 33px;
}
#wb_menuFontAwesomeIcon3:hover i
{
   color: #337AB7;
}
#wb_menuText1
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_menuText1 div
{
   text-align: left;
}
#wb_menuText2
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_menuText2 div
{
   text-align: left;
}
#wb_menuText3
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_menuText3 div
{
   text-align: left;
}
#page1Layer1
{
   background-color: #FFFFFF;
   background-image: none;
}
#page1Layer1
{
   display: inline-flex !important;
}
#wb_menuCarousel2
{
   background-color: #F2F5F7;
   background-image: none;
}
#menuCarousel2 .frame
{
   width: 466px;
   display: inline-block;
   float: left;
   height: 262px;
}
#wb_menuCarousel2 .pagination
{
   bottom: 0;
   left: 0;
   position: absolute;
   text-align: center;
   vertical-align: middle;
   width: 100%;
   z-index: 998;
}
#wb_menuCarousel2 .pagination img
{
   border-style: none;
   padding: 12px 12px 12px 12px;
}
#menuImage5
{
   border: 0px #000000 solid;
   padding: 0px 0px 0px 0px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#menuImage6
{
   border: 0px #000000 solid;
   padding: 0px 0px 0px 0px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#menuImage7
{
   border: 0px #000000 solid;
   padding: 0px 0px 0px 0px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_menuText7
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_menuText7 div
{
   text-align: left;
}
#wb_menuText8
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_menuText8 div
{
   text-align: left;
}
#wb_menuText9
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_menuText9 div
{
   text-align: left;
}
#wb_menuText10
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_menuText10 div
{
   text-align: left;
}
#menuImage8
{
   border: 0px #000000 solid;
   padding: 0px 0px 0px 0px;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#page1Layer2
{
   background-color: #FFFFFF;
   background-image: none;
}
#wb_page1LayoutGrid1
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
#page1LayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#page1LayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#page1LayoutGrid1 .row .col-1, #page1LayoutGrid1 .row .col-2
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
#page1LayoutGrid1 .row .col-1, #page1LayoutGrid1 .row .col-2
{
   float: left;
}
#page1LayoutGrid1 .row .col-1
{
   background-color: transparent;
   background-image: none;
   width: 75%;
   text-align: center;
}
#page1LayoutGrid1 .row .col-2
{
   background-color: transparent;
   background-image: none;
   width: 25%;
   text-align: center;
}
#page1LayoutGrid1:before,
#page1LayoutGrid1:after,
#page1LayoutGrid1 .row:before,
#page1LayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#page1LayoutGrid1:after,
#page1LayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#page1LayoutGrid1 .row .col-1, #page1LayoutGrid1 .row .col-2
{
   float: none;
   width: 100%;
}
}
#wb_menuText4
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 20px 0px 20px 0px;
   margin: 0;
   text-align: center;
}
#wb_menuText4 div
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
   height: 19px;
   width: 22px;
}
#FontAwesomeIcon5 i
{
   color: #FFFFFF;
   display: inline-block;
   font-size: 19px;
   line-height: 19px;
   vertical-align: middle;
   width: 11px;
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
   width: 21px;
}
#wb_FontAwesomeIcon6:hover i
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
   width: 23px;
}
#wb_FontAwesomeIcon9:hover i
{
   color: #FFFF00;
}
#page1Line1
{
   color: #9FB6C0;
   background-color: #9FB6C0;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#page1Line2
{
   color: #9FB6C0;
   background-color: #9FB6C0;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#page1Line2
{
   display: block;
   width: 100%;
   height: 27px;
   z-index: 34;
}
#wb_menuImage7
{
   position: absolute;
   left: 1507px;
   top: 15px;
   width: 265px;
   height: 185px;
   z-index: 18;
}
#wb_menuImage8
{
   position: absolute;
   left: 1041px;
   top: 15px;
   width: 265px;
   height: 185px;
   z-index: 17;
}
#wb_FontAwesomeIcon3
{
   position: absolute;
   left: 10px;
   top: 16px;
   width: 43px;
   height: 39px;
   text-align: center;
   z-index: 3;
}
#Line9
{
   display: block;
   width: 100%;
   height: 13px;
   z-index: 4;
}
#wb_FontAwesomeIcon5
{
   display: inline-block;
   width: 22px;
   height: 19px;
   text-align: center;
   z-index: 31;
}
#wb_FontAwesomeIcon6
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 32;
}
#Layer2
{
   position: absolute;
   text-align: left;
   left: 28px;
   top: 859px;
   width: 62px;
   height: 71px;
   z-index: 42;
}
#wb_Image3
{
   display: inline-block;
   width: 142px;
   height: 118px;
   z-index: 0;
}
#wb_Image4
{
   display: inline-block;
   width: 743px;
   height: 147px;
   z-index: 1;
}
#wb_FontAwesomeIcon9
{
   display: inline-block;
   width: 22px;
   height: 22px;
   text-align: center;
   z-index: 33;
}
#menuCarousel2
{
   position: absolute;
}
#page1Layer1
{
   position: relative;
   text-align: center;
   width: 100%;
   height: 100%;
   float: left;
   display: block;
   z-index: 43;
}
#page1Layer2
{
   position: relative;
   text-align: center;
   width: 100%;
   height: 160px;
   float: left;
   clear: left;
   display: block;
   z-index: 44;
}
#wb_menuCarousel2
{
   position: absolute;
   left: 252px;
   top: 12px;
   width: 466px;
   height: 262px;
   z-index: 20;
   overflow: hidden;
}
#wb_menuText7
{
   position: absolute;
   left: 149px;
   top: 212px;
   width: 210px;
   height: 16px;
   z-index: 13;
}
#wb_menuFontAwesomeIcon1
{
   display: inline-block;
   width: 36px;
   height: 34px;
   text-align: center;
   z-index: 10;
}
#menuCarousel2_next
{
   position: absolute;
   right: 4px;
   top: 44%;
   width: 30px;
   height: 30px;
   z-index: 999;
}
#wb_menuText8
{
   position: absolute;
   left: 615px;
   top: 212px;
   width: 202px;
   height: 16px;
   z-index: 15;
}
#wb_menuFontAwesomeIcon2
{
   display: inline-block;
   width: 36px;
   height: 34px;
   text-align: center;
   z-index: 6;
}
#wb_menuText9
{
   position: absolute;
   left: 1081px;
   top: 212px;
   width: 194px;
   height: 16px;
   z-index: 16;
}
#page1Layer1_Container
{
   width: 970px;
   height: 620px;
   position: relative;
   margin-left: auto;
   margin-right: auto;
   margin-top: auto;
   margin-bottom: auto;
   text-align: left;
}
#wb_menuFontAwesomeIcon3
{
   display: inline-block;
   width: 36px;
   height: 34px;
   text-align: center;
   z-index: 8;
}
#wb_ResponsiveMenu1
{
   display: inline-block;
   width: 100%;
   z-index: 2;
}
#wb_menuImage5
{
   position: absolute;
   left: 101px;
   top: 15px;
   width: 265px;
   height: 185px;
   z-index: 12;
}
#page1Line1
{
   display: block;
   width: 100%;
   height: 24px;
   z-index: 30;
}
#menuCarousel2_back
{
   position: absolute;
   left: 4px;
   top: 44%;
   width: 30px;
   height: 30px;
   z-index: 999;
}
#wb_menuText10
{
   position: absolute;
   left: 1547px;
   top: 212px;
   width: 210px;
   height: 16px;
   z-index: 19;
}
#wb_menuImage6
{
   position: absolute;
   left: 575px;
   top: 15px;
   width: 265px;
   height: 185px;
   z-index: 14;
}
@media only screen and (min-width: 1024px)
{
div#container
{
   width: 1024px;
}
#wb_ResponsiveMenu1
{
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon2
{
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
   width: 36px;
}
#wb_LayoutGrid3
{
   visibility: visible;
   display: table;
   font-size: 8px;
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
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#Line9
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
#wb_menuLayoutGrid1
{
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
#wb_menuLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#menuLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#menuLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#menuLayoutGrid1 .col-1
{
   display: block;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-2
{
   display: block;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-3
{
   display: block;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-4
{
   display: block;
   width: 25%;
   text-align: center;
}
#wb_menuFontAwesomeIcon1
{
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
#menuFontAwesomeIcon1
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon1 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon2
{
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
#menuFontAwesomeIcon2
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon2 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon3
{
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
#menuFontAwesomeIcon3
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon3 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuText1
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
#wb_menuText2
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#wb_menuText3
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#page1Layer1
{
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
#page1Layer1
{
   margin: 0px 0px 0px 0px;
}
#page1Layer1_Container
{
   width: 1024px;
   height:595px;
}
#wb_menuCarousel2
{
   left: 303px;
   top: 12px;
   width: 466px;
   height: 262px;
   visibility: visible;
   display: inline;
}
#menuCarousel2 .frame
{
   width: 466px;
   height: 262px;
}
#wb_menuImage5
{
   left: 101px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage6
{
   left: 575px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage7
{
   left: 1507px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuText7
{
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
#wb_menuText8
{
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
#wb_menuText9
{
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
#wb_menuText10
{
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
#wb_menuImage8
{
   left: 1041px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
}
@media only screen and (min-width: 980px) and (max-width: 1023px)
{
div#container
{
   width: 980px;
}
#wb_ResponsiveMenu1
{
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon2
{
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
#wb_LayoutGrid3
{
   visibility: visible;
   display: table;
   font-size: 8px;
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
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#Line9
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
#wb_menuLayoutGrid1
{
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
#wb_menuLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#menuLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#menuLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#menuLayoutGrid1 .col-1
{
   display: block;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-2
{
   display: block;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-3
{
   display: block;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-4
{
   display: block;
   width: 25%;
   text-align: center;
}
#wb_menuFontAwesomeIcon1
{
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
#menuFontAwesomeIcon1
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon1 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon2
{
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
#menuFontAwesomeIcon2
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon2 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon3
{
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
#menuFontAwesomeIcon3
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon3 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuText1
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
#wb_menuText2
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#wb_menuText3
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#page1Layer1
{
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
#page1Layer1
{
   margin: 0px 0px 0px 0px;
}
#page1Layer1_Container
{
   width: 980px;
   height:597px;
}
#wb_menuCarousel2
{
   left: 303px;
   top: 16px;
   width: 466px;
   height: 262px;
   visibility: visible;
   display: inline;
}
#menuCarousel2 .frame
{
   width: 466px;
   height: 262px;
}
#wb_menuImage5
{
   left: 101px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage6
{
   left: 575px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage7
{
   left: 1507px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuText7
{
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
#wb_menuText8
{
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
#wb_menuText9
{
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
#wb_menuText10
{
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
#wb_menuImage8
{
   left: 1041px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
}
@media only screen and (min-width: 800px) and (max-width: 979px)
{
div#container
{
   width: 800px;
}
#wb_ResponsiveMenu1
{
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon2
{
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
#wb_LayoutGrid3
{
   visibility: visible;
   display: table;
   font-size: 8px;
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
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#Line9
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
#wb_menuLayoutGrid1
{
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
#wb_menuLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#menuLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#menuLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#menuLayoutGrid1 .col-1
{
   display: block;
   width: 25%;
   text-align: left;
}
#menuLayoutGrid1 .col-2
{
   display: block;
   width: 25%;
   text-align: left;
}
#menuLayoutGrid1 .col-3
{
   display: block;
   width: 25%;
   text-align: center;
}
#menuLayoutGrid1 .col-4
{
   display: block;
   width: 25%;
   text-align: left;
}
#wb_menuFontAwesomeIcon1
{
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
#menuFontAwesomeIcon1
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon1 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon2
{
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
#menuFontAwesomeIcon2
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon2 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon3
{
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
#menuFontAwesomeIcon3
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon3 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuText1
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
#wb_menuText2
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#wb_menuText3
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#page1Layer1
{
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
#page1Layer1
{
   margin: 0px 0px 0px 0px;
}
#page1Layer1_Container
{
   width: 800px;
   height:591px;
}
#wb_menuCarousel2
{
   left: 185px;
   top: 12px;
   width: 466px;
   height: 262px;
   visibility: visible;
   display: inline;
}
#menuCarousel2 .frame
{
   width: 466px;
   height: 262px;
}
#wb_menuImage5
{
   left: 101px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage6
{
   left: 575px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage7
{
   left: 1507px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuText7
{
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
#wb_menuText8
{
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
#wb_menuText9
{
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
#wb_menuText10
{
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
#wb_menuImage8
{
   left: 1041px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
}
@media only screen and (min-width: 768px) and (max-width: 799px)
{
div#container
{
   width: 768px;
}
#wb_ResponsiveMenu1
{
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon2
{
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
#wb_LayoutGrid3
{
   visibility: visible;
   display: table;
   font-size: 8px;
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
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#Line9
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
#wb_menuLayoutGrid1
{
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
#wb_menuLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#menuLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#menuLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#menuLayoutGrid1 .col-1
{
   display: block;
   width: 25%;
   text-align: left;
}
#menuLayoutGrid1 .col-2
{
   display: block;
   width: 25%;
   text-align: left;
}
#menuLayoutGrid1 .col-3
{
   display: block;
   width: 25%;
   text-align: left;
}
#menuLayoutGrid1 .col-4
{
   display: block;
   width: 25%;
   text-align: left;
}
#wb_menuFontAwesomeIcon1
{
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
#menuFontAwesomeIcon1
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon1 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon2
{
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
#menuFontAwesomeIcon2
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon2 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon3
{
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
#menuFontAwesomeIcon3
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon3 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuText1
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
#wb_menuText2
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#wb_menuText3
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#page1Layer1
{
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
#page1Layer1
{
   margin: 0px 0px 0px 0px;
}
#page1Layer1_Container
{
   width: 768px;
   height:592px;
}
#wb_menuCarousel2
{
   left: 159px;
   top: 12px;
   width: 466px;
   height: 262px;
   visibility: visible;
   display: inline;
}
#menuCarousel2 .frame
{
   width: 466px;
   height: 262px;
}
#wb_menuImage5
{
   left: 101px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage6
{
   left: 575px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage7
{
   left: 1507px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuText7
{
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
#wb_menuText8
{
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
#wb_menuText9
{
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
#wb_menuText10
{
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
#wb_menuImage8
{
   left: 1041px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
}
@media only screen and (min-width: 480px) and (max-width: 767px)
{
div#container
{
   width: 480px;
}
#wb_ResponsiveMenu1
{
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon2
{
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
#wb_LayoutGrid3
{
   visibility: visible;
   display: table;
   font-size: 8px;
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
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#Line9
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
#wb_menuLayoutGrid1
{
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
#wb_menuLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#menuLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#menuLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#menuLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#menuLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#menuLayoutGrid1 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#menuLayoutGrid1 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_menuFontAwesomeIcon1
{
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
#menuFontAwesomeIcon1
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon1 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon2
{
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
#menuFontAwesomeIcon2
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon2 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon3
{
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
#menuFontAwesomeIcon3
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon3 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuText1
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
#wb_menuText2
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#wb_menuText3
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#page1Layer1
{
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
#page1Layer1
{
   margin: 0px 0px 0px 0px;
}
#page1Layer1_Container
{
   width: 480px;
   height:592px;
}
#wb_menuCarousel2
{
   left: 7px;
   top: 12px;
   width: 466px;
   height: 262px;
   visibility: visible;
   display: inline;
}
#menuCarousel2 .frame
{
   width: 466px;
   height: 262px;
}
#wb_menuImage5
{
   left: 101px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage6
{
   left: 575px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage7
{
   left: 1507px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuText7
{
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
#wb_menuText8
{
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
#wb_menuText9
{
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
#wb_menuText10
{
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
#wb_menuImage8
{
   left: 1041px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
}
@media only screen and (max-width: 479px)
{
div#container
{
   width: 320px;
}
#wb_ResponsiveMenu1
{
   visibility: visible;
   display: block;
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
#wb_FontAwesomeIcon2
{
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
#wb_LayoutGrid3
{
   visibility: visible;
   display: table;
   font-size: 8px;
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
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#Line9
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
#wb_menuLayoutGrid1
{
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
#wb_menuLayoutGrid1
{
   margin-top: 0px;
   margin-bottom: 0px;
}
#menuLayoutGrid1
{
   padding: 0px 15px 0px 15px;
}
#menuLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#menuLayoutGrid1 .col-1, #menuLayoutGrid1 .col-2, #menuLayoutGrid1 .col-3, #menuLayoutGrid1 .col-4
{
   padding-right: 15px;
   padding-left: 15px;
}
#menuLayoutGrid1 .col-1
{
   display: block;
   width: 100%;
   text-align: left;
}
#menuLayoutGrid1 .col-2
{
   display: block;
   width: 100%;
   text-align: left;
}
#menuLayoutGrid1 .col-3
{
   display: block;
   width: 100%;
   text-align: left;
}
#menuLayoutGrid1 .col-4
{
   display: block;
   width: 100%;
   text-align: left;
}
#wb_menuFontAwesomeIcon1
{
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
#menuFontAwesomeIcon1
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon1 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon2
{
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
#menuFontAwesomeIcon2
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon2 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuFontAwesomeIcon3
{
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
#menuFontAwesomeIcon3
{
   width: 36px;
   height: 34px;
}
#menuFontAwesomeIcon3 i
{
   line-height: 34px;
   font-size: 34px;
}
#wb_menuText1
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
#wb_menuText2
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#wb_menuText3
{
   visibility: visible;
   display: block;
   font-size: 8px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: transparent;
   background-image: none;
}
#page1Layer1
{
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
#page1Layer1
{
   margin: 0px 0px 0px 0px;
}
#page1Layer1_Container
{
   width: 320px;
   height:597px;
}
#wb_menuCarousel2
{
   left: 6px;
   top: 22px;
   width: 295px;
   height: 254px;
   visibility: visible;
   display: inline;
}
#menuCarousel2 .frame
{
   width: 295px;
   height: 254px;
}
#wb_menuImage5
{
   left: 101px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage6
{
   left: 404px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuImage7
{
   left: 900px;
   top: 17px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
#wb_menuText7
{
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
#wb_menuText8
{
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
#wb_menuText9
{
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
#wb_menuText10
{
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
#wb_menuImage8
{
   left: 699px;
   top: 15px;
   width: 265px;
   height: 185px;
   visibility: visible;
   display: inline;
}
}

	#wb_turnos_detallesLayoutGrid1
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
#turnos_detallesLayoutGrid1
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#turnos_detallesLayoutGrid1 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#turnos_detallesLayoutGrid1 .col-1, #turnos_detallesLayoutGrid1 .col-2
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
#turnos_detallesLayoutGrid1 .col-1, #turnos_detallesLayoutGrid1 .col-2
{
   float: right;
}
#turnos_detallesLayoutGrid1 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#turnos_detallesLayoutGrid1 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#turnos_detallesLayoutGrid1:before,
#turnos_detallesLayoutGrid1:after,
#turnos_detallesLayoutGrid1 .row:before,
#turnos_detallesLayoutGrid1 .row:after
{
   display: table;
   content: " ";
}
#turnos_detallesLayoutGrid1:after,
#turnos_detallesLayoutGrid1 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#turnos_detallesLayoutGrid1 .col-1, #turnos_detallesLayoutGrid1 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_turnos_detallesLayoutGrid2
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
#turnos_detallesLayoutGrid2
{
   -webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
   box-sizing: border-box;
   padding: 0px 15px 0px 15px;
   margin-right: auto;
   margin-left: auto;
}
#turnos_detallesLayoutGrid2 .row
{
   margin-right: -15px;
   margin-left: -15px;
}
#turnos_detallesLayoutGrid2 .col-1, #turnos_detallesLayoutGrid2 .col-2
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
#turnos_detallesLayoutGrid2 .col-1
{
   float: right;
}
#turnos_detallesLayoutGrid2 .col-1
{
   background-color: transparent;
   background-image: none;
   width: 33.33333333%;
   text-align: left;
}
#turnos_detallesLayoutGrid2 .col-2
{
   background-color: transparent;
   background-image: none;
   width: 66.66666667%;
   text-align: left;
}
#turnos_detallesLayoutGrid2:before,
#turnos_detallesLayoutGrid2:after,
#turnos_detallesLayoutGrid2 .row:before,
#turnos_detallesLayoutGrid2 .row:after
{
   display: table;
   content: " ";
}
#turnos_detallesLayoutGrid2:after,
#turnos_detallesLayoutGrid2 .row:after
{
   clear: both;
}
@media (max-width: 480px)
{
#turnos_detallesLayoutGrid2 .col-1, #turnos_detallesLayoutGrid2 .col-2
{
   float: none;
   width: 100%;
}
}
#wb_turnos_detallesText2
{
   background-color: transparent;
   background-image: none;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_turnos_detallesText2 div
{
   text-align: left;
}
#turnos_detallesLine4
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#turnos_detallesLine5
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#turnos_detallesLine5
{
   display: block;
   width: 100%;
   height: 11px;
   z-index: 25;
}
#turnos_detallesLine6
{
   color: #FFFFFF;
   background-color: #FFFFFF;
   border-width: 0;
   margin: 0;
   padding: 0;
}
#turnos_detallesTable1
{
   border: 1px #C0C0C0 solid;
   background-color: transparent;
   background-image: none;
   border-collapse: separate;
   border-spacing: 0px;
}
#turnos_detallesTable1 td
{
   padding: 0px 0px 0px 0px;
}
#turnos_detallesTable1 td div
{
   white-space: nowrap;
}
#turnos_detallesTable1 .cell0
{
   background-color: #DCDCDC;
   background-image: none;
   border: 1px #C0C0C0 solid;
   text-align: center;
   vertical-align: top;
}
#turnos_detallesTable1 .cell1
{
   background-color: transparent;
   background-image: none;
   border: 1px #C0C0C0 solid;
   text-align: center;
   vertical-align: top;
}
#turnos_detallesTable1 .cell2
{
   background-color: transparent;
   background-image: none;
   border: 1px #C0C0C0 solid;
   text-align: center;
   vertical-align: middle;
}
#turnos_detallesTable1 .cell3
{
   background-color: #87CEEB;
   background-image: none;
   border: 1px #C0C0C0 solid;
   text-align: center;
   vertical-align: middle;
}
#turnos_detallesTable1 .cell4
{
   background-color: transparent;
   background-image: none;
   border: 1px #C0C0C0 solid;
   text-align: left;
   vertical-align: top;
}

#Table1 .cell0
{
   background-color: #4D4D4D;
   background-image: none;
   border: 1px #949494 solid;
   text-align: center;
   vertical-align: middle;
   font-family: Arial;
   font-size: 11px;
   line-height: 13px;
}
#Table1 .cell1
{
   background-color: #4D4D4D;
   background-image: none;
   border: 1px #949494 solid;
   text-align: center;
   vertical-align: top;
   font-family: Arial;
   font-size: 11px;
   line-height: 13px;
}
#Table1 .cell2
{
   background-color: #4D4D4D;
   background-image: none;
   border: 1px #949494 solid;
   text-align: center;
   vertical-align: top;
   font-family: Verdana;
   font-size: 11px;
   line-height: 12px;
}
#Table1 .cell3
{
   background-color: #4D4D4D;
   background-image: none;
   border: 1px #949494 solid;
   text-align: left;
   vertical-align: middle;
}
#Table1 .cell4
{
   background-color: #4D4D4D;
   background-image: none;
   border: 1px #949494 solid;
   text-align: left;
   vertical-align: top;
   font-size: 0;
}
#Table1 .cell5
{
   background-color: transparent;
   background-image: none;
   border: 1px #949494 solid;
   text-align: center;
   vertical-align: middle;
   font-size: 0;
}
#Table1 .cell6
{
   background-color: transparent;
   background-image: none;
   border: 1px #949494 solid;
   text-align: left;
   vertical-align: middle;
   font-family: Arial;
   font-size: 13px;
   line-height: 16px;
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

#desde
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 35;
}

#desder
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

#desder:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

#desder
{
   display: block;
   width: 100%;
   height: 26px;
   line-height: 26px;
   z-index: 35;
}

#desder
{
   visibility: visible;
   display: block;
   color: #000000;
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

#hasta
{
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

#hasta:focus {
	border-color: #66AFE9;
	-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
	-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
	box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
	outline: 0;
}

#hasta {
	display: block;
	width: 100%;
	height: 26px;
	line-height: 26px;
	z-index: 41;
}

#hasta {
	visibility: visible;
	display: block;
	color: #000000;
	font-size: 13px;
	font-family: Arial;
	font-weight: normal;
	font-style: normal;
	text-decoration: none;
	background-color: #FFFFFF;
	background-image: none;
	border-radius: 4px;
}

#hastar
{
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

#hastar:focus {
	border-color: #66AFE9;
	-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
	-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
	box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
	outline: 0;
}

#hastar {
	display: block;
	width: 100%;
	height: 26px;
	line-height: 26px;
	z-index: 41;
}

#hastar {
	visibility: visible;
	display: block;
	color: #000000;
	font-size: 13px;
	font-family: Arial;
	font-weight: normal;
	font-style: normal;
	text-decoration: none;
	background-color: #FFFFFF;
	background-image: none;
	border-radius: 4px;
}

#wb_listas_ordenesLayoutGrid8
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

#listas_ordenesLayoutGrid8 {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 0px 0px 0px 0px;
    margin-right: auto;
    margin-left: auto;
}

#listas_ordenesLayoutGrid8 .col-1, #listas_ordenesLayoutGrid8 .col-2, #listas_ordenesLayoutGrid8 .col-3, #listas_ordenesLayoutGrid8 .col-4 {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font-size: 0px;
    min-height: 1px;
    position: relative;
}
#listas_ordenesLayoutGrid8 .col-1, #listas_ordenesLayoutGrid8 .col-2, #listas_ordenesLayoutGrid8 .col-3, #listas_ordenesLayoutGrid8 .col-4 {
    float: left;
}
#listas_ordenesLayoutGrid8 .col-1 {
    background-color: transparent;
    background-image: none;
    width: 33.33333333%;
    text-align: left;
}
#listas_ordenesLayoutGrid8 .col-2 {
    background-color: transparent;
    background-image: none;
    width: 16.66666667%;
    text-align: left;
}
#listas_ordenesLayoutGrid8 .col-3 {
    background-color: transparent;
    background-image: none;
    width: 33.33333333%;
    text-align: left;
}
#listas_ordenesLayoutGrid8 .col-4 {
    background-color: transparent;
    background-image: none;
    width: 16.66666667%;
    text-align: left;
}
#listas_ordenesLayoutGrid8:before, #listas_ordenesLayoutGrid8:after, #listas_ordenesLayoutGrid8 .row:before, #listas_ordenesLayoutGrid8 .row:after {
    display: table;
    content: " ";
}
#listas_ordenesLayoutGrid8:after, #listas_ordenesLayoutGrid8 .row:after {
    clear: both;
}

@media (max-width: 480px) {
#listas_ordenesLayoutGrid8 .col-1, #listas_ordenesLayoutGrid8 .col-2, #listas_ordenesLayoutGrid8 .col-3, #listas_ordenesLayoutGrid8 .col-4 {
    float: none;
    width: 100%;
}
}

#listas_ordenesLine25 {
    color: #FFFFFF;
    background-color: #FFFFFF;
    border-width: 0;
    margin: 0;
    padding: 0;
}

#listas_ordenesLine25 {
    display: block;
    width: 100%;
    height: 13px;
    z-index: 55;
}

#wb_listas_ordenesText12 {
    background-color: transparent;
    background-image: none;
    border: 0px #000000 solid;
    padding: 0;
    margin: 0;
    text-align: left;
}
#wb_listas_ordenesText12 div {
    text-align: left;
}

#listas_ordenesLine28 {
    color: #FFFFFF;
    background-color: #FFFFFF;
    border-width: 0;
    margin: 0;
    padding: 0;
}

#listas_ordenesLine28 {
    display: block;
    width: 100%;
    height: 13px;
    z-index: 58;
}

#hora {
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
#hora:focus {
    border-color: #66AFE9;
    -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
    -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
    outline: 0;
}
#hora {
    display: block;
    width: 100%;
    height: 26px;
    line-height: 26px;
    z-index: 59;
}

#wb_listas_ordenesText13 {
    background-color: transparent;
    background-image: none;
    border: 0px #000000 solid;
    padding: 0;
    margin: 0;
    text-align: left;
}
#wb_listas_ordenesText13 div {
    text-align: left;
}

#listas_ordenesLine31 {
    color: #FFFFFF;
    background-color: #FFFFFF;
    border-width: 0;
    margin: 0;
    padding: 0;
}
#listas_ordenesLine31 {
    display: block;
    width: 100%;
    height: 13px;
    z-index: 61;
}

#listas_ordenesLine29 {
    color: #FFFFFF;
    background-color: #FFFFFF;
    border-width: 0;
    margin: 0;
    padding: 0;
}
#listas_ordenesLine29 {
    display: block;
    width: 100%;
    height: 13px;
    z-index: 57;
}

#listas_ordenesLine32 {
    color: #FFFFFF;
    background-color: #FFFFFF;
    border-width: 0;
    margin: 0;
    padding: 0;
}
#listas_ordenesLine32 {
    display: block;
    width: 100%;
    height: 13px;
    z-index: 64;
}

#horaf {
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
#horaf:focus {
    border-color: #66AFE9;
    -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
    -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
    outline: 0;
}
#horaf {
    display: block;
    width: 100%;
    height: 26px;
    line-height: 26px;
    z-index: 65;
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
#wb_listas_ordenesCheckbox3 {
    display: inline-block;
    width: 18px;
    height: 20px;
    z-index: 69;
}

#urgente
{
   visibility: visible;
   display: block;
   color: #000000;
   font-size: 13px;
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
   background-color: #FFFFFF;
   background-image: none;
   border-radius: 4px;
}
#urgente
{
   display: block;
   width: 20%;
   height: 28px;
   z-index: 70;
}
#urgente
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
#urgente:focus
{
   border-color: #66AFE9;
   -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   box-shadow: inset 0px 1px 1px rgba(0,0,0,0.075), 0px 0px 8px rgba(102,175,233,0.60);
   outline: 0;
}

.not-active {
            pointer-events: none;
            cursor: default;
        }
</style>

<script src="jquery-1.12.4.min.js"></script>
<script src="wb.stickylayer.min.js"></script>
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
$(function() {
    var lastsel2;

    jQuery("#listapacientes").jqGrid({
        url:'datosresultados.php?codservicio=<?php echo $codservicio; ?>&codorigen=<?php echo $codorigen; ?>&codempresa=<?php echo $codempresa; ?>&codestudio=<?php echo $codestudio; ?>&codsector=<?php echo $codsector; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&desder=<?php echo $desder; ?>&hastar=<?php echo $hastar; ?>&hora=<?php echo $hora; ?>&horaf=<?php echo $horaf; ?>&urgente=<?php echo $urgente; ?>',
        datatype: 'json',
        mtype: 'GET',
    	loadonce:true,
        height: 330,
        recordpos: 'left',
        pagerpos: 'right',

		gridview: true,

        colNames:['Revisar','Imprimir',/*'Anular',*/'Nro. Orden', 'Establecimiento Salud', 'Origen Paciente','Nombres y Apellidos', 'Direcci&oacute;n', 'Tel&eacute;fono'],
        colModel:[
				{name:'modificar', width:60, resizable:false, align:"center",sorttype:"int", editable: false, editoptions:{maxlength:"50"}, search: false},

				{name:'imprimir', width:60, resizable:false, align:"center",sorttype:"int", editable: false, editoptions:{maxlength:"50"}, search: false},

			   /*{name:'anular', width:60, resizable:false, align:"center",sorttype:"int", editable: false, editoptions:{maxlength:"50"}, search: false},*/

            {name:'nordentra',index:'nordentra', width:120, align:"center", editable: true, searchoptions: {attr: {maxlength: 10,size: 7,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'nomservicio',index: "nomservicio", width: 250, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'nomorigen',index: "nomorigen", width: 250, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

            {name:'nomyape',index: "nomyape", width: 300, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'dccionr',index: "dccionr", width: 200, align:"center", editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'telefono',index:'telefono', width:120, align:"center", editable: true, searchoptions: {attr: {maxlength: 10,size: 10,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}}
                 ],

                caption: "PACIENTES",
                ignoreCase:true,
                pager: '#perpage',
                rowNum:7,
                rowList:[7,15,30],

                sortname: 'nordentra',
                sortorder: 'asc',
                viewrecords: true,
				editable: true,
				loadComplete: function() {$("tr.jqgrow:odd").css("background", "#FAFAFA").css("margin-bottom", "0 solid");},

                shrinkToFit: false, // well, it's 'true' by default
                forceFit:true,

        beforeRequest: function() {
            responsive_jqgrid($(".jqGrid"));
        },

    });

	grid = $("#listapacientes");

	jQuery("#listapacientes").jqGrid('setFrozenColumns');

  jQuery("#listapacientes").jqGrid('filterToolbar', {stringResult: true, searchOnEnter: false, defaultSearch : "cn"});



  function responsive_jqgrid(jqgrid) {
        jqgrid.find('.ui-jqgrid').addClass('clear-margin span12').css('width', '');
        jqgrid.find('.ui-jqgrid-view').addClass('clear-margin span12').css('width', '');
        jqgrid.find('.ui-jqgrid-view > div').eq(1).addClass('clear-margin span12').css('width', '').css('min-height', '0');
        jqgrid.find('.ui-jqgrid-view > div').eq(2).addClass('clear-margin span12').css('width', '').css('min-height', '0');
        jqgrid.find('.ui-jqgrid-sdiv').addClass('clear-margin span12').css('width', '');
        jqgrid.find('.ui-jqgrid-pager').addClass('clear-margin span12').css('width', '');
    }

});

function gridReload()
{
	var codservicio = jQuery("#Combobox1").val();
	var codorigen   = jQuery("#Combobox2").val();
	var codempresa  = jQuery("#Combobox3").val();
	var codestudio  = jQuery("#codestudio").val();
	var codsector  = jQuery("#codsector").val();
	var hasta	   = jQuery("#hasta").val();
	var desde  	   = jQuery("#desde").val();
	var hastar	   = jQuery("#hastar").val();
	var desder     = jQuery("#desder").val();
	var hora       = jQuery("#hora").val();
	var horaf      = jQuery("#horaf").val();
	var urgente    = jQuery("#urgente").val();

	jQuery("#listapacientes").jqGrid('setGridParam',{url:"datosresultados.php?codservicio="+codservicio+"&codorigen="+codorigen+"&codempresa="+codempresa+"&codestudio="+codestudio+"&codsector="+codsector+"&hasta="+hasta+"&desde="+desde+"&hastar="+hastar+"&desder="+desder+"&hora="+hora+"&horaf="+horaf+"&urgente="+urgente,datatype:'json'});

    jQuery("#listapacientes").trigger('reloadGrid');
	//location.reload();
}

function taerResultado(nordentra, codservicio)
{
	$.ajax({
			url: 'resultadosp.php',
			data: {"nordentra":nordentra},
			success:function(data){

				$("#listaresultado1").html(data).fadeIn();
			}
	});

}

function GenerarAgrupamiento()
{
	var i=0;

    $('#example tr').each(function() {

		i = i + 1;

		if(i > 1)
		{

			var nordentra     = $(this).find("td").eq(0).html(),
                 codresultado  = $("#codresultado"+i).val(),
                 nomresultado  = $("#nomresultado"+i).val(),
                 obs		   = $("#obs"+i).val(),
				 nroestudio	   = $(this).find("td").eq(5).html(),
				 idmuestra	   = $(this).find("td").eq(6).html(),
				 microbiologia = $(this).find("td").eq(7).html();

            jQuery.ajax({
                          url:'insertar_resultado.php',
                          type:'POST',
                          dataType:'json',
                          data:{nordentra:nordentra, codresultado:codresultado, resultado:nomresultado, obs:obs, nroestudio:nroestudio, idmuestra:idmuestra, microbiologia:microbiologia}
                      }).done(function(respuesta){


                          if(respuesta.grupo != 0)
                          {

                               /**/

                          }

                 });
		}

    });

	setTimeout(function () {

                                      swal({
                                              title: "Datos Registrados Exitosamente!",
                                              text: "",
                                              type: "success"
                                      });

                                  }, 1000);

}

function Validar(operacion)
{
	var nordentra     = $("#nordentrav").val(),
        codestudio    = $("#codestudiov").val(),
        codsector     = $("#codsectorv").val(),
		coddetermina  = $("#coddetermina").val();


     jQuery.ajax({
                    url:'insertar_validacion.php',
                    type:'POST',
                    dataType:'json',
                    data:{nordentra:nordentra, codestudio:codestudio, codsector:codsector, operacion:operacion, coddetermina:coddetermina}
             }).done(function(respuesta){


                    if(respuesta.grupo != 0)
                    {

                             setTimeout(function () {

                                swal({
                                        title: "Validacion Exitosa !",
                                        text: "",
                                        type: "success"
                                });

													gridReload();


					                            }, 1000);

												Ocultar();

				          }
						 			else
							 		{

										swal({
										  title: "Ya fue Validado!",
										  html: "",
										  type: "warning"
											})
									}

           });

}

function Anular(operacion)
{
		var 	nordentra     = $("#nordentrav").val(),
					codestudio    = $("#codestudiov").val(),
					codsector     = $("#codsectorv").val(),
					coddetermina  = $("#coddetermina").val();

		jQuery.ajax({
                    url:'insertar_anulacion.php',
                    type:'POST',
                    dataType:'json',
                    data:{nordentra:nordentra, codestudio:codestudio, codsector:codsector, operacion:operacion, coddetermina:coddetermina}
             }).done(function(respuesta){

                    if(respuesta.grupo != 0)
                    {

                             setTimeout(function () {

                                swal({
                                        title: "Anulacion Exitosa !",
                                        text: "",
                                        type: "success"
                                });

														gridReload();


						                            }, 1000);
														Ocultar();
						          }
								 			else
									 		{

												swal({
												  title: "Ya fue Anulada!",
												  html: "",
												  type: "warning"
													})
											}

           });

}

</script>

<script>

$(document).ready(function() {

	$("#Button102").click(function(){

		$("#myModal").modal("hide");

	});


	$("#Button103").click(function(){

		$("#myModal1").modal("show");

	});

	$("#Button104").click(function(){

		$("#myModal2").modal("show");

	});

} );


function getVal(i) {

    $('#example tr').each(function() {

    	var nordentra  = $(this).find("td").eq(0).html();
		var nomestudio = $(this).find("td").eq(1).html();
		var codsector  = $(this).find("td").eq(8).html();
		var codestudio = $(this).find("td").eq(9).html();
		var nomsector  = $(this).find("td").eq(10).html();
		var coddetermina = $(this).find("td").eq(11).html();

		if((this.rowIndex+1) == i)
		{


			$("#nordentrav").val(nordentra);
			$("#nordentrav1").html(nordentra);
			$("#nordentrav2").html(nordentra);

			$("#codsectorv").val(codsector);
			$("#codsectorv1").html(nomsector);
			$("#codsectorv2").html(nomsector);

			$("#codestudiov").val(codestudio);
			$("#codestudiov1").html(nomestudio);
			$("#codestudiov2").html(nomestudio);

			$("#coddetermina").val(coddetermina);

			if($("#nomresultado"+i)[0])
			{
				if($("#nomresultado"+i).val() != '')
				{
					$("#Button103").removeAttr("disabled");
					$("#Button104").removeAttr("disabled");

				}
				else
				{
					$("#Button103").prop('disabled', true);
					$("#Button104").prop('disabled', true);

				}
			}

			if($("#codresultado"+i)[0])
            {
				if($("#codresultado"+i).val() != '')
				{
					$("#Button103").removeAttr("disabled");
					$("#Button104").removeAttr("disabled");

				}
				else
				{
					$("#Button103").prop('disabled', true);
					$("#Button104").prop('disabled', true);

				}
			}

		}
	});

}

function Ocultar()
{
	$("[data-dismiss=modal]").trigger({ type: "click" });

}


</script>

<style type="text/css">
.glyphicon.glyphicon-edit, .glyphicon.glyphicon-trash {
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
            <a href="menu.php"><div id="FontAwesomeIcon3"><i class="fa fa-commenting-o">&nbsp;</i></div></a>
		</div>
	</div>
</div>

<div id="wb_LayoutGrid3">
	<div id="LayoutGrid3">
		<div class="row">
			<div class="col-1">
				<hr id="Line9"/>
				<div id="wb_Text1">
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br><br></strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>CARGA Y VALIDACION DE RESULTADOS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong><br />
					</strong></span>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="wb_pacientesLayoutGrid1">
<div id="pacientesLayoutGrid1">
<div class="row">
<div class="col-1">
<hr id="Line2">
<div id="wb_Text2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Laboratorio responsable: </strong></span>
</div>
<hr id="Line3">
	</div>

<div class="col-2">
<hr id="Line4">
<div class="selector-establecimiento">
	<select name="Combobox1" size="1" id="Combobox1" onChange="gridReload()" <?php if($codservicio1 != ''){ echo 'disabled';} ?> style="<?php if($codservicio1 != ''){echo "background-color: #DCDCDC";}?>">
	<option value=""></option>
	<?php
		$tabla_dpto = pg_query($link, "select * from establecimientos order by codservicio");
		while($depto = pg_fetch_array($tabla_dpto))
		{
		   if($depto['codservicio'] == $codservicio)
		   {
			  echo "<option value = ".$depto['codservicio']." selected>".$depto['nomservicio']."</option>";


		   }
		   else
		   {
			   echo "<option value = ".$depto['codservicio'].">".$depto['nomservicio']."</option>";
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
<hr id="Line2">
<div id="wb_Text2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Origen del Paciente: </strong></span>
</div>
<hr id="Line3">
	</div>

<div class="col-2">
<hr id="Line4">
<div class="selector-area">
<select name="Combobox2" size="1" id="Combobox2" onChange="gridReload()">
	<option value=""></option>
	<?php
		$tabla_dpto = pg_query($link, "select * from origenpaciente order by codorigen");
		while($depto = pg_fetch_array($tabla_dpto))
		{
		   if($depto['codorigen'] == $codorigen)
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

</div>

<hr id="Line5">
</div>

</div>

<div class="row">
<div class="col-1">
<hr id="Line2">
<div id="wb_Text2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Entidad Derivante: </strong></span>
</div>
<hr id="Line3">
	</div>

<div class="col-2">
<hr id="Line4">
<div class="selector-tipo">
<select name="Combobox3" size="1" id="Combobox3" onChange="gridReload()">
	<option value=""></option>
	<?php

		$tabla_dpto = pg_query($link, "select * from establecimientos order by codservicio");
		while($depto = pg_fetch_array($tabla_dpto))
		{
		   if($depto['codservicio'] == $codempresa)
		   {
			  echo "<option value = ".$depto['codservicio']." selected>".$depto['nomservicio']."</option>";


		   }
		   else
		   {
			   echo "<option value = ".$depto['codservicio'].">".$depto['nomservicio']."</option>";
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
<hr id="Line2">
<div id="wb_Text2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Sector: </strong></span>
</div>
<hr id="Line3">
	</div>

<div class="col-2">
<hr id="Line4">
<div class="selector-sector">
<select name="codsector" size="1" id="codsector" onChange="gridReload()">
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
<hr id="Line2">
<div id="wb_Text2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Estudio: </strong></span>
</div>
<hr id="Line3">
	</div>

<div class="col-2">
<hr id="Line4">
<div class="selector-estudio">
<select name="codestudio" size="1" id="codestudio" onChange="gridReload()">
	<option value=""></option>
	<?php

		$tabla_dpto = pg_query($link, "select * from estudios order by codestudio");
		while($depto = pg_fetch_array($tabla_dpto))
		{
		   if($depto['codestudio'] == $codestudio)
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
</div>
<hr id="Line5">
</div>
</div>



<div id="wb_LayoutGrid6">
  <div id="LayoutGrid6">
    <div class="row">
      <div class="col-1">
        <div id="wb_Text4"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Desde Fecha de Orden: </strong></span> </div>
      </div>
      <div class="col-2">
        <input type="date" id="desde" name="desde" value="<?php echo $desde; ?>" spellcheck="false" onChange="gridReload()">
      </div>
    </div>
  </div>
</div>
<br>
<div id="wb_LayoutGrid7">
  <div id="LayoutGrid7">
    <div class="row">
      <div class="col-1">
        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Hasta Fecha de Orden: </strong></span> </div>
      </div>
      <div class="col-2">
        <input type="date" id="hasta" name="hasta" value="<?php echo $hasta; ?>" spellcheck="false" onChange="gridReload()">
      </div>
    </div>
  </div>
</div>
<br>

<div id="wb_LayoutGrid6">
  <div id="LayoutGrid6">
    <div class="row">
      <div class="col-1">
        <div id="wb_Text4"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Desde Fecha de Resultado: </strong></span> </div>
      </div>
      <div class="col-2">
        <input type="date" id="desder" name="desder" value="<?php echo $desder; ?>" spellcheck="false" onChange="gridReload()">
      </div>
    </div>
  </div>
</div>
<br>

<div id="wb_LayoutGrid7">
  <div id="LayoutGrid7">
    <div class="row">
      <div class="col-1">
        <div id="wb_Text5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Hasta Fecha de Resultado: </strong></span> </div>
      </div>
      <div class="col-2">
        <input type="date" id="hastar" name="hastar" value="<?php echo $hastar; ?>" spellcheck="false" onChange="gridReload()">
      </div>
    </div>
  </div>
</div>
<br>

<div id="wb_listas_ordenesLayoutGrid8">
  <div id="listas_ordenesLayoutGrid8">
    <div class="row">
      <div class="col-1">
        <hr id="listas_ordenesLine25">
        <div id="wb_listas_ordenesText12"> <span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Desde Hora:</strong></span> </div>
        <hr id="listas_ordenesLine29">
      </div>
      <div class="col-2">
        <hr id="listas_ordenesLine28">
        <input type="time" id="hora" name="hora" value="<?php echo $hora; ?>" spellcheck="false" onChange="gridReload()">
      </div>
      <div class="col-3">
        <hr id="listas_ordenesLine31">
        <div id="wb_listas_ordenesText13"> <span style="color:#696969;font-family:Verdana;font-size:16px;"><strong>Hasta Hora:</strong></span> </div>
      </div>
      <div class="col-4">
        <hr id="listas_ordenesLine32">
        <input type="time" id="horaf" name="horaf" value="<?php echo $horaf; ?>" spellcheck="false" onChange="gridReload()">
      </div>
    </div>
  </div>
</div>
<br>
<div id="wb_listas_ordenesLayoutGrid5">
  <div id="listas_ordenesLayoutGrid5">
    <div class="row">
      <div class="col-1">

        <div id="wb_listas_ordenesText5"> <span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Urgentes: <br>
          </strong></span> </div>
      </div>
      <div class="col-2">
        <input type="text" name="urgente" id="urgente" list="listatb" value="<?php echo $urgente; ?>" onkeypress="return validarcar(event)" onChange="gridReload()">
      </div>
    </div>
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

<div id="wb_turnos_detallesLayoutGrid2">
<div id="turnos_detallesLayoutGrid2">
<div class="row">
  <div id="page1Layer1_Container">

      <div class="jqGrid">
        <br/>
        <table id="listapacientes"></table>
        <div id="perpage"></div>
      </div>
        <br />

	</div>
	<!-- Modal -->

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
 	 <div class="modal-dialog modal-lg" role="document" style="width: 1350px;">
 		 <div class="modal-content"  style="width: 1403px;">

 			 <div class="modal-header">
 				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 				 <br>
 				 <h4 class="modal-title" id="myModalLabel"></h4>
 			 </div>

 			 <div class="modal-body">

				 <?php
					 echo '<button type="button" class="btn btn-primary btn-lg" id="Button101" onclick="GenerarAgrupamiento()" style="float: left;margin-right: 10px;">Guardar</button>';

				   echo '<button type="button" class="btn btn-primary btn-lg" id="Button103" style="float: left;" disabled>Validar</button>';

					 echo '<button type="button" class="btn btn-primary btn-lg" id="Button104" style="float: left;left;margin-left: 10px;" disabled>Anular</button>';

					 echo '<button type="button" class="btn btn-primary btn-lg" id="Button102" style="float: left;margin-left: 10px;">Salir</button>';

					 echo '<br><br><br>';
					 //echo '<input type="button" id="pacientes_detallesButton1" name="agregar" value="Confirmar env&iacute;o" onclick="xajax_ConfirmarEnvio(xajax.getFormValues(formu));" disabled>';
				 ?>

				 <div class="jqGrid">
	         <br/>

	         <div id="listaresultado1"></div>
	       </div>
	         <br />

 			 </div>

 			 <div class="modal-footer">

 			 </div>

 		 </div>
 	</div>
  </div>

  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
 	 <div class="modal-dialog modal-lg" role="document" style="width: 58%;height: 170%;">
 		 <div class="modal-content"  style="width: 37%;margin-left: 30%;overflow-x: hidden;overflow-y: hidden;">

 			 <div class="modal-header">
 				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 				 <br>
 				 <h4 class="modal-title" id="myModalLabel"></h4>
 			 </div>

 			 <div class="modal-body">
				 <form id="formu" name="formu">
				 <table width="270" border="0">
					  <tbody>
						<tr>
						  <td style="width: 10px;"><div id="wb_FontAwesomeIcon7"><a onclick="Validar('E');" style="cursor: pointer"><div id="FontAwesomeIcon7"><i class="fa fa-check-square">&nbsp;</i></div></a></div></td>
						  <td style="width: 30px;">Estudio:</td>
						  <td>
							  <div id="codestudiov1"></div>
							  <input type="hidden" id="codestudiov">
						  </td>
						</tr>

						<tr>
						  <td style="width: 10px;"><div id="wb_FontAwesomeIcon7"><a onclick="Validar('S');" style="cursor: pointer"><div id="FontAwesomeIcon7"><i class="fa fa-check-square">&nbsp;</i></div></a></div></td>
						  <td>Sector:</td>
						  <td>
							  <div id="codsectorv1"></div>
							  <input type="hidden" id="codsectorv">
							  <input type="hidden" id="coddetermina">
						 </td>
						</tr>

						<tr>
						  <td style="width: 10px;"><div id="wb_FontAwesomeIcon7"><a onclick="Validar('O');" style="cursor: pointer"><div id="FontAwesomeIcon7"><i class="fa fa-check-square">&nbsp;</i></div></a></div></td>
						  <td>Orden:</td>
						  <td>
							  <div id="nordentrav1"></div>
							  <input type="hidden" id="nordentrav">

						 </td>
						</tr>

					  </tbody>
				 </table>
				</form>
 			 </div>

 			 <div class="modal-footer">

 			 </div>

 		 </div>
 	</div>
  </div>

  
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
 	 <div class="modal-dialog modal-lg" role="document" style="width: 58%;height: 170%;">
 		 <div class="modal-content"  style="width: 37%;margin-left: 30%;overflow-x: hidden;overflow-y: hidden;">

 			 <div class="modal-header">
 				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 				 <br>
 				 <h4 class="modal-title" id="myModalLabel"></h4>
 			 </div>

 			 <div class="modal-body">
				 <form id="formu" name="formu">
				 <table width="270" border="0">
					  <tbody>
						<tr>
						  <td style="width: 10px;"><div id="wb_FontAwesomeIcon7"><a onclick="Anular('E');" style="cursor: pointer"><div id="FontAwesomeIcon7"><i class="fa fa-check-square">&nbsp;</i></div></a></div></td>
						  <td style="width: 30px;">Estudio:</td>
						  <td>
							  <div id="codestudiov2"></div>
							  <input type="hidden" id="codestudiov">
						  </td>
						</tr>

						<tr>
						  <td style="width: 10px;"><div id="wb_FontAwesomeIcon7"><a onclick="Anular('S');" style="cursor: pointer"><div id="FontAwesomeIcon7"><i class="fa fa-check-square">&nbsp;</i></div></a></div></td>
						  <td>Sector:</td>
						  <td>
							  <div id="codsectorv2"></div>
							  <input type="hidden" id="codsectorv">
							  <input type="hidden" id="coddetermina">
						 </td>
						</tr>

						<tr>
						  <td style="width: 10px;"><div id="wb_FontAwesomeIcon7"><a onclick="Anular('O');" style="cursor: pointer"><div id="FontAwesomeIcon7"><i class="fa fa-check-square">&nbsp;</i></div></a></div></td>
						  <td>Orden:</td>
						  <td>
							  <div id="nordentrav2"></div>
							  <input type="hidden" id="nordentrav">

						 </td>
						</tr>

					  </tbody>
				 </table>
				</form>
 			 </div>

 			 <div class="modal-footer">

 			 </div>

 		 </div>
 	</div>
  </div>

</div>
</div>
</div>

<datalist id="listatb">
  <option value="">
  <option value="1. Si">
  <option value="2. No">
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

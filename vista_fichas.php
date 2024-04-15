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

if($row["laboratorio"] != ""){
   $laboratorio = $row['laboratorio'];
}else{
   $laboratorio = "2";
}

if($row["codservicio"] != ""){
	$codservicio1 = $row["codservicio"];
	$codservicio  = $row['codservicio'];
}
else{
	if($_GET['codservicio'] != ''){
		$codservicio = $_GET['codservicio'];
		$codservicio1= "";
		$_SESSION['codservicio'] = "";
	}
	else{
		$codservicio = $_SESSION['codservicio'];
	}

}

if($_GET['codorigen'] != ""){
	$codorigen = $_GET['codorigen'];
	$_SESSION['codorigen'] = "";
}
else{
	$codorigen = $_SESSION['codorigen'];
}

if($_GET['codempresa'] != ""){
	$codempresa = $_GET['codempresa'];
	$_SESSION['codempresa'] = "";
}
else{
	$codempresa = $_SESSION['codempresa'];
}

if($_GET['desde'] != ""){
	$desde = $_GET['desde'];
	$_SESSION['desde'] = "";
}
else{
	if($_SESSION['desde'] != ""){
		$desde = $_SESSION['desde'];
	}
	else{
		$desde = date("Y-m-d", time());
	}
}

if($_GET['hasta'] != ""){
	$hasta = $_GET['hasta'];
	$_SESSION['hasta'] = "";
}
else{
	if($_SESSION['desde'] != ""){
		$hasta = $_SESSION['hasta'];
	}
	else{
		$hasta = date("Y-m-d", time());
	}
}

$elusuario=$nomyape;

$v_13  = $_SESSION['V_13'];
$v_131 = $_SESSION['V_131'];
$v_132 = $_SESSION['V_132'];
$v_133 = $_SESSION['V_133'];
$v_14  = $_SESSION['V_14'];


if($_SESSION['usuario'] != "SI"){
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
<!----------- PARA MODAL  ---------->
<link rel="stylesheet" href="css/bootstrap.min.css">
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
/*   background-color: #FFFFFF;
   color: #337ab7;;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;*/
}
.form-control{
   height: 20px;
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
   width: 47px;
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

#hasta {
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
</style>

<script>
var x = jQuery.noConflict();

x(document).ready(function() {
	x("#Button10").click(function(){
		if(jQuery("#Combobox1").val() != '')
		{
			window.location = "nuevo_ordenes.php?codservicio="+jQuery("#Combobox1").val()+"&codorigen="+jQuery("#Combobox2").val()+"&codempresa="+jQuery("#Combobox3").val();
		}
		else
		{
			swal("Datos", "Los campos Establecimiento de Salud deben contener algun valor!", "warning");
		}

	});
});
</script>

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
        url:'datosordenes.php?codservicio=<?php echo $codservicio; ?>&codorigen=<?php echo $codorigen; ?>&codempresa=<?php echo $codempresa; ?>',
        datatype: 'json',
        mtype: 'GET',
    	loadonce:true,
        height: 330,
        recordpos: 'left',
        pagerpos: 'right',

		gridview: true,

        colNames:['Revisar','Borrar','Nro. Orden', 'Establecimiento Salud', 'Origen Paciente','Nombres y Apellidos', 'Fecha', 'Hora'],
        colModel:[
				{name:'modificar', width:60, resizable:false, align:"center", editable: false, editoptions:{maxlength:"50"}, search: false},

				{name:'borrar', width:60, resizable:false, align:"center", editable: false, editoptions:{maxlength:"50"}, search: false},

                {name:'nordentra',index:'nordentra', width:120, align:"center", editable: true, searchoptions: {attr: {maxlength: 10,size: 7,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'nomservicio',index: "nomservicio", width: 250, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'nomorigen',index: "nomorigen", width: 250, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

                {name:'nomyape',index: "nomyape", width: 300, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'fecharec',index: "fecharec", width: 100, align:"center", editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},

				{name:'horarec',index:'horarec', width:120, align:"center", editable: true, searchoptions: {attr: {maxlength: 10,size: 7,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}}
                 ],

                caption: "PACIENTES",
                ignoreCase:true,
                pager: '#perpage',
                rowNum:7,
                rowList:[7,15,30],

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
	var hasta	    = jQuery("#hasta").val();
	var desde  		= jQuery("#desde").val();

	jQuery("#listapacientes").jqGrid('setGridParam',{url:"datosordenes.php?codservicio="+codservicio+"&codorigen="+codorigen+"&codempresa="+codempresa+"&desde="+desde+"&hasta="+hasta,datatype:'json'}).trigger("reloadGrid");

}


</script>
<script language="JavaScript">

function confirmacion(cod, est)
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
				window.location = "eliminar_ordenes.php?nordentra=" + cod + "&codservicio=" + est;
			  }
			  else
			  {
				swal("El registro salvado!");
			  }
		});
}

</script>
<style type="text/css">
.glyphicon.glyphicon-edit, .glyphicon.glyphicon-trash {
    font-size: 20px;
}
</style>
<!-- <link rel="stylesheet" type="text/css" href="bootstrap-datepicker/bootstrap-datepicker3.min.css"> -->
<!-- JOSE -->
<script type="text/javascript">
   var idEnvio    = "";
   var ArrAGuardar = [];
   var ArrEnviados = [];
   // waitingDialog.show('Espere unos segundos... cargando ficha...');

   $(function () {
      $("#bc_datos,#bc_Enviados,.bc_impPDF,#bc_Codigo,#bc_NroEnvio,#bc_EliminarEnvio,#bc_ImprimirEnvio,#bc_Autocorreccion").hide();
      $(".sec_guardar").hide();
      // $("#Resultado").selectpicker();
      $('#modResultados').on('hidden.bs.modal', function (e) {
         $("body").css({"padding-right":"0px"});
      })
      // $.ajax({
      //    url: "views/sars_cov_2/frmDatosCierreCasos.html",
      //    cache: false,
      //    dataType: "html",
      //    success: function(data) {
      //       $("#DatosCierreCaso").append(data);
            
      //       $(".bc_FechaRecuperado").hide();
      //       $("#Recuperado").on("change",function(argument) {
      //          if ( $(this).val() == "SI" ) {
      //             $(".bc_FechaRecuperado").show();
      //          }else{
      //             $(".bc_FechaRecuperado").hide();
      //             $("#FechaRecuperado").val("");
      //          }
      //       })
      //       $("#CFSarsCov2").val("SOSPECHOSO");
      //       $("#CRSarsCov2").val("PENDIENTE");
      //       $("#CierreSarsCov2").val("");
      //       $("#CierreSarsCov2SE").val("");
      //       $("#RCSarsCov2").val("");
      //       $("#Recuperado").val("NO APLICA").trigger("change");
      //    }
      // });



      // $.ajax({
      //    type: 'POST',
      //    dataType: "json",
      //    url: 'dataserver/ajax/actualizar/view-v_laboratorios',
      //    data:{},
      // }).done(function(data) {
      //    if ( data.respuesta.length > 0 ) {
      //       $("select#LabEnvio").append( $("<option />").val("SD").text("Seleccione...") );  
      //       for (var i = 0; i < data.respuesta.length; i++) {
      //          $("select#LabEnvio").append( $("<option />").val(data.respuesta[i]["Laboratorio"]).text(data.respuesta[i]["Laboratorio"]) );  
      //       }
      //    }
      // })
      // .fail(function(){})
      // .always(function(){});

      


      // $('#FechaCierre').datepicker({
      //    todayBtn: true,
      //    clearBtn: true,
      //    language: "es",
      //    autoclose: true,
      //    todayHighlight: true
      // });
      // $('#FechaResultado').datepicker({
      //    todayBtn: true,
      //    clearBtn: true,
      //    language: "es",
      //    autoclose: true,
      //    todayHighlight: true
      // });




      // $('#FechaRecLab').datepicker({
      //    // orientation: "left bottom",
      //    todayBtn: true,
      //    clearBtn: true,
      //    language: "es",
      //    autoclose: true,
      //    todayHighlight: true
      // });
      
      // $('#FechaRecLab').datepicker({
      //    // orientation: "left bottom",
      //    todayBtn: true,
      //    clearBtn: true,
      //    language: "es",
      //    autoclose: true,
      //    todayHighlight: true
      // });
   });


   function AEnviar() {
      $("#btn_AEnviar").addClass("btn-warning");
      $("#btn_Enviados").removeClass("btn-warning");
      LimpiarDatosEnviados();
      $("#bc_AEnviar").show();
      $("#bc_Enviados").hide();
   }
   function Enviados(argument) {
      $("#btn_AEnviar").removeClass("btn-warning");
      $("#btn_Enviados").addClass("btn-warning");
      LimpiarDatosAEnviar();
      $("#bc_AEnviar").hide();
      $("#bc_Enviados").show();
   }
   
   function Buscar(argument) {
      if ($("#CodigoEnvio").val() != "") {
         LimpiarDatosAEnviar();
         var lab = <?php echo $laboratorio; ?>;
         // waitingDialog.show('Espere unos segundos...');
         $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'https://sistemasdgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/env-'+$("#CodigoEnvio").val()+'-1-'+lab+'-""',
            data:{ FuncionDB: $("#CodigoEnvio").val(), Orden: $("#orden").val() },
         }).done(function(data) {
            if ( data.respuesta.length > 0 ) {
               ArrAGuardar = data.respuesta;
               // console.log(ArrAGuardar[0]["CodigoPaciente"]);
               ArrEnviados = [];
               MatrizPendientes(data.respuesta,"AEnviar",function(argument) {
                  $("#bc_datos").show();
                  // $(".sec_guardar").show();
                  // $("#CFSarsCov2").val("SOSPECHOSO");
                  // $("#CRSarsCov2").val("PENDIENTE");
                  // $("#CierreSarsCov2").val("");
                  // $("#CierreSarsCov2SE").val("");
                  // $("#RCSarsCov2").val("");
                  // $("#Recuperado").val("NO APLICA").trigger("change");
                  // waitingDialog.hide();
               });
            }else{
               // waitingDialog.hide();
               swal('CIERRES...',"No se ha encontrado ningun dato..." );
            }
         })
         .fail(function() {
            // waitingDialog.hide();
         }).always(function(){});
      }
   }

   function VerificarDatos(argument) {
      if ($("#CodigoEnvio").val() != "") {
         LimpiarDatosAEnviar();
         var lab = <?php echo $laboratorio; ?>;
         // waitingDialog.show('Espere unos segundos...');
         $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'https://sistemasdgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/env-'+$("#CodigoEnvio").val()+'-1-'+lab+'-""',
            data:{ FuncionDB: $("#CodigoEnvio").val(), Orden: $("#orden").val() },
         }).done(function(data) {
            if ( data.respuesta.length > 0 ) {
               ArrAGuardar = data.respuesta;
               // console.log(ArrAGuardar[0]["CodigoPaciente"]);
               ArrEnviados = [];
               MatrizPendientesVerificar(data.respuesta,"AEnviar",function(argument) {
                  $("#bc_datos").show();
                  // $(".sec_guardar").show();
                  // $("#CFSarsCov2").val("SOSPECHOSO");
                  // $("#CRSarsCov2").val("PENDIENTE");
                  // $("#CierreSarsCov2").val("");
                  // $("#CierreSarsCov2SE").val("");
                  // $("#RCSarsCov2").val("");
                  // $("#Recuperado").val("NO APLICA").trigger("change");
                  // waitingDialog.hide();
               });
            }else{
               // waitingDialog.hide();
               swal('CIERRES...',"No se ha encontrado ningun dato..." );
            }
         })
         .fail(function() {
            // waitingDialog.hide();
         }).always(function(){});
      }      
   }
   
   function MatrizPendientesVerificar(argument,argument1,callback) {
      $("#tsw"+argument1).empty();
      $("#tabla"+argument1).hide();
      // console.log(argument);
      var ArrArgument = eval(argument);
      if ( ArrArgument.length > 0 ) {
         var $newtable = $("<table id='tbl_"+argument+"' class='table table-condensed'>");
         var $newtablehead = $("<thead>");
         var Cabeza = "<th>Item</th>"+
                   "<th>Codigo</th>"+
                   "<th>CI</th>"+
                   "<th>Nombres</th>"+
                   "<th>Apellidos</th>"+
                   "<th>Nro.Muestra</th>"+
                   "<th>Muestra Para</th>"+
                   "<th>Fecha Toma</th>"+
                   "<th>Muestra</th>"+
                   "<th>Nro. Laboratorio</th>"+
                   // "<th>Nro. Lab. Proceso</th>"+
                   "<th></th>";
                   // "<th class='text-center'><input type='checkbox' id='chk_all' name='chk_all'></th>";
         $($newtablehead).append(Cabeza);
         $($newtable).append($newtablehead);

         var $newtablebody = $("<tbody>");
         var existeLab = 0;
         for (var i = 0; i < ArrArgument.length; i++) {
            if ( ArrArgument[i]['NroLaboratorio'].length > 3  ) {
               var $newtr = $("<tr><td>"+(i+1)+"</td>"+ArrArgument[i]["td"]+"</tr>");
            }else{
               var $newtr = $("<tr class='bg-danger'><td>"+(i+1)+"</td>"+ArrArgument[i]["td"]+"</tr>");
            }
            
            $($newtablebody).append($newtr);
            if ( ArrArgument[i]["x"] == 1 ) {
               existeLab = 1
            }
         }
         if ( existeLab == 0 ) {
            $("#bc_EliminarEnvio").show();
            $("#bc_ImprimirEnvio").show();
         }
         $($newtable).append($newtablebody);
         $("#tsw"+argument1).empty();
         $("#tsw"+argument1).append(   '<hr style="border-top: 1px solid black;margin-bottom: 0">'+
                                 '<h3 class="block-title" style="padding-left: 15px;margin-top:10px;background-color: darkorange;color: white;"> TOMA DE MUESTRA</h3>'+
                                 '<hr style="border-top: 1px solid black;margin-bottom: 0;margin-top: 0px;">')
         $("#tsw"+argument1).append($newtable);
         $("#tabla"+argument1).show();
         $('[name="chk_all"]:checkbox').change(function() {
            $("input[name^='chk_']").prop('checked', $(this).prop("checked"));
         });
         callback();
      }else {
         $("#tsw"+argument1).empty();
         $("#tabla"+argument1).hide();
         callback();
      }
   }
   function BuscarPaciente(argument) {
      if ($("#CodigoPaciente").val() != "") {
         LimpiarDatosAEnviar();
         var lab = <?php echo $laboratorio; ?>;
         // waitingDialog.show('Espere unos segundos...');
         $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'https://sistemasdgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/env-'+$("#CodigoPaciente").val()+'-3-'+lab+'-""',
            data:{ FuncionDB: $("#CodigoPaciente").val(), Orden: $("#orden").val() },
         }).done(function(data) {
            if ( data.respuesta.length > 0 ) {
               ArrAGuardar = data.respuesta;
               ArrEnviados = [];
               MatrizPendientes(data.respuesta,"AEnviar",function(argument) {
                  $("#bc_datos").show();
               });
            }else{
               swal('CIERRES...', "No se ha encontrado ningun dato...");
            }
         })
         .fail(function() {
         }).always(function(){});
      }
   }
   
   function BuscarEnviados(argument) {
      LimpiarDatosEnviados();
      // waitingDialog.show('Espere unos segundos...');
      if ($("#FechaCierre").val() != "") {
         $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'dataserver/ajax/actualizar/cerradosLote',
            data:{ FuncionDB: $("#FechaCierre").val(), Orden: $("#ordenResultado").val() },
         }).done(function(data) {
            if ( data.respuesta.length > 0 ) {
               ArrEnviados = data.respuesta;
               ArrAGuardar = [];
               MatrizResultados(data.respuesta,"Enviados",function(argument) {
                  $(".sec_guardar").show();
                  $("#CFSarsCov2").val("SOSPECHOSO");
                  $("#CRSarsCov2").val("PENDIENTE");
                  $("#CierreSarsCov2").val("");
                  $("#CierreSarsCov2SE").val("");
                  $("#RCSarsCov2").val("");
                  $("#Recuperado").val("NO APLICA").trigger("change");
                  // waitingDialog.hide();
               });
            }else{
               // waitingDialog.hide();
               swal('CIERRES...', "No se ha encontrado ningun cierre...");
            }
         })
         .fail(function(){})
         .always(function(){});
      }
   }
   
   function MatrizPendientes(argument,argument1,callback) {
      $("#tsw"+argument1).empty();
      $("#tabla"+argument1).hide();
      // console.log(argument);
      var ArrArgument = eval(argument);
      if ( ArrArgument.length > 0 ) {
         var $newtable = $("<table id='tbl_"+argument+"' class='table table-condensed'>");
         var $newtablehead = $("<thead>");
         var Cabeza = "<th>Item</th>"+
                   "<th>Codigo</th>"+
                   "<th>CI</th>"+
                   "<th>Nombres</th>"+
                   "<th>Apellidos</th>"+
                   "<th>Nro.Muestra</th>"+
                   "<th>Muestra Para</th>"+
                   "<th>Fecha Toma</th>"+
                   "<th>Muestra</th>"+
                   "<th>Nro. Laboratorio</th>"+
                   // "<th>Nro. Lab. Proceso</th>"+
                   "<th></th>";
                   // "<th class='text-center'><input type='checkbox' id='chk_all' name='chk_all'></th>";
         $($newtablehead).append(Cabeza);
         $($newtable).append($newtablehead);

         var $newtablebody = $("<tbody>");
         var existeLab = 0;
         for (var i = 0; i < ArrArgument.length; i++) {
            var $newtr = $("<tr><td>"+(i+1)+"</td>"+ArrArgument[i]["td"]+"</tr>");
            $($newtablebody).append($newtr);
            if ( ArrArgument[i]["x"] == 1 ) {
               existeLab = 1
            }
         }
         if ( existeLab == 0 ) {
            $("#bc_EliminarEnvio").show();
            $("#bc_ImprimirEnvio").show();
         }
         $($newtable).append($newtablebody);
         $("#tsw"+argument1).empty();
         $("#tsw"+argument1).append(   '<hr style="border-top: 1px solid black;margin-bottom: 0">'+
                                 '<h3 class="block-title" style="padding-left: 15px;margin-top:10px;background-color: darkorange;color: white;"> TOMA DE MUESTRA</h3>'+
                                 '<hr style="border-top: 1px solid black;margin-bottom: 0;margin-top: 0px;">')
         $("#tsw"+argument1).append($newtable);
         $("#tabla"+argument1).show();
         $('[name="chk_all"]:checkbox').change(function() {
            $("input[name^='chk_']").prop('checked', $(this).prop("checked"));
         });
         callback();
      }else {
         $("#tsw"+argument1).empty();
         $("#tabla"+argument1).hide();
         callback();
      }
   }

   function LimpiarDatosAEnviar(argument) {
      ArrAGuardar = [];
      ArrEnviados = [];
      $("#bc_datos").hide();
      $("#FechaRecLab").val("");
      // $("#CFSarsCov2").val("SOSPECHOSO");
      // $("#CRSarsCov2").val("PENDIENTE");
      // $("#CierreSarsCov2").val("");
      // $("#CierreSarsCov2SE").val("");
      // $("#RCSarsCov2").val("");
      // $("#Recuperado").val("NO APLICA").trigger("change");
      // $(".sec_guardar").hide();
      $("#tswAEnviar").empty();
      $("#tablaAEnviar").hide();

      $("#tswEnviados").empty();
      $("#tablaEnviados").hide();
   }

   function LimpiarDatosEnviados(argument) {
      ArrAGuardar = [];
      ArrEnviados = [];
      $("#CFSarsCov2").val("SOSPECHOSO");
      $("#CRSarsCov2").val("PENDIENTE");
      $("#CierreSarsCov2").val("");
      $("#CierreSarsCov2SE").val("");
      $("#RCSarsCov2").val("");
      $("#Recuperado").val("NO APLICA").trigger("change");
      $(".sec_guardar").hide();
      $("#tswAEnviar").empty();
      $("#tablaAEnviar").hide();

      $("#tswEnviados").empty();
      $("#tablaEnviados").hide();
   }

	function ActNroLabPro(argument,argument1) {
      var CodMue = argument.split("-");
      if ( $("#NroLab_"+argument).val() == "" ) {
        // waitingDialog.show('Espere unos segundos...');
        for (var i = 0; i < ArrAGuardar.length; i++) {
            if( ArrAGuardar[i]["CodigoPaciente"] == CodMue[0] && ArrAGuardar[i]["NroMuestraRes"] == CodMue[1] ){
               var Pos = i;
               break;
            }
         }
         // console.log(ArrAGuardar[Pos]);
         
         if ( ArrAGuardar[Pos]["TDocumento"] == "CEDULA DE IDENTIDAD" ) { var tpdoc = "1"; }else{ var tpdoc = "2"; }
         var nom = ArrAGuardar[Pos]["Nombres"].split(" ");
         var ape = ArrAGuardar[Pos]["Apellidos"].split(" ");
         var nom1 = nom[0];
         var nom2 = "";
         for (var i = 1; i < nom.length; i++) {
            nom2 += nom[i];
            if ( (i+1) < nom.length ) { nom2 += " "; }
         }
         var ape1 = ape[0];
         var ape2 = "";
         for (var i = 1; i < ape.length; i++) {
            ape2 = ape[i];
            if ( (i+1) < ape.length ) { ape2 += " "; }
         }
         if ( ArrAGuardar[Pos]["Sexo"] == "MASCULINO" ) { var sex = "1"; }else{ var sex = "2"; }
         
         var feanac = "0000-00-00";
         if (ArrAGuardar[Pos]["FechaNacimiento"] != "") { var feanac = ArrAGuardar[Pos]["FechaNacimiento"].split("/"); }

         var ed = ArrAGuardar[Pos]["Edad"];
         var me = "0";
         if (ArrAGuardar[Pos]["MedidaEdad"] == "MES/ES" || ArrAGuardar[Pos]["MedidaEdad"] == "DIA/S") {
            ed = "0";
            me = ArrAGuardar[Pos]["Edad"];
         }
         var presi = "";
         if ( ArrAGuardar[Pos]["Residente"] == "SI" ) {
            presi = "PARAGUAY";
         }else if ( ArrAGuardar[Pos]["Residente"] == "NO" ) {
            presi = "EXTRANJERO";
         }else if ( ArrAGuardar[Pos]["Residente"] == "SD" ) {
            presi = "SD";
         }
         if ( $("#CodigoEnvio").val().split('_')[1] == "seq" ) {
         	ttoma = "98";
         }else{
         	ttoma = ArrAGuardar[Pos]["MuestraPara"];
         }
         var ToSendLCSP = [{  tdocumento:          tpdoc,
                              cedula:              ArrAGuardar[Pos]["CI"],
                              pnombre:             nom1,
                              snombre:             nom2,
                              papellido:           ape1,
                              sapellido:           ape2,
                              sexo:                sex,
                              fechanac:            feanac[2]+"-"+feanac[1]+"-"+feanac[0],
                              edada:               ed,
                              edadm:               me,
                              ecivil:              "7",
                              nacionalidad:        "",
                              telefono:            ArrAGuardar[Pos]["Telefono"],
                              email:               ArrAGuardar[Pos]["CorreoPaciente"],
                              codexterno:          "",
                              estado:              "1",
                              dccionr:             ArrAGuardar[Pos]["Direccion"],
                              paisr:               presi,
                              coddptor:            ArrAGuardar[Pos]["Departamento"],
                              coddistr:            ArrAGuardar[Pos]["Distrito"],
                              nomyapefam:          "",
                              telefonof:           "",
                              celularf:            "",
                              obs:                 "",
                              codusup:             "sdgvs",
                              tb:                  "2",
                              cod_dgvs:            ArrAGuardar[Pos]["CodigoPaciente"],
                              Establecimiento:     ArrAGuardar[Pos]["Establecimiento"],
                              EstablecimientoDes:  ArrAGuardar[Pos]["EstablecimientoDesc"],
                              LaboratorioProc:     ArrAGuardar[Pos]["LABORATORIO"],
                              // EstablecimientoMan:  $("#Establecimiento_manual").val(),
                              Hospitalizado:       ArrAGuardar[Pos]["Hospitalizado"],
                              NroMuestra:          ArrAGuardar[Pos]["NroMuestraRes"],
                              Muestra:             ArrAGuardar[Pos]["Muestra"],
                              ffiebre:             ArrAGuardar[Pos]["InicioFiebre"],
                              ftoma:               ArrAGuardar[Pos]["FechaToma"],
                              ttoma: 			      ttoma
                              // ArrLaboratorioTOT:   ArrLaboratorioTOT,
                              // ArrResultadoTOT:     ArrResultadoTOT,
                              // ArrEliminarLAB:      ArrEliminarLAB,
                              // U:                automac[0]["US"],
                           }];
         $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'vista_fichas_add.php',
            data:{ lcsp: ToSendLCSP },
         }).done(function(data) {
            // console.log(data.respuesta);
            // if ( data.retorno == "0" ) {
               // waitingDialog.hide();
               $("#NroLab_"+argument).val(data.respuesta);
               window.open("impresion_etiqueta_sis.php?nordentra="+CodMue[0]+"&codservicio="+CodMue[1]);
               var lab = <?php echo $laboratorio; ?>;
               var usu = <?php echo "'".$codusu."'"; ?>;
               if ( ttoma != "98") {
                  $.ajax({
                     type: 'POST',
                     dataType: "json",
                     url: 'https://sistemasdgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/actLCSP-1',
                     data:{ id: argument, orden: data.respuesta, usu: usu ,lab: lab },
                  }).done(function(data) {
                     if ( data.respuesta.error == "" ) {
                        swal('ACTUALIZACION D.G.V.S.', "Actualizado correctamente en D.G.V.S.");
                     }else{
                        swal('ACTUALIZACION D.G.V.S.', data.respuesta.error);
                     }
                  })
                  .fail(function() {
                  }).always(function(){});
               }else if ( ttoma == "98") {
                  $.ajax({
                     type: 'POST',
                     dataType: "json",
                     url: 'https://sistemasdgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/actLCSP-3',
                     data:{ id: argument, orden: data.respuesta, usu: usu ,lab: lab },
                  }).done(function(data) {
                     if ( data.respuesta.error == "" ) {
                        swal('ACTUALIZACION D.G.V.S.', "Actualizado correctamente en D.G.V.S.");
                     }else{
                        swal('ACTUALIZACION D.G.V.S.', data.respuesta.error);
                     }
                  })
                  .fail(function() {
                  }).always(function(){});
               }
            // }else if ( data.retorno == "1" ) {
            //   swal("La Ficha ya fue Agregada");
            //   $("#NroLab_"+argument).val(data.respuesta);
            //   window.open("impresion_etiqueta_sis.php?nordentra="+CodMue[0]+"&codservicio="+CodMue[1]);
            //}else{
               // waitingDialog.hide();
               // swal('ERROR...',content: "No se ha podido actualizar el Nro de Muestra..." });
            //}
         })
         .fail(function() {
            // waitingDialog.hide();
         }).always(function(){});
      }else{
         swal("La Ficha ya fue Agregada");
      }
   }

	function ActNroLabProOtros(argument,argument1) {
      $("#btn_"+argument).attr("disabled",true);
      var CodMue = argument.split("-");
      if ( $("#NroLab_"+argument).val() == "" ) {
        // waitingDialog.show('Espere unos segundos...');
        for (var i = 0; i < ArrAGuardar.length; i++) {
            if( ArrAGuardar[i]["idLab"] == CodMue[0] && ArrAGuardar[i]["NroMuestraRes"] == CodMue[1] ){
               var Pos = i;
               break;
            }
         }
         // console.log(ArrAGuardar[Pos]);
         // 5 = ELISA
         // 7 = CULTIVO VIRAL
         // 6 = INMUNOCROMATOGRAFICO
         // 2 = PCR
         if ( ArrAGuardar[Pos]["TDocumento"] == "CEDULA DE IDENTIDAD" ) { var tpdoc = "1"; }else{ var tpdoc = "2"; }
         var nom = ArrAGuardar[Pos]["Nombres"].split(" ");
         var ape = ArrAGuardar[Pos]["Apellidos"].split(" ");
         var nom1 = nom[0];
         var nom2 = "";
         for (var i = 1; i < nom.length; i++) {
            nom2 += nom[i];
            if ( (i+1) < nom.length ) { nom2 += " "; }
         }
         var ape1 = ape[0];
         var ape2 = "";
         for (var i = 1; i < ape.length; i++) {
            ape2 = ape[i];
            if ( (i+1) < ape.length ) { ape2 += " "; }
         }
         if ( ArrAGuardar[Pos]["Sexo"] == "MASCULINO" ) { var sex = "1"; }else{ var sex = "2"; }
         
         var feanac = "0000-00-00";
         if (ArrAGuardar[Pos]["FechaNacimiento"] != "") { var feanac = ArrAGuardar[Pos]["FechaNacimiento"].split("/"); }

         var ed = ArrAGuardar[Pos]["Edad"];
         var me = "0";
         if (ArrAGuardar[Pos]["MedidaEdad"] == "MES/ES" || ArrAGuardar[Pos]["MedidaEdad"] == "DIA/S") {
            ed = "0";
            me = ArrAGuardar[Pos]["Edad"];
         }
         var presi = "";
         if ( ArrAGuardar[Pos]["Residente"] == "SI" ) {
            presi = "PARAGUAY";
         }else if ( ArrAGuardar[Pos]["Residente"] == "NO" ) {
            presi = "EXTRANJERO";
         }else if ( ArrAGuardar[Pos]["Residente"] == "SD" ) {
            presi = "SD";
         }
         
         // if ( ArrAGuardar[Pos]["MuestraPara"] == "11" ) { /* Microscopia */
         //    ttoma = "05";
         // }else if ( ArrAGuardar[Pos]["MuestraPara"] == "2" ) { /* PCR */
         //    // ttoma = "05001";
         // }else if ( ArrAGuardar[Pos]["MuestraPara"] == "4" ) { /* TEST RAPIDO */
         //    // ttoma = "05001";
         // }

         var ToSendLCSP = [{  tdocumento:          tpdoc,
                              cedula:              ArrAGuardar[Pos]["CI"],
                              pnombre:             nom1,
                              snombre:             nom2,
                              papellido:           ape1,
                              sapellido:           ape2,
                              sexo:                sex,
                              fechanac:            feanac[2]+"-"+feanac[1]+"-"+feanac[0],
                              edada:               ed,
                              edadm:               me,
                              ecivil:              "7",
                              nacionalidad:        "",
                              telefono:            ArrAGuardar[Pos]["Telefono"],
                              email:               ArrAGuardar[Pos]["CorreoPaciente"],
                              codexterno:          "",
                              estado:              "1",
                              dccionr:             ArrAGuardar[Pos]["Direccion"],
                              paisr:               presi,
                              coddptor:            ArrAGuardar[Pos]["Departamento"],
                              coddistr:            ArrAGuardar[Pos]["Distrito"],
                              nomyapefam:          "",
                              telefonof:           "",
                              celularf:            "",
                              obs:                 "",
                              codusup:             "sdgvs",
                              tb:                  "2",
                              orden_dgvs:          ArrAGuardar[Pos]["idLab"],
                              cod_dgvs:            ArrAGuardar[Pos]["CodigoPaciente"],
                              NroMuestra:          ArrAGuardar[Pos]["NroMuestraRes"],
                              MuestraPara:         ArrAGuardar[Pos]["MuestraPara"],
                              Enfermedad:          ArrAGuardar[Pos]["Enfermedad"],
                              Establecimiento:     ArrAGuardar[Pos]["Establecimiento"],
                              EstablecimientoDes:  ArrAGuardar[Pos]["EstablecimientoDesc"],
                              // EstablecimientoMan:  $("#Establecimiento_manual").val(),
                              Hospitalizado:       ArrAGuardar[Pos]["Hospitalizado"],
                              Fallecido:           ArrAGuardar[Pos]["Fallecido"], 
                              Muestra:             ArrAGuardar[Pos]["Muestra"],
                              ffiebre:             ArrAGuardar[Pos]["InicioFiebre"],
                              ftoma:               ArrAGuardar[Pos]["FechaToma"],
                              ttoma: 			      'otros',
                              IdFicha:             ArrAGuardar[Pos]["IdFicha"],
                              id_secciones_ficha:  ArrAGuardar[Pos]["id_secciones_ficha"],

                              // ArrLaboratorioTOT:   ArrLaboratorioTOT,
                              // ArrResultadoTOT:     ArrResultadoTOT,
                              // ArrEliminarLAB:      ArrEliminarLAB,
                              // U:                automac[0]["US"],
                           }];
         $.ajax({
            type: 'POST',
            dataType: "json",
            url: 'vista_fichas_add_otr.php',
            data:{ lcsp: ToSendLCSP },
         }).done(function(data) {
            // console.log(data.respuesta);
            if ( data.retorno == "0" ) {
               // waitingDialog.hide();
               $("#NroLab_"+argument).val(data.respuesta);
               window.open("impresion_etiqueta_sis_otros.php?nordentra="+ArrAGuardar[Pos]["CodigoPaciente"]+"&codservicio="+CodMue[1]+"&orden_dgvs="+ArrAGuardar[Pos]["idLab"]);
               var lab = <?php echo $laboratorio; ?>;
               var usu = <?php echo "'".$codusu."'"; ?>;
               // if ( ttoma != "98") {
                  $.ajax({
                     type: 'POST',
                     dataType: "json",
                     url: 'https://sistemasdgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/actLCSP-Otros',
                     data:{ id: ArrAGuardar[Pos]["idRes"], orden: data.respuesta, usu: usu, lab: lab, idLab: ArrAGuardar[Pos]["idLab"] },
                  }).done(function(data) {
                     if ( data.respuesta.error == "" ) {
                        swal('ACTUALIZACION D.G.V.S.', "Actualizado correctamente en D.G.V.S.");
                        $("#btn_"+argument).attr("disabled",false);
                     }else{
                        swal('ACTUALIZACION D.G.V.S.', data.respuesta.error);
                        $("#btn_"+argument).attr("disabled",false);
                     }
                  })
                  .fail(function() {
                  }).always(function(){});



               // }else if ( ttoma == "98") {
               //    $.ajax({
               //       type: 'POST',
               //       dataType: "json",
               //       url: 'https://sistemasdgvs.mspbs.gov.py/sistemas/itdgvsops/dataserver/ajax/actualizar/actLCSP-3',
               //       data:{ id: argument, orden: data.respuesta, usu: usu, lab: lab },
               //    }).done(function(data) {
               //       if ( data.respuesta.error == "" ) {
               //          swal('ACTUALIZACION D.G.V.S.', "Actualizado correctamente en D.G.V.S.");
               //       }else{
               //          swal('ACTUALIZACION D.G.V.S.', data.respuesta.error);
               //       }
               //    })
               //    .fail(function() {
               //    }).always(function(){});
               // }
            }else if ( data.retorno == "1" ) {
               swal("La Ficha ya fue Agregada");
               $("#NroLab_"+argument).val(data.respuesta);
               window.open("impresion_etiqueta_sis_otros.php?nordentra="+$("#NroLab_"+argument).val()+"&codservicio="+CodMue[1]+"&orden_dgvs="+ArrAGuardar[Pos]["idLab"]);
               $("#btn_"+argument).attr("disabled",false);
               // window.open("impresion_etiqueta_sis_otros.php?nordentra="+ArrAGuardar[Pos]["CodigoPaciente"]+"&codservicio="+CodMue[1]+"&orden_dgvs="+ArrAGuardar[Pos]["idLab"]);
            }else{
               // waitingDialog.hide();
               // swal('ERROR...',content: "No se ha podido actualizar el Nro de Muestra..." });
            }
         })
         .fail(function() {
            // waitingDialog.hide();
         }).always(function(){});
      }else{
         swal("La Ficha ya fue Agregada");
         for (var i = 0; i < ArrAGuardar.length; i++) {
            if( ArrAGuardar[i]["idLab"] == CodMue[0] && ArrAGuardar[i]["NroMuestraRes"] == CodMue[1] ){
               var Pos = i;
               break;
            }
         }
         window.open("impresion_etiqueta_sis_otros.php?nordentra="+ArrAGuardar[Pos]["CodigoPaciente"]+"&codservicio="+CodMue[1]+"&orden_dgvs="+ArrAGuardar[Pos]["idLab"]);
         $("#btn_"+argument).attr("disabled",false);
      }
   }

   function MostrarResultados(argument){
      // console.log(argument);
      // waitingDialog.show('Espere unos segundos...');
      $.ajax({
         type: 'POST',
         dataType: "json",
         url: 'dataserver/ajax/actualizar/resultadosCodigo',
         data:{ FuncionDB: argument },
      }).done(function(data) {
         if ( data.respuesta.length > 0 ) {
            MatrizResultadosCodigo(data.respuesta,"Codigo",function(argument) {
               $( "#modResultados" ).modal( "show" );
            });
            // waitingDialog.hide();
         }else{
            // waitingDialog.hide();
            swal('MUESTRAS...', "No se ha encontrado ninguna muestra...");
         }
      })
      .fail(function() {
         // waitingDialog.hide();
      }).always(function(){});
   }

   function MatrizResultadosCodigo(argument,argument1,callback) {
      $("#tsw"+argument1).empty();
      $("#tabla"+argument1).hide();
      var ArrArgument = eval(argument);
      if ( ArrArgument.length > 0 ) {
         var $newtable = $("<table id='tbl_"+argument+"' class='table table-condensed'>");
         var $newtablehead = $("<thead>");
         var Cabeza = "<th>Codigo</th>"+
                   "<th>Nro. Muestra</th>"+
                   "<th>Fecha Toma</th>"+
                   "<th>Nro. Laboratorio</th>"+
                   "<th>Nro Lab. Resultado</th>"+
                   "<th>Resultado</th>"+
                   "<th>Excel</th>";
         $($newtablehead).append(Cabeza);
         $($newtable).append($newtablehead);

         var $newtablebody = $("<tbody>");
         var existeLab = 0;
         for (var i = 0; i < ArrArgument.length; i++) {
            var $newtr = $("<tr>"+ArrArgument[i]["td"]+"</tr>");
            $($newtablebody).append($newtr);
         }
         $($newtable).append($newtablebody);
         $("#tsw"+argument1).empty();
         $("#tsw"+argument1).append(   '<hr style="border-top: 1px solid black;margin-bottom: 0">'+
                                 '<h3 class="block-title" style="padding-left: 15px;margin-top:10px;background-color: darkorange;color: white;"> RESULTADOS</h3>'+
                                 '<hr style="border-top: 1px solid black;margin-bottom: 0;margin-top: 0px;">')
         $("#tsw"+argument1).append($newtable);
         $("#tabla"+argument1).show();
         callback();
      }else {
         $("#tsw"+argument1).empty();
         $("#tabla"+argument1).hide();
         callback();
      }
   }
</script>
</head>
<body onload="gridReload()">
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
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br><br></strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>ORDENES</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong><br />
					</strong></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container" style="padding: 0px">
<!-- EMPIEZA -->
   <div class="col-xs-12" id="frm_fsarscov2" name="frm_fsarscov2" style="margin-top: 0px;padding: 0px;">
      <div class="page-header" style="margin-top: 0px;padding-top: 0px;">
         <h3 style="margin-top: 0px;padding-top: 0px;">Recepcion de muestras</h3>
      </div>
<!--       <div class="row">
         <div calss="col-sm-12">
            <div class="form-group">
               <div class="col-sm-12 st-pad-t-0">
                    <div class="btn-group mr-1" role="group">
                     <button type="button" class="btn hidden-print" id="btn_AEnviar" onclick="AEnviar()">Cargar Recepcion</button>
                  </div>
                 <div class="btn-group mr-1" role="group">
                     <button type="button" class="btn hidden-print" id="btn_Enviados" onclick="Enviados()">Recepciones Cargadas</button>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
      
      <div class="panel panel-default" id="bc_AEnviar">
         <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> A RECEPCIONAR </div>
         <div class="panel-body" id="pb_AEnviar">
            <div class="col-xs-6 col-sm-3 col-md-3">
               <label for="CodigoEnvio">Codigo Envio</label>
               <div class="input-group">
                  <input id="CodigoEnvio" name="CodigoEnvio" class="form-control" type="text" style="width:80%;height: 20px;">
                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button" onclick="Buscar()">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                     </button>
                     <button type="button" class="btn btn-default hidden-print" onclick="LimpiarDatosAEnviar()">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                     </button>
                  </span>
               </div>
            </div>
            
            <div class="col-xs-6 col-sm-3 col-md-3">
               <label for="CodigoPaciente">Codigo Paciente</label>
               <div class="input-group">
                  <input id="CodigoPaciente" name="CodigoPaciente" class="form-control" type="text" style="width:80%;height: 20px;">
                  <span class="input-group-btn">
                     <button class="btn btn-default" type="button" onclick="BuscarPaciente()">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                     </button>
                     <button type="button" class="btn btn-default hidden-print" onclick="LimpiarDatosAEnviar()">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                     </button>
                  </span>
               </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                  <button type="button" class="btn btn-default hidden-print" onclick="VerificarDatos()" style="margin-top: 25px;">
                     <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
                  </button>
            </div>

            <div class="clearfix"></div>
            <div class="table-responsive" id="tablaAEnviar" style="background-color: white;padding-left: 3px;">
               <div id='tswAEnviar'></div>
            </div>
         </div>
<!--          <div class="col-xs-12" id="bc_datos" style="padding: 0px">
            <div class="col-xs-6 col-sm-3 col-md-3">
               <label for="FechaRecLab">Fecha de Recepcion</label>
               <input id="FechaRecLab" name="FechaRecLab" class="js-datepicker form-control" type="text" data-date-format="dd/mm/yyyy" style="width:100%;height: 20px;" placeholder="dd/mm/yyyy">
            </div>
            <div class="col-xs-3 col-sm-3 col-md-2">
               <button class="btn btn-success hidden-print" type="button" onclick="GuardarRecepcion()" style="margin-top: 24px;">Guardar</button>
            </div>
         </div> -->
      </div>
<!--       <div class="panel panel-default" id="bc_Enviados">
         <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> RECEPCIONADOS</div>
      </div> -->
</div>

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
   
<!--     <script src="bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="bootstrap-datepicker/bootstrap-datepicker.es.min.js"></script> -->
    <!-- <script src="js/espera.js"></script> -->
</body>
<?php
if ($_GET["mensage"]==4)
{
	echo "<script type=''>
     swal('NO se puede borrar, pues otros datos dependen de este registro !!!','','error');
     </script>";
}
if ($_GET["mensage"]==1)
{
	echo "<script type=''>
     swal('El registro ha sido eliminado!','','success');
     </script>";
}

?>
</html>

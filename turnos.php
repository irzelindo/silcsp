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

if($row["codarea"] != "")
{
	$codarea1 = $row["codarea"];
	$codarea  = $row['codarea'];
}
else
{
	if($_GET['codarea'] != '')
	{
		$codarea = $_GET['codarea'];
		$codarea1= "";
		$_SESSION['codarea'] = "";
	}
	else
	{
		$codarea = $_SESSION['codarea'];
	}
	
}

if($_GET['codturno'] != "")
{
	$codturno = $_GET['codturno'];
	$_SESSION['codturno'] = "";
}
else
{
	$codturno = $_SESSION['codturno'];
}

if($_GET['fechaturno'] != '')
{
	$fechaturno  = $_GET['fechaturno'];
	$_SESSION['fechaturno'] = "";
}
else
{
	$fechaturno = $_SESSION['fechaturno'];
}

$elusuario=$nomyape;

$v_12  = $_SESSION['V_12'];


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
  <link href="css/mibootstrap.css" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="style.css"/>
    
  <link href="css/animate.min.css" rel="stylesheet"/>

 <!----------- JAVASCRIPT ---------->
<script src="js/jquery.min.js"></script>
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css"> 
 <!----------- PARA ALERTAS  ---------->
<script src="js/sweetalert.min.js" type="text/javascript"></script>
<!----------- PARA CALENDARIO  ---------->
<link href="fullcalendar/fullcalendar.min.css" rel="stylesheet" />
<link href="fullcalendar/jquery-ui.css" rel="stylesheet" />
<link href="fullcalendar/fullcalendar.print.min.css" rel='stylesheet' media='print' />

<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/fullcalendar.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>
<script src="fullcalendar/demos/js/theme-chooser.js"></script>


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
   margin-bottom: 5px;
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
    left: 418px;
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
</style>

<script>
var a = jQuery.noConflict();
a(document).ready(function() {
	var tempVar = "";

	a('#calendar').fullCalendar({
		header: {
			left: '',
			center: '',
			right: ''
		},
		themeSystem: 'jquery-ui',
		contentHeight: 400,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi\u00e9rcoles','Jueves','Viernes','S\u00e1bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi\u00e9','Jue','Vie','S\u00e1b'],
		defaultDate: Date(),
		dayClick: function(date, jsEvent, view) {

			var fecha = date.format('DD/MM/YYYY');

			var f = fecha.toString();

			var dia  = f.substr(0, 2);
			var mes  = f.substr(3, 2); 
			var anio = f.substr(6, 4);

			switch(mes) {
				case '01':
					meses = "Enero";
					break;
				case '02':
					meses = "Febrero";
					break;
				case '03':
					meses = "Marzo";
					break;
				case '04':
					meses = "Abril";
					break;
				case '05':
					meses = "Mayo";
					break;
				case '06':
					meses = "Junio";
					break;
				case '07':
					meses = "Julio";
					break;
				case '08':
					meses = "Agosto";
					break;
				case '09':
					meses = "Septiembre";
					break;
				case '10':
					meses = "Octubre";
					break;
				case '11':
					meses = "Noviembre";
					break;
				case '12':
					meses = "Diciembre";
					break;
			}

			if(jQuery("#Combobox1").val() != '' && jQuery("#Combobox2").val() != '' && jQuery("#Combobox3").val() != '')
			{
				 a.ajax({
						url:'buscarturno.php',
						type:'POST',
						dataType:'json',
						data:{fecha:fecha, codservicio:jQuery("#Combobox1").val(), codarea:jQuery("#Combobox2").val(), codturno:jQuery("#Combobox3").val()}
					}).done(function(respuesta){

						  a("#CantDias").text(respuesta.cantdias);

						  a("#FechaHora").text(dia+' '+meses+' '+anio+': ');

						  a("#fechaturno").val(fecha);

						  a(document).ready(gridReload());

					});

					if (tempVar == "")
					{
						a(this).css('background-color', '#80C8D1');
						tempVar = this;
					}
					else
					{
						a(this).css('background-color', '#80C8D1');
						a(tempVar).css('background-color', '#FFFFFF');
						tempVar = this;
					}
		  }
		  else
		  {
			  swal("Los campos Establecimiento de Salud, Area del Establecimiento y Tipo Turno deben contener algun valor!", "", "warning");
		  }

		},
		selectable: false
	});


});

</script>

<script>
var x = jQuery.noConflict();

x(document).ready(function() {
	x("#Button1").click(function(){
			if(jQuery("#Combobox1").val() != '' && jQuery("#Combobox2").val() != '' && jQuery("#Combobox3").val() != '' && jQuery("#fechaturno").val() != '')
		  	{
				  x.ajax({
				  url:'disponibleturno.php',
				  type:'POST',
				  dataType:'json',
				  data:{ codservicio:jQuery("#Combobox1").val(), 
						 codarea:jQuery("#Combobox2").val(), 
						 codturno:jQuery("#Combobox3").val(), fechaturno:jQuery("#fechaturno").val()}
						  }).done(function(respuesta){
					  
					  if(respuesta.turno == 'Si')
					  {
						  window.location = "nuevo_turnos.php?codservicio="+jQuery("#Combobox1").val()+"&codarea="+jQuery("#Combobox2").val()+"&codturno="+jQuery("#Combobox3").val()+"&fechaturno="+jQuery("#fechaturno").val();
					  }
					  else
					  {
						  if(respuesta.turno == 'No')
						  {
							  swal("La Fecha elegida tiene que ser mayor o igual a la Fecha Actual!", "", "warning");
						  }
						  else
						  {
							  swal("La Fecha elegida es un dia festivo: "+respuesta.turno, "", "warning");
						  }  
					  }

				  });
		  	}
		  	else
		  	{
				  swal("Los campos Establecimiento de Salud, Area del Establecimiento, Tipo Turno y Fecha deben contener algun valor!", "", "warning");
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
        url:'datospacientesturnos.php?codservicio=<?php echo $codservicio; ?>&codarea=<?php echo $codarea; ?>&codturno=<?php echo $codturno; ?>&fechaturno=<?php echo $fechaturno; ?>',
        datatype: 'json',
        mtype: 'GET',
    	loadonce:true,
        height: 200,
        recordpos: 'left',
        pagerpos: 'right',

		gridview: true,
        
        colNames:['Revisar','Anular','Hora Turno', 'Nro. Paciente','Nombres y Apellidos', 'Direcci&oacute;n', 'Tel&eacute;fono'],
        colModel:[
				{name:'modificar', width:60, resizable:false, align:"center",sorttype:"int", editable: false, editoptions:{maxlength:"50"}, search: false},
				{name:'borrar', width:60, resizable:false, align:"center",sorttype:"int", editable: false, editoptions:{maxlength:"50"}, search: false},
				{name:'horatur',index:'horatur', width:120, align:"center", editable: true, searchoptions: {attr: {maxlength: 10,size: 7,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},
                {name:'nropaciente',index:'nropaciente', width:120, align:"center", editable: true, searchoptions: {attr: {maxlength: 10,size: 7,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},
                {name:'nomyape',index: "nomyape", width: 300, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},
                {name:'dccionr',index: "dccionr", width: 250, editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}},
				{name:'telefono',index: "telefono", width: 100, align:"center", editable: true, searchoptions: {attr: {maxlength: 100,size: 80,style: "width:auto;padding:1;max-width:100%;height:3em;float:left"}}}
                 ],
                                  
                caption: "PACIENTES",
                ignoreCase:true,                
                pager: '#perpage',
                rowNum:7,
                rowList:[7,15,30],

                sortname: 'horatur',
                sortorder: 'asc',
                viewrecords: true,
				editable: true,
				loadComplete: function() {$("tr.jqgrow:odd").css("background", "#FAFAFA").css("margin-bottom", "0 solid");},

                autowidth: true,
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
	var codarea     = jQuery("#Combobox2").val();
	var codturno    = jQuery("#Combobox3").val();
	var fechaturno  = jQuery("#fechaturno").val();

	jQuery("#listapacientes").jqGrid('setGridParam',{url:"datospacientesturnos.php?codservicio="+codservicio+"&codarea="+codarea+"&codturno="+codturno+"&fechaturno="+fechaturno,datatype:'json'}).trigger("reloadGrid");
	
}
	

</script>
<script language="JavaScript">

function confirmacion(cod, est) 
{ 
	swal({
			  title: "Anular Registro",
			  text: "Est\u00e1 seguro que desea anular el turno?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) 
			  {
				window.location = "anular_turnos.php?nroturno=" + cod + "&codservicio=" + est;
			  } 
			  else 
			  {
				swal("El turno salvado!");
			  }
		});
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
					<span style="color:#000000;font-family:Arial;font-size:13px;"><strong>USUARIO: </strong></span><span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong><?php echo $elusuario;?></strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br><br></strong></span><span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>TURNOS</strong></span><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><br></strong><br />
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
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Establecimiento de Salud: </strong></span>
</div>
<hr id="Line3">
	</div>
	
<div class="col-2">
<hr id="Line4">
<div class="selector-establecimiento">
	<select name="Combobox1" size="1" id="Combobox1" onChange="gridReload()" <?php if($codservicio1 != ''){ echo 'disabled';} ?> style="<?php if($codservicio1 != ''){echo "background-color: #DCDCDC";}?>">
	<?php if($codservicio != '')
              { 
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
    
                    echo "</select>";
                }
                else
                {    
        ?>
        </select>
        <script type="text/javascript">
				
				var form_data = {
						is_ajax: 1,
						establecimiento: ""
				};
				
                $(document).ready(function() {
                    $.ajax({
                            data:  form_data,
							type: "POST",
                            url: "ListaEstablecimiento.php",
                            success: function(response)
                            {
                                $('.selector-establecimiento select').html(response).fadeIn();
                            }
                    });

                });
	</script>
   <?php } ?>

</div>
<hr id="Line5">
</div>

</div>

<div class="row">
<div class="col-1">
<hr id="Line2">
<div id="wb_Text2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Area del Establecimiento: </strong></span>
</div>
<hr id="Line3">
	</div>
	
<div class="col-2">
<hr id="Line4">
<div class="selector-area">
<select name="Combobox2" size="1" id="Combobox2" onChange="gridReload()" <?php if($codarea1 != ''){ echo 'disabled';} ?> style="<?php if($codarea1 != ''){echo "background-color: #DCDCDC";}?>">
	
        <?php if($codservicio != '')
              { 
                    $tabla_dpto = pg_query($link, "select * from areasest where codservicio = '$codservicio' order by codarea");
    
                    echo "<option value = ''></option>";
    
                    while($depto = pg_fetch_array($tabla_dpto)) 
                    {
                       if($depto['codarea'] == $codarea)
                       {
                          echo "<option value = ".$depto['codarea']." selected>".$depto['nomarea']."</option>"; 


                       }
                       else
                       {
                           echo "<option value = ".$depto['codarea'].">".$depto['nomarea']."</option>";
                       }
                    }
    
                    echo "</select>";
                }
                else
                {    
        ?>
        </select>
        <script type="text/javascript">
            
        $(document).ready(function() {
			$(".selector-establecimiento select").change(function() {
				var form_data = {
						is_ajax: 1,
						establecimiento: $(".selector-establecimiento select").val()
				};
				$.ajax({
						type: "POST",
						url: "ListaAreaEstablecimiento.php",
						data: form_data,
						success: function(response)
						{
							$('.selector-area select').html(response).fadeIn();
						}
				});
			
			});

		});
	</script>
   <?php } ?>
</div>

<hr id="Line5">
</div>

</div>

<div class="row">
<div class="col-1">
<hr id="Line2">
<div id="wb_Text2">
<span style="color:#808080;font-family:Verdana;font-size:16px;"><strong>Tipo de Turno: </strong></span>
</div>
<hr id="Line3">
	</div>
	
<div class="col-2">
<hr id="Line4">
<div class="selector-tipo">
<select name="Combobox3" size="1" id="Combobox3" onChange="gridReload()">
    <?php if($codturno != '')
              { 
                    $tabla_dpto = pg_query($link, "select * from tiposturnos where codservicio = '$codservicio' and codarea = '$codarea' order by codturno");
    
                    echo "<option value = ''></option>";
    
                    while($depto = pg_fetch_array($tabla_dpto)) 
                    {
                       if($depto['codturno'] == $codturno)
                       {
						   echo "<option value = ".$depto['codturno']." selected>".$depto['nomturno']."</option>";

                       }
                       else
                       {
                           echo "<option value = ".$depto['codturno'].">".$depto['nomturno']."</option>";
                       }
						
                    }
    
                    echo "</select>";
                }
                else
                {    
        ?>
        </select>
        <script type="text/javascript">
		$(document).ready(function() {
			$(".selector-area select").change(function() {
				var form_data = {
						is_ajax: 1,
						area: $(".selector-area select").val(),
						establecimiento: $(".selector-establecimiento select").val()
				};
				$.ajax({
						type: "POST",
						url: "ListaTipoTurno.php",
						data: form_data,
						success: function(response)
						{
							$('.selector-tipo select').html(response).fadeIn();
						}
				});
			});

		});
	</script>
   <?php } ?>
	
</div>
<hr id="Line5">
</div>
<input type="hidden" id="fechaturno" name="fechaturno">
</div>
</div>
</div>


<div id="wb_turnos_detallesLayoutGrid2">
	<div id="turnos_detallesLayoutGrid2">
		<div class="row">

		  <div class="col-md-12" style="width: 383px; float: left; padding-left: 15px">

				<div id="wb_turnos_detallesText2">
					<span style="color:#808080;font-family:Verdana;font-size:16px; font-weight: bold" id="FechaHora"></span><span style="color:#FF0000;font-family:Verdana;font-size:16px;font-weight: bold" id="CantDias"></span>
				</div>

				<div class="panel-body">
					<div id='calendar'></div>
				</div>

			</div>

			<div class="col-2" style="position: absolute; width: 622px">

				<br><br>
				<hr id="turnos_detallesLine6">
				<?php
				if ( $v_12 == 2 || $v_12 == 3 ) {
					//echo '<button type="button" class="btn btn-primary btn-lg" onclick="window.location.href=\'nuevo_sintomas.php\';">Agregar</span></button>';

					echo '<button type="button" id="Button1" class="btn btn-primary btn-lg">
					  			Agregar
					</button>';

				}
				?>
				<br>
				<div class="jqGrid">
					<br/>
					<table id="listapacientes"></table>
					<div id="perpage"></div>

				</div>

			</div>

		</div>
	</div>
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

</body>
<?php
if ($_GET["mensage"]==3)
{
	echo "<script type=''>
	 swal('El turno ha sido anulado!', '', 'error');
     </script>";
}
?>
</html>
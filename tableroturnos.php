<?php
@Header("Content-type: text/html; charset=iso-8859-1");
session_start();

include("conexion.php"); 
$link=Conectarse();
$nomyape=$_SESSION["nomyape"];
$codusu=$_SESSION['codusu'];

$elusuario=$nomyape;


if ($_SESSION["usuario"] == "SI")
{
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Language" content="es-py"/>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1; Content-Encoding: gzip; Vary: Accept-Encoding;" />
<meta http-equiv="refresh" content="10"/>
<meta http-equiv="expires" content="0"/>
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Pragma" content="no-cache"/>

<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<meta name="description" content="Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica"/>
<meta name="author" content="Victor Diaz Ovando"/>
<meta name="Distribution" content="Global" />
<meta name="Robots" content="index,follow" />
<link rel="shortcut icon" href="images/icono1.ico"/>

<link href="jquery.alerts.css" rel="StyleSheet" type="text/css" />
<script src="jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="jquery.ui.draggable.js" type="text/javascript"></script>
<script src="jquery.alerts.mod.js" type="text/javascript"></script>

<style type="text/css">
div#container
{
   width: 962px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
   text-align: center;
   margin: 0;
   background-color: #FFFFFF;
/*
   background-color: #724A93;
   background-image: url(images/motivos_egresos_bkgrnd.png);
*/
   background-repeat: repeat-x;
   color: #000000;
}
</style>
<script type="text/javascript" src="jscookmenu.min.js"></script>
<style type="text/css">
a
{
   color: #C7B5D7;
   text-decoration: underline;
}
a:visited
{
   color: #C7B5D7;
}
a:active
{
   color: #C7B5D7;
}
a:hover
{
   color: #DA70D6;
   text-decoration: underline;
}
</style>


<style type="text/css">
#Layer1
{
   background-color: #FFFFFF;
   border-width: 2px;
   border-color: #FAFAFA;
   border-style: solid;	
/*   background-color: #EEEEEE; */
}
#Layer2
{
   background-color: #F1F1F1;
}
#Layer3
{
   background-color: #FFFFFF;
/*   background-color: #000000; */
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text7 div
{
   text-align: left;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#Table2
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
   border-spacing: 1px;
}
#Table2 td
{
   padding: 1px 1px 1px 1px;
}
#Table2 td div
{
   white-space: nowrap;
}
#Editbox1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Editbox2
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Button1
{
   border: 2px #A9A9A9 solid;
   -moz-border-radius: 7px;
   -webkit-border-radius: 7px;
   border-radius: 7px;
   background-color: #8042AD;
   color: #FFFFFF;
   font-family: Verdana;
   font-size: 13px;
}
#Image3
{
   border: 0px #000000 solid;
}
#Image5
{
   border: 0px #000000 solid;
}
.ThemeMenuBar1Menu,
.ThemeMenuBar1SubMenuTable
{
   font-family: Verdana;
   font-size: 12px;
   font-weight: bold;
   color: #FFFFFF;
   text-align: center;
   padding: 0;
   cursor: pointer;
}
.ThemeMenuBar1MenuOuter
{
   border: 0;
   margin: 0 -5px 0 0;
}
.ThemeMenuBar1SubMenu
{
   position: absolute;
   visibility: hidden;
   border: 0;
   padding: 0;
   border: 0;
}
.ThemeMenuBar1Menu td
{
   padding: 0;
}
.ThemeMenuBar1SubMenuTable
{
   color: #FFFFFF;
   text-align: left;
   background-color: #9C7DB9;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
}
.ThemeMenuBar1SubMenuTable td
{
   white-space: nowrap;
}
.ThemeMenuBar1MainItem
{
}
.ThemeMenuBar1MainItem,
.ThemeMenuBar1MainItemHover,
.ThemeMenuBar1MainItemActive,
.ThemeMenuBar1MenuItem,
.ThemeMenuBar1MenuItemHover,
.ThemeMenuBar1MenuItemActive
{
   white-space: nowrap;
}
.ThemeMenuBar1MenuItem
{
}
.ThemeMenuBar1MainItem
{
   background: url(images/img0001.gif);
   width: 125px;
   padding-right: 5px;
   height: 34px;
   background-repeat: no-repeat;
}
.ThemeMenuBar1MainItemHover,
.ThemeMenuBar1MainItemActive
{
   background: url(images/img0001.gif);
   width: 125px;
   height: 34px;
   padding-right: 5px;
   background-repeat: no-repeat;
}
.ThemeMenuBar1MainItemHover,
.ThemeMenuBar1MainItemActive
{
   color: #D3D3D3;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
}
.ThemeMenuBar1MenuItemHover,
.ThemeMenuBar1MenuItemActive
{
   color: #000000;
   background-color: #D1D1D1;
   font-weight: normal;
   font-style: normal;
   text-decoration: none;
}
.ThemeMenuBar1MenuFolderLeft,
.ThemeMenuBar1MenuFolderRight,
.ThemeMenuBar1MenuItemLeft,
.ThemeMenuBar1MenuItemRight
{
   padding: 0px 0px 0px 0px;
}
td.ThemeMenuBar1MainFolderText,
td.ThemeMenuBar1MainItemText
{
   padding: 0px 0px 0px 0px;
   width: 125px;
   height: 34px;
   padding-right: 5px;
}
.ThemeMenuBar1MenuFolderText,
.ThemeMenuBar1MenuItemText
{
   padding: 3px 5px 3px 5px;
}
td.ThemeMenuBar1MenuSplit
{
   overflow: hidden;
   background-color: inherit;
}
div.ThemeMenuBar1MenuSplit
{
   height: 1px;
   margin: 0px 0px 0px 0px;
   overflow: hidden;
   background-color: inherit;
   border-top: 1px solid #EEEEEE;
}
.ThemeMenuBar1MenuVSplit
{
   display: block;
   width: 1px;
   margin: 0px 2px 0px 2px;
   overflow: hidden;
   background-color: inherit;
   border-right: 1px solid #EEEEEE;
}
#Layer4
{
   background-color: #F1F1F1;
}
#Image1
{
   border: 0px #000000 solid;
}
#Line1
{
   color: #CCCCCC;
   background-color: #CCCCCC;
   border-width: 0px;
}
</style>
<script type="text/javascript" src="wwb9.min.js"></script>

<style type="text/css">
	.ui-datepicker{
		font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size:11px;
		margin-left:10px;
	}
</style>
<!--
<link rel='stylesheet' type='text/css' href='jquery-ui2.css' />
<link rel='stylesheet' type='text/css' href='ui.jqgrid.css' />
-->

<link rel='stylesheet' type='text/css' href='css/ui.datepicker.css' />

<script src="js/jquery-1.11.1.min.js"></script>
<script type='text/javascript' src='js/jquery-ui-min.js'></script>     
<script type='text/javascript' src='js/i18n/grid.locale-es.js'></script>
<script type='text/javascript' src='js/jquery.jqGrid.js'></script>

	
<script>
$(document).ready(function()
		{
			var lastsel2;

			jQuery("#list_records").jqGrid({
                url:'datospanel.php',
                datatype: 'json',
                mtype: 'GET',
				loadonce:true,
                colNames:[' Nro. Orden', 'Nombres y Apellidos'],
				gridview: true,
                colModel:[
					{name:'nordentra', index:'nordentra', width:160, resizable:false, align:"center", sorttype:'int',editable: true, editoptions:{readonly:'readonly',maxlength:"10"}, search: false},
					{name:'nomyape', index:'nomyape', width:670, resizable:false, align:"left", sorttype:'int',editable: true, editoptions:{readonly:'readonly',maxlength:"190"}, search: false} ],
					
				afterInsertRow: function(id){ 
				
				var grid = jQuery("#list_records");
				var selRowId = grid.jqGrid('getGridParam', 'selrow');
				elid=' ';  //id.substring(3,5); 
				grid.jqGrid("setCell", id, 'nordentra', elid);
				 
			},
				onSelectRow: function(id){
							  iraeliminar(id);
						  },
                pager: '#perpage',
                rowNum:30,
				width:940,
				height:250,
                rowList:[30,60,90],
                sortname: 'nordentra',
                sortorder: 'desc',
                viewrecords: true,
				editable: true,
				multiselect: true,
				multiselectWidth: 60,
                caption: 'PACIENTES ESPERANDO',
                ignoreCase:true,
				loadComplete: function() {$("tr.jqgrow:odd").css("background", "#F1F1F1");},
				shrinkToFit: false			
            });
	
			grid = $("#list_records");							
		//	jQuery("#list_records").jqGrid('navGrid','#perpage',{edit:false,add:false,del:false,search:false},{},{},{},{closeAfterSearch:true, showQuery: true},{});
			jQuery("#list_records").jqGrid('setFrozenColumns');
			jQuery("#list_records").jqGrid("setLabel", "cb", " Atendido ");
        });

        
</script>

<script language="JavaScript"> 

function iraeliminar(registro)
{
jConfirm('Confirma que este cliente ya ha sido atendido?', 'Confirmar Operaci\u00f3n', function(entrar) {
    if(entrar) 
	{ 
		window.location = "eliminar_turnoespera.php?id=" + registro ;
		return true;
    }
});
	
	
}

function alertwarning(texto)
{
	jWarning(texto);	
}
function alerterror(texto)
{
	jError(texto);	
}
function alertmensaje(texto)
{
	jMessage(texto);	
}
</script>

</head>
<body>
<div id="container">
	<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:30px;width:961px;height:609px;z-index:7;" title="">

		<div style="position:absolute;left:10px;top:84px;width:695px;height:107px;z-index:1;">
		
			<div style="position:absolute;left:0px;top:50px;width:800px;">
			<table id="list_records"></table> 
			<div id="perpage"></div>
			</div>

		</div>
		
	</div>
		

	<div id="Layer2" style="position:absolute;text-align:left;left:0px;top:126px;width:963px;height:30px;z-index:8;" title="">
		<div id="wb_Text3" style="position:absolute;left:9px;top:5px;width:95px;height:16px;z-index:4;text-align:left;">
			<span style="color:#BCA7CF;font-family:Verdana;font-size:13px;"><strong>USUARIO:</strong></span>
		</div>
	</div>
	
	<div id="wb_Text2" style="position:absolute;left:90px;top:132px;width:564px;height:16px;z-index:10;text-align:left;">
		<span style="color:#000000;font-family:Verdana;font-size:13px;"><?php echo $elusuario;?></span>
	</div>	
	
	
	<div id="Layer4" style="position:absolute;text-align:left;left:0px;top:0px;width:963px;height:120px;z-index:15;" title="">
		<div id="wb_Image1" style="position:absolute;left:10px;top:2px;width:796px;height:120px;z-index:6;">
			<img src="images/logo-msp-labo.fw.png" id="Image1" alt="" style="width:796px;height:115px;"/>
		</div>		
	</div>
	<hr id="Line1" style="margin:0;padding:0;position:absolute;left:0px;top:122px;width:963px;height:4px;z-index:16;"/>
</div>
</body>

</html>
<?php
}
?>
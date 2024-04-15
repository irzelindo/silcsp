<style type="text/css">
.cuadro 
{
	border-style:  ridge;
	border-width: 2px;
    border-collapse: separate;
}

.hr 
{
	background-color: #000080;
	color: white;
    height: 30px;
	font-family: "verdana";
	font-size: 10px;
	padding-left: 5px;
	padding-right: 5px;
}

.tr
{
	background-color: #F4F4F4;
	font-family:"verdana";
	font-size:10px; 
    height: 40px;
	border: 0px solid black; padding: 0.1em;
	padding-left: 5px;
	padding-right: 5px;
}


tr a
{
	text-decoration:none;
	color:#3300FF;
	border-bottom:solid 1px #999;
	font-size: 10px;
}

tr a:hover
{
	color:#990000;
	border-bottom:solid 1px #990000;
}

.trpar
{
	font-family:"Times New Roman",Verdana,Tahoma,sans-serif;
	font-size:10px; 
	border: 1px solid black; padding: 0.1em;
	padding-left: 5px;
	padding-right: 5px;
	background-color: #EED8AE;
}
</style>
<?php
function acentos($cadena) 
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);
 
   return $cadena;
}

@Header("Content-type: text/html; charset=utf-8");

session_start();
include("conexion.php");
include("conexionsaa.php");
$con=Conectarse();
$consaa=Conectarsesaa();

$codusu=$_SESSION['codusu'];
$tabla=trim($_POST['tabla']);
$tiporeporte=$_POST['tiporeporte'];

if ($tiporeporte==1)//Navegador
   {
   print '<head><link rel="shortcut icon" href="images/icono.ico"/><link rel="stylesheet" type="text/css" href="images/style.css" />'
         .'<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes"/><title>Reporte - Tablas Codificadas</title><script type="text/javascript" src="reflection.js"></script></head><body style="color: black;background: white;font-size: 90%;">';	
   }


$_SESSION['tabla']=$_POST['tabla'];

$incluirfile='tabla_'.trim(strtolower($tabla));

if ($tabla=="" )
    {
    echo "<div align='center'>";
    echo "<font face='Times New Roman' size='4'>Debe Seleccionar una Tabla de la lista presentada</font>";
    echo "</div>";    	
    echo "<br /><br />";
	print '<p align="center"><a href="javascript:close()">Volver a la p&aacute;gina anterior</a></p>';  
    }
else
   {
   include($incluirfile);
   }  
?>
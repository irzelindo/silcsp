<?php 
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_12  = $_SESSION['V_12'];
$v_121 = $_SESSION['V_121'];

$nropaciente = $_GET['nropaciente'];

$query = "select * from paciente where nropaciente = '$nropaciente'";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$pnombre 	= $row["pnombre"];
$snombre 	= $row["snombre"];
$papellido 	= $row["papellido"];
$sapellido 	= $row["sapellido"];
$cedula 	= $row["cedula"];
$tdocumento = $row["tdocumento"];
$telefono 	= $row["telefono"];

if($row["edada"] != 0)
{
	$edad = $row["edada"];
}
else
{
	$edad = $row["edadm"];
}

switch ($tdocumento) {
    case '1':
        $nomdocumento = "Cedula";
        break;
    case '2':
        $nomdocumento = "Pasaporte";
        break;
    case '3':
        $nomdocumento = "Carnet Indigena";
        break;
	case '4':
        $nomdocumento = "Otros";
        break;
	case '5':
        $nomdocumento = "No Tiene";
        break;
}

if($row["sexo"] == 1)
{
	$sexo  = "Masculino";
}
else
{
	$sexo  = "Femenino";
}

$query1 = "select  es.nordentra,
					e.nomestudio,
					es.fecha,
					es.nromuestra,
					es.codservicio,
					es.codorigen
			from estrealizar es, estudios e
			where es.codestudio  = e.codestudio
			and   es.nropaciente   = '$nropaciente'
			order by 1";
$result1 = pg_query($link,$query1);




if ( $_SESSION[ 'usuario' ] != "SI" ) {
	header( "Location: index.php" );
}
?>
       
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sistema de Informaci&oacute;n del Laboratorio de Salud P&uacute;blica</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="shortcut icon" href="favicon.ico"/>
<style>
#contenedor {
	width: 950px;
	height: 1400px;
	margin: auto;
	
}

</style>
</head>
<body>
	<div id="contenedor">
     
      <div style="font-size: 24px; padding-bottom: 5px; margin-top: 5px; text-align:left; height: 130px; border: 1px #000000 solid; text-align: center">
      	<img src="images/logo-msp-labo.fw.png" width="673">
      </div>
  	  <div style="border-bottom: 1px #000000 solid; border-left: 1px #000000 solid; border-right: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">
      <div style="font-size: 25px; text-align:center; text-decoration: underline;font-weight: bold; height: 35px;">Historia Cl&iacute;nica</div>
      <div style="font-size: 16px; text-align:left">
        <b>Tip.Doc:</b> <?php echo $nomdocumento; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <b>Nro. Doc:</b> <?php echo $cedula; ?>
      </div>
      <div style="font-size: 16px; text-align:left"><b>Apellido y nombre:</b> <?php echo $papellido." ".$sapellido." ".$pnombre." ".$snombre; ?></div>
      <div>
        <div style="font-size: 16px; text-align:left; width: 700px; float: left"><b>Sexo:</b> <?php echo $sexo; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Edad:</b> <?php echo $edad; ?>&nbsp;&nbsp;&nbsp;&nbsp;</div>
      
      
      <div style="font-size: 16px; text-align:left; width: 700px; "><b>Tel&eacute;fono:</b> <?php echo $telefono; ?>
  &nbsp;&nbsp;</div>
      </div>
   </div>

    <div style="height: 280px;">
   	  <div style="font-size: 18px; text-align: left; margin-bottom: 10px; margin-top: 10px; text-decoration: underline;font-weight: bold;">Estudios Realizados</div>
	  <table width="800" border="1" align="center">
		   <tr>
			 <td width="100" align="center">Muestra</td>
			 <td width="300" align="center">Estudio</td>
			 <td width="50" align="center">Fecha</td>
			 <td width="50" align="center">Orden</td>
			 <td width="100" align="center">Origen</td>
		   </tr>
	  <?php
		while ($row1 = pg_fetch_array($result1))
		{
			$nordentra  = $row1["nordentra"];
			$nomestudio = $row1["nomestudio"];
			$fecha     	= date("d/m/Y", strtotime($row1["fecha"]));
			$nromuestra = $row1["nromuestra"];
			$codservicio= $row1["codservicio"];
			$codorigen  = $row1["codorigen"];

			$query3 = "select * from origenpaciente where codorigen = '$codorigen'";
			$result3 = pg_query($link,$query3);

			$row3 = pg_fetch_assoc($result3);

			$nomorigen = $row3["nomorigen"];
			
			$muestra = str_pad($nromuestra, 8, '0', STR_PAD_LEFT);
			
			 print '<tr>'
				   .'<td align="center">'.$codservicio.$muestra.'</td>'
				   .'<td align="left">'.$nomestudio.'</td>'
				   .'<td align="center">'.$fecha.'</td>'
				   .'<td align="center">'.$nordentra.'</td>'
				   .'<td align="center">'.$nomorigen.'</td>'
				   .'</tr>';
		}
	  ?>
		</table>
    </div>

  <br>
</div>
</body>
</html>
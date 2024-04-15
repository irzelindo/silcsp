<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$v_12  = $_SESSION['V_12'];
$v_121 = $_SESSION['V_121'];

$nordentra 	 = $_GET['nordentra'];
$codservicio = $_GET['codservicio'];

$query = "select * from establecimientos where codservicio = '$codservicio'";
$result = pg_query($link,$query);

$row = pg_fetch_assoc($result);

$nomservicio = $row["nomservicio"];

$query1 = "select * from ordtrabajo where nordentra = '$nordentra'";
$result1 = pg_query($link,$query1);

$row1 = pg_fetch_assoc($result1);

$nropaciente = $row1["nropaciente"];
$fecharec 	 = date("d/m/Y", strtotime($row1["fecharec"]));
$codmedico   = $row1["codmedico"];
$codorigen	 = $row1["codorigen"];
$horarec     = $row1["horarec"];

$query2 = "select * from paciente where nropaciente = '$nropaciente'";
$result2 = pg_query($link,$query2);

$row2 = pg_fetch_assoc($result2);

$pnombre 	= $row2["pnombre"];
$snombre 	= $row2["snombre"];
$papellido 	= $row2["papellido"];
$sapellido 	= $row2["sapellido"];
$cedula 	= $row2["cedula"];
$tdocumento = $row2["tdocumento"];
$telefono 	= $row2["telefono"];

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


if($row2["sexo"] == 1)
{
	$sexo  = "Masculino";
}
else
{
	$sexo  = "Femenino";
}

$query3 = "select e.codexterno,
				  e.nomestudio,
				  e.codestudio
			from estrealizar es, estudios e
			where es.codestudio = e.codestudio
			and   es.nordentra   = '$nordentra'
			and   es.codservicio= '$codservicio'";
$result3 = pg_query($link,$query3);

$query4 = "select t.texto, t.nomtexto
			from textosestudios te, textos t, estrealizar es
			where te.codtexto = t.codtexto
			and   te.tipo     = 1
			and   te.codestudio=es.codestudio
			and   es.nordentra   = '$nordentra'
			and   es.codservicio= '$codservicio'";
$result4 = pg_query($link,$query4);

$query5 = "select * from medicos where codmedico = '$codmedico'";
$result5 = pg_query($link,$query5);

$row5 = pg_fetch_assoc($result5);

$nomyape = $row5["nomyape"];

$query6 = "select * from origenpaciente where codorigen = '$codorigen'";
$result6 = pg_query($link,$query6);

$row6 = pg_fetch_assoc($result6);

$nomorigen = $row6["nomorigen"];

if($row2["edada"] != 0)
{
	$edad = $row2["edada"];
}
else
{
	$edad = $row2["edadm"];
}

$query7 = "select max(es.fecha + cast(e.dias as integer)) as fechasal
			from estrealizar es, estudios e
			where es.codestudio = e.codestudio
			and   es.nordentra = '$nordentra'";
$result7 = pg_query($link,$query7);

$row7 = pg_fetch_assoc($result7);

$fechasal  = date("d/m/Y", strtotime($row7["fechasal"]));

function acentos($cadena)
{
   $search = explode(",","Ã,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,Ã‘,Ã,ü");
   $replace = explode(",","Í,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,Ñ,Á,&uuml;");
   $cadena= str_replace($search, $replace, $cadena);

   return $cadena;
}

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
<script type="text/javascript" src="js/JsBarcode.all.min.js"></script>
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

      <div style="font-size: 24px; padding-bottom: 5px; margin-top: 5px; text-align:left; height: 150px; border: 1px #000000 solid;">
      	<div style="float: left; margin-left: 25px; margin-top: 15px;margin-right:20px;">
      		<img src="images/logo-msp-labo.fw.png" width="673">
      	</div>
      	<div style="width: 210px; float: left; height: 140px; border-left: 1px #000000 solid; padding-left: 10px; padding-top: 15px;font-size: 16px;">Fecha: <?php echo $fecharec; ?><br>
      	Hora: <?php echo $horarec; ?>
      	<br>
      	Usuario: <?php echo $codusu; ?>
      	</div>
      </div>
  	  <div style="border-bottom: 1px #000000 solid; border-left: 1px #000000 solid; border-right: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">
      <div style="font-size: 25px; text-align:center; text-decoration: underline;font-weight: bold; height: 35px;">Entrega de resultados</div>
      <div style="font-size: 16px; text-align:left"><b>Orden:</b> <?php echo $nordentra; ?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <b>Establecimiento: </b><?php echo $nomservicio; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <b>Tip.Doc:</b> <?php echo $nomdocumento; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <b>Nro. Doc:</b> <?php echo $cedula; ?>
      </div>
      <div style="font-size: 16px; text-align:left"><b>Apellido y nombre:</b> <?php echo $papellido." ".$sapellido." ".$pnombre." ".$snombre; ?></div>
      <div style="font-size: 16px; text-align:left"><b>M&eacute;dico:</b> <?php echo $nomyape; ?></div>

      <div>
      <div style="font-size: 16px; text-align:left; width: 700px; float: left"><b>Instituci&oacute;n:</b> ---</div>
      <div style="width: 220px; float: right; text-align: center; margin-right: 5px; height: 50px"><svg id="barcode" ></svg></div>

      <div style="font-size: 16px; text-align:left; width: 700px; float: left"><b>Sexo:</b> <?php echo $sexo; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <b>Edad:</b> <?php echo $edad; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <b>Origen del Paciente:</b> <?php echo $nomorigen; ?>
      </div>


      <div style="font-size: 16px; text-align:left; width: 700px; "><b>Tel&eacute;fono:</b> <?php echo $telefono; ?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <b>Nro. afiliado:</b>
      </div>
      </div>
   </div>

    <div style="height: 280px;">
   	  <div style="font-size: 18px; text-align: left; margin-bottom: 10px; margin-top: 10px;">Estudios</div>

	  <?php
		while ($row3 = pg_fetch_array($result3))
		{
			echo '<div style="font-size: 18px; text-align:left; width: 780px; float: left; margin-bottom: 10px;">'.$row3["nomestudio"].'</div>';
		}
	  ?>
    </div>

  <br>
  <div style="font-size: 15px;">
  	<b>LCSP - La entrega de resultado se realizar&aacute; el d&iacute;a <?php echo $fechasal; ?> entre las horas 13:00 Hs. A 17:00 Hs.</b>
  </div>
</div>

<script type="text/javascript">
JsBarcode("#barcode", "<?php echo $codservicio.$nordentra; ?>", {
  format: "CODE128A",
  lineColor: "#000000",
  width: 1,
  height: 40,
  displayValue: false
});
</script>
</body>
</html>

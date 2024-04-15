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

$grupo = $_GET['grupo'];

$query1 = "select distinct o.codservrem,
          	        o.codservder,
          	        CAST(now() AS date) fechaenvio
          from datoagrupado d, ordtrabajo o
          where d.nordentra = o.nordentra
          and   d.grupo = '$grupo'";
$result1 = pg_query($link,$query1);

$row1    = pg_fetch_assoc($result1);

$codservrem  = $row1["codservrem"];
$codservder  = $row1["codservder"];
$fechaenvio  = date("d/m/Y", strtotime($row1["fechaenvio"]));

$query2 = "select o.nordentra,
            	   p.cedula,
            	   p.pnombre||' '||p.snombre||' '||p.papellido||' '||p.sapellido nombres,
            	   p.sexo,
            	   p.edada,
            	   o.codorigen
            from datoagrupado d, ordtrabajo o, paciente p
            where d.nordentra   = o.nordentra
            and   o.nropaciente = p.nropaciente
            and   d.grupo = '$grupo'";
$result2 = pg_query($link,$query2);


$query3 = "select * from establecimientos where codservicio = '$codservrem'";
$result3 = pg_query($link,$query3);

$row3 = pg_fetch_assoc($result3);

$nomservrem = $row3["nomservicio"];

$query4 = "select * from establecimientos where codservicio = '$codservder'";
$result4 = pg_query($link,$query4);

$row4 = pg_fetch_assoc($result4);

$nomservder = $row4["nomservicio"];

$query5 = "select count(d.nordentra) cantidad
          from datoagrupado d, ordtrabajo o
          where d.nordentra = o.nordentra
          and   d.grupo = '$grupo'";
$result5 = pg_query($link,$query5);

$row5    = pg_fetch_assoc($result5);

$cantorden  = $row5["cantidad"];

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

  <div style="border: 1px #000000 solid;padding-top: 10px;padding-left: 20px;height: 170px;">
      <div style="font-size: 25px; text-align:center; text-decoration: underline;font-weight: bold; height: 35px;padding-bottom: 50px;">LISTADO DE MUESTRAS ENVIADOS</div>
      <div style="font-size: 16px; text-align:left"><b>Fecha Envio:</b> <?php echo $fechaenvio; ?>
      <br>
      <br>
      <div style="float:left; margin-right: 20px;">
          <b>Establecimiento Remitente: </b><?php echo $nomservrem; ?>
      </div>
      <div style="float:left">
          <b>Establecimiento Receptor:</b> <?php echo $nomservder; ?>
      </div>

      </div>

      <div>

      </div>
   </div>
   <br><br>
    <div style="height: 280px;">
   	  <div style="font-size: 18px; text-align: left; margin-bottom: 10px; margin-top: 10px; font-weight: bold;">DETALLE DE MUESTRAS</div>

      <div>
      	  <table width="900" border="1" align="center">
      		   <tr>
      			 <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Nro. Orden</td>
      			 <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">CI</td>
      			 <td width="300" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Nombres</td>
      			 <td width="50" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Sexo</td>
      			 <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Edad</td>
             <td width="200" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Origen</td>
      		   </tr>
      	  <?php
      		while ($row2 = pg_fetch_array($result2))
      		{
      			$codorigen  = $row2["codorigen"];

      			$queryo = "select * from origenpaciente where codorigen = '$codorigen'";
      			$resulto = pg_query($link,$queryo);

      			$rowo = pg_fetch_assoc($resulto);

      			$nomorigen = $rowo["nomorigen"];

            if($row2["sexo"] == 1)
            {
            	$sexo  = "Masculino";
            }
            else
            {
            	$sexo  = "Femenino";
            }

      			 print '<tr>'
      				   .'<td align="center">'.$row2["nordentra"].'</td>'
      				   .'<td align="center">'.$row2["cedula"].'</td>'
      				   .'<td align="center">'.$row2["nombres"].'</td>'
      				   .'<td align="center">'.$sexo.'</td>'
                 .'<td align="center">'.$row2["edada"].'</td>'
      				   .'<td align="center">'.$nomorigen.'</td>'
      				   .'</tr>';
      		}
      	  ?>
      		</table>
      </div>

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div style="font-size: 25px; margin-left: 720px; font-weight: bold;">
  	Total Ordenes: <?php echo $cantorden; ?>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div style="font-size: 15px;float: left;">
  	<b>Recibido por:</b>
  </div>
  <div style="font-size: 15px;float: left;margin-left: 650px;">
  	<b>Enviado por:</b>
  </div>
</div>

</body>
</html>

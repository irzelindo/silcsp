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

$fecha = date("d/m/Y", time());
$hora  = date("H:i", time());

$query2 = "select o.nordentra,
            	   p.pnombre||' '||p.snombre||' '||p.papellido||' '||p.sapellido nombres,
            	   p.edada,
                 o.codservicio,
                 e.nromuestra,
        				 es.nomestudio,
        				 es.codsector
            from ordenagrupado d, ordtrabajo o, paciente p, estrealizar e, estudios es
            where d.nordentra   = o.nordentra
            and   o.nropaciente = p.nropaciente
            and   e.nordentra   = o.nordentra
    			  and   e.codestudio  = es.codestudio
            and   d.grupo = '$grupo'";
$result2 = pg_query($link,$query2);

$row3 = pg_fetch_assoc( $result2 );

$codsector  = $row3[ "codsector" ];
$nomestudio = $row3["nomestudio"];

$query5 = "select * from sectores where codsector = '$codsector'";
$result5 = pg_query( $link, $query5 );

$row5 = pg_fetch_assoc( $result5 );

$nomsector = $row5[ "nomsector" ];

$query4 = "select o.nordentra,
            	   p.pnombre||' '||p.snombre||' '||p.papellido||' '||p.sapellido nombres,
            	   p.edada,
                 o.codservicio,
                 e.nromuestra,
        				 es.nomestudio,
        				 es.codsector
            from ordenagrupado d, ordtrabajo o, paciente p, estrealizar e, estudios es
            where d.nordentra   = o.nordentra
            and   o.nropaciente = p.nropaciente
            and   e.nordentra   = o.nordentra
    			  and   e.codestudio  = es.codestudio
            and   d.grupo = '$grupo'";
$result4 = pg_query($link,$query4);

$query6 = "select count(d.nordentra) cantidad
          from ordenagrupado d, ordtrabajo o
          where d.nordentra = o.nordentra
          and   d.grupo = '$grupo'";
$result6 = pg_query($link,$query6);

$row6    = pg_fetch_assoc($result6);

$cantorden  = $row6["cantidad"];

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
	margin-left: 250px;

}

</style>
</head>
<body>
	<div id="contenedor">

  <br>
  <br>
  <div style="border: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">

        <?php

            echo '<div style="font-size: 25px; text-align:left"><b>Nro. Lista Trabajo:</b> '.$grupo.'</div>';
            echo '<div style="font-size: 25px; text-align:left"><b>Fecha y Hora:</b> '.$fecha.' '.$hora.'</div>';
            echo '<div style="font-size: 16px; text-align:left"><b>Usuario:</b> '.$codusu.'</div>';
            echo '<div style="font-size: 16px; text-align:left"><b>Sector:</b> '.$nomsector.'</div>';
            echo '<div style="font-size: 16px; text-align:left"><b>Estudio:</b> '.$nomestudio.'</div>';
        ?>

  </div>

   <br><br>
    <div style="height: 280px;">

      <div>
      	  <table width="800" border="1" align="center">
      		   <tr>
             <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Item</td>
      			 <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Nro. Orden</td>
      			 <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Codigo de dgvs</td>
      			 <td width="300" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Nombres</td>
      			 <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Edad</td>
             <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Resultado</td>
             <td width="100" align="center" style="background-color:#00BCD4; vertical-align:top; font-weight: bold;">Observacion</td>
      		   </tr>
      	  <?php
          $i = 0;
      		while ($row2 = pg_fetch_array($result4))
      		{
             $i = $i + 1;

             print '<tr>'
                 .'<td align="center">'.$i.'</td>'
      				   .'<td align="center">'.$row2["nordentra"].'</td>'
      				   .'<td align="center">'.$row2["codservicio"].$row2["nordentra"].$row2["nromuestra"].'</td>'
      				   .'<td>'.$row2["nombres"].'</td>'
                 .'<td align="center">'.$row2["edada"].'</td>'
      				   .'<td align="center"></td>'
                 .'<td align="center"></td>'
      				   .'</tr>';
      		}
      	  ?>
      		</table>
      </div>
      <br>
      <br>
  
      <div style="font-size: 20px; margin-left: 720px; font-weight: bold;">
      	Total Estudios: <?php echo $cantorden; ?>
      </div>
</div>
</div>
</body>
</html>

<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

$fecha = date("d/m/Y", time());
$hora  = date("H:i", time());

if(isset($_GET["grupo"]))
{
    $grupo = $_GET['grupo'];
    $_SESSION['grupo'] = $_GET['grupo'];
}
else
{
    $grupo = "";
    $_SESSION['grupo'] = "";
}

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
            and   d.grupo = '$grupo' order by o.nordentra";
$result2 = pg_query($link,$query2);
$countlc = pg_num_rows($result2);

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
                 o.cod_dgvs,
        				 es.nomestudio,
        				 es.codsector,
                 o.fecharec
            from ordenagrupado d, ordtrabajo o, paciente p, estrealizar e, estudios es
            where d.nordentra   = o.nordentra
            and   o.nropaciente = p.nropaciente
            and   e.nordentra   = o.nordentra
    			  and   e.codestudio  = es.codestudio
            and   d.grupo = '$grupo' order by o.nordentra";
$result4 = pg_query($link,$query4);


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

<!----------- PARA ALERTAS  ---------->
<script src="js/sweetalert2.all.min.js" type="text/javascript"></script>

<!----------- PARA MODAL  ---------->
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

<style>

.container {
      width: 970px;
      margin: 0 auto 0 auto;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgb(217, 235, 235);
    }

    .table-hover tbody tr:hover {
      background-color: rgba(122, 114, 81, 0.7);
      color: rgb(112, 24, 78);
    }

    .thead-green {
      background-color: rgb(0, 99, 71);
      color: white;
    }

</style>
</head>
<body>
<?php
  if($countlc != 0 )
  {
?>
  <div class="container">
    <div style="border-bottom: 1px #000000 solid;margin-top: 6px; border-top: 1px #000000 solid; border-left: 1px #000000 solid; border-right: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">

<div style="font-size: 16px; text-align:center"><b>LISTA DE TRABAJO</b></div>
    <div style="font-size: 14px; text-align:left; margin-top: 6px;"><b>Ingresado por:___________________ Extraccion:____________________ PCR:____________________ Validacion:___________________</b></div>

          <?php

          header("Pragma: public");
          header("Expires: 0");
          $filename = "listaordentrabajo.xls";
          header("Content-type: application/x-msdownload");
          header("Content-Disposition: attachment; filename=$filename");
          header("Pragma: no-cache");
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

          echo '<div style="font-size: 16px; text-align:left"><b>Nro. Lista Trabajo:</b> '.$grupo.'</div>';
          echo '<div style="font-size: 16px; text-align:left"><b>Fecha y Hora:</b> '.$fecha.' '.$hora.'</div>';
          echo '<div style="font-size: 16px; text-align:left"><b>Usuario:</b> '.$codusu.'</div>';
          echo '<div style="font-size: 16px; text-align:left"><b>Sector:</b> '.$nomsector.'</div>';
          echo '<div style="font-size: 16px; text-align:left"><b>Estudio:</b> '.$nomestudio.'</div>';

          ?>

    </div>
   <br>

      <table class="table table-striped table-hover">
        <thead class="thead-green">
          <tr>
                 <th>Item</th>
            <th>Nro. Orden</th>
            <th>Cod. DGVS</th>
            <th>Nombres</th>
            <th>Edad</th>
             <th>Fecha Recepcion</th>
            <<th>Gen N</th>
            <th>Gen ORF1ab</th>
            <th>Resultado</th>
            <th>OBS.</th>


          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;

      		while ($row2 = pg_fetch_array($result4))
      		{
                $i++;

          print '<tr>'
                    .'<td style="font-size: 12px;align="center">'.$i.'</td>'
                    .'<td style="font-size: 12px;align="center">'.$row2["nordentra"].'</td>'
                    .'<td style="font-size: 12px;align="center">'.$row2["cod_dgvs"].'</td>'
                    .'<td style="font-size: 12px" >'.$row2["nombres"].'</td>'
                    .'<td style="font-size: 12px; align="center">'.$row2["edada"].'</td>'
                    .'<td style="font-size: 12px;align="center">'.$row2["fecharec"].'</td>'
                    .'<td style="font-size: 12px;align="center"></td>'
                    .'<td style="font-size: 12px;align="center"></td>'
                    .'<td style="font-size: 12px;align="center"></td>'
                    .'<td style="font-size: 12px;align="center"></td>'
                    .'</tr>';
      		}
      	  ?>
        </tbody>
      </table>
    </div>
<?php
  }
  else
  {
        echo '<script type="text/javascript">
              let timerInterval
              swal({
                title: "No posee registro con los parametros elegidos !",
                html: "",
                type: "warning",
                timer: 2800,
                onOpen: () => {
                swal.showLoading()
                timerInterval = setInterval(() => {
                  swal.getContent().querySelector("strong")
                  .textContent = swal.getTimerLeft()
                }, 100)
                },
                onClose: () => {
                clearInterval(timerInterval);
                window.close();
                }
              }).then((result) => {
                if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.timer
                ) {
                console.log("I was closed by the timer")
                }
              })
            </script>';
  }
?>

</body>
</html>

<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

if(isset($_GET["codsector"]))
{
    $codsector = $_GET['codsector'];
    $_SESSION['codsector'] = $_GET['codsector'];
}
else
{
    $codsector = "";
    $_SESSION['codsector'] = "";
}

if(isset($_GET["codestudio"]) && $_GET["codestudio"] != '')
{
    $codestudio     = $_GET['codestudio'];
    $_SESSION['codestudio'] = $_GET['codestudio'];
}
else
{
    $codestudio	 = "";
    $_SESSION['codestudio'] = "";
}

if(isset($_GET["codservicio"]) && $_GET["codservicio"] != '')
{
    $codservicio = $_GET['codservicio'];
    $_SESSION['codservicio'] = $_GET['codservicio'];
}
else
{
    $codservicio	 = "";
    $_SESSION['codservicio'] = "";
}

if(isset($_GET["codorigen"]) && $_GET["codorigen"] != '')
{
    $codorigen	 = $_GET['codorigen'];
    $_SESSION['codorigen'] = $_GET['codorigen'];
}
else
{
    $codorigen	 = "";
    $_SESSION['codorigen'] = "";
}

if(isset($_GET["codservder"]) && $_GET["codservder"] != '')
{
    $codservder	 = $_GET['codservder'];
    $_SESSION['codservder'] = $_GET['codservder'];
}
else
{
    $codservder	 = "";
    $_SESSION['codservder'] = "";
}

if(isset($_GET["desde"]) && $_GET["desde"] != 'null')
{
    $desde	 = $_GET['desde'];
    $_SESSION['desde'] = $_GET['desde'];
}
else
{
    $desde	 = "";
    $_SESSION['desde'] = "";
}

if(isset($_GET["hasta"]) && $_GET["hasta"] != 'null')
{
    $hasta	 = $_GET['hasta'];
    $_SESSION['hasta'] = $_GET['hasta'];
}
else
{
    $hasta	 = "";
    $_SESSION['hasta'] = "";
}


if($codsector != '')
{
    $w=$w." and r.codsector= '$codsector'";

    $cadena5="select * from sectores where codsector='$codsector'";
    $lista5 = pg_query($link, $cadena5);
    $registro5 = pg_fetch_array($lista5);
    $nomsector=$registro5['nomsector'];

    $reportsector = '<div style="font-size: 16px; text-align:left"><b>Sector:</b> '.$nomsector.'</div>';
}

if($codestudio != '')
{
    $w=$w." and r.codestudio= '$codestudio'";

    $cadena4="select * from estudios where codestudio='$codestudio'";
    $lista4 = pg_query($link, $cadena4);
    $registro4 = pg_fetch_array($lista4);
    $nomestudio=$registro4['nomestudio'];

    $reportestudio = '<div style="font-size: 16px; text-align:left"><b>Estudio:</b> '.$nomestudio.'</div>';
}

if($codservicio!= '')
{
    $w=$w." and t.codservicio= '$codservicio'";

    $cadena1="select * from establecimientos where codservicio='$codservicio'";
    $lista1 = pg_query($link, $cadena1);
    $registro1 = pg_fetch_array($lista1);
    $nomservicio=$registro1['nomservicio'];

    $reportestable = '<div style="font-size: 16px; text-align:left"><b>Laboratorio responsable:</b> '.$nomservicio.'</div>';
}

if($codorigen != '')
{
    $w=$w." and t.codorigen = '$codorigen'";

    $cadena2="select * from origenpaciente where codorigen='$codorigen'";
    $lista2 = pg_query($link, $cadena2);
    $registro2 = pg_fetch_array($lista2);
    $nomorigen=$registro2['nomorigen'];

    $reportorigen = '<div style="font-size: 16px; text-align:left"><b>Origen del Paciente:</b> '.$nomorigen.'</div>';
}

if($codservder != '')
{
    $w=$w." and t.codservder = '$codservder'";

    $cadena3="select * from establecimientos where codservicio='$codservder'";
    $lista3 = pg_query($link, $cadena3);
    $registro3 = pg_fetch_array($lista3);
    $nomservicior=$registro3['nomservicio'];

    $reportestabler = '<div style="font-size: 16px; text-align:left"><b>Entidad Derivante:</b> '.$nomservicior.'</div>';
}

if($desde != '')
{
    $w=$w." and t.fecharec >= '$desde'";

    $desde     = date("d/m/Y", strtotime($desde));
}

if($hasta != '')
{
    $w=$w." and t.fecharec <= '$hasta'";

    $hasta     = date("d/m/Y", strtotime($hasta));

    $reportfecha = '<div style="font-size: 16px; text-align:left"><b>Fecha de Orden:</b> '.$desde.' al '.$hasta.'</div>';
}


$sql1 = "
select distinct t.nordentra,
p.cedula,
p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
e.microbiologia,
t.codservder,
t.cod_dgvs,
t.codusu,
er.nromuestra,
(select nomresultado from resultadocodificado re where re.codresultado = r.codresultado) as resultado
from paciente p, ordtrabajo t, estudios e, resultados r, estrealizar er
where p.nropaciente = t.nropaciente
and   e.codestudio  = r.codestudio
and   t.nordentra   = r.nordentra
and   t.nordentra   = er.nordentra
".$w."

union all

select distinct t.nordentra,
p.cedula,
p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
e.microbiologia,
t.codservder,
t.cod_dgvs,
t.codusu,
er.nromuestra,
(select nomresultado from resultadocodificado re where re.codresultado = r.codresultado) as resultado
from paciente p, ordtrabajo t, estudios e, resultadosmicro r, estrealizar er
where p.nropaciente = t.nropaciente
and   e.codestudio  = r.codestudio
and   t.nordentra   = r.nordentra
and   t.nordentra   = er.nordentra
".$w."
order by nordentra";

$result1 = pg_query($link,$sql1);
$countlc = pg_num_rows($result1);

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
  if($countlc != 0)
  {
?>
  <div class="container">
    <div style="font-size: 24px; padding-bottom: 5px; margin-top: 5px; text-align:left; height: 150px; border: 1px #000000 solid;">
        <div style="float: left; margin-left: 150px; margin-top: 15px;margin-right:20px;">
          <img src="images/logo-msp-labo.fw.png" width="673">
        </div>
    </div>
    <div style="border-bottom: 1px #000000 solid; border-left: 1px #000000 solid; border-right: 1px #000000 solid; padding-bottom: 10px; padding-left: 10px;">

          <?php
              header("Pragma: public");
              header("Expires: 0");
              $filename = "listaresultado.xls";
              header("Content-type: application/x-msdownload");
              header("Content-Disposition: attachment; filename=$filename");
              header("Pragma: no-cache");
              header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

              if($reportestable!= ''){ echo $reportestable; }
              if($reportfecha != ''){ echo $reportfecha; }
              if($reportorigen != ''){ echo $reportorigen; }
              if($reportestabler != ''){ echo $reportestabler; }
              if($reportsector != ''){ echo $reportsector; }
              if($reportestudio != ''){ echo $reportestudio; }
          ?>

    </div>
   <br>

      <table class="table table-striped table-hover">
        <thead class="thead-green">
          <tr>
            <th>Item</th>
            <th>Nro. Orden</th>
            <th>C.I</th>
            <th>Nombre y Apellido</th>
            <th>Nro. Muestra</th>
            <th>Codigo DGVS</th>
            <th>Resultado</th>
            <th>Usuario</th>
            <th>Microbiologia</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;

      		while ($row1 = pg_fetch_array($result1))
      		{
                $i++;

                if($row1["microbiologia"] == 1)
                {
                	$microbiologia  = "Si";
                }
                else
                {
                	$microbiologia  = "No";
                }

          			 print '<tr>'
                     .'<td>'.$i.'</td>'
          				   .'<td>'.$row1["nordentra"].'</td>'
          				   .'<td>'.$row1["cedula"].'</td>'
          				   .'<td>'.$row1["nomyape"].'</td>'
          				   .'<td>'.$row1["nromuestra"].'</td>'
                     .'<td>'.$row1["cod_dgvs"].'</td>'
                     .'<td>'.$row1["resultado"].'</td>'
                     .'<td>'.$row1["codusu"].'</td>'
          				   .'<td>'.$microbiologia.'</td>'
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

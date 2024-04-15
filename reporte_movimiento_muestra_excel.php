<?php
@Header( "Content-type: text/html; charset=iso-8859-1" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

$elusuario = $nomyape;

if(isset($_GET["nordentra"]))
{
    $nordentra = $_GET['nordentra'];
    $_SESSION['nordentra'] = $_GET['nordentra'];
}
else
{
    $nordentra = "";
    $_SESSION['nordentra'] = "";
}


if($nordentra!= '')
{
    $w= " and t.nordentra = '$nordentra'";

    $reportnordentra = '<div style="font-size: 16px; text-align:left"><b>Nro. Orden:</b> '.$nordentra.'</div>';
}

$sql1 = "
select distinct d.fecha,
		t.cod_dgvs,
		(select e.nomservicio from establecimientos e where e.codservicio = coalesce(d.codservicioe, t.codservicio)) as codservicioe,
		(select e.nomservicio from establecimientos e where e.codservicio = coalesce(d.codservicior, t.codservicio)) as codservicior,
		coalesce(d.fecha, r.fecha) as fecha,
		coalesce(d.estado, 3) AS estado,
    t.codusu
from ordtrabajo t, estrealizar r
FULL OUTER JOIN datoagrupado d ON d.nordentra = r.nordentra and d.nromuestra = r.nromuestra
where t.nordentra   = r.nordentra
".$w;

$result1 = pg_query($link,$sql1);
$countlc = pg_num_rows($result1);

$sql = "
select distinct t.nordentra,
p.cedula,
p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
p.sexo,
p.edada,
t.cod_dgvs,
t.codusu
from paciente p, ordtrabajo t
where p.nropaciente = t.nropaciente
".$w;

$result = pg_query($link,$sql);

$row = pg_fetch_assoc($result);

$cedula     = $row["cedula"];
$nomyape    = $row["nomyape"];
$coddgvs    = $row["cod_dgvs"];
$edada      = $row["edada"];

if($row["sexo"] == 1)
{
	$sexo  = "Masculino";
}
else
{
	$sexo  = "Femenino";
}

if($countlc != 0 && $nordentra!= '')
{
  $reportnordentra = '<div style="font-size: 16px; text-align:left"><b>Nro. Orden:</b> '.$nordentra.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Nro. Doc:</b> '.$cedula.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Apellido y nombre:</b> '.$nomyape.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Sexo:</b> '.$sexo.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Edad:</b> '.$edada.'</div>'.
                    '<div style="font-size: 16px; text-align:left"><b>Id DGVS:</b> '.$coddgvs.'</div>';
}

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
  if($countlc != 0 && $nordentra!= '')
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
              $filename = "listamovimientomuestra.xls";
              header("Content-type: application/x-msdownload");
              header("Content-Disposition: attachment; filename=$filename");
              header("Pragma: no-cache");
              header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

              if($reportnordentra != ''){ echo $reportnordentra; }

          ?>

    </div>
   <br>

      <table class="table table-striped table-hover">
        <thead class="thead-green">
          <tr>
            <th>Item</th>
            <th>Fecha</th>
            <th>Enviado</th>
			<th>Recibido</th>
            <th>Estado</th>
            <th>Usuario</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;

      		while ($row1 = pg_fetch_array($result1))
      		{
                $i++;

                $fecharec  = date("d/m/Y", strtotime($row1[fecha]));

                $estado    = $row1["estado"];

                switch ($estado) {
            			case 1:
            				$nomestado = 'Pendiente';
            				break;
            			case 2:
            				$nomestado = 'Enviado';
            				break;
            			case 3:
            				$nomestado = 'Recibido';
            				break;
            			case 4:
            				$nomestado = 'Rechazado';
            				break;
            			case 5:
            				$nomestado = 'Anulado';
            				break;
            		}

                print '<tr>'
                    .'<td>'.$i.'</td>'
                    .'<td>'.$fecharec.'</td>'
                    .'<td>'.$row1["codservicioe"].'</td>'
					 .'<td>'.$row1["codservicior"].'</td>'
                    .'<td>'.$nomestado.'</td>'
                    .'<td>'.$row1["codusu"].'</td>'
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

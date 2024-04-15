<?php
@Header( "Content-type: text/html; charset=UTF-8" );
session_start();

include( "conexion.php" );
$link = Conectarse();

$nomyape = $_SESSION[ "nomyape" ];
$codusu = $_SESSION[ 'codusu' ];

if(isset($_REQUEST["nordentra"]))
{
  $nordentra = $_REQUEST['nordentra'];
}
else
{
  $nordentra	 = "";
}

?>

<table id="example" class="table table-striped table-hover" width="100%">
  <!--class="cell-border" width="100%" cellspacing="0"> -->

  <thead>
    <tr>
      <td scope="col" >Nro. Orden</td>
      <td scope="col">Estudios</td>
	  <td scope="col">Determinacion </td>
	  <td scope="col">Resultado </td>
	  <td scope="col">Observacion </td>
    </tr>
  </thead>

  <tbody>
  <?php

  $sql="select distinct t.nordentra,
                     t.codservicio,
                     t.codorigen,
                     t.fecharec,
                     t.horarec,
                     p.nropaciente,
                     p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
                     p.dccionr,
                     p.telefono,
                     e.microbiologia,
                     re.nroestudio,
                     re.codestudio,
                     e.nomestudio,
                     re.coddetermina,
                     d.nomdetermina,
                         d.aliasdetermina,
					 d.posicion,
                     re.resultado,
                     re.codumedida,
                     re.codestado,
                     r.nromuestra,
                     r.fecha,
					 re.idmuestra,
					 re.obs,
					 re.codresultado,
         			 re.codsector
		 		  from paciente p, ordtrabajo t, estudios e, estrealizar r, resultados re, determinaciones d
                   where p.nropaciente = t.nropaciente
                   and   e.codestudio  = r.codestudio
                   and   t.nordentra   = r.nordentra
                   and   t.codservicio = r.codservicio
                   and   re.nroestudio = r.nroestudio
                   and   re.nordentra  = r.nordentra
                   and   re.codservicio= r.codservicio
                   and   re.codestudio  = d.codestudio
                   and   re.coddetermina  = d.coddetermina
                   and   t.nordentra   = '$nordentra'
                   union all
               select distinct t.nordentra,
                     t.codservicio,
                     t.codorigen,
                     t.fecharec,
                     t.horarec,
                     p.nropaciente,
                     p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
                     p.dccionr,
                     p.telefono,
                     e.microbiologia,
                     re.nroestudio,
                     re.codestudio,
                     e.nomestudio,
                     re.coddetermina,
                     d.nomdetermina,
                       d.aliasdetermina,
					 d.posicion,
                     re.resultado,
                     re.codumedida,
                     re.codestado,
                     r.nromuestra,
                     r.fecha,
					 re.idmuestra,
					 re.obs,
					 re.codresultado,
					 re.codsector
                   from paciente p, ordtrabajo t, estudios e, estrealizar r, resultadosmicro re, determinaciones d
                   where p.nropaciente = t.nropaciente
                   and   e.codestudio  = r.codestudio
                   and   t.nordentra   = r.nordentra
                   and   t.codservicio = r.codservicio
                   and   re.nroestudio = r.nroestudio
                   and   re.nordentra  = r.nordentra
                   and   re.codservicio= r.codservicio
                   and   re.codestudio  = d.codestudio
                   and   re.coddetermina  = d.coddetermina
                   and   t.nordentra    = '$nordentra'
                   order by codestudio, posicion";

  $res=pg_query($link,$sql);

  $i = 1;

  while ($row = pg_fetch_array($res))
  {
       $i = $i + 1;

	   $codresultado  = $row['codresultado'];
       $codestudio    = $row['codestudio'];
       $coddetermina  = $row['coddetermina'];
       $codequipo     = $row['codequipo'];
       $codmetodo     = $row['codmetodo'];
       $codumedida    = $row['codumedida'];
       $codestado     = $row['codestado'];
	   $codsector	  = $row['codsector'];
	   $resul         = $row['resultado'];

      	if ($codestado != '')
		{

   			$tabr = pg_query($link, "select codestado, nomestado from estadoresultado where codestado = trim('$codestado')");
   			$rowr = pg_fetch_array($tabr);
   			$nomestado = $rowr['nomestado'];
   		}
   		else
   		{
   			$nomestado = '';
   		}

	    if ($codsector != '')
		{

   			$tabr = pg_query($link, "select codsector, nomsector from sectores where codsector = '$codsector'");
   			$rowr = pg_fetch_array($tabr);
   			$nomsector = $rowr['nomsector'];
   		}
   		else
   		{
   			$nomsector = '';
   		}


		$result1 = pg_query($link, "select rc.codresultado,
										  rc.nomresultado
									from resultadoposible rs, resultadocodificado rc
									where rs.codresultado = rc.codresultado
									and   rs.codestudio = '$codestudio'
                  and   rs.coddetermina = '$coddetermina'
									union all
									select rc.codresultado,
										   rc.nomresultado
									from resultadoposible rs, resultadocodificadobio rc
									where rs.codresultado = rc.codresultado
									and   rs.codestudio = '$codestudio'
                  and   rs.coddetermina = '$coddetermina'");

		$cantresultado = pg_num_rows( $result1 );

		if($cantresultado != 0)
		{
			$resultado = '<select   float:right; name="codresultado'.$i.'" id="codresultado'.$i.'" required>
			<option value=""></option>';

			while ($fila = pg_fetch_array($result1))
			{
				if(trim($fila["codresultado"]) == trim($codresultado))
				{
					$resultado .=  '<option value="'.$fila["codresultado"].'" selected>'.$fila["nomresultado"].'</option>';
				}
				else
				{
					$resultado .=  '<option value="'.$fila["codresultado"].'">'.$fila["nomresultado"].'</option>';
				}
			}

			$resultado .=  '</select>';
		}
		else
		{
			$resultado =  '<input type="text" value="'.$row['resultado'].'" name="nomresultado'.$i.'" id="nomresultado'.$i.'" required>';
		}

	    echo "<tr onClick='getVal(".$i.")'>";

		echo "<td>" . $row['nordentra'] . "</td>";
        echo "<td style='text-align: left;'>" . $row['nomestudio']. "</td>";
	    echo "<td style='text-align: left;'>" . $row['aliasdetermina'] . "</td>";
        echo "<td >" . $resultado . "</td>";
		echo "<td>" . '<input type="text" value="'.$row['obs'].'" name="obs'.$i.'" id="obs'.$i.'" required>' . "</td>";
        echo "<td style='display:none;'>" . $row['nroestudio'] . "</td>";
        echo "<td style='display:none;'>" . $row['idmuestra'] . "</td>";
	    echo "<td style='display:none;'>" . $row['microbiologia'] . "</td>";
	    echo "<td style='display:none;'>" . $row['codsector'] . "</td>";
	    echo "<td style='display:none;'>" . $row['codestudio'] . "</td>";
	    echo "<td style='display:none;'>" . $nomsector . "</td>";
	    echo "<td style='display:none;'>" . $row['coddetermina'] . "</td>";

	  	echo "</tr>";

	}
?>
</tbody>
</table>

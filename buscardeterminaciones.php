<?php
include("conexion.php"); 
$con=Conectarse();

$nroeval    = $_POST['nroeval'];
$codestudio = $_POST['codestudio'];

$sql = "select coddetermina, codestudio, nroeval, drp
		from evaluaciondeterminacion
		where nroeval = '$nroeval'
		and   codestudio = '$codestudio'";

$res = pg_query($con,$sql);

if(!$res)
{
       echo "Ocurrio un error en la consulta"; /* Si ocurre verifica todo lo tengas bien */
}
else
{
       $tabla ="<table class='table table-striped table-hover'>";
       $tabla .= "<thead>
					<tr>
					  <td scope='col'>Item</td>
					  <td scope='col'>Determinacion</td>
					  <td scope='col'>D.R.P</td>
					  <td scope='col'>Eliminar</td>
					</tr>
				  </thead>";
       $tabla .="<tbody>";
	   $i = 0;
	
       while ($data = pg_fetch_assoc($res) ) {
		   
		  $i = $i + 1;
		   
		  $coddetermina = $data["coddetermina"];
		   
		  $query3 = "select * from determinaciones where codestudio = '$codestudio' and coddetermina = '$coddetermina'";
		  $result3 = pg_query($con,$query3);

	      $row3 = pg_fetch_assoc($result3);
		   
		  $nomdetermina = $row3["nomdetermina"];
		   
          $tabla .="<tr>";
             
           $tabla .="<td>".$i."</td>";
		   $tabla .="<td>".$nomdetermina."</td>";
		   $tabla .="<td>".$data['drp']."</td>";
		   $tabla .='<td><div id="wb_FontAwesomeIcon4"><a href="#" onclick="eliminar('."'".$data['nroeval']."', '".$data['codestudio']."', '".$data['coddetermina']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div></td>';
          $tabla .="</tr>";
       }
       $tabla .="</tbody>";
       $tabla .="</table>";
       echo $tabla;
}

pg_close($con);
?>
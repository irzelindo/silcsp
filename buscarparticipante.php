<?php
include("conexion.php"); 
$con=Conectarse();

$nroeval = $_POST['nroeval'];

$sql = "select item,
				codusu,
				nroeval
		from evalucionparticipante
		where nroeval = '$nroeval'";

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
					  <td scope='col'>Participante</td>
					  <td scope='col'>Eliminar</td>
					</tr>
				  </thead>";
       $tabla .="<tbody>";
       while ($data = pg_fetch_assoc($res) ) {
		   
		  $usuario = $data["codusu"];
		   
		  $query3 = "select * from usuarios where codusu = '$usuario'";
		  $result3 = pg_query($con,$query3);

	      $row3 = pg_fetch_assoc($result3);
		   
		  $razonsocial = $row3["nomyape"];
		   
          $tabla .="<tr>";
             
           $tabla .="<td>".$data["item"]."</td>";
		   $tabla .="<td>".$razonsocial."</td>";
		   $tabla .='<td><div id="wb_FontAwesomeIcon4"><a href="#" onclick="eliminar('."'".$data['nroeval']."', '".$data['item']."', '".$data['codusu']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div></td>';
          $tabla .="</tr>";
       }
       $tabla .="</tbody>";
       $tabla .="</table>";
       echo $tabla;
}

pg_close($con);
?>
<?php
include("conexion.php"); 
$con=Conectarse();

$idpregunta = $_POST['idpregunta'];

$sql = "select *
		from respuesta
		where idpregunta = '$idpregunta'";

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
					  <td scope='col'>Respuesta</td>
					  <td scope='col'>Eliminar</td>
					</tr>
				  </thead>";
       $tabla .="<tbody>";

       while ($data = pg_fetch_assoc($res) ) 
	   {
		   
          $tabla .="<tr>";
             
           $tabla .="<td>".$data['item']."</td>";
		   $tabla .="<td>".$data['descripcio']."</td>";
		   $tabla .='<td><div id="wb_FontAwesomeIcon4"><a href="#" onclick="eliminar1('."'".$data['idpregunta']."', '".$data['item']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div></td>';
          $tabla .="</tr>";
       }
       $tabla .="</tbody>";
       $tabla .="</table>";
       echo $tabla;
}

pg_close($con);
?>
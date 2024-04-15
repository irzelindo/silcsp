<?php
include("conexion.php");
$con=Conectarse();

$nordentra 	= $_POST['nordentra'];

$sql="select  (select e.nomestudio from estudios e where e.codestudio = r.codestudio) as estudio,
		(select re.nomresultado from resultadocodificado re where re.codresultado = r.codresultado) as resultado
from resultados r
where r.nordentra   = '$nordentra'

union

select  (select e.nomestudio from estudios e where e.codestudio = r.codestudio) as estudio,
		(select re.nomresultado from resultadocodificado re where re.codresultado = r.codresultado) as resultado
from resultadosmicro r
where r.nordentra   = '$nordentra'";

$res=pg_query($con,$sql);

$i = 0;

echo '<table class="table table-striped table-hover">
	<thead class="thead-green">
		<tr>
			<th>Item</th>
			<th>Estudio</th>
			<th>Resultado</th>
		</tr>
	</thead>
	<tbody>';
while ($row1 = pg_fetch_array($res))
{
			$i++;

			 echo '<tr>'
					 .'<td>'.$i.'</td>'
					 .'<td>'.$row1["estudio"].'</td>'
					 .'<td>'.$row1["resultado"].'</td>'
					 .'</tr>';
}

echo '</tbody>
</table>';

?>

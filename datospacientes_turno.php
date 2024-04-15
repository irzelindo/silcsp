<?php
// Se crea la conexi�n a la base de datos
   session_start();

   ini_set('memory_limit', '-1');

   $codusu=$_SESSION['codusu'];

   $v_11  = $_SESSION['V_11'];

    include("conexion.php");
	$con=Conectarse();

	$page = $_REQUEST['page'];
	$limit = $_REQUEST['rows'];
	$sidx = $_REQUEST['sidx'];
	$sord = $_REQUEST['sord'];

	$sqlorden = "select 	*
				from paciente p, ordtrabajo o
				WHERE p.nropaciente = o.nropaciente
				order by p.nropaciente";

	$resorden = pg_query($con,$sqlorden);
	$conorden = pg_num_rows($resorden);


	if($_REQUEST["_search"] == "false")
	{
		$where = " ";
	}
	else
	{
		$operations = array(
			'eq' => "= '%s'",
			'ne' => "!= '%s'",
			'lt' => "< '%s'",
			'le' => "<= '%s'",
			'gt' => "> '%s'",
			'ge' => ">= '%s'",
			'bw' => "like '%s%%'",
			'bn' => "not like '%s%%'",
			'in' => "in ('%s')",
			'ni' => "not in ('%s')",
			'ew' => "like '%%%s'",
			'en' => "not like '%%%s'",
			'cn' => "like '%%%s%%'",
			'nc' => "not like '%%%s%%'",
			'nu' => "is null",
			'nn' => "is not null"
		);

		$value = pg_escape_string($_REQUEST["searchString"]);
		$where = sprintf(" %s ".$operations[$_REQUEST["searchOper"]], $_REQUEST["searchField"], $value);
	}

    // Se obtiene el resultado de la consulta
    $sql="select 	p.nropaciente,
	p.tdocumento,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	p.pnombre,
	p.snombre,
	p.papellido,
	p.sapellido,
	p.cedula,
	p.fechareg,
	p.dccionr,
	p.telefono
from paciente p
order by p.nropaciente ";

	$res=pg_query($con,$sql);
	$count=pg_num_rows($res);

    //En base al numero de registros se obtiene el numero de paginas
    if( $count >0 ) {
	$total_pages = ceil($count/$limit);
    } else {
	$total_pages = 0;
    }
    if ($page > $total_pages)
        $page=$total_pages;

    //Almacena numero de registro donde se va a empezar a recuperar los registros para la pagina
    $start = $limit*$page - $limit;

    //Consulta que devuelve los registros de una sola pagina
    $sql1 = "select 	p.nropaciente,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	p.tdocumento,
	p.pnombre,
	p.snombre,
	p.papellido,
	p.sapellido,
	p.cedula,
	p.fechareg,
	p.dccionr,
	p.telefono
from paciente p
order by p.nropaciente desc";

	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();

    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
		$respuesta->rows[$i]['id'] = $row['nropaciente'];
		$fechareg = date("d/m/Y", strtotime($row[fechareg]));

		switch ($row[tdocumento]) {
		case '1':
			$nomdocumento = "1. Cedula";
			break;
		case '2':
			$nomdocumento = "2. Pasaporte";
			break;
		case '3':
			$nomdocumento = "3. Carnet Indigena";
			break;
		case '4':
			$nomdocumento = "4. Otros";
			break;
		case '5':
			$nomdocumento = "5. No Tiene";
			break;
		}

	$respuesta->rows[$i]['cell'] = array('<a href="#" style="color:#0B610B" onClick="enviarpaciente('."'".$row[nropaciente]."', '".$nomdocumento."', '".$row[cedula]."', '".$row[pnombre]."', '".$row[snombre]."', '".$row[papellido]."', '".$row[sapellido]."'".')")>'.$row[nropaciente] .'</a>',$row[nomyape],$row[cedula],$fechareg,$row[dccionr],$row[telefono]);

	$i++;
	}

	//Asignamos todo esto en variables de json, para enviarlo al navegador.

    echo json_encode($respuesta);
?>

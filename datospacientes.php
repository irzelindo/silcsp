<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

   $v_11  = $_SESSION['V_11'];

    include("conexion.php");
	$con=Conectarse();

	$page = $_REQUEST['page'];
	$limit = $_REQUEST['rows'];
	$sidx = $_REQUEST['sidx'];
	$sord = $_REQUEST['sord'];


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
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	p.cedula,
	p.fechareg,
	p.dccionr,
	p.telefono
from paciente p ";

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

	if($v_11==3)
	   {
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_pacientes.php?nropaciente='.$row[nropaciente].'\'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon4"><a href="#" onclick="confirmacion('."'".$row[nropaciente]."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-trash-o">&nbsp;</i></div></a></div>',$row[nropaciente],$row[nomyape],$row[cedula],$fechareg,$row[dccionr],$row[telefono]);
	   }
    else
	   {
	   	if($v_11==2)
	   	   {
	   	   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div>';
	   	   }
	   	else
		   {
		   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-info-circle">&nbsp;</i></div>';
		   }
	   	$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_pacientes.php?nropaciente='.$row[nropaciente].'\'";>'.$palabra.'</a></div>','S/Permiso',$row[nropaciente],$row[nomyape],$row[cedula],$fechareg,$row[dccionr],$row[telefono]);
	   }

	$i++;
	}

	//Asignamos todo esto en variables de json, para enviarlo al navegador.

    echo json_encode($respuesta);
?>

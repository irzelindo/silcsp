<?php
// Se crea la conexión a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

    $v_151   = $_SESSION['V_151'];	// Ingresos y Cajas
	$v_152   = $_SESSION['V_152'];	// Pagos Home Banking
	$v_1511   = $_SESSION['V_1511'];	// Recibos
	$v_153   = $_SESSION['V_153'];	// Apertura y Cierre de Caja
	$v_154   = $_SESSION['V_154'];	// Arqueo

   
    include("conexion.php"); 
	$con=Conectarse();
	
	$page = $_REQUEST['page']; 
	$limit = $_REQUEST['rows']; 
	$sidx = $_REQUEST['sidx']; 
	$sord = $_REQUEST['sord'];

	if(isset($_GET["codservicio"])) 
	{
		$codservicio = $_GET['codservicio'];
		$_SESSION['codservicio'] = $_GET['codservicio'];
	}
	else 
	{	
		$codservicio = "";
		$_SESSION['codservicio'] = "";
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

	if($desde == "")
	{
		$desde = date("Y-m-d", time());
	}

	if($hasta == "")
	{
		$hasta = date("Y-m-d", time());
	}

	if($codservicio != '')
    {
   		$w=" i.codservicio = '$codservicio'";  
    }

	if($desde != '')
    {
   		$w=$w." and i.fecha >= '$desde'";  
    }

	if($hasta != '')
    {
   		$w=$w." and i.fecha <= '$hasta'";  
    }

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
    $sql="SELECT i.nroingreso, 
				   i.fecha,
				   i.nomyape,
				   (select nroexpediente from homebanking h where i.nroingreso = h.nroingreso) as homebanking,
				   i.estado,
				   sum(r.monto) as monto
			FROM ingresocaja i
			FULL JOIN recibos r
			ON i.nroingreso   = r.nroingreso
			AND   i.nrorecibo    = r.nrorecibo
			AND   i.nroreciboser = r.nroreciboser 
			WHERE $w
			GROUP BY i.nroingreso, 
				   i.fecha,
				   i.nomyape,
				   i.estado
			ORDER BY i.nroingreso desc"; 

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
    $sql1 = "SELECT i.nroingreso, 
				   i.fecha,
				   i.nomyape,
				   i.nropaciente as nropaciente,
				   (select nroexpediente from homebanking h where i.nroingreso = h.nroingreso) as homebanking,
				   i.estado,
				   sum(r.monto) as monto
			FROM ingresocaja i
			FULL JOIN recibos r
			ON i.nroingreso   = r.nroingreso
			AND   i.nrorecibo    = r.nrorecibo
			AND   i.nroreciboser = r.nroreciboser 
			WHERE $w
			GROUP BY i.nroingreso, 
				   i.fecha,
				   i.nomyape,
				   i.estado
			ORDER BY i.nroingreso desc";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
	   $respuesta->rows[$i]['id'] = $row['nroingreso'];
		
	   $fecha  	   = date("d/m/Y", strtotime($row[fecha]));
	   $nomyape    = $row['nomyape'];
	   $homebanking= $row['homebanking'];
	   $nropaciente= $row['nropaciente'];
		
	   $monto       = number_format($row['monto'], 0, ',', '.');
		
		if($nomyapea == '')
		{
			$querye = "select * from empresas where codempresa = '$nropaciente' ";
			$resulte = pg_query($con,$querye);

			$rowe = pg_fetch_assoc($resulte);

			$nomyape = $rowe["razonsocial"];
		}
		
	    if($row['estado'] == 2)
		{
			$anulado = '<span style="color:#FF0000;font-family:Arial;font-size:13px;"><strong>Anulado</strong></span>';
		}
		else
		{
			$anulado = '<div id="wb_FontAwesomeIcon4"><a href="#" onclick="window.location.href=\'anular_ingresos_caja_detalle.php?nroingreso='.$row['nroingreso'].'\'";><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div>';

		}
	   
	   $link = "window.open('imprimir_ticket.php?nroingreso=".$row['nroingreso']."', '_blank')";
		
	   $ver = '<div id="wb_FontAwesomeIcon4"><a href="#" onclick="'.$link.'";><div id="FontAwesomeIcon4"><i class="fa fa-eye">&nbsp;</i></div></a></div>';
		
	   $respuesta->rows[$i]['cell'] = array($ver, $anulado, $row['nroingreso'],$fecha,$nomyape,$homebanking,$monto); 
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
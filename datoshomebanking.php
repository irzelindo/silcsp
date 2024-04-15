<?php
// Se crea la conexi�n a la base de datos
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
   		$w=$w." and i.codservicio = '$codservicio'";  
    }

	if($desde != '')
    {
   		$w=$w." and h.fecha >= '$desde'";  
    }

	if($hasta != '')
    {
   		$w=$w." and h.fecha <= '$hasta'";  
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
	   h.fecha, 
	   h.estadu,
	   r.codarancel,
       sum(h.monto) as monto
FROM ingresocaja i, recibos r, homebanking h
WHERE i.nroingreso   = r.nroingreso
AND   i.nrorecibo    = r.nrorecibo
AND   i.nroreciboser = r.nroreciboser 
AND   i.nroingreso   = h.nroingreso $w
GROUP BY i.nroingreso, 
	   h.fecha, 
	   h.estadu,
	   r.codarancel	 "; 

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
	   h.fecha, 
	   h.estadu,
	   r.codarancel,
       sum(h.monto) as monto
FROM ingresocaja i, recibos r, homebanking h
WHERE i.nroingreso   = r.nroingreso
AND   i.nrorecibo    = r.nrorecibo
AND   i.nroreciboser = r.nroreciboser 
AND   i.nroingreso   = h.nroingreso $w
GROUP BY i.nroingreso, 
	   h.fecha, 
	   h.estadu,
	   r.codarancel";
	
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
	   $codarancel = $row['codarancel'];
		
	   $query2 = "select * from aranceles where codarancel = '$codarancel'";
       $result2 = pg_query($con,$query2);

       $row2 = pg_fetch_assoc($result2);

       $nomarancel 	= $row2["nomarancel"];
		
	   if($v_152==3)
	   {
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_homebanking.php?nroingreso='.$row[nroingreso].'\'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>', '<div id="wb_FontAwesomeIcon4"><a href="#" onclick="confirmacion('."'".$row[nroingreso]."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-trash-o">&nbsp;</i></div></a></div>', $row['nroingreso'],$fecha,$nomarancel,$row['monto']); 	   	
	   }	
       else
	   {
	   	if($v_152==2)
	   	   {
	   	   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div>';
	   	   }
	   	else
		   {
		   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-info-circle">&nbsp;</i></div>';
		   }    
		   
		   $respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_homebanking.php?nroingreso='.$row['nroingreso'].'\'";>'.$palabra.'</a></div>', 'S/Permiso', $row['nroingreso'],$fecha,$nomarancel,$row['monto']); 
	   } 
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
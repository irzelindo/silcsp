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

	$w = "";

	if(isset($_GET["nroingreso"])) 
	{
		$nroingreso = $_GET['nroingreso'];
	}
	else 
	{	
		$nroingreso = "";
	}

	if(isset($_GET["nrorecibo"])) 
	{
		$nrorecibo = $_GET['nrorecibo'];
	}
	else 
	{	
		$nrorecibo = "";
	}
	
	if(isset($_GET["nroreciboser"])) 
	{
		$nroreciboser = $_GET['nroreciboser'];
	}
	else 
	{	
		$nroreciboser = "";
	}
		
	if($nroingreso != '') 
	{	
		$w = " and r.nroingreso = '".$nroingreso."'";
	}

	if($nrorecibo != '') 
	{	
		$w = $w." and r.nrorecibo = '".$nrorecibo."'";
	}
	
	if($nroreciboser != '') 
	{	
		$w = $w." and r.nroreciboser = '".$nroreciboser."'";
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
    $sql="SELECT r.nroingreso, 
	   r.nrorecibo, 
	   r.nroreciboser, 
	   r.norden, 
	   r.codarancel,
	   a.nomarancel,
	   r.monto, 
	   r.fecha, 
	   r.exonerado
	FROM recibos r, aranceles a
	where r.codarancel = a.codarancel ".$w; 

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
    $sql1 = "SELECT r.nroingreso, 
	   r.nrorecibo, 
	   r.nroreciboser, 
	   r.norden, 
	   r.codarancel,
	   a.nomarancel,
	   r.monto, 
	   r.fecha, 
	   r.exonerado,
	   i.estado
	FROM recibos r, aranceles a, ingresocaja i
	where r.codarancel = a.codarancel
	and   i.nroingreso = r.nroingreso ".$w." order by r.nroingreso";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
		$respuesta->rows[$i]['id'] = $row['nroingreso'].$row['norden'];
		
		$respuesta->rows[$i]['cell'] = array($row[norden],$row[codarancel],$row[nomarancel],$row[monto]); 

		$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
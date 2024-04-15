<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

   $v_12  = $_SESSION['V_12'];
   
    include("conexion.php"); 
	$con=Conectarse();
	
	$page = $_REQUEST['page']; 
	$limit = $_REQUEST['rows']; 
	$sidx = $_REQUEST['sidx']; 
	$sord = $_REQUEST['sord'];

	$w = "";

	if(isset($_GET["nordentra"])) 
	{
		$nordentra = $_GET['nordentra'];
	}
	else 
	{	
		$nordentra = "";
	}

	if(isset($_GET["codservicio"])) 
	{
		$codservicio = $_GET['codservicio'];
	}
	else 
	{	
		$codservicio = "";
	}
	
	if(isset($_GET["nromuestra"])) 
	{
		$nromuestra = $_GET['nromuestra'];
	}
	else 
	{	
		$nromuestra = "";
	}
		
	if($nordentra != '') 
	{	
		$w = " and r.nordentra = '".$nordentra."' and r.codservicio = '".$codservicio."'";
	}
	
	if($nromuestra != '') 
	{	
		$w = $w." and r.nromuestra = '".$nromuestra."'";
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
    $sql="select 	e.codexterno,
	e.codestudio,
	e.nomestudio,
	e.abreviatura,
	r.nordentra, 
	r.nroestudio,
	r.nroturno,
	r.codservicio
from estrealizar r, estudios e, datoagrupado d
where r.codestudio = e.codestudio
and d.nordentra    = r.nordentra 
and d.codservicioe = r.codservicio 
and d.nromuestra   = r.nromuestra ".$w; 

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
    $sql1 = "select 	e.codexterno,
	e.codestudio,
	e.nomestudio,
	e.abreviatura,
	r.nordentra, 
	r.nroestudio,
	r.nroturno,
	r.codservicio
from estrealizar r, estudios e, datoagrupado d
where r.codestudio = e.codestudio
and d.nordentra    = r.nordentra 
and d.codservicioe = r.codservicio 
and d.nromuestra   = r.nromuestra ".$w." order by e.codexterno";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
		$respuesta->rows[$i]['id'] = $row['nroestudio'];

		$respuesta->rows[$i]['cell'] = array($row['codexterno'],$row['codestudio'],$row['nomestudio'],$row['abreviatura']);

		$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
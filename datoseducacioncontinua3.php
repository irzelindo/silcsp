<?php
// Se crea la conexión a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];
   
    include("conexion.php"); 
	$con=Conectarse();
	
	$page = $_REQUEST['page']; 
	$limit = $_REQUEST['rows']; 
	$sidx = $_REQUEST['sidx']; 
	$sord = $_REQUEST['sord'];

	if(isset($_GET["nroeval"])) 
	{
		$nroeval = $_GET['nroeval'];
	}
	else 
	{	
		$nroeval = "";
	}

	if(isset($_GET["codempresa"])) 
	{
		$codempresa = $_GET['codempresa'];
	}
	else 
	{	
		$codempresa = "";
	}

	if($nroeval != '') 
	{	
		$w = " and r.nroeval = '".$nroeval."'";
	}
	else
	{
		$w = "";
	}

	if($codempresa != '') 
	{	
		$w =$w. " and r.codempresa = '".$codempresa."'";
	}
	else
	{
		$w = "";
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
    $sql="select r.nroeval,
       r.codempresa,
	   r.nropregunta,
	   p.textopregunta,
	   p.respuesta as respuestap,
	   r.respuesta,
	   r.puntaje
from respeducacioncontinua r, preguntaedcontinua p
where r.nropregunta = p.nropregunta ".$w; 

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
    $sql1 = "select r.nroeval,
				   r.codempresa,
				   r.nropregunta,
				   p.textopregunta,
				   p.respuesta as respuestap,
				   r.respuesta,
				   r.puntaje
			from respeducacioncontinua r, preguntaedcontinua p
			where r.nropregunta = p.nropregunta ".$w." order by r.nroeval, r.codempresa";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
		$respuesta->rows[$i]['id'] = $row['nroeval'].$row['codempresa'].$row['nropregunta'];
		
	    $respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon4"><a href="#" style="text-decoration:none" data-toggle="modal" data-target="#myModal" id="button"><div id="FontAwesomeIcon4"><i class="fa fa-edit">&nbsp;</i></div></a></div>',$row['textopregunta'],$row['respuestap'],$row['respuesta'],$row['puntaje'],$row['nropregunta']); 
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
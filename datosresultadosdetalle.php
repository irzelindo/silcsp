<?php
// Se crea la conexión a la base de datos
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

	if(isset($_GET["codestudio"])) 
	{
		$codestudio = $_GET['codestudio'];
	}
	else 
	{	
		$codestudio = "";
	}
		
	if($nordentra != '') 
	{	
		$w = " and r.nordentra = '".$nordentra."' and r.codservicio = '".$codservicio."'";
	}

	if($codestudio != '') 
	{	
		$w = $w." and r.codestudio = '".$codestudio."'";
	}
	else
	{
		$w = $w." and r.codestudio = '999'";
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
    $sql="select	r.nordentra,
		r.codservicio,
		r.nroestudio,
		r.codestudio,
		r.coddetermina,
		r.resultado,
		r.codumedida,
		r.codestado,
		e.nromuestra,
		r.nroorden,
		r.anulado,
		es.microbiologia
from resultados r, estrealizar e, estudios es
where r.nroestudio = e.nroestudio
and   r.nordentra  = e.nordentra
and   r.codservicio= e.codservicio
and   es.codestudio= e.codestudio ".$w; 

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
    $sql1 = "select	r.nordentra,
		r.codservicio,
		r.nroestudio,
		r.codestudio,
		r.coddetermina,
		r.resultado,
		r.codumedida,
		r.codestado,
		e.nromuestra,
		r.nroorden,
		r.anulado,
		es.microbiologia
from resultados r, estrealizar e, estudios es
where r.nroestudio = e.nroestudio
and   r.nordentra  = e.nordentra
and   r.codservicio= e.codservicio
and   es.codestudio= e.codestudio ".$w." order by r.nroorden";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
		$respuesta->rows[$i]['id'] = $row['nroestudio'].$row['nordentra'].$row['codservicio'].$row['nroorden'];
		
		$codservicio 	= $row['codservicio'];
		$codestudio  	= $row['codestudio'];
		$nordentra   	= $row['nordentra'];
		$nroestudio  	= $row['nroestudio'];
		$coddetermina  	= $row['coddetermina'];
		$resultado  	= $row['resultado'];
		$codumedida  	= $row['codumedida'];
		$codestado  	= $row['codestado'];
		$nroorden		= $row['nroorden'];
		$microbiologia	= $row['microbiologia'];
		
		$cadena2="select * from determinaciones where codestudio='$codestudio' and coddetermina='$coddetermina'";
		
        $lista2       = pg_query($con, $cadena2);
        $registro2    = pg_fetch_array($lista2);
        $nomdetermina = $registro2['nomdetermina'];
		
		$cadena3="select * from unidadmedida where codumedida='$codumedida'";
		
        $lista3       = pg_query($con, $cadena3);
        $registro3    = pg_fetch_array($lista3);
        $nomumedida   = $registro3['nomumedida'];
		
		$cadena4="select * from estadoresultado where codestado='$codestado'";
		
        $lista4       = pg_query($con, $cadena4);
        $registro4    = pg_fetch_array($lista4);
        $nomestado    = $registro4['nomestado'];
		
		$muestra = str_pad($row['nromuestra'], 8, '0', STR_PAD_LEFT);
		
		$nromuestra = $codservicio.$muestra;
		
		$link = "window.location.href='resultados_detalle.php?nordentra=".$row['nordentra']."&codservicio=".$row['codservicio']."&codestudio=".$row['codestudio']."&nroorden=".$row['nroorden']."'";
		
		
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="'.$link.'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>', $nomdetermina,$resultado,$nomumedida,$nromuestra,$nomestado,$nordentra,$codservicio,$nroestudio,$nroorden);

		$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
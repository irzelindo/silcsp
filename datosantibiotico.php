<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

    $v_161  = $_SESSION['V_161']; //Carga, Validaci�n Revalidaci�n
	$v_162 = $_SESSION['V_162']; //Impresi�n Resultados
	$v_163 = $_SESSION['V_163 ']; //Carga, Validaci�n Microbiolog�a
	$v_164 = $_SESSION['V_164']; //Email Resultados
	$v_168 = $_SESSION['V_168']; //Hist�rico de Resultados
	$v_169 = $_SESSION['V_169']; //Interfaces con Analizadores
	$v_1691  = $_SESSION['V_1691']; //Preparar Muestras
	$v_1692  = $_SESSION['V_1692']; //Confirmar Resultados 
   
    include("conexion.php"); 
	$con=Conectarse();
	
	$page = $_REQUEST['page']; 
	$limit = $_REQUEST['rows']; 
	$sidx = $_REQUEST['sidx']; 
	$sord = $_REQUEST['sord'];

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

	if(isset($_GET["nroestudio"])) 
	{
		$nroestudio = $_GET['nroestudio'];
	}
	else 
	{	
		$nroestudio = "";
	}
	
	if(isset($_GET["nroorden"])) 
	{
		$nroorden = $_GET['nroorden'];
	}
	else 
	{	
		$nroorden = "";
	}
	
	if($nordentra != '') 
	{	
		$w = " and r.nordentra = '".$nordentra."' and r.codservicio = '".$codservicio."'";
	}
	
	if($nroestudio != '') 
	{	
		$w = $w." and r.nroestudio = '".$nroestudio."'";
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
    $sql="select 	r.codantibiot,
		r.codestudio,
		r.resultado,
		r.diametro,
		r.cmi,
		r.obs
from resultadoantibiotico r, estudios e
where r.codestudio = e.codestudio ".$w; 

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
    $sql1 = "select 	r.codantibiot,
		r.codestudio,
		r.resultado,
		r.diametro,
		r.cmi,
		r.obs,
		r.nroresul
from resultadoantibiotico r, estudios e
where r.codestudio = e.codestudio ".$w." order by r.codantibiot";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
		$respuesta->rows[$i]['id'] = $row['nroestudio'].$row['idmuestra'];
		
		$codantibiot   = $row['codantibiot'];
		$resultado     = $row["resultado"];
		$diametro      = $row["diametro"];
		$cmi           = $row["cmi"];
		$obs		   = $row["obs"];
		
		$query1 = "select * from antibioticos where codantibiot = '$codantibiot'";
		$result1 = pg_query($con,$query1);

		$row1 = pg_fetch_assoc($result1);

		$nomantibiot = $row1["nomantibiot"];
		
		
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_resultado_anti.php?nordentra='.$nordentra.'&codestudio='.$row['codestudio'].'&codservicio='.$codservicio.'&nroresul='.$row['nroresul'].'&nroorden='.$nroorden.'\'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon4"><a href="#" onclick="confirmacion1('."'".$nordentra."', '".$row['codestudio']."', '".$row['nroresul']."', '".$codservicio."', '".$nroorden."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div>',$nomantibiot,$resultado,$diametro,$cmi,$obs); 
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
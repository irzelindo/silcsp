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
		
	if($nordentra != '') 
	{	
		$w = " and r.nordentra = '".$nordentra."'";
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
    $sql="select  distinct r.codtmuestra, 	
					r.nromuestra,
					r.nordentra, 
					r.codservicio,
					s.codsector,
					s.nomsector
			from sectores s, estrealizar r, estudios e
			where e.codsector   = s.codsector
			and   e.codestudio  = r.codestudio
			and   r.nromuestra   is not null ".$w; 

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
    $sql1 = "select  distinct r.codtmuestra, 	
					r.nromuestra,
					r.nordentra, 
					r.codservicio,
					s.codsector,
					s.nomsector,
					r.validar
			from sectores s, estrealizar r, estudios e
			where e.codsector   = s.codsector
			and   e.codestudio  = r.codestudio
			and   r.nromuestra   is not null ".$w." order by r.nromuestra";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
		$respuesta->rows[$i]['id'] = $row['nordentra'];
		
	    $codtmuestra = $row['codtmuestra'];
		$codservicio = $row['codservicio'];
		$codsector   = $row['codsector'];
		$nordentra   = $row['nordentra'];
		$nomsector   = $row['nomsector'];
		$validar	 = $row['validar'];
		
		$cadena2="select * from tipomuestra where codtmuestra='$codtmuestra'";
        $lista2 = pg_query($con, $cadena2);
        $registro2 = pg_fetch_array($lista2);
        $nomtmuestra=$registro2['nomtmuestra'];
		
		$muestra = str_pad($row['nromuestra'], 8, '0', STR_PAD_LEFT);
		
		$nromuestra = $codservicio.$muestra;
		
		$cadena3="select * from establecimientos where codservicio='$codservicio'";
        $lista3 = pg_query($con, $cadena3);
        $registro3 = pg_fetch_array($lista3);
        $nomservicio=$registro3['nomservicio'];
		
		if($validar == 1)
		{
			$chkvalidar = '<input type="checkbox" name="validar'.$i.'" value="1" checked>';
		}
		else
		{
			$chkvalidar = '<input type="checkbox" name="validar'.$i.'" value="0">';
		}

		$respuesta->rows[$i]['cell'] = array($nomtmuestra,$nromuestra,$codsector,$nomsector,$chkvalidar, $nordentra,$nomservicio,$codservicio);

		$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
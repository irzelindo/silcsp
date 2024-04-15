<?php
// Se crea la conexión a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

    $v_181   = $_SESSION['V_181'];	// Previsto Bioquímica Clínica
	$v_182   = $_SESSION['V_182'];	// Previsto Dengue
	$v_183   = $_SESSION['V_183'];	// Previsto Hematología
	$v_184   = $_SESSION['V_184'];	// Previsto Influenza
	$v_185   = $_SESSION['V_185'];	// Previsto Parasitología Intestinal
	$v_186   = $_SESSION['V_186'];	// Previsto Rotavirus
	$v_187   = $_SESSION['V_187'];	// Previsto Sífilis
	$v_188   = $_SESSION['V_188'];	// Previsto Malaria

   
    include("conexion.php"); 
	$con=Conectarse();
	
	$page = $_REQUEST['page']; 
	$limit = $_REQUEST['rows']; 
	$sidx = $_REQUEST['sidx']; 
	$sord = $_REQUEST['sord'];

	if(isset($_GET["nroeval"])) 
	{
		$nroeval = $_GET['nroeval'];
		$_SESSION['nroeval'] = $_GET['nroeval'];
	}
	else 
	{	
		$nroeval = "";
		$_SESSION['nroeval'] = "";
	}

	if(isset($_GET["texamen"])) 
	{
		$texamen             = $_GET['texamen'];
		$_SESSION['texamen'] = $_GET['texamen'];
	}
	else 
	{	
		$texamen	 = "";
		$_SESSION['texamen'] = "";
	}

	if(isset($_GET["mes"])) 
	{
		$mes	 = $_GET['mes'];
		$_SESSION['mes'] = $_GET['mes'];
	}
	else 
	{	
		$mes	 = "";
		$_SESSION['mes'] = "";
	}

	if(isset($_GET["anio"])) 
	{
		$anio	 = $_GET['anio'];
		$_SESSION['anio'] = $_GET['anio'];
	}
	else 
	{	
		$anio	 = "";
		$_SESSION['anio'] = "";
	}

	if(isset($_GET["codempresa"])) 
	{
		$codempresa	 = $_GET['codempresa'];
		$_SESSION['codempresa'] = $_GET['codempresa'];
	}
	else 
	{	
		$codempresa	 = "";
		$_SESSION['codempresa'] = "";
	}

	if($nroeval != '')
    {
   		if($w == '')
		{
			$w=" WHERE nroeval = '$nroeval'";  
		}
		else
		{
			$w=$w." and nroeval = '$nroeval'"; 
		}
		
    }

	if($texamen != '')
    {
   		if($w == '')
		{
			$w=" WHERE texamen = '$texamen'";  
		}
		else
		{
			$w=$w." and texamen = '$texamen'"; 
		}  
    }

	if($mes != '')
    {
   		if($w == '')
		{
			$w=" WHERE permes = '$mes'";  
		}
		else
		{
			$w=$w." and permes = '$mes'"; 
		}  
    }

	if($anio != '')
    {
   		if($w == '')
		{
			$w=" WHERE peranio = '$anio'";  
		}
		else
		{
			$w=$w." and peranio = '$anio'"; 
		}  
    }

	if($codempresa != '')
    {
   		if($w == '')
		{
			$w=" WHERE codempresa = '$codempresa'";  
		}
		else
		{
			$w=$w." and codempresa = '$codempresa'"; 
		}  
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
    $sql="WITH RECURSIVE seleccion_empresa(nroeval, codempresa, permes, peranio, texamen) AS (
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '1' 
	FROM evalbioquimica
    UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '2' 
	FROM evaldengue
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '3' 
	FROM evalhematologia
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '4' 
	FROM evalinfluenza
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '5' 
	FROM evalpintestinal
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '6' 
	FROM evalrotavirus
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '7' 
	FROM evalsifilis
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '8' 
	FROM evalmalaria
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '9' 
	FROM evaleducacioncontinua
  )
SELECT nroeval, codempresa, permes, peranio, texamen
FROM seleccion_empresa ".$w; 

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
    $sql1 = "WITH RECURSIVE seleccion_empresa(nroeval, codempresa, permes, peranio, texamen) AS (
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '1' 
	FROM evalbioquimica
    UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '2' 
	FROM evaldengue
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '3' 
	FROM evalhematologia
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '4' 
	FROM evalinfluenza
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '5' 
	FROM evalpintestinal
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '6' 
	FROM evalrotavirus
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '7' 
	FROM evalsifilis
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '8' 
	FROM evalmalaria
	UNION ALL
    SELECT nroeval, 
		   codempresa, 
	       permes, 
	       peranio, 
	       '9' 
	FROM evaleducacioncontinua
  )
SELECT nroeval, codempresa, permes, peranio, texamen
FROM seleccion_empresa ".$w." ORDER BY nroeval";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
	   $respuesta->rows[$i]['id'] = $row['nroeval'].$row['codempresa'];
       
       $codempresa  = $row['codempresa'];
	   $texamen     = $row['texamen'];
	   $permes      = $row['permes'];
	   $peranio     = $row['peranio'];
	   $nroeval     = $row['nroeval'];
        
	   $cadena1="WITH RECURSIVE establecimiento_empresa(codempresa, razonsocial) AS (
					SELECT codservicio, 
						   nomservicio
					FROM establecimientos
					UNION ALL
					SELECT codempresa, 
						   razonsocial
					FROM empresas
				  )
				SELECT codempresa, razonsocial
				FROM establecimiento_empresa
				WHERE codempresa = '$codempresa'
				ORDER BY codempresa";
       $lista1      = pg_query($con, $cadena1);
       $registro1   = pg_fetch_array($lista1);
       $razonsocial = $registro1['razonsocial'];
		
	   switch ($texamen ) {
			case '1':
				$nomexamen = 'BIOQUIMICA CLINICA';
			    break;
			case '2':
				$nomexamen = 'DENGUE';
			    break;
			case '3':
				$nomexamen = 'HEMATOLOGIA';
			    break;
			case '4':
				$nomexamen = 'INFLUENZA';
			    break;
			case '5':
				$nomexamen = 'PARASITOLOGIA INTESTINAL';
			    break;
			case '6':
				$nomexamen = 'ROTAVIRUS';
			    break;
			case '7':
				$nomexamen = 'SIFILIS';
			    break;
			case '8':
				$nomexamen = 'MALARIA';
			    break;
			case '9':
				$nomexamen = 'EDUCACION CONTINUA';
			    break;
		}
		
		switch ($permes) {
			case '1':
				$nommes = 'ENERO';
			    break;
			case '2':
				$nommes = 'FEBRERO';
			    break;
			case '3':
				$nommes = 'MARZO';
			    break;
			case '4':
				$nommes = 'ABRIL';
			    break;
			case '5':
				$nommes = 'MAYO';
			    break;
			case '6':
				$nommes = 'JUNIO';
			    break;
			case '7':
				$nommes = 'JULIO';
			    break;
			case '8':
				$nommes = 'AGOSTO';
			    break;
			case '9':
				$nommes = 'SETIEMBRE';
			    break;
			case '10':
				$nommes = 'OCTUBRE';
			    break;
			case '11':
				$nommes = 'NOVIEMBRE';
			    break;
			case '12':
				$nommes = 'DICIEMBRE';
			    break;
		}
		
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_resultados_previstos.php?nroeval='.$row['nroeval'].'&codempresa='.$row['codempresa'].'&texamen='.$texamen.'&permes='.$permes.'&peranio='.$peranio.'\'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>',$nroeval,$razonsocial,$nomexamen,$nommes,$peranio);
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
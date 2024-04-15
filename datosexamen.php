<?php
// Se crea la conexión a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

    $v_171   = $_SESSION['V_171'];	// Selección para Examinar
	$v_1711  = $_SESSION['V_1711'];	// Envio de Examen

   
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
    $sql="SELECT nroeval, 
		   codsector, 
	       permes, 
	       peranio,
		   tipo
	FROM evaluacion ".$w; 

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
    $sql1 = "SELECT nroeval, 
		   codsector, 
	       permes, 
	       peranio,
		   tipo
	FROM evaluacion ".$w." ORDER BY nroeval";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
	   $respuesta->rows[$i]['id'] = $row['nroeval'];
       
       $codsector   = $row['codsector'];
	   $permes      = $row['permes'];
	   $peranio     = $row['peranio'];
	   $nroeval     = $row['nroeval'];
	   $tipoex      = $row['tipo'];
        
	   $cadena1="SELECT *
				FROM sectores
				WHERE codsector = '$codsector'
				ORDER BY codsector";
       $lista1      = pg_query($con, $cadena1);
       $registro1   = pg_fetch_array($lista1);
       $razonsocial = $registro1['nomsector'];
		
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
		
		switch ($tipoex) {
			case '1':
				$tipo = 'Evaluacion Continua';
			    break;
			case '2':
				$tipo = 'Control de Calidad';
			    break;
			case '3':
				$tipo = 'Evaluacion Leishmania';
			    break;
			case '4':
				$tipo = 'Evaluacion Parasito  intestinal';
			    break;
			
		}
		
		if($v_171==3)
	   {
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_examen.php?nroeval='.$row['nroeval'].'\'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon4"><a href="#" onclick="confirmacion('."'".$row['nroeval']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon4"><a href="#" onclick="elegir('."'".$row['nroeval']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-users" style="color: orange;font-size: 30px;">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon7"><a href="#" onclick=" abrirEmail('."'".$row['nroeval']."'".')"><div id="FontAwesomeIcon7"><i class="fa fa-envelope">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon7"><a href="#" onclick=" imprimir('."'".$row['nroeval']."', '".$row['tipo']."'".')"><div id="FontAwesomeIcon7"><i class="fa fa-print">&nbsp;</i></div></a></div>',$nroeval,$tipo,$razonsocial,$nommes,$peranio); 	   	
	   }	
       else
	   {
	   	if($v_171==2)
	   	   {
	   	   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div>';
	   	   }
	   	else
		   {
		   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-info-circle">&nbsp;</i></div>';
		   }    
	   	$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_examen.php?nroeval='.$row['nroeval'].'\'";>'.$palabra.'</a></div>','S/Permiso', 'S/Permiso','S/Permiso','S/Permiso',$nroeval,$tipo,$razonsocial,$nommes,$peranio);
	   } 
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
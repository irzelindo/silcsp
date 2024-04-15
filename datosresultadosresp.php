<?php
// Se crea la conexión a la base de datos

    $v_191   = $_SESSION['V_191'];	// Realizar Control

   
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

	if(isset($_GET["usuario"])) 
	{
		$usuario	 = $_GET['usuario'];
		$_SESSION['usuario1'] = $_GET['usuario'];
	}
	else 
	{	
		$usuario	 = "";
		$_SESSION['usuario1'] = "";
	}

	if($nroeval != '')
    {
   		$w=$w." and e.nroeval = '$nroeval'"; 
		
    }

	if($mes != '')
    {
   		$w=$w." and e.permes = '$mes'";  
    }

	if($anio != '')
    {
   		$w=$w." and e.peranio = '$anio'";  
    }

	if($usuario != '')
    {
   		$w .= " and  ep.codusu = '$usuario'";   
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
    $sql="select distinct e.nroeval,
						   e.peranio,
						   e.permes,
						   ep.codusu,
						   ep.estado,
						   e.codsector,
						   e.subprograma
					from evaluacion e, evaluaciondetestu ed, evalucionparticipante ep
					where e.nroeval  = ed.nroeval 
					and   ep.nroeval = ed.nroeval
					".$w; 

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
    $sql1 = "select distinct e.nroeval,
						   e.peranio,
						   e.permes,
						   ep.codusu,
						   ep.estado,
						   e.codsector,
						   e.subprograma
					from evaluacion e, evaluaciondetestu ed, evalucionparticipante ep
					where e.nroeval  = ed.nroeval 
					and   ep.nroeval = ed.nroeval
					".$w." ORDER BY e.nroeval desc";
	
	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();
    
    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;

	while ($row = pg_fetch_array($res1))
	{
	   $respuesta->rows[$i]['id'] = $row['nroeval'].$row['item'];
       
	   $permes   	= $row['permes'];
	   $peranio  	= $row['peranio'];
	   $nroeval  	= $row['nroeval'];
	   $codusu      = $row['codusu'];
	   $estado      = $row['estado'];
	   $codsector	= $row['codsector'];
	   $subprograma	= $row['subprograma'];
		
		$lista2    = pg_query($con, "select * from sectores where codsector = '$codsector'");
        $registro2 = pg_fetch_array($lista2);
        $nomsector = $registro2['nomsector'];
		
		$sql2     = "select * 
		from evalucionparticipante 
		where nroeval = '$nroeval' 
		and   estado = '2'
		and   codusu='$codusu'";
		
	    $res2     = pg_query($con,$sql2);
	    $cantidad = pg_num_rows($res2);
		
		$sql3="select distinct e.nroeval,
						   e.peranio,
						   e.permes,
						   ep.codusu
					from evaluacion e, evaluaciondetestu ed, evalucionparticipante ep
					where e.nroeval  = ed.nroeval 
					and   ep.nroeval = ed.nroeval   
					and   e.nroeval  = '$nroeval' 
					and   CAST(now() AS date) >= e.fechainicio  
					and   CAST(now() AS date) <= e.fecharcierre"; 

		$res3=pg_query($con,$sql3);
		$count3=pg_num_rows($res3);
		
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
		
		$codusu1      = "'".$codusu."'";
		
		if($cantidad != 0 || $count3 == 0)
        {
            $impresul = '<div id="wb_FontAwesomeIcon7"><a href="#" class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square" style="color: silver;">&nbsp;</i></div></a></div>';
        }
        else
        {
            $impresul = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick=" abrirVentana('.$row['nroeval'].', '.$codusu1.')"><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';
        }
		
		if($estado == '2' || $estado == '3')
        {
            $imppdf = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick=" abrirVentana1('.$row['nroeval'].', '.$codusu1.')"><div id="FontAwesomeIcon7"><i class="fa fa-file-pdf-o" style="font-size: 30px;">&nbsp;</i></div></a></div>';
        }
        else
        {
			$imppdf = '<div id="wb_FontAwesomeIcon7"><a href="#" class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-file-pdf-o" style="color: silver;">&nbsp;</i></div></a></div>';
        }
		
		$descarga = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick=" openWin('.$row['nroeval'].')"><div id="FontAwesomeIcon7"><i class="fa fa-download" style="font-size: 30px;">&nbsp;</i></div></a></div>';
		
		$respuesta->rows[$i]['cell'] = array($impresul,$imppdf,$descarga,$nroeval,$nomsector,$subprograma,$nommes,$peranio,$codusu);
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
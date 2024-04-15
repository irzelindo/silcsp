<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

   $v_14  = $_SESSION['V_14'];

   
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

	if($codservicio != '')
    {
   		$w=$w." and t.codservicio= '$codservicio'";  
    }

	if($desde != '')
    {
   		$w=$w." and t.fecharec >= '$desde'";  
    }

	if($hasta != '')
    {
   		$w=$w." and t.fecharec <= '$hasta'";  
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
    $sql="select 	n.nronotif,
	t.nordentra,
	t.codservicio,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	t.fecharec,
	t.horarec,
	n.codenferm
from paciente p, ordtrabajo t, nobligatorias n
where p.nropaciente = t.nropaciente
and   t.nordentra   = n.nordentra ".$w; 

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
    $sql1 = "select 	n.nronotif,
	t.nordentra,
	t.codservicio,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	t.fecharec,
	t.horarec,
	n.codenferm
from paciente p, ordtrabajo t, nobligatorias n
where p.nropaciente = t.nropaciente
and   t.nordentra   = n.nordentra ".$w." order by n.nronotif";
	
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
		
	   $fecharec  = date("d/m/Y", strtotime($row[fecharec]));
	   $codenferm = $row['codenferm'];
		
	   $query2 = "select * from enfermedades where codenferm = '$codenferm'";
       $result2 = pg_query($con,$query2);

       $row2 = pg_fetch_assoc($result2);

       $nomenferm 	= $row2["nomenferm"];
		
		if($v_14==3)
	   {
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_notificacion.php?nronotif='.$row['nronotif'].'\'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon4"><a href="#" onclick="confirmacion('."'".$row['nordentra']."', '".$row['codservicio']."', '".$row['nronotif']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div>',$row['nronotif'],$row['nordentra'],$row['nomyape'],$fecharec,$row['horarec'], $nomenferm ); 	   	
	   }	
       else
	   {
	   	if($v_14==2)
	   	   {
	   	   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div>';
	   	   }
	   	else
		   {
		   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-info-circle">&nbsp;</i></div>';
		   }    
	   	$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_notificacion.php?nronotif='.$row['nronotif'].'\'";>'.$palabra.'</a></div>','S/Permiso',$row['nronotif'],$row['nordentra'],$row['nomyape'],$fecharec,$row['horarec'], $nomenferm );
	   } 
	
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
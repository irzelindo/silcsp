<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

   $v_13  = $_SESSION['V_13'];
   $v_131 = $_SESSION['V_131'];
   $v_132 = $_SESSION['V_132'];
   $v_133 = $_SESSION['V_133'];
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

	if(isset($_GET["codorigen"]) && $_GET["codorigen"] != '')
	{
		$codorigen     = $_GET['codorigen'];
		$_SESSION['codorigen'] = $_GET['codorigen'];
	}
	else
	{
		$codorigen	 = "";
		$_SESSION['codorigen'] = "";
	}

	if(isset($_GET["codempresa"]) && $_GET["codempresa"] != '')
	{
		$codempresa	 = $_GET['codempresa'];
		$_SESSION['codempresa'] = $_GET['codempresa'];
	}
	else
	{
		$codempresa	 = "";
		$_SESSION['codempresa'] = "";
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

	if($desde == "")
	{
		$desde = date("Y-m-d", time());
	}

	if($hasta == "")
	{
		$hasta = date("Y-m-d", time());
	}

	if($codservicio != '')
    {
   		$w=$w." and  e.codservact = '$codservicio'";
    }

	if($codorigen != '')
    {
   		$w=$w." and t.codorigen= '$codorigen'";
    }

	if($codempresa != '')
    {
   		$w=$w." and t.codservder= '$codempresa'";
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
    $sql="select distinct p.nropaciente,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	p.dccionr,
	p.telefono,
	t.nordentra,
	e.codservact as codservicio,
	t.codorigen,
	t.fecharec,
	t.horarec
from paciente p, ordtrabajo t LEFT JOIN estrealizar e  ON t.nordentra = e.nordentra
where p.nropaciente = t.nropaciente ".$w;

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
    $sql1 = "select distinct p.nropaciente,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	p.dccionr,
	p.telefono,
	t.nordentra,
	e.codservact as codservicio,
	t.codorigen,
	t.fecharec,
	t.horarec
from paciente p, ordtrabajo t LEFT JOIN estrealizar e  ON t.nordentra = e.nordentra
where p.nropaciente = t.nropaciente ".$w." order by t.nordentra";

	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();

    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
	   $respuesta->rows[$i]['id'] = $row['nordentra'].$row['codservicio'];

       $codorigen   = $row['codorigen'];
	   $codservicio = $row['codservicio'];

	   $cadena1="select * from origenpaciente where codorigen='$codorigen'";
       $lista1 = pg_query($con, $cadena1);
       $registro1 = pg_fetch_array($lista1);
       $nomorigen=$registro1['nomorigen'];

	   $cadena2="select * from establecimientos where codservicio='$codservicio'";
       $lista2 = pg_query($con, $cadena2);
       $registro2 = pg_fetch_array($lista2);
       $nomservicio=$registro2['nomservicio'];

	   $fecharec = date("d/m/Y", strtotime($row[fecharec]));

		if($v_13==3)
	   {
		$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_ordenes.php?nordentra='.$row['nordentra'].'&codservicio='.$row['codservicio'].'\'";><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>','<div id="wb_FontAwesomeIcon4"><a href="#" onclick="confirmacion('."'".$row['nordentra']."', '".$row['codservicio']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div>',$row['nordentra'],$fecharec,$row['horarec'],$row['nomyape'],$nomservicio,$nomorigen);
	   }
       else
	   {
	   	if($v_13==2)
	   	   {
	   	   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div>';
	   	   }
	   	else
		   {
		   	$palabra='<div id="FontAwesomeIcon7"><i class="fa fa-info-circle">&nbsp;</i></div>';
		   }
	   	$respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon7"><a href="#" onclick="window.location.href=\'modifica_ordenes.php?nordentra='.$row['nordentra'].'&codservicio='.$row['codservicio'].'\'";>'.$palabra.'</a></div>','S/Permiso',$row['nordentra'],$fecharec,$row['horarec'],$row['nomyape'],$nomservicio,$nomorigen);
	   }

	$i++;
	}

	//Asignamos todo esto en variables de json, para enviarlo al navegador.

    echo json_encode($respuesta);
?>

<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];
   $codservicio = $_SESSION["codservicio"];

   $v_211 = $_SESSION['V_211'];

    include("conexion.php");
	$con=Conectarse();

	$page = $_REQUEST['page'];
	$limit = $_REQUEST['rows'];
	$sidx = $_REQUEST['sidx'];
	$sord = $_REQUEST['sord'];

  if(isset($_POST["codsector"]))
  {
  	$codsector = $_POST['codsector'];
  }
  else
  {
      if(isset($_GET["codsector"]))
      {
        $codsector = $_GET['codsector'];
      }
      else
      {
        $codsector = "";
      }
  }

  if(isset($_POST["codestudio"]))
  {
  	 $codestudio = $_POST['codestudio'];
  }
  else
  {
      if(isset($_GET["codestudio"]))
      {
        $codestudio = $_GET['codestudio'];
      }
      else
      {
        $codestudio = "";
      }
  }

	if(isset($_GET["desde"]) && $_GET["desde"] != 'null')
	{
		$desde	 = $_GET['desde'];
	}
	else
	{
		$desde	 = "";
	}

	if(isset($_GET["hasta"]) && $_GET["hasta"] != 'null')
	{
		$hasta	 = $_GET['hasta'];
	}
	else
	{
		$hasta	 = "";
	}

  	if($codsector != '')
	{
		$w=$w." and  es.codsector = '$codsector'";

	}

	if($codestudio != '')
	{
		$w=$w." and  es.codestudio = '$codestudio'";

	}

	if($desde != '')
    {
   		$w=$w." and t.fecharec >= '$desde'";
    }

	if($hasta != '')
    {
   		$w=$w." and t.fecharec <= '$hasta'";
    }

	if($codservicio != '')
	{
		$w=$w." and  t.codservicio = '$codservicio'";

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
			t.codservicio,
			t.codorigen,
			e.nromuestra,
			e.codtmuestra,
			e.codservact,
			e.nroestudio,
			es.nomestudio,
      es.codestudio
		from paciente p, ordtrabajo t, estudios es, estrealizar e
		FULL OUTER JOIN ordenagrupado d ON d.nordentra = e.nordentra
		where p.nropaciente = t.nropaciente
		and   e.nordentra   = t.nordentra
		and   e.codestudio  = es.codestudio
		and   e.estadoestu  = '1' ".$w;

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
			t.codservicio,
			t.codorigen,
			e.nromuestra,
			e.codtmuestra,
			e.codservact,
			e.nroestudio,
			es.nomestudio
		from paciente p, ordtrabajo t, estudios es, estrealizar e
		FULL OUTER JOIN ordenagrupado d ON d.nordentra = e.nordentra
		where p.nropaciente = t.nropaciente
		and   e.nordentra   = t.nordentra
		and   e.codestudio  = es.codestudio
		and   e.estadoestu  = '1' ".$w." order by t.nordentra desc";

	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();

    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
	    $respuesta->rows[$i]['id'] = $row['nordentra'].$row['nroestudio'];

        $codorigen   = $row['codorigen'];
	      $codtmuestra = $row['codtmuestra'];
		    $codservicio = $row['codservicio'];
		    $nomestudio  = $row['nomestudio'];
		    $nropaciente = $row['nropaciente'];
		    $codservact  = $row['codservact'];

	      $cadena1="select * from origenpaciente where codorigen='$codorigen'";
        $lista1 = pg_query($con, $cadena1);
        $registro1 = pg_fetch_array($lista1);
        $nomorigen=$registro1['nomorigen'];

		    $cadena2="select * from tipomuestra where codtmuestra='$codtmuestra'";
        $lista2 = pg_query($con, $cadena2);
        $registro2 = pg_fetch_array($lista2);
        $nomtmuestra=$registro2['nomtmuestra'];

		    $muestra = str_pad($row['nromuestra'], 8, '0', STR_PAD_LEFT);

		    $nromuestra = $codservicio.$muestra;

		    $nromuestra1 = $row['nromuestra'];

		    $cadena3="select * from establecimientos where codservicio='$codservact'";
        $lista3 = pg_query($con, $cadena3);
        $registro3 = pg_fetch_array($lista3);
        $nomservicio=$registro3['nomservicio'];

		    $respuesta->rows[$i]['cell'] = array('<div id="wb_FontAwesomeIcon4"><a href="#" style="text-decoration:none"><div id="FontAwesomeIcon4"><i class="fa fa-times-circle">&nbsp;</i></div></a></div>', $row['nordentra'],$row['nomestudio'],$row['nomyape'],$nomtmuestra,$nomservicio,$nropaciente, $codservicio, $nromuestra1,$row['codestudio']);

		    $i++;
	}

	//Asignamos todo esto en variables de json, para enviarlo al navegador.

    echo json_encode($respuesta);
?>

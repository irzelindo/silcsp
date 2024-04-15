<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

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
		$nordentra	 = "";
	}

	if(isset($_GET["codservicio"]))
	{
		$codservicio	 = $_GET['codservicio'];
	}
	else
	{
		$codservicio	 = "";
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
    $sql="select distinct t.nordentra,
                     t.codservicio,
                     t.codorigen,
                     t.fecharec,
                     t.horarec,
                     p.nropaciente,
                     p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
                     p.dccionr,
                     p.telefono,
                     e.microbiologia,
                     re.nroestudio,
                     re.codestudio,
                     e.nomestudio,
                     re.coddetermina,
                     d.nomdetermina,
                     re.resultado,
                     re.codumedida,
                     re.codestado,
                     r.nromuestra,
                     r.fecha
                   from paciente p, ordtrabajo t, estudios e, estrealizar r, resultados re, determinaciones d
                   where p.nropaciente = t.nropaciente
                   and   e.codestudio  = r.codestudio
                   and   t.nordentra   = r.nordentra
                   and   t.codservicio = r.codservicio
                   and   re.nroestudio = r.nroestudio
                   and   re.nordentra  = r.nordentra
                   and   re.codservicio= r.codservicio
                   and   re.codestudio  = d.codestudio
                   and   re.coddetermina  = d.coddetermina
                   and   t.codservicio= '$codservicio'
                   and   t.nordentra   = '$nordentra'
                   union all
               select distinct t.nordentra,
                     t.codservicio,
                     t.codorigen,
                     t.fecharec,
                     t.horarec,
                     p.nropaciente,
                     p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
                     p.dccionr,
                     p.telefono,
                     e.microbiologia,
                     re.nroestudio,
                     re.codestudio,
                     e.nomestudio,
                     re.coddetermina,
                     d.nomdetermina,
                     re.resultado,
                     re.codumedida,
                     re.codestado,
                     r.nromuestra,
                     r.fecha
                   from paciente p, ordtrabajo t, estudios e, estrealizar r, resultadosmicro re, determinaciones d
                   where p.nropaciente = t.nropaciente
                   and   e.codestudio  = r.codestudio
                   and   t.nordentra   = r.nordentra
                   and   t.codservicio = r.codservicio
                   and   re.nroestudio = r.nroestudio
                   and   re.nordentra  = r.nordentra
                   and   re.codservicio= r.codservicio
                   and   re.codestudio  = d.codestudio
                   and   re.coddetermina  = d.coddetermina
                   and   t.codservicio  = '$codservicio'
                   and   t.nordentra    = '$nordentra'
                   order by nordentra";

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
    $sql1 = "select distinct t.nordentra,
                     t.codservicio,
                     t.codorigen,
                     t.fecharec,
                     t.horarec,
                     p.nropaciente,
                     p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
                     p.dccionr,
                     p.telefono,
                     e.microbiologia,
                     re.nroestudio,
                     re.codestudio,
                     e.nomestudio,
                     re.coddetermina,
                     d.nomdetermina,
                     re.resultado,
                     re.codumedida,
                     re.codestado,
                     r.nromuestra,
                     re.codresultado,
                     re.idmuestra,
                     e.microbiologia,
                     re.codequipo,
                     re.obs,
                     re.codmetodo,
                     r.fecha
                   from paciente p, ordtrabajo t, estudios e, estrealizar r, resultados re, determinaciones d
                   where p.nropaciente = t.nropaciente
                   and   e.codestudio  = r.codestudio
                   and   t.nordentra   = r.nordentra
                   and   t.codservicio = r.codservicio
                   and   re.nroestudio = r.nroestudio
                   and   re.nordentra  = r.nordentra
                   and   re.codservicio= r.codservicio
                   and   re.codestudio  = d.codestudio
                   and   re.coddetermina  = d.coddetermina
                   and   t.codservicio= '$codservicio'
                   and   t.nordentra   = '$nordentra'
                   union all
               select distinct t.nordentra,
                     t.codservicio,
                     t.codorigen,
                     t.fecharec,
                     t.horarec,
                     p.nropaciente,
                     p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
                     p.dccionr,
                     p.telefono,
                     e.microbiologia,
                     re.nroestudio,
                     re.codestudio,
                     e.nomestudio,
                     re.coddetermina,
                     d.nomdetermina,
                     re.resultado,
                     re.codumedida,
                     re.codestado,
                     r.nromuestra,
                     re.codresultado,
                     re.idmuestra,
                     e.microbiologia,
                     re.codequipo,
                     re.obs,
                     re.codmetodo,
                     r.fecha
                   from paciente p, ordtrabajo t, estudios e, estrealizar r, resultadosmicro re, determinaciones d
                   where p.nropaciente = t.nropaciente
                   and   e.codestudio  = r.codestudio
                   and   t.nordentra   = r.nordentra
                   and   t.codservicio = r.codservicio
                   and   re.nroestudio = r.nroestudio
                   and   re.nordentra  = r.nordentra
                   and   re.codservicio= r.codservicio
                   and   re.codestudio  = d.codestudio
                   and   re.coddetermina  = d.coddetermina
                   and   t.codservicio  = '$codservicio'
                   and   t.nordentra    = '$nordentra'
                   order by nordentra";

	  $res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();

    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
	     $respuesta->rows[$i]['id'] = $row['nordentra'].$row['codestudio'].$row['coddetermina'].$row['nropaciente'];

       $codresultado  = $row['codresultado'];
       $codestudio    = $row['codestudio'];
       $coddetermina  = $row['coddetermina'];
       $codequipo     = $row['codequipo'];
       $codmetodo     = $row['codmetodo'];
       $codumedida    = $row['codumedida'];
       $codestado     = $row['codestado'];

       $fecha  	   = date("d/m/Y", strtotime($row[fecha]));

   		if ($codresultado != '')
   		{
   			$tabreg = pg_query($con, "select rc.codresultado,
      												 rc.nomresultado
      										from resultadoposible rp, resultadocodificado rc
      										where rp.codresultado = rc.codresultado
      										and rp.codestudio = '$codestudio'
      										and rp.coddetermina = '$coddetermina'
                          and rc.codresultado = '$codresultado'");
   			$rowreg = pg_fetch_array($tabreg);
   			$nomresultado = $rowreg['nomresultado'];
   		}
   		else
   		{
   			$nomresultado = '';
   		}

      if ($codequipo != '')
   		{
   			$tabr = pg_query($con, "select codequipo, descripcion from equipos where codequipo = trim('$codequipo')");
   			$rowr = pg_fetch_array($tabr);
   			$descripcion = $rowr['descripcion'];
   		}
   		else
   		{
   			$descripcion = '';
   		}

      if ($codmetodo != '')
   		{
   			$tabr = pg_query($con, "select codmetodo, nommetodo from metodos where codmetodo = trim('$codmetodo')");
   			$rowr = pg_fetch_array($tabr);
   			$nommetodo = $rowr['nommetodo'];
   		}
   		else
   		{
   			$nommetodo = '';
   		}

      if ($codumedida != '')
   		{
   			$tabr = pg_query($con, "select codumedida, nomumedida from unidadmedida where codumedida = trim('$codumedida')");
   			$rowr = pg_fetch_array($tabr);
   			$nomumedida = $rowr['nomumedida'];
   		}
   		else
   		{
   			$nomumedida = '';
   		}

      if ($codestado != '')
   		{
   			$tabr = pg_query($con, "select codestado, nomestado from estadoresultado where codestado = trim('$codestado')");
   			$rowr = pg_fetch_array($tabr);
   			$nomestado = $rowr['nomestado'];
   		}
   		else
   		{
   			$nomestado = '';
   		}

		  $respuesta->rows[$i]['cell'] = array($row['nordentra'],$row['nomestudio'],$row['nomdetermina'], $nomresultado, $row['resultado'], $row['obs'], $nomestado, $fecha, $row['codestudio'], $row['coddetermina'], $row['codservicio'], $row['nroestudio'], $row['idmuestra'], $row['microbiologia'], $codresultado);

		  $i++;
	}

	//Asignamos todo esto en variables de json, para enviarlo al navegador.

    echo json_encode($respuesta);
?>
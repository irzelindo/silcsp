<?php
// Se crea la conexi�n a la base de datos
   session_start();
   $codusu=$_SESSION['codusu'];

   $v_161  = $_SESSION['V_161']; //Carga, Validaci�n Revalidaci�n
   $v_163  = $_SESSION['V_163 ']; //Carga, Validación Microbiología

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

	if(isset($_GET["codestudio"]) && $_GET["codestudio"] != '')
	{
		$codestudio	 = $_GET['codestudio'];
		$_SESSION['codestudio'] = $_GET['codestudio'];
	}
	else
	{
		$codestudio	 = "";
		$_SESSION['codestudio'] = "";
	}

	if(isset($_GET["codsector"]) && $_GET["codsector"] != '')
	{
		$codsector	 = $_GET['codsector'];
		$_SESSION['codsector'] = $_GET['codsector'];
	}
	else
	{
		$codsector	 = "";
		$_SESSION['codsector'] = "";
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

	if(isset($_GET["desder"]) && $_GET["desder"] != 'null')
	{
		$desder	 = $_GET['desder'];
		$_SESSION['desder'] = $_GET['desder'];
	}
	else
	{
		$desder	 = "";
		$_SESSION['desder'] = "";
	}

	if(isset($_GET["hastar"]) && $_GET["hastar"] != 'null')
	{
		$hastar	 = $_GET['hastar'];
		$_SESSION['hastar'] = $_GET['hastar'];
	}
	else
	{
		$hastar	 = "";
		$_SESSION['hastar'] = "";
	}

	if(isset($_GET["hora"]))
	{
		$hora	 = $_GET['hora'];
		$_SESSION['hora'] = $_GET['hora'];
	}
	else
	{
		$hora	 = "";
		$_SESSION['hora'] = "";
	}

	if(isset($_GET["horaf"]))
	{
		$horaf	 = $_GET['horaf'];
		$_SESSION['horaf'] = $_GET['horaf'];
	}
	else
	{
		$horaf	 = "";
		$_SESSION['horaf'] = "";
	}

	if(isset($_GET["urgente"]))
	{
		$urgente	 = substr($_GET['urgente'],0,1);
		$_SESSION['urgente'] = $_GET['urgente'];
	}
	else
	{
		$urgente	 = "";
	}

	if($codservicio != '')
    {
   		$w=$w." and t.codservicio= '$codservicio'";
    }

	if($codorigen != '')
    {
   		$w=$w." and t.codorigen= '$codorigen'";
    }

	if($codempresa != '')
    {
   		$w=$w." and t.codservder= '$codempresa'";
    }

	if($codestudio != '')
    {
   		$w=$w." and e.codestudio = '$codestudio'";
    }

	if($codsector != '')
    {
   		$w=$w." and e.codsector = '$codsector'";
    }

	if($hora != '')
    {
   		$w=$w." and t.horasal >= '$hora'";
    }

	if($horaf != '')
    {
   		$w=$w." and t.horasal <= '$horaf'";
    }

	if($urgente != '')
    {
   		$w=$w." and t.urgente = '$urgente'";
    }

	if($desde != '')
    {
   		$w=$w." and t.fecharec >= '$desde'";
    }

	if($hasta != '')
    {
   		$w=$w." and t.fecharec <= '$hasta'";
    }

	if($desder != '')
    {
   		$w1=$w1." and r.fecha >= '$desder'";
    }

	if($hastar != '')
    {
   		$w1=$w1." and r.fecha <= '$hastar'";
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
	e.microbiologia
from paciente p, ordtrabajo t, estudios e, estrealizar r
where p.nropaciente = t.nropaciente
and   e.codestudio  = r.codestudio
and   t.nordentra   = r.nordentra
and   t.codservicio = r.codservicio
and   exists(select * from resultados rs
			 where rs.nordentra   = t.nordentra
			 and   rs.codservicio = t.codservicio ".$w1.")".$w."
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
	e.microbiologia
from paciente p, ordtrabajo t, estudios e, estrealizar r
where p.nropaciente = t.nropaciente
and   e.codestudio  = r.codestudio
and   t.nordentra   = r.nordentra
and   t.codservicio = r.codservicio
and   exists(select * from resultadosmicro rs
			 where rs.nordentra   = t.nordentra
			 and   rs.codservicio = t.codservicio ".$w1.")".$w;

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
	e.microbiologia
from paciente p, ordtrabajo t, estudios e, estrealizar r
where p.nropaciente = t.nropaciente
and   e.codestudio  = r.codestudio
and   t.nordentra   = r.nordentra
and   t.codservicio = r.codservicio
and   exists(select * from resultados rs
			 where rs.nordentra   = t.nordentra
			 and   rs.codservicio = t.codservicio ".$w1.")".$w."
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
	e.microbiologia
from paciente p, ordtrabajo t, estudios e, estrealizar r
where p.nropaciente = t.nropaciente
and   e.codestudio  = r.codestudio
and   t.nordentra   = r.nordentra
and   t.codservicio = r.codservicio
and   exists(select * from resultadosmicro rs
			 where rs.nordentra   = t.nordentra
			 and   rs.codservicio = t.codservicio ".$w1.")".$w." order by nordentra";

	$res1=pg_query($con,$sql1);

    // Se agregan los datos de la respuesta del servidor
    $respuesta = new stdClass();

    $respuesta->page = $page;
    $respuesta->total = $total_pages;
    $respuesta->records = $count;
    $i=0;
	while ($row = pg_fetch_array($res1))
	{
	   $respuesta->rows[$i]['id'] = $row['nordentra'].$row['codservicio'].$row['nroestudio'];

       $codorigen     = $row['codorigen'];
	   $codservicio   = $row['codservicio'];
	   $microbiologia = $row['microbiologia'];
       $nordentra     = $row['nordentra'];

	   $cadena1="select * from origenpaciente where codorigen='$codorigen'";
       $lista1 = pg_query($con, $cadena1);
       $registro1 = pg_fetch_array($lista1);
       $nomorigen=$registro1['nomorigen'];

	   $cadena2="select * from establecimientos where codservicio='$codservicio'";
       $lista2 = pg_query($con, $cadena2);
       $registro2 = pg_fetch_array($lista2);
       $nomservicio=$registro2['nomservicio'];

       $link = "taerResultado('".$row['nordentra']."','".$row['codservicio']."')";

     if($microbiologia == 2)
     {
            $sqlresul    = "select * from resultados where nordentra = '$nordentra' and fechares is not null and fechaval is null";
          	$resresul    = pg_query($con, $sqlresul);
          	$countresul  = pg_num_rows($resresul);

		    $sqlresul1    = "select * from resultados where nordentra = '$nordentra' and   (codresultado !='' or   resultado !='' )";
          	$resresul1    = pg_query($con, $sqlresul1);
          	$countresul1  = pg_num_rows($resresul1);

			$sqlresul2    = "select * from resultados where nordentra = '$nordentra' and fechares is not null and fechaval is not null";
          	$resresul2    = pg_query($con, $sqlresul2);
          	$countresul2  = pg_num_rows($resresul2);

		        if($countresul2 == 0)
            {
                $impresul = '<div id="wb_FontAwesomeIcon7"><a href="impresion_resultados.php?nordentra='.$row['nordentra'].'&codservicio='.$row['codservicio'].'" target="_blank" class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-print" style="color: silver;">&nbsp;</i></div></a></div>';
            }
            else
            {
                $impresul = '<div id="wb_FontAwesomeIcon7"><a href="impresion_resultados.php?nordentra='.$row['nordentra'].'&codservicio='.$row['codservicio'].'" target="_blank" ><div id="FontAwesomeIcon7"><i class="fa fa-print">&nbsp;</i></div></a></div>';
            }

            if($v_161 == 2 || $v_161 == 3)
            {
                	$edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';

                /*if($countresul1 == 0)
        				{
        					$edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';

        					$anular = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick="anular('."'".$row['nordentra']."'".');" style="text-decoration:none" class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-times-circle" style="color: silver;">&nbsp;</i></div></a></div>';
        				}
        				else
        				{
        					if($countresul != 0)
        					{
        						$edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';

        						$anular = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick="anular('."'".$row['nordentra']."'".');" style="text-decoration:none" class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-times-circle" style="color: silver;">&nbsp;</i></div></a></div>';
        					}
        					else
        					{
        						$edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.' class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square" style="color: silver;">&nbsp;</i></div></a></div>';

        						$anular = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick="anular('."'".$row['nordentra']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon7"><i class="fa fa-times-circle" style="color: red;">&nbsp;</i></div></a></div>';
        					}
        				}*/
            }
            else
            {
                  $edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';

                  /*if($countresul1 == 0)
                  {
                      $edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';
                  }
                  else
                  {
                      if($countresul != 0)
          					  {
          						  $edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';
          					  }
          					  else
          					  {
          						  $edit = 'Cargado';
          					  }
                  } */
            }
     }
     else
     {
		    $sqlresulm    = "select * from resultadosmicro where nordentra = '$nordentra' and fechares is not null";
          	$resresulm    = pg_query($con, $sqlresulm);
          	$countresulm  = pg_num_rows($resresulm);

		 	      if($countresulm == 0)
            {
                $impresul = '<div id="wb_FontAwesomeIcon7"><a href="impresion_resultados.php?nordentra='.$row['nordentra'].'&codservicio='.$row['codservicio'].'" target="_blank" class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-print" style="color: silver;">&nbsp;</i></div></a></div>';
            }
            else
            {
                $impresul = '<div id="wb_FontAwesomeIcon7"><a href="impresion_resultados.php?nordentra='.$row['nordentra'].'&codservicio='.$row['codservicio'].'" target="_blank" ><div id="FontAwesomeIcon7"><i class="fa fa-print">&nbsp;</i></div></a></div>';
            }



            if($v_163 == 2 || $v_163 == 3)
            {
                  $edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';
          				/*if($countresulm == 0)
          				{
          					$edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';

          					$anular = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick="anular('."'".$row['nordentra']."'".');" style="text-decoration:none" class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-times-circle" style="color: silver;">&nbsp;</i></div></a></div>';
          				}
          				else
          				{
          					$edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.' class="not-active"><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square" style="color: silver;">&nbsp;</i></div></a></div>';

          					$anular = '<div id="wb_FontAwesomeIcon7"><a href="#" onclick="anular('."'".$row['nordentra']."'".');" style="text-decoration:none"><div id="FontAwesomeIcon7"><i class="fa fa-times-circle" style="color: red;">&nbsp;</i></div></a></div>';
          				}*/
            }
            else
            {
                    $edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';
                  /*if($countresulm == 0)
                  {
                      $edit = '<div id="wb_FontAwesomeIcon7"><a href="#" data-toggle="modal" data-target="#myModal" onclick='.$link.'><div id="FontAwesomeIcon7"><i class="fa fa-pencil-square">&nbsp;</i></div></a></div>';
                  }
                  else
                  {
                      $edit = 'Cargado';
                  }*/
            }
     }



		/*$respuesta->rows[$i]['cell'] = array($edit,$impresul,$anular,$nordentra ,$nomservicio,$nomorigen,$row['nomyape'],$row['dccionr'],$row['telefono']);*/

		$respuesta->rows[$i]['cell'] = array($edit,$impresul,$nordentra ,$nomservicio,$nomorigen,$row['nomyape'],$row['dccionr'],$row['telefono']);

		$i++;
	}

	//Asignamos todo esto en variables de json, para enviarlo al navegador.

    echo json_encode($respuesta);
?>

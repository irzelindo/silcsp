<?php
  include("conexion.php");
	$con=Conectarse();

  $codservicio = $_GET[ 'codservicio' ];
  $desde       = $_GET[ 'desde' ];
  $hasta       = $_GET[ 'hasta' ];

  $w = "";

  if($codservicio != '')
	{
		$w=$w." and t.laboratorio = '$codservicio'";
	}

  if($desde != '')
	{
		$w  = $w." and t.fecharec >= '$desde'";
	    $w1 = " t.fecharec >= '$desde'";
	}

	if($hasta != '')
	{
		$w=$w." and t.fecharec <= '$hasta'";
		$w1=$w1." and t.fecharec <= '$hasta'";
	}

  if ($_GET['tipo']==1)
  {
      $sql1 = "select a.codservicior,
                  	  a.cantidad,
                  	  a.rk
              from (
                  select (select es.nomservicio from establecimientos es where es.codservicio = e.codservact) as codservicior,
                          count(distinct e.nordentra)  as cantidad,
                  	    ROW_NUMBER () OVER (
                             ORDER BY count(distinct e.nordentra) desc
                          ) as rk
                  from ordtrabajo t, estrealizar e
                  where t.nordentra = e.nordentra
                  and   to_char(t.fecharec, 'ddmmyyyy')  = to_char(now(), 'ddmmyyyy')
                  group by (select es.nomservicio from establecimientos es where es.codservicio = e.codservact)
                  order by 2 desc
              ) a
              where a.rk < 10";

      $result = pg_query($con,$sql1);


      $jsondata = array();

      $i = 0;


      while ($row = pg_fetch_array($result))
    	{
            $jsondata[$i] = array(
              'codservicior' => $row['codservicior'],
              'cantidad' => $row['cantidad']
              );

            $i++;
      }
  }

  if ($_GET['tipo']==2)
  {
      $sql1 = "select  e.estadoestu,
                  		CASE
                  			 WHEN e.estadoestu = '1'  THEN 'Pendiente'
                  			 WHEN e.estadoestu = '2'  THEN 'Enviado'
                  			 WHEN e.estadoestu = '3'  THEN 'Recibido'
                  			 WHEN e.estadoestu = '4'  THEN 'Rechazado'
                  			 WHEN e.estadoestu = '5'  THEN 'En Proceso'
                  			 WHEN e.estadoestu = '6'  THEN 'Procesado'
                  			 WHEN e.estadoestu = '7'  THEN 'Entregado'
                  			 ELSE  'Anulado'
                  		END as descripcion,
                        	count(distinct e.nordentra) as cantidad
              from ordtrabajo t, estrealizar e
              where t.nordentra = e.nordentra
              ".$w."
              group by e.estadoestu
              order by 2 desc";

      $result = pg_query($con,$sql1);


      $jsondata = array();

      $i = 0;


      while ($row = pg_fetch_array($result))
    	{
            $jsondata[$i] = array(
              'descripcion' => $row['descripcion'],
              'cantidad' => $row['cantidad']
              );

            $i++;
      }
  }

  if ($_GET['tipo']==3)
  {
      $sql1 = "select a.nomestudio,
                  	  a.cantidad,
                  	  a.rk
              from (
                  select  (select nomestudio from estudios where codestudio = e.codestudio) as nomestudio,
							count(e.codestudio) as cantidad,
							ROW_NUMBER () OVER (ORDER BY count(*) desc) as rk
				 from ordtrabajo t, estrealizar e
				 where t.nordentra = e.nordentra
         and   to_char(fecharec, 'yyyymm') = to_char(now(), 'yyyymm')
         ".$w."
				 group by (select nomestudio from estudios where codestudio = e.codestudio)
				 order by 2 desc
              ) a
          where a.rk < 10";

      $result = pg_query($con,$sql1);


      $jsondata = array();

      $i = 0;


      while ($row = pg_fetch_array($result))
    	{
            $jsondata[$i] = array(
              'nomestudio' => $row['nomestudio'],
              'cantidad' => $row['cantidad']
              );

            $i++;
      }
  }

  if ($_GET['tipo']==4)
  {
      $sql1 = "select s.codservicior,
                	   sum(s.enero) as enero,
                	   sum(s.febrero) as febrero,
                	   sum(s.marzo) as marzo,
                	   sum(s.abril) as abril,
                	   sum(s.mayo) as mayo,
                	   sum(s.junio) as junio,
                	   sum(s.julio) as julio,
                	   sum(s.agosto) as agosto,
                	   sum(s.setiembre) as setiembre,
                	   sum(s.octubre) as octubre,
                	   sum(s.noviembre) as noviembre,
                	   sum(s.diciembre) as diciembre
                from(
                select 	(select es.nomservicio from establecimientos es where es.codservicio = e.codservact) as codservicior,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '01'  THEN count(distinct e.nordentra) END, 0) as Enero,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '02'  THEN count(distinct e.nordentra) END, 0) as Febrero,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '03'  THEN count(distinct e.nordentra) END, 0) as Marzo,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '04'  THEN count(distinct e.nordentra) END, 0) as Abril,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '05'  THEN count(distinct e.nordentra) END, 0) as Mayo,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '06'  THEN count(distinct e.nordentra) END, 0) as Junio,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '07'  THEN count(distinct e.nordentra) END, 0) as Julio,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '08'  THEN count(distinct e.nordentra) END, 0) as Agosto,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '09'  THEN count(distinct e.nordentra) END, 0) as Setiembre,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '10'  THEN count(distinct e.nordentra) END, 0) as Octubre,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '11'  THEN count(distinct e.nordentra) END, 0) as Noviembre,
                                    		COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '12'  THEN count(distinct e.nordentra) END, 0) as Diciembre

                                    from ordtrabajo t, estrealizar e
                                    where t.nordentra = e.nordentra
                                    ".$w."
                                    group by (select es.nomservicio from establecimientos es where es.codservicio = e.codservact),to_char(t.fecharec, 'mm')
                ) as s
                group by s.codservicior";

      $result = pg_query($con,$sql1);

      while ($row = pg_fetch_array($result))
    	{
            $jsondata[$row['codservicior']]= array(
              'Enero' => $row['enero'],
              'Febrero' => $row['febrero'],
              'Marzo' => $row['marzo'],
              'Abril' => $row['abril'],
              'Mayo' => $row['mayo'],
              'Junio' => $row['junio'],
              'Julio' => $row['julio'],
              'Agosto' => $row['agosto'],
              'Setiembre' => $row['setiembre'],
              'Octubre' => $row['octubre'],
              'Noviembre' => $row['noviembre'],
              'Diciembre' => $row['diciembre']
            );

      }

  }

  if ($_GET['tipo']==5)
  {
      $sql1 = "select s.codservicior,
                	   sum(s.domingo) as domingo,
                	   sum(s.lunes) as lunes,
                	   sum(s.martes) as martes,
                	   sum(s.miercoles) as miercoles,
                	   sum(s.jueves) as jueves,
                	   sum(s.viernes) as viernes,
                	   sum(s.sabado) as sabado
                from(
                select 	(select es.nomservicio from establecimientos es where es.codservicio = e.codservact) as codservicior,
                                    		COALESCE (CASE  WHEN extract(dow from  fecharec) = 0  THEN count(distinct e.nordentra) END, 0) as Domingo,
                                    		COALESCE (CASE  WHEN extract(dow from  fecharec) = 1  THEN count(distinct e.nordentra) END, 0) as Lunes,
                                    		COALESCE (CASE  WHEN extract(dow from  fecharec) = 2 THEN count(distinct e.nordentra) END, 0) as Martes,
                                    		COALESCE (CASE  WHEN extract(dow from  fecharec) = 3  THEN count(distinct e.nordentra) END, 0) as Miercoles,
                                    		COALESCE (CASE  WHEN extract(dow from  fecharec) = 4  THEN count(distinct e.nordentra) END, 0) as Jueves,
                                    		COALESCE (CASE  WHEN extract(dow from  fecharec) = 5 THEN count(distinct e.nordentra) END, 0) as Viernes,
                                    		COALESCE (CASE  WHEN extract(dow from  fecharec) = 6  THEN count(distinct e.nordentra) END, 0) as Sabado

                                    from ordtrabajo t, estrealizar e
                                    where t.nordentra = e.nordentra
                                    ".$w."
                                    group by (select es.nomservicio from establecimientos es where es.codservicio = e.codservact),extract(dow from  fecharec)
                ) as s
                group by s.codservicior";

      $result = pg_query($con,$sql1);


      $jsondata = array();

      while ($row = pg_fetch_array($result))
    	{
            $jsondata[$row['codservicior']]= array(
              'domingo' => $row['domingo'],
              'lunes' => $row['lunes'],
              'martes' => $row['martes'],
              'miercoles' => $row['miercoles'],
              'jueves' => $row['jueves'],
              'viernes' => $row['viernes'],
              'sabado' => $row['sabado']
            );

      }
  }

  if ($_GET['tipo']==6)
  {
      $sql1 = "select a.codservicior,
                  	  a.cantidad,
                  	  a.rk
              from (
                  select (select es.nomservicio from establecimientos es where es.codservicio = t.codservder) as codservicior,
                          count(distinct e.nordentra)  as cantidad,
                  	    ROW_NUMBER () OVER (
                             ORDER BY count(distinct e.nordentra) desc
                          ) as rk
                  from ordtrabajo t, estrealizar e
                  where t.nordentra = e.nordentra
                  ".$w."
                  group by (select es.nomservicio from establecimientos es where es.codservicio = t.codservder)
                  order by 2 desc
              ) a
              where a.rk < 10";

      $result = pg_query($con,$sql1);


      $jsondata = array();

      $i = 0;


      while ($row = pg_fetch_array($result))
    	{
            $jsondata[$i] = array(
              'codservicior' => $row['codservicior'],
              'cantidad' => $row['cantidad']
              );

            $i++;
      }
  }

  if ($_GET['tipo']==7)
  {
      $query2 = "select  count(e.codestudio) as cantidad
            from ordtrabajo t, estrealizar e
            where t.nordentra = e.nordentra
            ".$w;
	  $result2 = pg_query($con,$query2);

	  $row2 = pg_fetch_assoc($result2);

	  $cantestu = number_format($row2["cantidad"], 0, '', '.');
	  
	  $query1 = "select count(*) as cantidad
          from ordtrabajo t
          where ".$w1;
	  $result1 = pg_query($con,$query1);

	  $row1 = pg_fetch_assoc($result1);

	  $cantorden = number_format($row1["cantidad"], 0, '', '.');

      $jsondata = array();

      $jsondata[0] = array(
              'cantidadorden' => $cantorden,
              'cantidadresultado' => $cantestu
              );

  }

  //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata);
  exit();


?>

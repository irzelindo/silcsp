<?php
  include("conexion.php");
	$con=Conectarse();

  $codservicio  = $_GET[ 'codservicio' ];
  $codresultado = $_GET[ 'codresultado' ];
  $desde        = $_GET[ 'desde' ];
  $hasta        = $_GET[ 'hasta' ];

  $w = "";

  if($codservicio != '')
  {
		$w=$w." and t.codservder = '$codservicio'";
  }

  if ($_GET['tipo']==1)
  {
      $sql1 = "select  b.codservicior,
					   b.cantidad
				from (
					select a.codservicior,
						   count(distinct a.nordentra) as cantidad,
						   ROW_NUMBER () OVER (ORDER BY count(distinct a.nordentra) desc) as rk
					from (
							select COALESCE (CASE 
								   WHEN t.codservder != ''  THEN 
										(select es.nomservicio from establecimientos es where es.codservicio = t.codservder)
								   ELSE  (select es.nomservicio from establecimientos es where es.codservicio = t.codservicio)
								   END, (select es.nomservicio from establecimientos es where es.codservicio = '001')) as codservicior,
								   t.nordentra							
							from ordtrabajo t, resultados e
							where t.nordentra = e.nordentra
							and   t.fecharec >= '$desde'
			  				and   t.fecharec <= '$hasta'
							and   e.codestudio = '08004'
							and   e.coddetermina = '800194'
							and   e.codresultado != ''
							$w
						) a
					group by a.codservicior
				  ) b
				  where  b.rk < 11";

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
      $sql1 = "select (select es.nomresultado from resultadocodificado es where es.codresultado = r.codresultado) as codservicior, count(distinct r.nroestudio) as cantidad
				from resultados r
				where r.codestudio = '08004'
				and   r.coddetermina = '800194'
				and   r.codresultado != ''
				and   exists(select * 
							 from ordtrabajo t
							 where t.nordentra = r.nordentra
               and   t.fecharec >= '$desde'
				       and   t.fecharec <= '$hasta'
							 $w
							)
				group by r.codresultado
				order by 2 asc";

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

  if ($_GET['tipo']==3)
  {
      $sql1 = "select s.anio,
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
                select 	to_char(t.fecharec, 'yyyy')  anio,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '01'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Enero,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '02'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Febrero,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '03'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Marzo,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '04'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Abril,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '05'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Mayo,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '06'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Junio,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '07'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Julio,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '08'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Agosto,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '09'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Setiembre,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '10'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Octubre,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '11'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Noviembre,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '12'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Diciembre
				from ordtrabajo t, resultados e
				  where t.nordentra = e.nordentra
				  and   t.fecharec >= '$desde'
				  and   t.fecharec <= '$hasta'
				  and   e.codestudio = '08004'
				  and   e.coddetermina = '800194'
				  and   e.codresultado != ''
				  $w
				group by to_char(t.fecharec, 'yyyy'), to_char(t.fecharec, 'mm')
                ) as s
                group by s.anio";

      $result = pg_query($con,$sql1);
	  
      while ($row = pg_fetch_array($result))
      {
		  	$jsondata[$row['anio']]= array(
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
                select 	(select es.nomresultado from resultadocodificado es where es.codresultado = e.codresultado) as codservicior,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '01'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Enero,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '02'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Febrero,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '03'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Marzo,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '04'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Abril,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '05'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Mayo,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '06'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Junio,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '07'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Julio,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '08'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Agosto,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '09'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Setiembre,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '10'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Octubre,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '11'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Noviembre,
                        COALESCE (CASE  WHEN to_char(t.fecharec, 'mm') = '12'  THEN count(distinct e.codresultado || cast(e.nroestudio as varchar)) END, 0) as Diciembre
				from ordtrabajo t, resultados e
				  where t.nordentra = e.nordentra
				  and   t.fecharec >= '$desde'
				  and   t.fecharec <= '$hasta'
				  and   e.codestudio = '08004'
				  and   e.coddetermina = '800194'
				  and   e.codresultado != ''
				  $w
				group by to_char(t.fecharec, 'yyyy'), to_char(t.fecharec, 'mm'), e.codresultado
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
                select 	(select es.nomresultado from resultadocodificado es where es.codresultado = e.codresultado) as codservicior,
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
				from ordtrabajo t, resultados e
				  where t.nordentra = e.nordentra
				  and   t.fecharec >= '$desde'
				  and   t.fecharec <= '$hasta'
				  and   e.codestudio = '08004'
				  and   e.coddetermina = '800194'
				  and   e.codresultado != ''
				  $w
				group by to_char(t.fecharec, 'yyyy'), to_char(t.fecharec, 'mm'), e.codresultado
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

  if ($_GET['tipo']==6)
  {
      $sql1 = "select e.codresultado,
                      (select es.nomresultado from resultadocodificado es where es.codresultado = e.codresultado) as codservicior,
                      count(distinct e.nordentra) as cantidad
                from ordtrabajo t, resultados e
                where t.nordentra = e.nordentra
                and   t.fecharec >= '$desde'
                and   t.fecharec <= '$hasta'
                and   e.codestudio = '08004'
                and   e.coddetermina = '800194'
                and   e.codresultado != ''
                $w
                group by e.codresultado";

      
      $result = pg_query($con,$sql1);
      while ($row = pg_fetch_array($result))
      {
        $codresultado = $row['codresultado'];

        $sql2 = "WITH total_mes AS (
                                    select to_char(t.fecharec, 'YYYY') as anio,
                                                    to_char(t.fecharec, 'mm') as mes,
                                                    count(distinct e.nordentra) as cantidad
                                                  from ordtrabajo t, resultados e
                                                  where t.nordentra = e.nordentra
                                          and   t.fecharec >= '$desde'
                                          and   t.fecharec <= '$hasta'
                                          and   e.codestudio = '08004'
                                          and   e.coddetermina = '800194'
                                          and   e.codresultado != ''
                                          group by to_char(t.fecharec, 'mm'), to_char(t.fecharec, 'YYYY')
                                ), top_mes AS (
                                    select to_char(t.fecharec, 'YYYY') as anio,
                                                    to_char(t.fecharec, 'mm') as mes,
                                                    count(distinct e.nordentra) as cantidad
                                                  from ordtrabajo t, resultados e
                                                  where t.nordentra = e.nordentra
                                                  and   e.codresultado = '$codresultado'
                                                  group by to_char(t.fecharec, 'mm'), to_char(t.fecharec, 'YYYY')
                                )
                                SELECT total_mes.anio, 
                                       total_mes.mes,
                                       COALESCE(top_mes.cantidad,0) as cantidad
                                FROM total_mes
                                LEFT OUTER JOIN top_mes ON total_mes.anio = top_mes.anio and total_mes.mes = top_mes.mes
                                order by 1, 2";

        $result1 = pg_query($con,$sql2);

        $i = 0;
        while ($row1 = pg_fetch_array($result1))
        {
            $data[$i] = array('mes' => obtenermes($row1['mes']).$row1['anio'], 'cantidad' => $row1['cantidad']);

            $i = $i + 1;
        }

        $jsondata[$row['codservicior']] = $data;
          
      }
  }

  function obtenermes($mes)
  {
	  if($mes == '01')
	  {
		  return 'Ene.';
	  }
	  
	  if($mes == '02')
	  {
		  return 'Feb.';
	  }
	  
	  if($mes == '03')
	  {
		  return 'Mar.';
	  }
	  
	  if($mes == '04')
	  {
		  return 'Abr.';
	  }
	  
	  if($mes == '05')
	  {
		  return 'May.';
	  }
	  
	  if($mes == '06')
	  {
		  return 'Jun.';
	  }
	  
	  if($mes == '07')
	  {
		  return 'Jul.';
	  }
	  
	  if($mes == '08')
	  {
		  return 'Ago.';
	  }
	  
	  if($mes == '09')
	  {
		  return 'Set.';
	  }
	  
	  if($mes == '10')
	  {
		  return 'Oct.';
	  }
	  
	  if($mes == '11')
	  {
		  return 'Nov.';
	  }
	  
	  if($mes == '12')
	  {
		  return 'Dic.';
	  }
  }

  //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata);
  exit();


?>

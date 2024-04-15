<?php
@Header("Content-type: text/html; charset=utf-8");
session_start();

$codusu = $_SESSION[ 'codusu' ];

include("conexion.php");
$con=Conectarse();

$codsector  	= $_POST['codsector'];
$codestudio 	= $_POST['codestudio'];
$nordentra		= $_POST['nordentra'];
$codresultado 	= $_POST['codresultado'];
$cantidad		= count($nordentra);
$microbiologia  = $_POST['microbiologia'];

$fecha = date("Y-n-j", time());

$respuesta = new stdClass();

for($i=0;$i<$cantidad;$i++){
	if($microbiologia[$i] == 2){
		pg_query( $con, "UPDATE estrealizar
						 SET estadoestu  = '6'
						 WHERE nordentra = '$nordentra[$i]'");

		pg_query( $con, "UPDATE resultados
						 SET codestado   = '002',
						 codresultado    = '$codresultado',
						 fechares        = '$fecha'
						 WHERE nordentra = '$nordentra[$i]'");
		$sql = "SELECT 
				ordtrabajo.nordentra as \"orden\"
				,concat(ordtrabajo.cod_dgvs,'-',ordtrabajo.nro_toma) as \"Codigo\"
				,to_char(ordtrabajo.fecharec, 'DD/MM/YYYY') as \"FechaRecLab\" 
				,to_char(resultados.fechares, 'DD/MM/YYYY') as \"FechaResLab\"
				,case when resultados.fechares IS NOT NULL then
					CASE WHEN resultados.codresultado::integer = 5 THEN 'SARS CoV-2' ELSE 'NEGATIVO' END
				 else
					'PENDIENTE'
				 end as \"Resultado\"
				FROM public.ordtrabajo
				inner join public.resultados on (resultados.nordentra = ordtrabajo.nordentra)
				where ordtrabajo.cod_dgvs <> 0 AND ordtrabajo.nordentra = '$nordentra[$i]'";

		$resultRES = pg_query( $con, $sql );
		$rowRES    = pg_fetch_assoc( $resultRES );
		if ( $rowRES['Resultado'] == 'NEGATIVO' ) {
			array_push( $resultados, array( 'Codigo'	  => $rowRES['Codigo'],
											'orden'		  => $rowRES['orden'],
											'CF' 		  => 'DESCARTADO',
											'Fecha' 	  => date("Y-m-d H:i:s"),
											'FechaRecLab' => $rowRES['FechaRecLab'],
											'FechaResLab' => $rowRES['FechaResLab'], 
											'LABORATORIO' => $rowUSU['laboratorio'],
											'Resultado'   => $rowRES['Resultado'],
											'TECNICA' 	  => 'PCR',
											'Usuario' 	  => 'LCSP'.$rowUSU['laboratorio']
			 							  ) );
		}else{
			array_push( $resultados, array( 'Codigo'	  => $rowRES['Codigo'],
											'orden'		  => $rowRES['orden'],
											'CF' 		  => 'CONFIRMADO',
											'Fecha' 	  => date("Y-m-d H:i:s"),
											'FechaRecLab' => $rowRES['FechaRecLab'],
											'FechaResLab' => $rowRES['FechaResLab'], 
											'LABORATORIO' => $rowUSU['laboratorio'],
											'Resultado'   => $rowRES['Resultado'],
											'TECNICA' 	  => 'PCR',
											'Usuario' 	  => 'LCSP'.$rowUSU['laboratorio']
			 							  ) );
		}
	}
	else{
		pg_query( $con, "UPDATE estrealizar
						 SET estadoestu  = '6'
						 WHERE nordentra = '$nordentra[$i]'");

		pg_query( $con, "UPDATE resultadosmicro
						 SET codestado    = '002',
						 	 codresultado = '$codresultado',
						 	 fechares 	  = '$fecha'
						 WHERE nordentra  = '$nordentra[$i]'");

	}
}

	$respuesta->grupo = 1;

echo json_encode($respuesta);
?>

<?php
// Se crea la conexión a la base de datos
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

$fecha=date("Y-n-j", time());

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
    $sql="select 	p.nropaciente,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	p.dccionr,
	p.telefono,
	t.nordentra,
	t.codservicio,
	t.codorigen,
	t.fecharec,
	t.atendido,
	t.horarec
from paciente p, ordtrabajo t
where t.atendido is null and fecharec='".$fecha."' and p.nropaciente = t.nropaciente "; 

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
    $sql1 = "select 	p.nropaciente,
	p.pnombre ||' '||p.snombre|| ' ' ||p.papellido|| ' '|| p.sapellido as nomyape,
	p.dccionr,
	p.telefono,
	t.nordentra,
	t.codservicio,
	t.codorigen,
	t.fecharec,
	t.atendido,
	t.horarec
from paciente p, ordtrabajo t
where t.atendido is null and fecharec='".$fecha."' and p.nropaciente = t.nropaciente order by t.nordentra";
	
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
       $atendido = $row[atendido];

       $respuesta->rows[$i]['cell'] = array($row['nordentra'],$row['nomyape']); 	   	
    
	   // OJO: Falta filtrar por establecimiento del usuario y fecha del DIA 
        
	$i++;
	}
	
	//Asignamos todo esto en variables de json, para enviarlo al navegador.
	
    echo json_encode($respuesta);
?>
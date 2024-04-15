<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codenferm']=$_POST['codenferm'];
   $_SESSION['nomsintoma']=$_POST['nomsintoma'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codenferm = trim($_POST['codenferm']);
   $nomsintoma = trim($_POST['nomsintoma']);
   
	$query0 = "select * from sintomas where nomsintoma = '$nomsintoma'";
    $result0 = pg_query($conn, $query0);
    $row0 = pg_fetch_array($result0);
	$codsintoma = $row0['codsintoma'];
	$tipo = $row0['tipo'];
   
	$query1 = "select * from enfsintomas where codenferm = '$codenferm' and codsintoma = '$codsintoma' and tipo='$tipo'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 

    $norden=0;
    $ultimoorden = pg_query($conn,"select norden from enfsintomas where codenferm = '$codenferm' order by norden"); 
    while ($row = pg_fetch_array($ultimoorden))
	    {
	    $norden = $row['norden'];
	    }
    $norden=$norden+1;

    if ($nroreg1==0)
	   {
	 	$result = pg_query($conn, "insert into enfsintomas( codenferm, codsintoma, norden, tipo) values ('$codenferm', '$codsintoma', $norden, $tipo)"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_421";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Sintomas de Enfermedades: Inserta-Reg.: ".$codenferm.', Cod.Sintoma: '.$codsintoma;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_enfermedades.php?mensage=9&id=".$codenferm);
       }
	else
       {
   		header("Location: nuevo_sintomasrel.php?mensage2=1&codenferm=$codenferm"); 
       }
?>

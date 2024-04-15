<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codsector']=$_POST['codsector'];
   $_SESSION['nomsector']=$_POST['nomsector'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codsector = trim($_POST['codsector']);
   $nomsector = trim($_POST['nomsector']);
   $posicion  = $_POST['posicion'];

   if($posicion == '')
   {
	   $posicion = 0;
   }
	
   
	$query1 = "select * from sectores where codsector = '$codsector'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from sectores where nomsector = '$nomsector'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into sectores( codsector, nomsector, posicion) values ('$codsector', '$nomsector', '$posicion')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4110";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Sectores Laboratoriales: Inserta-Reg.: ".$codsector."-".$nomsector;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: sectores.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_sectores.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_sectores.php?mensage2=2"); 
           }
       }
?>

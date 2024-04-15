<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codumedida']=$_POST['codumedida'];
   $_SESSION['nomumedida']=$_POST['nomumedida'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codumedida = trim($_POST['codumedida']);
   $nomumedida = trim($_POST['nomumedida']);
	
   
	$query1 = "select * from unidadmedida where codumedida = '$codumedida'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from unidadmedida where nomumedida = '$nomumedida'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into unidadmedida( codumedida, nomumedida) values ('$codumedida', '$nomumedida')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_439";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Unidades de Medida: Inserta-Reg.: ".$codumedida."-".$nomumedida;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: unidad_medida.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_unidad_medida.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_unidad_medida.php?mensage2=2"); 
           }
       }
?>

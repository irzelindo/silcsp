<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codproceso']=$_POST['codproceso'];
   $_SESSION['nomproceso']=$_POST['nomproceso'];
   $_SESSION['textobase']=$_POST['textobase'];
   $_SESSION['codopc']=$_POST['codopc'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codproceso = trim($_POST['codproceso']);		
   $nomproceso = trim($_POST['nomproceso']);
   $textobase = trim($_POST['textobase']);
   $codopc = $_POST['codopc'];
	
   
	$query1 = "select * from procesos where codproceso = '$codproceso'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from procesos where nomproceso = '$nomproceso'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into procesos( codproceso, nomproceso, textobase, codopc) values ('$codproceso', '$nomproceso', '$textobase','$codopc')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopcx = "V_415";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Procesos: Inserta-Reg.: ".$codproceso."-".$nomproceso;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopcx,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: procesos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_procesos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_procesos.php?mensage2=2"); 
           }
       }
?>

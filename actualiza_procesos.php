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
			
	   
	$codproceso  = trim($_POST['codproceso']);
	$nomproceso  = trim($_POST['nomproceso']);
	$textobase   = trim($_POST['textobase']);
	$nomprocesox = trim($_POST['nomprocesox']);
    $codopc      = $_POST['codopc'];    
/*	
echo $codproceso;
echo'<br>';
echo $nomproceso;
echo'<br>';
echo $nomprocesox;
*/   
	$query2 = "select * from procesos where nomproceso = '$nomproceso'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomproceso==$nomprocesox))
	   {
        $result = pg_query($conn,"UPDATE procesos SET nomproceso='$nomproceso', textobase='$textobase', codopc='$codopc' WHERE codproceso='$codproceso'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopcx = "V_415";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Procesos: Modifica-Reg.: ".$codproceso."-".$nomproceso;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopcx,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: procesos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_procesos.php?id=$codproceso&mensage2=2"); 
       }  

?>

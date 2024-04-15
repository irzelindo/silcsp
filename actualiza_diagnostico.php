<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['coddiagnostico']=$_POST['coddiagnostico'];
   $_SESSION['nomdiagnostico']=$_POST['nomdiagnostico'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			 
	$coddiagnostico  = trim($_POST['coddiagnostico']);
	$nomdiagnostico  = trim($_POST['nomdiagnostico']);
	$nomdiagnosticox = trim($_POST['nomdiagnosticox']);
/*	
echo $coddiagnostico;
echo'<br>';
echo $nomdiagnostico;
echo'<br>';
echo $nomdiagnosticox;
*/   
	$query2 = "select * from diagnostico where nomdiagnostico = '$nomdiagnostico'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomdiagnostico==$nomdiagnosticox))
	   {
        $result = pg_query($conn,"UPDATE diagnostico SET nomdiagnostico='$nomdiagnostico' WHERE coddiagnostico='$coddiagnostico'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_425";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Diagnostico: Modifica-Reg.: ".$coddiagnostico."-".$nomdiagnostico;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: diagnostico.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_diagnostico.php?id=$coddiagnostico&mensage2=2"); 
       }  

?>

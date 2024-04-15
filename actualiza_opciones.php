<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codopc']=$_POST['codopc'];
   $_SESSION['nomopc']=$_POST['nomopc'];
   $_SESSION['ayuda']=$_POST['ayuda'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codopc  = $_POST['codopc'];
	$nomopc  = $_POST['nomopc'];
	$ayuda   = trim($_POST['ayuda']);
	$nomopcx = $_POST['nomopcx'];
/*	
echo $codopc;
echo'<br>';
echo $nomopc;
echo'<br>';
echo $nomopcx;
*/   
    $nroreg2=0; 

    if ($nroreg2==0)
	   {
        $result = pg_query($conn,"UPDATE opciones SET ayuda='$ayuda' WHERE codopc='$codopc'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopcx = "V_414";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="opciones: Modifica-Reg.: ".$codopc."-".$nomopc;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopcx,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: opciones.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_opciones.php?id=$codopc&mensage2=2"); 
       }  

?>

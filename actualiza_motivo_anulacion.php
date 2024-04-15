<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codanula']=$_POST['codanula'];
   $_SESSION['nomanula']=$_POST['nomanula'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codanula  = trim($_POST['codanula']);
	$nomanula  = trim($_POST['nomanula']);
	$nomanulax = trim($_POST['nomanulax']);
/*	
echo $codanula;
echo'<br>';
echo $nomanula;
echo'<br>';
echo $nomanulax;
*/   
	$query2 = "select * from motivoanulacion where nomanula = '$nomanula'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomanula==$nomanulax))
	   {
        $result = pg_query($conn,"UPDATE motivoanulacion SET nomanula='$nomanula' WHERE codanula='$codanula'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_443";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Motivos de Anulacion de ingresos: Modifica-Reg.: ".$codanula."-".$nomanula;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: motivo_anulacion.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_motivo_anulacion.php?id=$codanula&mensage2=2"); 
       }  

?>

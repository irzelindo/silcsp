<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codrechazo']=$_POST['codrechazo'];
   $_SESSION['nomrechazo']=$_POST['nomrechazo'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codrechazo  = trim($_POST['codrechazo']);
	$nomrechazo  = trim($_POST['nomrechazo']);
	$nomrechazox = trim($_POST['nomrechazox']);
/*	
echo $codrechazo;
echo'<br>';
echo $nomrechazo;
echo'<br>';
echo $nomrechazox;
*/   
	$query2 = "select * from motivorechazo where nomrechazo = '$nomrechazo'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomrechazo==$nomrechazox))
	   {
        $result = pg_query($conn,"UPDATE motivorechazo SET nomrechazo='$nomrechazo' WHERE codrechazo='$codrechazo'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4310";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Motivos de Rechazo: Modifica-Reg.: ".$codrechazo."-".$nomrechazo;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: motivo_rechazo.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_motivo_rechazo.php?id=$codrechazo&mensage2=2"); 
       }  

?>

<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codbco']=$_POST['codbco'];
   $_SESSION['nombco']=$_POST['nombco'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codbco  = trim($_POST['codbco']);
	$nombco  = trim($_POST['nombco']);
	$nombcox = trim($_POST['nombcox']);
/*	
echo $codbco;
echo'<br>';
echo $nombco;
echo'<br>';
echo $nombcox;
*/   
	$query2 = "select * from bancos where nombco = '$nombco'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nombco==$nombcox))
	   {
        $result = pg_query($conn,"UPDATE bancos SET nombco='$nombco' WHERE codbco='$codbco'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_443";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Bancos: Modifica-Reg.: ".$codbco."-".$nombco;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: bancos.php?mensage=7");
       } 
	else
       {
   		header("Location: modifica_bancos.php?id=$codbco&mensage2=2"); 
       }  

?>

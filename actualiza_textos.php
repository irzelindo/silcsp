<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codtexto']=$_POST['codtexto'];
   $_SESSION['nomtexto']=$_POST['nomtexto'];
   $_SESSION['eltexto']=$_POST['eltexto'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codtexto  = trim($_POST['codtexto']);
	$nomtexto  = trim($_POST['nomtexto']);
	$eltexto   = trim($_POST['eltexto']);
	$nomtextox = trim($_POST['nomtextox']);
/*	
echo $codtexto;
echo'<br>';
echo $nomtexto;
echo'<br>';
echo $nomtextox;
*/   
	$query2 = "select * from textos where nomtexto = '$nomtexto'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomtexto==$nomtextox))
	   {
        $result = pg_query($conn,"UPDATE textos SET nomtexto='$nomtexto', texto='$eltexto' WHERE codtexto='$codtexto'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_438";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Textos: Modifica-Reg.: ".$codtexto."-".$nomtexto;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: textos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_textos.php?id=$codtexto&mensage2=2"); 
       }  

?>

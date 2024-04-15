<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codestado']=$_POST['codestado'];
   $_SESSION['nomestado']=$_POST['nomestado'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	$codestado  = trim($_POST['codestado']);
	$nomestado  = trim($_POST['nomestado']);
	$nomestadox = trim($_POST['nomestadox']);
    
/*	
echo $codestado;
echo'<br>';
echo $nomestado;
echo'<br>';
echo $nomestadox;
*/   
	$query2 = "select * from estadoresultado where nomestado = '$nomestado'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomestado==$nomestadox))
	   {
        $result = pg_query($conn,"UPDATE estadoresultado SET nomestado='$nomestado' WHERE codestado='$codestado'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4311";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Estados de Resultados: Modifica-Reg.: ".$codestado."-".$nomestado;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: estado_resultado.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_estado_resultado.php?id=$codestado&mensage2=2"); 
       }  

?>

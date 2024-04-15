<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codmetodo']=$_POST['codmetodo'];
   $_SESSION['nommetodo']=$_POST['nommetodo'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	$codmetodo  = trim($_POST['codmetodo']);
	$nommetodo  = trim($_POST['nommetodo']);
	$nommetodox = trim($_POST['nommetodox']);   
/*	
echo $codmetodo;
echo'<br>';
echo $nommetodo;
echo'<br>';
echo $nommetodox;
*/   
	$query2 = "select * from metodos where nommetodo = '$nommetodo'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nommetodo==$nommetodox))
	   {
        $result = pg_query($conn,"UPDATE metodos SET nommetodo='$nommetodo' WHERE codmetodo='$codmetodo'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_436";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Metodos: Modifica-Reg.: ".$codmetodo."-".$nommetodo;
        $terminal = $_SERVER['REMOTE_ADDR']; 
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: metodos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_metodos.php?id=$codmetodo&mensage2=2"); 
       }  

?>

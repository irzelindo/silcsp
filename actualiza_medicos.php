<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codmedico']=$_POST['codmedico'];
   $_SESSION['nomyapex']=$_POST['nomyapex'];
   $_SESSION['tipoprof']=$_POST['tipoprof'];
   $_SESSION['nroregistro']=$_POST['nroregistro'];
   $_SESSION['estado']=$_POST['estado'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codmedico  = trim($_POST['codmedico']);
	$nomyapex   = trim($_POST['nomyapex']);
	$tipoprof   = $_POST['tipoprof'];
	$nomyapexx  = trim($_POST['nomyapexx']);
	$nroregistro  = $_POST['nroregistro'];
    $estado = 1*$_POST['estado'];    

/*	
echo $codmedico;
echo'<br>';
echo $nomyapex;
echo'<br>';
echo $nomyapexx;
*/   
	$query2 = "select * from medicos where nomyape = '$nomyapex'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomyapex==$nomyapexx))
	   {
        $result = pg_query($conn,"UPDATE medicos SET nomyape='$nomyapex', tipoprof='$tipoprof', nroregistro='$nroregistro', estado=$estado WHERE codmedico='$codmedico'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_424";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Medicos: Modifica-Reg.: ".$codmedico."-".$nomyapex;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: medicos.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_medicos.php?id=$codmedico&mensage2=2"); 
       }  

?>

<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codantibiogr']=$_POST['codantibiogr'];
   $_SESSION['nomantibiogr']=$_POST['nomantibiogr'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codantibiogr  = trim($_POST['codantibiogr']);
	$nomantibiogr  = trim($_POST['nomantibiogr']);
	$nomantibiogrx = trim($_POST['nomantibiogrx']);
/*	
echo $codantibiogr;
echo'<br>';
echo $nomantibiogr;
echo'<br>';
echo $nomantibiogrx;
*/   
	$query2 = "select * from antibiogramas where nomantibiogr = '$nomantibiogr'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomantibiogr==$nomantibiogrx))
	   {
        $result = pg_query($conn,"UPDATE antibiogramas SET nomantibiogr='$nomantibiogr' WHERE codantibiogr='$codantibiogr'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4315";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Antibiogramas: Modifica-Reg.: ".$codantibiogr."-".$nomantibiogr;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: antibiogramas.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_antibiogramas.php?id=$codantibiogr&mensage2=2"); 
       }  

?>

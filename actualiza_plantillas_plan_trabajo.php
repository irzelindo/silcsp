<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codplatilla']=$_POST['codplatilla'];
   $_SESSION['nomplatilla']=$_POST['nomplatilla'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codplatilla  = trim($_POST['codplatilla']);
	$nomplatilla  = trim($_POST['nomplatilla']);
	$nomplatillax = trim($_POST['nomplatillax']);
/*	
echo $codplatilla;
echo'<br>';
echo $nomplatilla;
echo'<br>';
echo $nomplatillax;
*/   
	$query2 = "select * from plantillaplan where nomplatilla = '$nomplatilla'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomplatilla==$nomplatillax))
	   {
        $result = pg_query($conn,"UPDATE plantillaplan SET nomplatilla='$nomplatilla' WHERE codplatilla='$codplatilla'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4318";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Plantillas de Planes de Trabajo: Modifica-Reg.: ".$codplatilla."-".$nomplatilla;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: plantillas_plan_trabajo.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_plantillas_plan_trabajo.php?id=$codplatilla&mensage2=2"); 
       }  

?>

<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['nropregunta']=$_POST['nropregunta'];
   $_SESSION['respuesta']=$_POST['respuesta'];
   $_SESSION['textopregunta']=$_POST['textopregunta'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			  
	$nropregunta    = $_POST['nropregunta'];
	$respuesta      = trim($_POST['respuesta']);
	$textopregunta  = trim($_POST['textopregunta']);
	$respuestax     = trim($_POST['respuestax']);
/*	
echo $nropregunta;
echo'<br>';
echo $respuesta;
echo'<br>';
echo $respuestax;
*/   
    $nroreg2=0; 

    if ($nroreg2==0)
	   {
        $result = pg_query($conn,"UPDATE preguntaedcontinua SET respuesta='$respuesta', textopregunta='$textopregunta', puntaje='$puntaje', tipo='$tipo' WHERE nropregunta='$nropregunta'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_451";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Preguntas de educacion continua: Modifica-Reg.: ".$nropregunta."-".$respuesta;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: educacion_continua.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_educacion_continua.php?id=$nropregunta&mensage2=2"); 
       }  

?>

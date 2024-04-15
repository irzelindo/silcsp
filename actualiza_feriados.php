<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['nroorden']=$_POST['nroorden'];
   $_SESSION['dia']=$_POST['dia'];
   $_SESSION['mes']=$_POST['mes'];
   $_SESSION['anio']=$_POST['anio'];
   $_SESSION['esanual']=$_POST['esanual'];
   $_SESSION['motivo']=$_POST['motivo'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
   $nroorden  = $_POST['nroorden'];
   $dia=1*$_POST['dia'];
   $mes=1*$_POST['mes'];
   $anio=1*$_POST['anio'];
   $esanual = 1*$_POST['esanual'];
   $motivo = trim($_POST['motivo']);

/*	
echo $nroorden;
echo'<br>';
echo $dia;
echo'<br>';
echo $diax;
*/   
    $nroreg2=0; 

    if ($nroreg2==0)
	   {
        $result = pg_query($conn,"UPDATE feriados SET dia='$dia', mes='$mes', anio='$anio', esanual=$esanual, motivo='$motivo' WHERE nroorden='$nroorden'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4113";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Feriados y Asuetos: Modifica-Reg.: ".$nroorden."-".$dia;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: feriados.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_feriados.php?id=$nroorden&mensage2=2"); 
       }  

?>

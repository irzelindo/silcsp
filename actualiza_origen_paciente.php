<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codorigen']=$_POST['codorigen'];
   $_SESSION['nomorigen']=$_POST['nomorigen'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codorigen  = trim($_POST['codorigen']);
	$nomorigen  = trim($_POST['nomorigen']);
	$nomorigenx = trim($_POST['nomorigenx']);
/*	
echo $codorigen;
echo'<br>';
echo $nomorigen;
echo'<br>';
echo $nomorigenx;
*/   
	$query2 = "select * from origenpaciente where nomorigen = '$nomorigen'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomorigen==$nomorigenx))
	   {
        $result = pg_query($conn,"UPDATE origenpaciente SET nomorigen='$nomorigen' WHERE codorigen='$codorigen'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_423";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Origen del Paciente: Modifica-Reg.: ".$codorigen."-".$nomorigen;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: origen_paciente.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_origen_paciente.php?id=$codorigen&mensage2=2"); 
       }  

?>

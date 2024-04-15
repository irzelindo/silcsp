<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codcourier']=$_POST['codcourier'];
   $_SESSION['nomcourier']=$_POST['nomcourier'];
   $_SESSION['director']=$_POST['director'];
   $_SESSION['dccion']=$_POST['dccion'];
   $_SESSION['estado']=$_POST['estado'];
   $_SESSION['telefono']=$_POST['telefono'];
   $_SESSION['email']=$_POST['email'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	$codcourier  = trim($_POST['codcourier']);
	$nomcourier  = trim($_POST['nomcourier']);
	$director    = trim($_POST['director']);
	$nomcourierx = trim($_POST['nomcourierx']);
	$dccion      = trim($_POST['dccion']);
    $estado      = 1*$_POST['estado'];    
    $telefono    = trim($_POST['telefono']);
    $email       = trim($_POST['email']);

/*	
echo $codcourier;
echo'<br>';
echo $nomcourier;
echo'<br>';
echo $nomcourierx;
*/   
	$query2 = "select * from courier where nomcourier = '$nomcourier'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomcourier==$nomcourierx))
	   {
        $result = pg_query($conn,"UPDATE courier SET nomcourier='$nomcourier', director='$director', dccion='$dccion', estado=$estado, telefono='$telefono', email='$email' WHERE codcourier='$codcourier'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4111";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Courier: Modifica-Reg.: ".$codcourier."-".$nomcourier;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: courier.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_courier.php?id=$codcourier&mensage2=2"); 
       }  

?>

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

   $codcourier = trim($_POST['codcourier']);		
   $nomcourier = trim($_POST['nomcourier']);
   $director = trim($_POST['director']);
   $dccion = trim($_POST['dccion']);
   $estado = 1*$_POST['estado'];
   $telefono = trim($_POST['telefono']);
   $email = trim($_POST['email']);
	
   
	$query1 = "select * from courier where codcourier = '$codcourier'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from courier where nomcourier = '$nomcourier'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into courier( codcourier, nomcourier, director, dccion, estado, telefono, email) values ('$codcourier', '$nomcourier', '$director', '$dccion', $estado, '$telefono', '$email')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4111";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Courier: Inserta-Reg.: ".$codcourier."-".$nomcourier;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: courier.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_courier.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_courier.php?mensage2=2"); 
           }
       }
?>

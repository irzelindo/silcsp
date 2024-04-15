<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codorigen']=$_POST['codorigen'];
   $_SESSION['nomorigen']=$_POST['nomorigen'];
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codorigen = trim($_POST['codorigen']);
   $nomorigen = trim($_POST['nomorigen']);
	
   
	$query1 = "select * from origenpaciente where codorigen = '$codorigen'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from origenpaciente where nomorigen = '$nomorigen'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into origenpaciente( codorigen, nomorigen) values ('$codorigen', '$nomorigen')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_423";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Origen del Paciente: Inserta-Reg.: ".$codorigen."-".$nomorigen;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: origen_paciente.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_origen_paciente.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_origen_paciente.php?mensage2=2"); 
           }
       }
?>

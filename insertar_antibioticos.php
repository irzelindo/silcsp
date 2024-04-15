<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codantibiot']=$_POST['codantibiot'];
   $_SESSION['nomantibiot']=$_POST['nomantibiot'];
   $_SESSION['abreviatura']=$_POST['abreviatura'];
   $_SESSION['diamresmen']=$_POST['diamresmen'];
   $_SESSION['diammedmin']=$_POST['diammedmin'];
   $_SESSION['diammedmax']=$_POST['diammedmax'];
   $_SESSION['diamsensmen']=$_POST['diamsensmen'];
   $_SESSION['codexterno']=$_POST['codexterno'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();

   $codantibiot = trim($_POST['codantibiot']);		
   $nomantibiot = trim($_POST['nomantibiot']);
   $abreviatura = $_POST['abreviatura'];
   $diamresmen = $_POST['diamresmen'];
   $diammedmin = $_POST['diammedmin'];
   $diammedmax = $_POST['diammedmax'];
   $diamsensmen = $_POST['diamsensmen'];
   $codexterno = $_POST['codexterno'];
	
   
	$query1 = "select * from antibioticos where codantibiot = '$codantibiot'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from antibioticos where nomantibiot = '$nomantibiot'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into antibioticos( codantibiot, nomantibiot, abreviatura, diamresmen, diammedmin, diammedmax,diamsensmen,codexterno) values ('$codantibiot', '$nomantibiot', '$abreviatura', '$diamresmen', '$diammedmin', '$diammedmax','$diamsensmen','$codexterno')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4316";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Antibioticos: Inserta-Reg.: ".$codantibiot."-".$nomantibiot;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: antibioticos.php?mensage=9");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_antibioticos.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_antibioticos.php?mensage2=2"); 
           }
       }
?>

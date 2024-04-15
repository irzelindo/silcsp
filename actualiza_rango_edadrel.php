<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['cgrupoedad']=$_POST['cgrupoedad'];
   $_SESSION['posicion']=$_POST['posicion'];
   $_SESSION['desdeedad']=$_POST['desdeedad'];
   $_SESSION['hastaedad']=$_POST['hastaedad'];
   $_SESSION['tipo']=$_POST['tipo'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $cgrupoedad = trim($_POST['cgrupoedad']);
   $posicion = 1*$_POST['posicion'];
   $desdeedad = $_POST['desdeedad'];
   $hastaedad = $_POST['hastaedad'];
   $tipo = $_POST['tipo'];

   if($desdeedad==''){$desdeedad=0;}
   if($hastaedad==''){$hastaedad=0;}
   if($tipo==''){$tipo=0;}
	
   
	$query1 = "select * from rangoedad where cgrupoedad = '$cgrupoedad' and desdeedad = '$desdeedad' and hastaedad = '$hastaedad' and tipo = '$tipo' and posicion<>$posicion";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 


    if ($nroreg1==0)
	   {
	 	$result = pg_query($conn, "UPDATE rangoedad set desdeedad=$desdeedad,
                                                        hastaedad=$hastaedad,
                                                        tipo='$tipo' 
                                           where cgrupoedad = '$cgrupoedad' and posicion = '$posicion'"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_4114";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Rango de Edades: Modifica-Reg.Rango: ".$cgrupoedad.', Posicion: '.$posicion.', Desde: '.$desdeedad.', hasta: '.$hastaedad;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_rango_edad.php?mensage=7&id=".$cgrupoedad);
       }
	else
       {
   		header("Location: modifica_rango_edadrel.php?mensage2=1&cgrupoedad=$cgrupoedad&posicion=$posicion"); 
       }
?>

<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['coddetermina']=$_POST['coddetermina'];
   $_SESSION['nomdetermina']=$_POST['nomdetermina'];

   $_SESSION['codumedida']    = $_POST['codumedida'];  
   $_SESSION['codresultado']    = $_POST['codresultado'];  
   $_SESSION['tipo']    = $_POST['tipo'];  
   $_SESSION['abreviatura']    = $_POST['abreviatura'];  
   $_SESSION['tiempohab']    = $_POST['tiempohab'];  
   $_SESSION['tiempourg']    = $_POST['tiempourg'];
$_SESSION['aliasdetermina']    = $_POST['aliasdetermina'];


      
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $coddetermina = trim($_POST['coddetermina']);
   $nomdetermina = trim($_POST['nomdetermina']);

   $codumedida    = $_POST['codumedida'];  
   $codresultado    = $_POST['codresultado'];  
   $tipo           = $_POST['tipo'];  
   $abreviatura    = $_POST['abreviatura'];  
   $tiempohab    = 1*$_POST['tiempohab'];  
   $tiempourg    = 1*$_POST['tiempourg'];

	if($_POST['aliasdetermina'] == '')
	   {
		   $aliasdetermina  = 'null';
	   }
	   else
	   {
		   $aliasdetermina  = "'".$_POST['aliasdetermina']."'";
	   }
  	
	$query1 = "select * from determinaciones where coddetermina = '$coddetermina'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from determinaciones where nomdetermina = '$nomdetermina'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into determinaciones( coddetermina, nomdetermina, codumedida, codresultado, tipo, abreviatura, tiempohab, tiempourg, aliasdetermina) values ('$coddetermina', '$nomdetermina', '$codumedida', '$codresultado', '$tipo', '$abreviatura', $tiempohab, $tiempourg, $aliasdetermina)"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_433";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Determinaciones: Inserta-Reg.: ".$coddetermina."-".$nomdetermina;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_determinaciones.php?id=".$coddetermina);
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_determinaciones.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_determinaciones.php?mensage2=2"); 
           }
       }
?>

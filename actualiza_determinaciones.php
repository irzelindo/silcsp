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
			
	   
	$coddetermina  = trim($_POST['coddetermina']);
	$nomdetermina  = trim($_POST['nomdetermina']);
	$nomdeterminax = trim($_POST['nomdeterminax']);
    
   $codumedida    = $_POST['codumedida'];  
   $codresultado    = $_POST['codresultado'];  
   $tipo           = $_POST['tipo'];  
   $abreviatura    = $_POST['abreviatura'];  
   $tiempohab    = 1*$_POST['tiempohab'];  
   $tiempourg    = 1*$_POST['tiempourg']; 
   $aliasdetermina    = $_POST['aliasdetermina'];
/*	
echo $coddetermina;
echo'<br>';
echo $nomdetermina;
echo'<br>';
echo $nomdeterminax;
*/   
	$query2 = "select * from determinaciones where nomdetermina = '$nomdetermina'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomdetermina==$nomdeterminax))
	   {
        $result = pg_query($conn,"UPDATE determinacionesmaster SET nomdetermina='$nomdetermina',
                                                                   codumedida='$codumedida', 
                                                                   codresultado='$codresultado', 
                                                                   tipo='$tipo', 
                                                                   abreviatura='$abreviatura', 
                                                                   tiempohab=$tiempohab, 
                                                                   tiempourg=$tiempourg  
                                                                   WHERE coddetermina='$coddetermina'"); 
     	
        //----------- ACTUALIZAR EN determinaciones para todos los estudios que lo incluyan ---------- //
        $result2 = pg_query($conn,"UPDATE determinaciones SET nomdetermina='$nomdetermina',
                                                                   codumedida='$codumedida', 
                                                                   codresultado='$codresultado', 
                                                                   tipo='$tipo', 
                                                                   abreviatura='$abreviatura', 
                                                                   tiempohab=$tiempohab, 
                                                                   tiempourg=$tiempourg,
																   aliasdetermina = '$aliasdetermina'
                                                                   WHERE coddetermina='$coddetermina'"); 
        
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_433";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Determinaciones: Modifica-Reg.: ".$coddetermina."-".$nomdetermina;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: determinaciones.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_determinaciones.php?id=$coddetermina&mensage2=2"); 
       }  

?>

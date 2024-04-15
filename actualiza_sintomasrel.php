<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codenferm']=$_POST['codenferm'];
   $_SESSION['nomsintoma']=$_POST['nomsintoma'];
   $_SESSION['nomsintomax']=$_POST['nomsintomax'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codenferm = trim($_POST['codenferm']);
   $nomsintoma = trim($_POST['nomsintoma']);
   $nomsintomax = trim($_POST['nomsintomax']);
   $norden = $_POST['norden'];
	
    $query = "select * from sintomas where nomsintoma = '$nomsintoma'";
    $result = pg_query($conn,$query);
    $row0 = pg_fetch_assoc($result); 
    $codsintoma=$row0['codsintoma'];
    $tipo=$row0['tipo'];

   
	$query1 = "select * from enfsintomas where codenferm = '$codenferm' and codsintoma = '$codsintoma' and tipo='$tipo'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 

    if ($nroreg1==0 || ($nroreg1>0 && $nomsintoma==$nomsintomax))
	   {
	 	$result = pg_query($conn, "UPDATE enfsintomas set codsintoma='$codsintoma', tipo='$tipo' 
                                           where codenferm = '$codenferm' and norden = '$norden'"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_421";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Sintomas de Enfermedades: Modifica-Reg.: ".$codenferm.', Cod.Sintoma: '.$codsintoma;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_enfermedades.php?mensage=7&id=".$codenferm);
       }
	else
       {
   		header("Location: modifica_sintomasrel.php?mensage2=1&codenferm=$codenferm&norden=$norden"); 
       }
?>

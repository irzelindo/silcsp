<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codservicio']=$_POST['codservicio'];
   $_SESSION['codarea']=$_POST['codarea'];
   $_SESSION['nomarea']=$_POST['nomarea'];
   $_SESSION['codsector']=$_POST['codsector'];


   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codservicio = trim($_POST['codservicio']);
   $codarea = trim($_POST['codarea']);
   $nomarea = trim($_POST['nomarea']);
   $codsector = trim($_POST['codsector']);
	
   
	$query1 = "select * from areasest where codservicio = '$codservicio' and codarea = '$codarea'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 

	$query2 = "select * from areasest where nomarea = '$nomarea' and codservicio='$codservicio'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into areasest( codservicio, codarea, nomarea, codsector) values ('$codservicio', '$codarea', '$nomarea', '$codsector')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_416";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Areas de Establecimientos: Inserta-Reg.: ".$codservicio."-".$nomservicio.', Cod.Area: '.$codarea;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_establecimientossa.php?mensage=9&id=".$codservicio."#areas");
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_areasrel.php?mensage2=1&codservicio=$codservicio"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_areasrel.php?mensage2=2&codservicio=$codservicio"); 
           }
       }       
?>

<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codservicio']=$_POST['codservicio'];
   $_SESSION['codarea']=$_POST['codarea'];
   $_SESSION['nomarea']=$_POST['nomarea'];
   $_SESSION['nomareax']=$_POST['nomcodareax'];
   $_SESSION['codsector']=$_POST['codsector'];

   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codservicio = trim($_POST['codservicio']);
   $codarea = trim($_POST['codarea']);
   $nomarea = trim($_POST['nomarea']);
   $nomareax = trim($_POST['nomareax']);
   $codsector = trim($_POST['codsector']);	
   
	$query1 = "select * from areasest where codservicio = '$codservicio' and nomarea = '$nomarea'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1); 


    if ($nroreg1==0 || ($nroreg1>0 && $nomarea==$nomareax))
	   {
	 	$result = pg_query($conn, "UPDATE areasest set codarea='$codarea',
                                                       nomarea='$nomarea', 
                                                       codsector='$codsector'  
                                           where codservicio = '$codservicio' and codarea = '$codarea'"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_416";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Areas de Establecimientos: Modifica-Reg.: ".$codservicio.', Cod.Area: '.$codarea;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_establecimientossa.php?mensage=7&id=".$codservicio."#areas");
       }
	else
       {
   		header("Location: modifica_areasrel.php?mensage2=2&codservicio=$codservicio&codarea=$codarea"); 
       }
?>

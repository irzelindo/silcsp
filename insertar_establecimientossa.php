<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codservicio']=$_POST['codservicio'];
   $_SESSION['nomservicio']=$_POST['nomservicio'];
   
   $_SESSION['tiposerv']=$_POST['tiposerv'];
   $_SESSION['director']=$_POST['director'];
   $_SESSION['dccion']=$_POST['dccion'];
   $_SESSION['telefono']=$_POST['telefono'];
   $_SESSION['email']=$_POST['email'];
   $_SESSION['region']          = $_POST['region'];
   $_SESSION['distrito']        = $_POST['distrito'];
   $_SESSION['establecimiento'] = $_POST['establecimiento'];

   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
   $codservicio = trim($_POST['codservicio']);
   $nomservicio = trim($_POST['nomservicio']);

   $tiposerv=$_POST['tiposerv'];
   $director=$_POST['director'];
   $dccion=$_POST['dccion'];
   $telefono=$_POST['telefono'];
   $email=$_POST['email'];

   $region          = $_POST['region'];
   $distrito        = $_POST['distrito'];
   $establecimiento = $_POST['establecimiento'];
   $codreg=substr($region,0,2);
   $subcreg=substr($region,2,3);	
   $_SESSION['codreg']=$codreg;
   $_SESSION['subcreg']=$subcreg;
   
      
	$query1 = "select * from establecimientos where codservicio = '$codservicio'";
    $result1 = pg_query($conn, $query1);
    $nroreg1=pg_num_rows($result1);

	$query2 = "select * from establecimientos where nomservicio = '$nomservicio'";
    $result2 = pg_query($conn, $query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg1==0 && $nroreg2==0)
	   {
	 	$result = pg_query($conn, "insert into establecimientos( codservicio, nomservicio, tiposerv, nomserv, director, dccion, telefono, email, codreg, subcreg, coddist, codserv) values ('$codservicio', '$nomservicio', '$tiposerv', '$nomserv', '$director', '$dccion', '$telefono', '$email', '$codreg', '$subcreg', '$distrito', '$establecimiento')"); 
    	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_416";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Establecimientos: Inserta-Reg.: ".$codservicio."-".$nomservicio;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: modifica_establecimientossa.php?id=".$codservicio);
       }
	else
       {
        if ($nroreg1!=0)
           {
       		header("Location: nuevo_establecimientossa.php?mensage2=1"); 
           }
        if ($nroreg2!=0)
           {
       		header("Location: nuevo_establecimientossa.php?mensage2=2"); 
           }
       }
?>

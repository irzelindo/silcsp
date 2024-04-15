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
			 
	$codservicio  = trim($_POST['codservicio']);
	$nomservicio  = trim($_POST['nomservicio']);
	$nomserviciox = trim($_POST['nomserviciox']);

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
    
/*	
echo $codservicio;
echo'<br>';
echo $nomservicio;
echo'<br>';
echo $nomserviciox;
*/   
	$query2 = "select * from establecimientos where nomservicio = '$nomservicio'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomservicio==$nomserviciox))
	   {
        $result = pg_query($conn,"UPDATE establecimientos SET nomservicio='$nomservicio',
                                                          tiposerv='$tiposerv', 
                                                          nomserv='$nomserv', 
                                                          director='$director', 
                                                          dccion='$dccion', 
                                                          telefono='$telefono', 
                                                          email='$email', 
                                                          codreg='$codreg', 
                                                          subcreg='$subcreg', 
                                                          coddist='$distrito', 
                                                          codserv='$establecimiento'   
                                                          WHERE codservicio='$codservicio'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_416";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Establecimientos: Modifica-Reg.: ".$codservicio."-".$nomservicio;
        $terminal = $_SERVER['REMOTE_ADDR'];
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: establecimientossa.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_establecimientossa.php?id=$codservicio&mensage2=2"); 
       }  

?>

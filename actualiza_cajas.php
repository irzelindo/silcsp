<?php 
@Header("Content-type: text/html; charset=utf-8");
   session_start();
   $_SESSION['codcaja']=$_POST['codcaja'];
   $_SESSION['nomcaja']=$_POST['nomcaja'];
   $_SESSION['codserviciox']=$_POST['codserviciox'];
   $_SESSION['regionx']=$_POST['regionx'];
   $_SESSION['codusucx']=$_POST['codusucx'];
   
   $codusu=$_SESSION['codusu'];      

   include("conexion.php");
   $conn=Conectarse();
			
	   
	$codcaja  = $_POST['codcaja'];
	$nomcaja  = trim($_POST['nomcaja']);
	$nomcajax = trim($_POST['nomcajax']);
    $codservicio = $_POST['codserviciox'];
    $codusuc = $_POST['codusuc'];
    $region = $_POST['regionx'];
       
/*	
echo $codcaja;
echo'<br>';
echo $nomcaja;
echo'<br>';
echo $nomcajax;
*/   
	$query2 = "select * from cajas where nomcaja = '$nomcaja'  and codservicio='$codservicio'";
    $result2 = pg_query($conn,$query2);
    $nroreg2=pg_num_rows($result2);

    if ($nroreg2==0 || ($nroreg2>0 && $nomcaja==$nomcajax))
	   {
        $result = pg_query($conn,"UPDATE cajas SET nomcaja='$nomcaja', codusu='$codusuc' WHERE codcaja='$codcaja' and codservicio='$codservicio'"); 
     	
		 // Bitacora
        include("bitacora.php");
	    $codopc = "V_443";
	    $fecha1=date("Y-n-j", time());
        $hora=date("G:i:s",time());
        $accion="Cajas: Modifica-Reg.: ".$codcaja."-".$nomcaja.", Servicio: ".$codservicio;
        $terminal = $_SERVER['REMOTE_ADDR']; 
        $a=archdlog($_SESSION['codusu'],$codopc,$fecha1,$hora,$accion,$terminal);
        // Fin grabacion de registro de auditoria
  
   		header("Location: cajas.php?mensage=7");
       }
	else
       {
   		header("Location: modifica_cajas.php?id=$codcaja&codservicio=$codservicio&mensage2=2"); 
       }  

?>
